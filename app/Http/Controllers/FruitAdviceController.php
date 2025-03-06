<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\FruitAdvice;
use Illuminate\Http\Request;
use App\Models\FruitHasAdvice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FruitAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all fruits for the dropdown
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize the query for fruit advice
        $query = FruitAdvice::orderBy('created_at', 'DESC');

        // Filter by selected fruit (if a fruit is selected)
        if ($request->has('fruit_id') && $request->fruit_id) {
            $fruitId = $request->fruit_id;
            $query->whereHas('fruits', function ($q) use ($fruitId) {
                $q->where('fruit_id', $fruitId);
            });
        }

        // Fetch the filtered advice
        $fruit_advice = $query->paginate(10); // 10 items per page

        // Pass the data to the view
        return view('pages.admin.advice.fruit_advice.index', [
            'fruit_advice' => $fruit_advice,
            'fruits' => $fruits,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fruits = Fruit::pluck('name', 'name')->all();
        return view(
            'pages.admin.advice.fruit_advice.create',
            [
                'fruits' => $fruits
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'description' => 'required|min:3',
            'fruits' => 'required|array', // Ensure fruits is an array
        ]);

        Log::info('Validation successful.', ['validated_data' => $validated]);

        try {
            // Initialize the fruit advice object
            $fruitAdvice = new FruitAdvice();
            $fruitAdvice->description = $request->description;

            // Save the fruit advice in the database
            $fruitAdvice->save();

            // Attach the selected fruits to the advice
            foreach ($request->fruits as $fruitName) {
                // Find the fruit by name
                $fruit = Fruit::where('name', $fruitName)->first();

                if ($fruit) {
                    // Create a record in the fruit_has_advice table
                    FruitHasAdvice::create([
                        'advice_id' => $fruitAdvice->id,
                        'fruit_id' => $fruit->id,
                    ]);
                }
            }

            // Return JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Fruit Advice added successfully!',
                'data' => $fruitAdvice, // Optionally include the created advice object
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error storing fruit advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FruitAdvice $fruitAdvice)
    {
        // Load the related fruits
        $fruitAdvice->load('fruits');

        return view('pages.admin.advice.fruit_advice.show', compact('fruitAdvice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FruitAdvice $fruitAdvice)
    {
        // Fetch all fruits
        $fruits = Fruit::pluck('name', 'id')->all();

        // Fetch the IDs of currently associated fruits
        $associatedFruits = $fruitAdvice->fruits->pluck('id')->all();

        return view('pages.admin.advice.fruit_advice.edit', compact('fruitAdvice', 'fruits', 'associatedFruits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FruitAdvice $fruitAdvice)
    {
        // Validate the request
        $rules = [
            'description' => 'required|min:3',
            'fruits' => 'required|array', // Ensure fruits is an array
        ];

        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        try {
            // Update description
            $fruitAdvice->description = $request->description;
            $fruitAdvice->save();

            // Sync the associated fruits
            $fruitAdvice->fruits()->sync($request->fruits);

            // Return JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Fruit Advice updated successfully!',
                'data' => $fruitAdvice, // Optionally include the updated advice object
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating fruit advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the fruit advice by ID
            $fruitAdvice = FruitAdvice::findOrFail($id);

            // Delete the associated image file
            if ($fruitAdvice->image) {
                File::delete(public_path('uploads/vegetable_advice/' . $fruitAdvice->image));
            }

            // Delete the vegetable advice
            $fruitAdvice->delete();

            // Return JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Fruit advice deleted successfully!',
            ]);
        } catch (\Exception $e) {
            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the fruit advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
}
