<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VegetableController extends Controller
{
    /**
     * Display a listing of vegetables with optional filtering.
     */
    public function index(Request $request)
    {
        // Fetch all vegetables for the dropdown selection.
        $vegetables = Vegetable::pluck('name', 'id')->all();

        // Initialize query for listing vegetables, ordered by latest entry.
        $query = Vegetable::orderBy('created_at', 'DESC');

        // Apply filtering if a vegetable is selected.
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $query->where('id', $request->vegetable_id);
        }

        // Paginate results (10 items per page).
        $vegetablesList = $query->paginate(10);

        return view('pages.admin.category.vegetables.index', [
            'vegetables' => $vegetables,
            'vegetablesList' => $vegetablesList,
        ]);
    }

    /**
     * Show the form for creating a new vegetable entry.
     */
    public function create()
    {
        return view('pages.admin.category.vegetables.create');
    }

    /**
     * Store a newly created vegetable in the database.
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required|min:3|max:255|unique:vegetable',
            'description' => 'required|min:3|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        // Validate request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Create a new Vegetable entry
            $vegetable = new Vegetable();
            $vegetable->name = $request->name;
            $vegetable->description = $request->description;

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $request->name . '.' . time() . '.' . $fileExtension;
                $filePath = 'vegetable-photos/' . $fileName;

                // Store image in the 'public' disk
                Storage::disk('public')->put($filePath, file_get_contents($file));
                $vegetable->image = $filePath;

                // Log successful image upload
                Log::info('New vegetable photo uploaded.', ['path' => $filePath]);
            }

            // Save the vegetable in the database
            $vegetable->save();

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vegetable added successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error saving vegetable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the vegetable. Please try again.',
            ], 500);
        }
    }

    /**
     * Display details of a specific vegetable.
     */
    public function show(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.show', compact('vegetable'));
    }

    /**
     * Show the form for editing an existing vegetable entry.
     */
    public function edit(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.edit', compact('vegetable'));
    }

    /**
     * Update an existing vegetable in the database.
     */
    public function update(Request $request, Vegetable $vegetable)
    {
        // Validation rules
        $rules = [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        // Validate request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all(),
            ], 422);
        }

        // Begin database transaction
        DB::beginTransaction();

        try {
            // Update vegetable details
            $vegetable->name = $request->name;
            $vegetable->description = $request->description;

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($vegetable->image) {
                    Storage::disk('public')->delete($vegetable->image);
                }

                // Store the new image
                $image = $request->file('image');
                $fileName = $request->name . '.' . time() . '.' . $image->getClientOriginalExtension();
                $filePath = 'vegetable-photos/' . $fileName;
                Storage::disk('public')->put($filePath, file_get_contents($image));
                $vegetable->image = $filePath;
            }

            // Save updated details in the database
            $vegetable->save();

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vegetable updated successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error updating vegetable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the vegetable. Please try again.',
            ], 500);
        }
    }

    /**
     * Delete a vegetable from the database.
     */
    public function destroy(Vegetable $vegetable)
    {
        // Begin database transaction
        DB::beginTransaction();

        try {
            // Delete image if it exists
            if ($vegetable->image) {
                Storage::disk('public')->delete($vegetable->image);
            }

            // Delete the vegetable entry from the database
            $vegetable->delete();

            // Commit transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vegetable deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error deleting vegetable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the vegetable. Please try again.',
            ], 500);
        }
    }
}
