<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FruitController extends Controller
{
    // Index method with pagination
    public function index(Request $request)
    {
        // Fetch all fruits for the dropdown filter
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize the query for fruits
        $query = Fruit::orderBy('created_at', 'DESC');

        // Filter by selected fruit (if a fruit is selected)
        if ($request->has('fruit_id') && $request->fruit_id) {
            $query->where('id', $request->fruit_id);
        }

        // Fetch the filtered fruits with pagination
        $fruitsList = $query->paginate(10); // 10 items per page

        // Pass the data to the view
        return view('pages.admin.category.fruits.index', [
            'fruits' => $fruits, // For the dropdown filter
            'fruitsList' => $fruitsList, // For displaying the filtered list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.fruits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation rules
            $rules = [
                'name' => 'required|min:3|max:255|unique:fruit',
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

            // Initialize the fruit object
            $fruit = new Fruit();
            $fruit->name = $request->name;
            $fruit->description = $request->description;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Generate a unique filename
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $fruit->name . '.' . time() . '.' . $fileExtension;
                $filePath = 'fruit-photos/' . $fileName;

                // Store the file in the 'public' disk
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the relative file path in the database
                $fruit->image = $filePath;

                // Log the image upload
                Log::info('New fruit photo uploaded.', ['path' => $filePath]);
            }

            // Save the fruit in the database
            $fruit->save();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Fruit added successfully',
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving fruit: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the fruit. Please try again.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        return view('pages.admin.category.fruits.show', compact('fruit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        return view('pages.admin.category.fruits.edit', compact('fruit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fruit $fruit)
    {
        try {
            // Validation rules
            $rules = [
                'name' => 'required|min:5',
                'description' => 'required|min:3',
                'image' => 'nullable|image'
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

            // Update fruit object
            $fruit->name = $request->name;
            $fruit->description = $request->description;

            // Handle the image upload if it exists
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($fruit->image) {
                    Storage::disk('public')->delete($fruit->image);
                }

                // Generate a unique filename
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $fruit->name . '.' . time() . '.' . $fileExtension;
                $filePath = 'fruit-photos/' . $fileName;

                // Store the file in the 'public' disk
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Store the relative file path in the database
                $fruit->image = $filePath;
            }

            // Save the fruit in the database
            $fruit->save();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Fruit updated successfully',
            ], 200);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating fruit: ' . $e->getMessage());

            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the fruit. Please try again.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        try {
            // Delete the fruit image if it exists
            if ($fruit->image) {
                Storage::disk('public')->delete($fruit->image);
            }

            // Delete the fruit
            $fruit->delete();

            return response()->json([
                'success' => true,
                'message' => 'Fruit deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting fruit: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
