<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view('pages.admin.roles-permissions.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
            ]);

            // Create a new permission
            Permission::create(['name' => $validated['name']]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully.',
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
                'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            ]);

            // Find and update the permission
            $permission = Permission::findOrFail($id);
            $permission->update(['name' => $validated['name']]);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully.',
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find and delete the permission
            $permission = Permission::findOrFail($id);
            $permission->delete();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully.',
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Permission not found.',
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
