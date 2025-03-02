<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class VegetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all vegetables for the dropdown
        $vegetables = Vegetable::pluck('name', 'id')->all();

        // Initialize the query for vegetables
        $query = Vegetable::orderBy('created_at', 'DESC');

        // Filter by selected vegetable (if a vegetable is selected)
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $query->where('id', $request->vegetable_id);
        }

        // Fetch the filtered vegetables with pagination
        $vegetablesList = $query->paginate(10); // 10 items per page

        // Pass the data to the view
        return view('pages.admin.category.vegetables.index', [
            'vegetables' => $vegetables, // For the dropdown filter
            'vegetablesList' => $vegetablesList, // For displaying the filtered list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.vegetables.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation rules
            $rules = [
                'name' => 'required|min:3|max:255|unique:vegetables',
                'description' => 'required|min:3|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];

            // Validate the request
            $validator = Validator::make($request->all(), $rules);

            // If validation fails, return JSON response with errors
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            // Initialize the vegetable object
            $vegetable = new Vegetable();
            $vegetable->name = $request->name;
            $vegetable->description = $request->description;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Generate a unique filename using Str::random
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $vegetableName = $request->name; // Get the vegetable name
                $fileName = $vegetableName . '.' . time() . '.' . $fileExtension;
                $filePath = 'vegetable-photos/' . $fileName;

                // Store the file in the 'public' disk, under the 'vegetable-photos' directory
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the relative file path in the database
                $vegetable->image = $filePath;

                // Log the image upload
                Log::info('New vegetable photo uploaded.', ['path' => $filePath]);
            }

            // Save the vegetable in the database
            $vegetable->save();

            return response()->json([
                'success' => true,
                'message' => 'Product added successfully',
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving vegetable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the product. Please try again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.show', compact('vegetable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.edit', compact('vegetable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vegetable $vegetable)
    {
        try {
            $rules = [
                'name' => 'required|min:5',
                'description' => 'required|min:3',
                'image' => 'nullable|image' // make sure the image is optional but must be an image file
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            // Update product object
            $vegetable->name = $request->name;
            $vegetable->description = $request->description;

            // Handle the image upload if it exists
            if ($request->hasFile('image')) {
                File::delete(public_path('uploads/vegetable/' . $vegetable->image));

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . '.' . $ext; // unique image name

                // Save the image in the 'uploads/products' directory
                $image->move(public_path('uploads/vegetable'), $imageName);

                // Set the image name in the product object
                $vegetable->image = $imageName;
            }

            // Save the product in the database
            $vegetable->save();

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
            ], 200);
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
    public function destroy(Vegetable $vegetable)
    {
        try {
            // Delete the fruit image if it exists
            if ($vegetable->image) {
                Storage::disk('public')->delete($vegetable->image);
            }

            // Delete the fruit
            $vegetable->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vegetable deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting vegetable: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
