<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\FruitAdvice;
use Illuminate\Http\Request;
use App\Models\FruitHasAdvice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FruitAdviceController extends Controller
{
    /**
     * Display a listing of the fruit advice.
     */
    public function index(Request $request)
    {
        // Fetch all fruits for the dropdown list
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize the query for fruit advice
        $query = FruitAdvice::orderBy('created_at', 'DESC');

        // Filter fruit advice by selected fruit (if a fruit is selected)
        if ($request->has('fruit_id') && $request->fruit_id) {
            $fruitId = $request->fruit_id;
            $query->whereHas('fruits', function ($q) use ($fruitId) {
                $q->where('fruit_id', $fruitId);
            });
        }

        // Fetch the filtered fruit advice with pagination (10 items per page)
        $fruit_advice = $query->paginate(10);

        // Pass data to the view
        return view('pages.admin.advice.fruit_advice.index', [
            'fruit_advice' => $fruit_advice,
            'fruits' => $fruits,
        ]);
    }

    /**
     * Show the form for creating a new fruit advice resource.
     */
    public function create()
    {
        // Fetch all fruits to display in the dropdown for advice creation
        $fruits = Fruit::pluck('name', 'name')->all();

        return view('pages.admin.advice.fruit_advice.create', [
            'fruits' => $fruits
        ]);
    }

    /**
     * Store a newly created fruit advice in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'description' => 'required|min:3',
            'fruits' => 'required|array', // Ensure 'fruits' is an array
        ]);

        Log::info('Validation successful.', ['validated_data' => $validated]);

        // Begin database transaction for safer operations
        DB::beginTransaction();

        try {
            // Initialize a new fruit advice object
            $fruitAdvice = new FruitAdvice();
            $fruitAdvice->description = $request->description;

            // Save the fruit advice to the database
            $fruitAdvice->save();

            // Attach selected fruits to the fruit advice
            foreach ($request->fruits as $fruitName) {
                // Find the fruit by its name
                $fruit = Fruit::where('name', $fruitName)->first();

                if ($fruit) {
                    // Create a record in the fruit_has_advice table to associate the fruit with advice
                    FruitHasAdvice::create([
                        'advice_id' => $fruitAdvice->id,
                        'fruit_id' => $fruit->id,
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Fruit Advice added successfully!',
                'data' => $fruitAdvice, // Optionally include the created advice object
            ]);
        } catch (\Exception $e) {
            // In case of an error, roll back the transaction
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error storing fruit advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified fruit advice.
     */
    public function show(FruitAdvice $fruitAdvice)
    {
        // Load the associated fruits with the fruit advice
        $fruitAdvice->load('fruits');

        // Return the view with the fruit advice data
        return view('pages.admin.advice.fruit_advice.show', compact('fruitAdvice'));
    }

    /**
     * Show the form for editing the specified fruit advice.
     */
    public function edit(FruitAdvice $fruitAdvice)
    {
        // Fetch all fruits to display in the dropdown for advice editing
        $fruits = Fruit::pluck('name', 'id')->all();

        // Get the IDs of the fruits that are already associated with this advice
        $associatedFruits = $fruitAdvice->fruits->pluck('id')->all();

        // Return the edit view with the fruit advice, fruits list, and associated fruits
        return view('pages.admin.advice.fruit_advice.edit', compact('fruitAdvice', 'fruits', 'associatedFruits'));
    }

    /**
     * Update the specified fruit advice in storage.
     */
    public function update(Request $request, FruitAdvice $fruitAdvice)
    {
        // Validate the incoming request data
        $rules = [
            'description' => 'nullable|min:3',
            'fruits' => 'nullable|array', // Ensure 'fruits' is an array
        ];

        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return a JSON response with validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        // Begin database transaction for safer operations
        DB::beginTransaction();

        try {
            // Update the description of the fruit advice
            $fruitAdvice->description = $request->description;
            $fruitAdvice->save();

            // Sync the associated fruits (this will update the pivot table)
            $fruitAdvice->fruits()->sync($request->fruits);

            // Commit the transaction
            DB::commit();

            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Fruit Advice updated successfully!',
                'data' => $fruitAdvice, // Optionally include the updated advice object
            ]);
        } catch (\Exception $e) {
            // In case of an error, roll back the transaction
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error updating fruit advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Remove the specified fruit advice from storage.
     */
    public function destroy($id)
    {
        // Begin database transaction for safer operations
        DB::beginTransaction();

        try {
            // Find the fruit advice by ID
            $fruitAdvice = FruitAdvice::findOrFail($id);

            // Delete the associated image file if it exists
            if ($fruitAdvice->image) {
                File::delete(public_path('uploads/vegetable_advice/' . $fruitAdvice->image));
            }

            // Delete the fruit advice record
            $fruitAdvice->delete();

            // Commit the transaction
            DB::commit();

            // Return a JSON response indicating success
            return response()->json([
                'success' => true,
                'message' => 'Fruit advice deleted successfully!',
            ]);
        } catch (\Exception $e) {
            // In case of an error, roll back the transaction
            DB::rollBack();

            // Return a JSON response indicating failure
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
}
