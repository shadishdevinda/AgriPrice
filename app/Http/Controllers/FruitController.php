<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FruitController extends Controller
{
    // Index method with pagination
    public function index(Request $request)
    {
        // Fetch all fruits for the dropdown filter
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize the query for fruits, ordered by created_at in descending order
        $query = Fruit::orderBy('created_at', 'DESC');

        // Filter by selected fruit if a fruit_id is provided in the request
        if ($request->has('fruit_id') && $request->fruit_id) {
            $query->where('id', $request->fruit_id);
        }

        // Fetch the filtered list of fruits with pagination
        $fruitsList = $query->paginate(10); // 10 items per page

        // Return the view with the necessary data
        return view('pages.admin.category.fruits.index', [
            'fruits' => $fruits,  // Data for dropdown filter
            'fruitsList' => $fruitsList,  // Data for displaying filtered fruits
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
        // Begin transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Define validation rules
            $rules = [
                'name' => 'required|min:3|max:255|unique:fruits',
                'description' => 'required|min:3|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules);

            // If validation fails, return a JSON response with validation errors
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            // Create a new fruit object and populate its properties
            $fruit = new Fruit();
            $fruit->name = $request->name;
            $fruit->description = $request->description;

            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Generate a unique filename for the uploaded image
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $fruit->name . '.' . time() . '.' . $fileExtension;
                $filePath = 'fruit-photos/' . $fileName;

                // Store the image on the public disk
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Save the relative file path to the database
                $fruit->image = $filePath;

                // Log the image upload event
                Log::info('New fruit photo uploaded.', ['path' => $filePath]);
            }

            // Save the fruit object in the database
            $fruit->save();

            // Commit the transaction to finalize the changes
            DB::commit();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Fruit added successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error saving fruit: ' . $e->getMessage());

            // Return a generic error response
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
        // Begin transaction for update operation
        DB::beginTransaction();

        try {
            // Validation rules for updating the fruit
            $rules = [
                'name' => 'required|min:5',
                'description' => 'required|min:3',
                'image' => 'nullable|image',
            ];

            // Validate the incoming request data
            $validator = Validator::make($request->all(), $rules);

            // If validation fails, return a JSON response with errors
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all(),
                ], 422);
            }

            // Update fruit properties with the new values
            $fruit->name = $request->name;
            $fruit->description = $request->description;

            // Handle image upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($fruit->image) {
                    Storage::disk('public')->delete($fruit->image);
                }

                // Generate a unique filename for the new image
                $file = $request->file('image');
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = $fruit->name . '.' . time() . '.' . $fileExtension;
                $filePath = 'fruit-photos/' . $fileName;

                // Store the image on the public disk
                Storage::disk('public')->put($filePath, file_get_contents($file));

                // Update the database with the new image path
                $fruit->image = $filePath;
            }

            // Save the updated fruit object to the database
            $fruit->save();

            // Commit the transaction to finalize the update
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Fruit updated successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error updating fruit: ' . $e->getMessage());

            // Return a generic error message
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
        // Begin transaction to ensure safe deletion
        DB::beginTransaction();

        try {
            // Delete the fruit image if it exists
            if ($fruit->image) {
                Storage::disk('public')->delete($fruit->image);
            }

            // Delete the fruit record from the database
            $fruit->delete();

            // Commit the transaction to finalize the deletion
            DB::commit();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Fruit deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error deleting fruit: ' . $e->getMessage());

            // Return an error response
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
