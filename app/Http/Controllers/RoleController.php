<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles with optional filtering.
     */
    public function index(Request $request)
    {
        // Fetch all roles for dropdown filtering
        $roles = Role::pluck('name', 'id');

        // Initialize query builder for roles
        $query = Role::orderBy('created_at', 'DESC');

        // Apply filtering if a specific role is selected
        if ($request->has('role_id') && $request->role_id) {
            $query->where('id', $request->role_id);
        }

        // Paginate the filtered results
        $roleList = $query->paginate(10);
        $permissions = Permission::get();

        return view('pages.admin.roles-permissions.roles.index', [
            'roles' => $roles,
            'roleList' => $roleList,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created role in the database.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
            ]);

            // Create a new role
            Role::create(['name' => $validated['name']]);

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Role created successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack(); // Rollback transaction on error
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update an existing role in the database.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $id,
            ]);

            // Find and update the role
            $role = Role::findOrFail($id);
            $role->update(['name' => $validated['name']]);

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Assign permissions to a specific role.
     */
    public function givePermissions(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'array', // Ensure permissions input is an array
            'permission.*' => 'string|exists:permissions,name', // Validate each permission exists
        ]);

        try {
            DB::beginTransaction(); // Start transaction

            // Find the role and sync permissions
            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->permission);

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Permissions assigned successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a role from the database.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction(); // Start transaction

            // Find and delete the role
            $role = Role::findOrFail($id);
            $role->delete();

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Role not found.',
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
