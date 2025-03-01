<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('pages.admin.roles-permissions.roles.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
            ]);

            // Create a new permission
            Role::create(['name' => $validated['name']]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Return general errors as JSON
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
            ]);

            // Find and update the permission
            $role = Role::findOrFail($id);
            $role->update(['name' => $validated['name']]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            // Return general errors as JSON
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function givePermissions(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required',
        ]);

        try {
            // Find the role
            $role = Role::findOrFail($roleId);

            // Sync the permissions
            $role->syncPermissions($request->permission);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Permissions assigned successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        } catch (\Exception $e) {
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
            // Find and delete the role
            $role = Role::findOrFail($id);
            $role->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        } catch (\Exception $e) {
            // Return general errors as JSON
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
