<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;
use App\Models\VegetableAdvice;
use App\Models\VegetableHasAdvice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class VegetableAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all vegetables for the dropdown
        $vegetables = Vegetable::pluck('name', 'id')->all();

        // Initialize the query for vegetable advice
        $query = VegetableAdvice::orderBy('created_at', 'DESC');

        // Filter by selected vegetable (if a vegetable is selected)
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $vegetableId = $request->vegetable_id;
            $query->whereHas('vegetables', function ($q) use ($vegetableId) {
                $q->where('vegetable_id', $vegetableId);
            });
        }

        // Fetch the filtered advice
        $vegetable_advice = $query->paginate(10); // 10 items per page

        // Pass the data to the view
        return view('pages.admin.advice.vegetable_advice.index', [
            'vegetable_advice' => $vegetable_advice,
            'vegetables' => $vegetables,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vegetables = Vegetable::pluck('name', 'name')->all();
        return view('pages.admin.advice.vegetable_advice.create',
            [
                'vegetables' => $vegetables
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
            'description' => 'required|min:3|unique:vegetable_advice,description',
            'vegetables' => 'required|array', // Ensure vegetables is an array
        ]);

        Log::info('Validation successful.', ['validated_data' => $validated]);

        try {
            // Initialize the vegetable advice object
            $vegetableAdvice = new VegetableAdvice();
            $vegetableAdvice->description = $request->description;

            // Manually set the created_at and updated_at timestamps
            $vegetableAdvice->created_at = now(); // Current timestamp
            $vegetableAdvice->updated_at = now(); // Current timestamp

            // Save the vegetable advice in the database
            $vegetableAdvice->save();

            // Attach the selected vegetables to the advice
            foreach ($request->vegetables as $vegetableName) {
                // Find the vegetable by name
                $vegetable = Vegetable::where('name', $vegetableName)->first();

                if ($vegetable) {
                    // Create a record in the vegetable_has_advice table
                    VegetableHasAdvice::create([
                        'advice_id' => $vegetableAdvice->id,
                        'vegetable_id' => $vegetable->id,
                        'created_at' => now(), // Set created_at timestamp
                        'updated_at' => now(), // Set updated_at timestamp
                    ]);
                }
            }

            // Return a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Vegetable Advice added successfully!',
                'data' => $vegetableAdvice, // Optionally include the created advice object
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error storing vegetable advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the vegetable advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(VegetableAdvice $vegetableAdvice)
    {
        // Load the related vegetables
        $vegetableAdvice->load('vegetables');

        return view('pages.admin.advice.vegetable_advice.show', compact('vegetableAdvice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VegetableAdvice $vegetableAdvice)
    {
        // Fetch all vegetables
        $vegetables = Vegetable::pluck('name', 'id')->all();

        // Fetch the IDs of currently associated vegetables
        $associatedVegetables = $vegetableAdvice->vegetables->pluck('id')->all();

        return view('pages.admin.advice.vegetable_advice.edit', compact('vegetableAdvice', 'vegetables', 'associatedVegetables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VegetableAdvice $vegetableAdvice)
    {
        // Validate the request
        $rules = [
            'description' => 'required|min:3',
            'vegetables' => 'required|array', // Ensure vegetables is an array
        ];

        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }

        try {
            // Update description
            $vegetableAdvice->description = $request->description;

            // Explicitly update the updated_at column
            $vegetableAdvice->updated_at = now(); // Manually set the updated_at timestamp

            // Save the vegetable advice in the database
            $vegetableAdvice->save();

            // Sync the associated vegetables
            $vegetableAdvice->vegetables()->sync($request->vegetables);

            // Return JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Vegetable advice updated successfully!',
                'data' => $vegetableAdvice, // Optionally include the updated advice object
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating vegetable advice:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the vegetable advice.',
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
            // Find the vegetable advice by ID
            $vegetableAdvice = VegetableAdvice::findOrFail($id);

            // Delete the associated image file
            if ($vegetableAdvice->image) {
                File::delete(public_path('uploads/vegetable_advice/' . $vegetableAdvice->image));
            }

            // Delete the vegetable advice
            $vegetableAdvice->delete();

            // Return JSON response for success
            return response()->json([
                'success' => true,
                'message' => 'Vegetable advice deleted successfully!',
            ]);
        } catch (\Exception $e) {
            // Return JSON response for error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the vegetable advice.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
}
