<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.userManagement.index');
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
                'password' => 'required|string|min:8',
                'center_reg_id' => 'nullable|string',
                'center_name' => 'nullable|string',
                'center_location' => 'nullable|string',
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
            Log::info('User created.', ['user_id' => $user->id]);

            // Check if Economic Center data is provided
            $centerCreated = false;
            if (!empty($validated['center_reg_id']) && !empty($validated['center_name']) && !empty($validated['center_location'])) {
                $center = EconomicCenter::create([
                    'center_name' => $validated['center_name'],
                    'center_reg_id' => $validated['center_reg_id'],
                    'center_location' => $validated['center_location'],
                ]);
                Log::info('Economic Center created.', ['center_id' => $center->id]);
                $centerCreated = true;
            }

            // Set success message based on the outcome
            $message = $centerCreated
                ? 'User created with Economic Center successfully.'
                : 'User created successfully.';

            Log::info('Store method executed successfully.', ['message' => $message]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
