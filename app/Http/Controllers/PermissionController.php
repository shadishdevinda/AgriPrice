<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch all permissions for the dropdown filter
        $permissions = Permission::pluck('name', 'id')->all();

        // Initialize query for permissions
        $query = Permission::orderBy('created_at', 'DESC');

        // Apply filtering if a specific permission is selected
        if ($request->has('permission_id') && $request->permission_id) {
            $query->where('id', $request->permission_id);
        }

        // Fetch filtered permissions with pagination (10 per page)
        $permissionsList = $query->paginate(10);

        // Pass data to the view
        return view('pages.admin.roles-permissions.permissions.index', [
            'permissions' => $permissions, // Dropdown filter options
            'permissionsList' => $permissionsList, // Paginated permissions
        ]);
    }

    /**
     * Store a newly created permission in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
            ]);

            // Use database transaction for safe data handling
            DB::transaction(function () use ($validated) {
                Permission::create(['name' => $validated['name']]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified permission.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            ]);

            // Use transaction to safely update permission
            DB::transaction(function () use ($id, $validated) {
                $permission = Permission::findOrFail($id);
                $permission->update(['name' => $validated['name']]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->all(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            // Use transaction to ensure data integrity
            DB::transaction(function () use ($id) {
                $permission = Permission::findOrFail($id);
                $permission->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Permission not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
