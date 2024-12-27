<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class EconomicCenterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', 'market-user')->paginate(10);
        $roles = Role::pluck('name', 'name')->all();
        return view('pages.admin.userManagement.economic_center_user.index', compact('users', 'roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $economicCenters = EconomicCenter::pluck('center_name', 'id')->all();
        return view('pages.admin.userManagement.economic_center_user.create', compact('roles', 'economicCenters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Economic center user assign method called.', ['request_data' => $request->all()]);

            // Validate the request data
            $validated = $request->validate([
                'center_id' => 'required|exists:economic_center,id',
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
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name')->toArray(); // Get an array of role names
        $userRoles = $user->roles ? $user->roles->pluck('name')->toArray() : []; // Handle null cases
        return view('pages.admin.userManagement.economic_center_user.edit', compact('user', 'roles', 'userRoles'));
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
