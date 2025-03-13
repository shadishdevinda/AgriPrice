<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Mail\SendLoginCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EconomicCenterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize the query for market users filtering by 'center_id' not null
        $query = User::whereNotNull('center_id');

        // Apply filter if user_id is selected (optional)
        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('id', $request->user_id);
        }

        // Sort users by created_at in descending order (newest first)
        $query->orderBy('created_at', 'DESC');

        // Fetch filtered users with their related economic center, paginate results
        $users = $query->with('economicCenter')->paginate(10);

        // Fetch user options for the dropdown (ID, Name, Email)
        $userOptions = User::whereNotNull('center_id')
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => "{$user->id} - {$user->name} - {$user->email}"];
            });

        // Return the view with user data
        return view('pages.admin.userManagement.economic_center_user.index', compact('users', 'userOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch roles excluding 'system-admin' for selection
        $roles = Role::whereNotIn('name', ['system-admin'])->pluck('name', 'name')->all();

        // Fetch economic centers for selection
        $economicCenters = EconomicCenter::pluck('center_name', 'id')->all();

        // Return the view with available roles and economic centers
        return view('pages.admin.userManagement.economic_center_user.create', compact('roles', 'economicCenters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        // Wrap the operations in a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            Log::info('Economic center user assign method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_id' => 'required|exists:economic_center,id', // Ensure economic center exists
                'username' => 'required|string|max:255',             // Ensure username is provided
                'roles' => 'required|array',                          // Ensure roles are provided
                'email' => 'required|string|email|max:255|unique:users,email', // Ensure email is unique
                'password' => 'required|string|min:8|confirmed',     // Ensure password is strong and confirmed
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Ensure valid image if provided
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Create the new user related to the economic center
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'center_id' => $validated['center_id'],
                'password' => Hash::make($validated['password']),
            ]);

            // Sync roles with the validated roles (only valid roles from the request)
            $validatedRoles = array_intersect($request['roles'], Role::pluck('name')->toArray());
            $user->syncRoles($validatedRoles);

            // Handle profile photo upload if provided
            if ($request->hasFile('profile_photo')) {
                $existingPhoto = $user->profile_photo_path;

                // If a profile photo exists, delete the old one before uploading a new one
                if ($existingPhoto && Storage::disk('public')->exists('profile-photos/' . basename($existingPhoto))) {
                    Storage::disk('public')->delete('profile-photos/' . basename($existingPhoto));
                    Log::info('Old profile photo deleted.', ['file_path' => $existingPhoto, 'user_id' => $user->id]);
                }

                // Generate a unique filename using Str::random and store the photo
                $file = $request->file('profile_photo');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = Str::random(40) . '.' . $fileExtension; // Generate a random 40-character string as the filename
                $filePath = 'profile-photos/' . $fileName;

                // Store the file in 'public' disk under the 'profile-photos' directory
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the relative file path in the user's profile_photo_path field
                $user->profile_photo_path = $filePath;
                $user->save();

                Log::info('Profile photo uploaded.', ['file_path' => $filePath, 'user_id' => $user->id]);
            }

            Log::info('User assigned to economic center.', ['user_id' => $user->id]);

            // Send email with login credentials
            Mail::to($user->email)->send(new SendLoginCredentials($user->email, $validated['password']));
            Log::info('Login credentials email sent.', ['user_id' => $user->id]);

            // Commit the transaction since everything is successful
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User assigned to economic center successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, roll back the transaction
            DB::rollBack();
            Log::error('Validation failed', ['errors' => $e->validator->errors()->all()]);

            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // If any other exception occurs, roll back the transaction
            DB::rollBack();
            Log::error('An exception occurred.', ['exception' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Fetch roles excluding 'system-admin' to prevent assigning this role to users
        $roles = Role::whereNotIn('name', ['system-admin'])->pluck('name', 'name')->all();

        // Fetch current roles of the user and handle cases where roles may be null
        $userRoles = $user->roles ? $user->roles->pluck('name')->toArray() : [];

        // Return the view with necessary data (user, roles, and user roles)
        return view('pages.admin.userManagement.economic_center_user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Begin database transaction to ensure atomic operations
        DB::beginTransaction();

        try {
            // Log incoming request data for debugging and tracking purposes
            Log::info('Updating user with ID: ' . $user->id, ['request_data' => $request->all()]);

            // Validate the incoming request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'roles' => 'required|array', // Ensure roles are an array
                'password' => 'nullable|string|min:8|confirmed',
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Log validated data for debugging and tracking purposes
            Log::info('Validation passed for user update.', ['validated_data' => $validated]);

            // Handle the profile photo upload if a new photo is provided
            if ($request->hasFile('profile_photo')) {
                // Delete the old profile photo if it exists in storage
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                    Log::info('Old profile photo deleted.');
                }

                // Store the new profile photo and retrieve the storage path
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo_path'] = $path; // Store the full path
                Log::info('New profile photo uploaded.', ['path' => $path]);
            } else {
                // If no new photo is uploaded, retain the old profile photo path
                $validated['profile_photo_path'] = $user->profile_photo_path;
            }

            // Prepare data for updating the user record
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'profile_photo_path' => $validated['profile_photo_path'], // Ensure this is included
            ];

            // If a new password is provided, hash and include it in the update data
            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            // Log the data array before updating the user
            Log::info('Data array before update:', ['data' => $data]);

            // Perform the user update operation
            $user->update($data);

            // Log the updated user record for debugging and tracking purposes
            Log::info('User record after update:', ['user' => $user->fresh()]);

            // Sync the user roles with the provided roles from the request
            $user->syncRoles($validated['roles']);

            Log::info('User updated successfully.', ['user_id' => $user->id]);

            // Commit the database transaction
            DB::commit();

            // Return success response with a message
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors for debugging and tracking purposes
            Log::error('Validation error while updating user.', ['errors' => $e->validator->errors()->all()]);

            // Rollback transaction in case of validation errors
            DB::rollBack();

            // Return validation errors as JSON response
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected errors for debugging and tracking purposes
            Log::error('An unexpected error occurred while updating user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Rollback transaction in case of an exception
            DB::rollBack();

            // Return general errors as JSON response
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for assigning permissions to a user.
     */
    public function userPermissions(User $user)
    {
        // Retrieve all available permissions
        $permissions = Permission::all();

        // Return the view with the user and available permissions data
        return view('pages.admin.userManagement.economic_center_user.give-permissions', compact('user', 'permissions'));
    }

    public function givePermissions(Request $request, $userID)
    {
        DB::beginTransaction(); // Begin the transaction

        try {
            // Log incoming request data for auditing purposes
            Log::info('Giving permissions to user with ID: ' . $userID, ['request_data' => $request->all()]);

            // Validate the incoming request to ensure required data is present
            $validated = $request->validate([
                'permission' => 'required', // Ensure permission is provided
            ]);

            // Log validated data for debugging purposes
            Log::info('Validation passed for user permissions.', ['validated_data' => $validated]);

            // Find the user by ID, throw an error if not found
            $user = User::findOrFail($userID);

            // Sync permissions to the user
            $user->syncPermissions($validated['permission']);

            // Commit the transaction after successful permission sync
            DB::commit();

            // Log the successful permission update
            Log::info('Permissions given to user successfully.', ['user_id' => $user->id]);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Permissions given to user successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction if validation fails
            DB::rollBack();

            // Log validation exception errors
            Log::error('Validation error while giving permissions to user.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Rollback the transaction if any other unexpected error occurs
            DB::rollBack();

            // Log unexpected errors with full error details
            Log::error('An unexpected error occurred while giving permissions to user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Return a general error response
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction(); // Begin the transaction

        try {
            // Find the user by ID, throw an error if not found
            $user = User::findOrFail($id);
            Log::info('Economic center User found', ['user' => $user]);

            // Delete the user record
            $user->delete();

            // Commit the transaction after successful deletion
            DB::commit();

            // Log the successful user deletion
            Log::info('Economic center User deleted successfully.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Economic center User deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if any unexpected error occurs
            DB::rollBack();

            // Log unexpected errors with full error details
            Log::error('An unexpected error occurred while deleting user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Return a general error response
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
