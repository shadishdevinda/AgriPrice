<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\SendLoginCredentials;
use Illuminate\Support\Facades\Mail;

class EconomicCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all economic centers for the dropdown
        $userOptions = EconomicCenter::all()->mapWithKeys(function ($economicCenter) {
            return [
                $economicCenter->id => "{$economicCenter->id} - {$economicCenter->center_name}"
            ];
        });

        // Base query for economic centers
        $query = EconomicCenter::orderBy('created_at', 'DESC');

        // Apply filter if economicCenter_id is provided
        if ($request->has('economicCenter_id') && $request->economicCenter_id) {
            $query->where('id', $request->economicCenter_id);
        }

        // Paginate the results
        $economicCenters = $query->paginate(10);

        return view('pages.admin.economicCenter.index', compact('economicCenters', 'userOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.economicCenter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            Log::info('Store method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_id' => 'required|string|max:255|unique:economic_center,id',
                'center_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'center_location' => 'required|string',
                'center_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Handle the center photo upload if provided
            $photoPath = null; // Default value

            if ($request->hasFile('center_photo')) {
                // Store the new profile photo
                $photoPath = $request->file('center_photo')->store('center-photos', 'public');
                Log::info('New center photo uploaded.', ['path' => $photoPath]);
            }

            // Create new economic center including profile_photo_path
            $eCenter = EconomicCenter::create([
                'id' => $validated['center_id'],
                'center_name' => $validated['center_name'],
                'contact_number' => $validated['contact_number'],
                'center_location' => $validated['center_location'],
                'profile_photo_path' => $photoPath, // Store the image path
            ]);

            Log::info('Economic center created successfully.', ['eCenter' => $eCenter]);

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Economic center created successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction on validation error
            DB::rollBack();
            Log::error('Validation failed.', ['errors' => $e->validator->errors()->all()]);

            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Rollback the transaction on exception
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
    public function edit(EconomicCenter $economicCenter)
    {
        return view('pages.admin.economicCenter.edit', compact('economicCenter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EconomicCenter $economicCenter)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Log incoming request data
            Log::info('Updating economic center with ID ' . $economicCenter->id, ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_name' => 'required|string|max:255',
                'contact_number' => 'required|string|max:255',
                'center_location' => 'required|string',
            ]);

            // Log validate data
            Log::info('Validation passed for economic center update.', ['validated_data' => $validated]);

            // Handle the profile photo upload if provided
            if ($request->hasFile('center-photo')) {
                // Delete the old profile photo if it exists
                if ($economicCenter->profile_photo_path && Storage::disk('public')->exists($economicCenter->profile_photo_path)) {
                    Storage::disk('public')->delete($economicCenter->profile_photo_path);
                    Log::info('Old profile photo deleted.');
                }

                // Store the new profile photo
                $path = $request->file('center-photo')->store('center-photo', 'public');
                $validated['profile_photo_path'] = $path; // Store the full path
                Log::info('New profile photo uploaded.', ['path' => $path]);
            } else {
                // If no new photo, retain the old one
                $validated['profile_photo_path'] = $economicCenter->profile_photo_path;
            }

            // Prepare data for update
            $data = [
                'center_name' => $validated['center_name'],
                'contact_number' => $validated['contact_number'],
                'center_location' => $validated['center_location'],
            ];

            // Update the economic center record
            $economicCenter->update($data);

            Log::info('Economic center updated successfully.');

            // Commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Economic Center Updated Successfully !',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction on validation error
            DB::rollBack();
            Log::error('Validation error while updating economic center.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->all(),
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            Log::error("An unexpected error occurred while updating user.", [
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
     * Show the form for assigning a user to an economic center.
     */
    public function assignUserPage(EconomicCenter $economicCenter)
    {
        $roles = Role::whereNotIn('name', ['system-admin'])->pluck('name', 'name')->all();
        return view('pages.admin.economicCenter.assignUser', compact('economicCenter', 'roles'));
    }

    /**
     * Assign a user to an economic center.
     */
    public function assignUser(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            Log::info('Economic center user assign method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_id' => 'required|string',
                'username' => 'required|string|max:255',
                'roles' => 'required|array',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 8 characters
                    'confirmed', // Must match password_confirmation
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', // Password strength
                ],
                'password_confirmation' => 'required|string|min:8',
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Create new user related with the economic center
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'center_id' => $validated['center_id'],
                'password' => Hash::make($validated['password']),
            ]);

            // Sync roles
            $validatedRoles = array_intersect($request['roles'], Role::pluck('name')->toArray());
            $user->syncRoles($validatedRoles);

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

            Log::info('User assigned to economic center.', ['user_id' => $user->id]);

            // Send email with login credentials
            Mail::to($user->email)->send(new SendLoginCredentials($user->email, $validated['password']));

            Log::info('Login credentials email sent.', ['user_id' => $user->id]);

            // Commit the transaction
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User assigned to economic center.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction on validation error
            DB::rollBack();
            Log::error('Validation failed', ['errors' => $e->validator->errors()->all()]);

            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            Log::error('An exception occurred.', ['exception' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            $eCenter = EconomicCenter::findOrFail($id);
            Log::info('Economic center found', ['Economic Center' => $eCenter]);

            // Delete profile photo if exists
            if ($eCenter->profile_photo_path) {
                $photoPath = 'public/center-photos/' . basename($eCenter->profile_photo_path);

                if (Storage::exists($photoPath)) {
                    Storage::delete($photoPath);
                    Log::info('Profile photo deleted.', ['file_path' => $photoPath]);
                }
            }

            // Delete the economic center
            $eCenter->delete();
            Log::info('Economic center deleted successfully.', ['id' => $eCenter->id]);

            // Commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Economic center deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction on exception
            DB::rollBack();
            Log::error('An unexpected error occurred while deleting Economic center.', [
                'error_message' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
