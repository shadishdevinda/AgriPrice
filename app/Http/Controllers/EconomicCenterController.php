<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EconomicCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $economicCenters = EconomicCenter::paginate(3);
        return view('pages.admin.economicCenter.index', compact('economicCenters'));
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

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Economic center created successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed.', ['errors' => $e->validator->errors()->all()]);

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

            // Prepare data for update
            $data = [
                'center_name' => $validated['center_name'],
                'contact_number' => $validated['contact_number'],
                'center_location' => $validated['center_location'],
            ];

            // Update the economic center record
            $economicCenter->update($data);

            Log::info('Economic center updated successfully.');

            return response()->json([
                'success' => true,
                'message' => 'Economic Center Updated Successfully !',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation exception error
            Log::error('Validation error while updating economic center.', ['errors' => $e->validator->errors()->all()]);

            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->all(),
            ]);
        } catch (\Exception $e) {
            // Log unexpected errors
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

    public function assignUserPage(EconomicCenter $economicCenter)
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('pages.admin.economicCenter.assignUser', compact('economicCenter', 'roles'));
    }

    public function assignUser(Request $request)
    {
        try {
            Log::info('Economic center user assign method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_id' => 'required|string',
                'user_type' => 'required|string',
                'username' => 'required|string|max:255',
                'roles' => 'required|array',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            Log::info('Validation successful.', ['validated_data' => $validated]);

            // Create new user related with the economic center
            $user = User::create([
                'name' => $validated['username'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
                'center_id' => $validated['center_id'],
                'password' => Hash::make($validated['password']),
            ]);

            // Sync roles
            $validatedRoles = array_intersect($request['roles'], Role::pluck('name')->toArray());
            $user->syncRoles($validatedRoles);

            // Handle file upload
            if ($request->hasFile('profile_photo')) {
                $user->profile_photo_path = $request->file('profile_photo')->store('profile_photos', 'public');
                $user->save();
            }

            Log::info('User assigned to economic center.', ['user_id' => $user->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'User assigned to economic center.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->validator->errors()->all()]);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the Economic center by ID
            $eCenter = EconomicCenter::findOrFail($id);
            Log::info('Economic center found', ['Economic Center' => $eCenter]);

            // Delete the Economic center
            $eCenter->delete();
            Log::info('Economic center deleted successfully.', ['id' => $eCenter->id]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Economic center deleted successfully.',
            ]);
        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('An unexpected error occurred while deleting Economic center.', [
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
