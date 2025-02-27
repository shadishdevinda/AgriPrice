<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;


class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::where('user_type', 'system-user')->paginate(5);
        $roles = Role::pluck('name', 'name')->all();
        return view('pages.admin.userManagement.system_user.index', compact('users', 'roles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('pages.admin.userManagement.system_user.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Store method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'user_type' => 'required|string',
                'roles' => 'required',
                'password' => 'required|string|min:8|confirmed',
                'center_reg_id' => 'nullable|string',
                'center_name' => 'nullable|string',
                'center_location' => 'nullable|string',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Create a new user
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
                'center_id' => $validated['center_reg_id'] ?? null,
                'password' => Hash::make($validated['password']),
            ]);

            $user->syncRoles($validated['roles']);

            // Handle profile photo upload
            if ($request->hasFile('profile_photo')) {
                $existingPhoto = $user->profile_photo_path;

                // If a profile photo exists, delete the old one before uploading a new one
                if ($existingPhoto && Storage::disk('public')->exists('profile-photos/' . basename($existingPhoto))) {
                    Storage::disk('public')->delete('profile-photos/' . basename($existingPhoto));
                    Log::info('Old profile photo deleted.', ['file_path' => $existingPhoto, 'user_id' => $user->id]);
                }

                // Generate a unique filename using Str::random
                $file = $request->file('profile_photo');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = Str::random(40) . '.' . $fileExtension; // Generate a 40-character random string as the filename
                $filePath = 'profile-photos/' . $fileName;

                // Store the file in the 'public' disk, under the 'profile-photos' directory
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the new file URL in the database, but remove the '/storage' part
                $user->profile_photo_path = $filePath;  // Store just the relative path
                $user->save();

                Log::info('Profile photo uploaded.', ['file_path' => $filePath, 'user_id' => $user->id]);
            }

            Log::info('User created.', ['user_id' => $user->id]);

            // // Check if Economic Center data is provided
            // $centerCreated = false;
            // if (!empty($validated['center_reg_id']) && !empty($validated['center_name']) && !empty($validated['center_location'])) {
            //     $center = EconomicCenter::create([
            //         'center_name' => $validated['center_name'],
            //         'center_reg_id' => $validated['center_reg_id'],
            //         'center_location' => $validated['center_location'],
            //     ]);
            //     Log::info('Economic Center created.', ['center_id' => $center->id]);
            //     $centerCreated = true;
            // }
            // // Set success message based on the outcome
            // $message = $centerCreated
            //     ? 'User created with Economic Center successfully.'
            //     : 'User created successfully.';

            // Log::info('Store method executed successfully.', ['message' => $message]);

            // // Return success response
            // return response()->json([
            //     'success' => true,
            //     'message' => $message,
            // ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
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
        $roles = Role::pluck('name')->toArray(); // Get an array of role names
        $userRoles = $user->roles ? $user->roles->pluck('name')->toArray() : []; // Handle null cases
        return view('pages.admin.userManagement.system_user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            // Log incoming request data
            Log::info('Updating user with ID: ' . $user->id, ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'user_type' => 'required|string',
                'roles' => 'required',
                'password' => 'nullable|string|min:8|confirmed',
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Log validated data
            Log::info('Validation passed for user update.', ['validated_data' => $validated]);

            // Handle the profile photo upload if provided
            if ($request->hasFile('profile_photo')) {
                // Delete the old profile photo if it exists
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                    Log::info('Old profile photo deleted.');
                }

                // Store the new profile photo
                $path = $request->file('profile_photo')->store('profile-photos', 'public');
                $validated['profile_photo_path'] = $path; // Store the full path
                Log::info('New profile photo uploaded.', ['path' => $path]);
            } else {
                // If no new photo, retain the old one
                $validated['profile_photo_path'] = $user->profile_photo_path;
            }

            // Prepare data for update
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
                'profile_photo_path' => $validated['profile_photo_path'], // Ensure this is included
            ];

            // Update password if provided
            if (!empty($validated['password'])) {
                $data['password'] = Hash::make($validated['password']);
            }

            // Log the data array before updating
            Log::info('Data array before update:', ['data' => $data]);

            // Update the user record
            $user->update($data);

            // Log the updated user record
            Log::info('User record after update:', ['user' => $user->fresh()]);

            // Sync roles
            $user->syncRoles($validated['roles']);

            Log::info('User updated successfully.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation exception errors
            Log::error('Validation error while updating user.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected errors
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
        $permissions = Permission::all();
        return view('pages.admin.userManagement.system_user.give-permissions', compact('user', 'permissions'));
    }

    public function givePermissions(Request $request, $userID)
    {
        try {
            // Log incoming request data
            Log::info('Giving permissions to user with ID: ' . $userID, ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'permission' => 'required',
            ]);

            // Log validated data
            Log::info('Validation passed for user permissions.', ['validated_data' => $validated]);

            // Find the user by ID
            $user = User::findOrFail($userID);

            // Sync permissions
            $user->syncPermissions($validated['permission']);

            Log::info('Permissions given to user successfully.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Permissions given to user successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation exception errors
            Log::error('Validation error while giving permissions to user.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('An unexpected error occurred while giving permissions to user.', [
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
            Log::info('User found', ['user' => $user]);

            // Delete the user
            $user->delete();
            Log::info('User deleted successfully.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('An unexpected error occurred while deleting user.', [
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
}
