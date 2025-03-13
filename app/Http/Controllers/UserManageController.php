<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use App\Mail\SendLoginCredentials;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize the query for system users, filtering those with a null center_id
        $query = User::whereNull('center_id');

        // Apply filter if user_id is provided in the request
        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('id', $request->user_id);
        }

        // Sort the users by created_at in descending order (newest first)
        $query->orderBy('created_at', 'DESC');

        // Paginate the users, showing 10 per page
        $users = $query->paginate(10);

        // Fetch users for the dropdown (ID, Name, Email), ensuring users have null center_id
        $userOptions = User::whereNull('center_id')
            ->get()
            ->mapWithKeys(function ($user) {
                return [$user->id => "{$user->id} - {$user->name} - {$user->email}"];
            });

        // Return the view with users and user options for the dropdown
        return view('pages.admin.userManagement.system_user.index', compact('users', 'userOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all roles except 'system-user' and 'market-user' for the second dropdown
        $roles = Role::whereNotIn('name', ['market-admin'])->pluck('name', 'name')->all();

        // Return the view with roles data
        return view('pages.admin.userManagement.system_user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Start a database transaction to ensure safer operations
        DB::beginTransaction();

        try {
            Log::info('Store method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'roles' => 'required',
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 8 characters
                    'confirmed', // Must match password_confirmation
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', // Password strength
                ],
                'password_confirmation' => 'required|string|min:8',
                'center_reg_id' => 'nullable|string',
                'center_name' => 'nullable|string',
                'center_location' => 'nullable|string',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Create a new user within a database transaction
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'center_id' => $validated['center_reg_id'] ?? null,
                'password' => Hash::make($validated['password']),
            ]);

            // Sync roles with the newly created user
            $user->syncRoles($validated['roles']);

            // Handle profile photo upload, if any
            if ($request->hasFile('profile_photo')) {
                $existingPhoto = $user->profile_photo_path;

                // If a profile photo exists, delete the old one before uploading a new one
                if ($existingPhoto && Storage::disk('public')->exists('profile-photos/' . basename($existingPhoto))) {
                    Storage::disk('public')->delete('profile-photos/' . time() . basename($existingPhoto));
                    Log::info('Old profile photo deleted.', ['file_path' => $existingPhoto, 'user_id' => $user->id]);
                }

                // Generate a unique filename using Str::random and store the profile photo
                $file = $request->file('profile_photo');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = Str::random(40) . '.' . $fileExtension;
                $filePath = 'profile-photos/' . $fileName;

                // Store the file in the 'public' disk, under the 'profile-photos' directory
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Save the profile photo path in the database
                $user->profile_photo_path = $filePath;
                $user->save();

                Log::info('Profile photo uploaded.', ['file_path' => $filePath, 'user_id' => $user->id]);
            }

            Log::info('User created.', ['user_id' => $user->id]);

            // Send email with login credentials
            Mail::to($user->email)->send(new SendLoginCredentials($user->email, $validated['password']));

            Log::info('Login credentials email sent.', ['user_id' => $user->id]);

            // Commit the transaction if everything was successful
            DB::commit();

            // Return success response with user details
            return response()->json([
                'success' => true,
                'message' => 'User created successfully.',
                'user_id' => $user->id,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction in case of validation error
            DB::rollBack();
            Log::error('Validation failed.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an unexpected error
            DB::rollBack();
            Log::error('An exception occurred.', ['exception' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit(User $user)
    {
        // Fetch all roles except 'market-admin' for the second dropdown in the form
        $roles = Role::whereNotIn('name', ['market-admin'])->pluck('name', 'name')->all();

        // Fetch the current user's roles and handle the case where the user has no roles assigned
        $userRoles = $user->roles ? $user->roles->pluck('name')->toArray() : [];

        // Return the view for editing a user, passing the user, available roles, and the user's current roles
        return view('pages.admin.userManagement.system_user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction(); // Begin the database transaction to ensure atomicity of operations

        try {
            // Log incoming request data for debugging purposes
            Log::info('Updating user with ID: ' . $user->id, ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255', // Ensure the name is required and a string
                'email' => 'required|email|unique:users,email,' . $user->id, // Ensure unique email, except for the current user
                'roles' => 'required', // Ensure at least one role is selected
                'password' => 'nullable|string|min:8|confirmed', // Optional password field, with confirmation
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional profile photo field, with validation
            ]);

            // Log the validated data
            Log::info('Validation passed for user update.', ['validated_data' => $validated]);

            // Handle profile photo upload if provided
            if ($request->hasFile('profile_photo')) {
                // If the user has an existing profile photo, delete the old one
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                    Log::info('Old profile photo deleted.');
                }

                // Store the new profile photo and get the file path
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo_path'] = $path; // Store the full path in the validated data
                Log::info('New profile photo uploaded.', ['path' => $path]);
            } else {
                // If no new photo is uploaded, retain the old profile photo
                $validated['profile_photo_path'] = $user->profile_photo_path;
            }

            // Prepare the data array for the user update
            $data = [
                'name' => $validated['name'], // Update the name
                'email' => $validated['email'], // Update the email
                'profile_photo_path' => $validated['profile_photo_path'], // Update the profile photo path
            ];

            // If a new password is provided, hash and include it in the data array
            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            // Log the data that will be used to update the user
            Log::info('Data array before update:', ['data' => $data]);

            // Update the user record with the new data
            $user->update($data);

            // Log the updated user record after the update
            Log::info('User record after update:', ['user' => $user->fresh()]);

            // Sync the roles for the user
            $user->syncRoles($validated['roles']);

            // Commit the transaction if everything is successful
            DB::commit();

            // Log successful user update
            Log::info('User updated successfully.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction in case of validation failure
            DB::rollBack();

            // Log validation exception errors
            Log::error('Validation error while updating user.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Rollback the transaction in case of any unexpected error
            DB::rollBack();

            // Log unexpected errors with details
            Log::error('An unexpected error occurred while updating user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Return general errors as JSON
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function userPermissions(User $user)
    {
        // Fetch all available permissions for the user to assign
        $permissions = Permission::all();

        // Return the view for giving permissions to a user
        return view('pages.admin.userManagement.system_user.give-permissions', compact('user', 'permissions'));
    }

    public function givePermissions(Request $request, $userID)
    {
        // Start a database transaction for safe operations
        DB::beginTransaction();

        try {
            // Log incoming request data for debugging purposes
            Log::info('Giving permissions to user with ID: ' . $userID, ['request_data' => $request->all()]);

            // Validate the request data to ensure permissions are correct
            $validated = $request->validate([
                'permission' => 'nullable|array', // Allow no permissions selected (empty array)
                'permission.*' => 'string|exists:permissions,name', // Ensure each permission exists in the permissions table
            ]);

            // Log validated data
            Log::info('Validation passed for user permissions.', ['validated_data' => $validated]);

            // Find the user by ID, will throw a ModelNotFoundException if not found
            $user = User::findOrFail($userID);

            // Sync the selected permissions with the user (this removes any old ones and adds new ones)
            $user->syncPermissions($validated['permission'] ?? []); // Use an empty array if no permissions are selected

            // Log the successful syncing of permissions
            Log::info('Permissions synced for user successfully.', [
                'user_id' => $user->id,
                'permissions' => $validated['permission'] ?? []
            ]);

            // Commit the transaction after successfully syncing the permissions
            DB::commit();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Permissions updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation error while giving permissions to user.', ['errors' => $e->validator->errors()->all()]);

            // Rollback the transaction if validation fails
            DB::rollBack();

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error('An unexpected error occurred while giving permissions to user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Rollback the transaction if any exception occurs
            DB::rollBack();

            // Return a general error message
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        // Start a database transaction for safe operations
        DB::beginTransaction();

        try {
            // Find the user by ID, will throw a ModelNotFoundException if not found
            $user = User::findOrFail($id);
            Log::info('User found', ['user' => $user]);

            // Delete the user's profile photo if it exists
            if ($user->profile_photo_path) {
                // Construct the path to the profile photo
                $photoPath = 'public/storage/profile-photos/' . basename($user->profile_photo_path);

                // Check if the photo file exists before deleting
                if (file_exists($photoPath)) {
                    unlink($photoPath); // Delete the profile photo
                    Log::info('User profile photo deleted.', ['profile_photo_path' => $photoPath]);
                } else {
                    // Log a warning if the photo is not found
                    Log::warning('Profile photo not found at path:', ['profile_photo_path' => $photoPath]);
                }
            }

            // Delete the user from the database
            $user->delete();
            Log::info('User deleted successfully.', ['user_id' => $user->id]);

            // Commit the transaction after the user is successfully deleted
            DB::commit();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error('An unexpected error occurred while deleting user.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            // Rollback the transaction if any exception occurs
            DB::rollBack();

            // Return a general error message
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

}
