<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;
use App\Models\VegetableAdvice;
use App\Models\VegetableHasAdvice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VegetableAdviceController extends Controller
{
    /**
     * Display a listing of vegetable advice.
     */
    public function index(Request $request)
    {
        // Fetch all vegetables for the dropdown selection
        $vegetables = Vegetable::pluck('name', 'id')->all();

        // Initialize the query to fetch vegetable advice, ordered by the most recent
        $query = VegetableAdvice::orderBy('created_at', 'DESC');

        // Apply filtering if a specific vegetable is selected
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $vegetableId = $request->vegetable_id;
            $query->whereHas('vegetables', function ($q) use ($vegetableId) {
                $q->where('vegetable_id', $vegetableId);
            });
        }

        // Fetch paginated results (10 per page)
        $vegetable_advice = $query->paginate(10);

        return view('pages.admin.advice.vegetable_advice.index', [
            'vegetable_advice' => $vegetable_advice,
            'vegetables' => $vegetables,
        ]);
    }

    /**
     * Show the form for creating new vegetable advice.
     */
    public function create()
    {
        $vegetables = Vegetable::pluck('name', 'name')->all();
        return view('pages.admin.advice.vegetable_advice.create', compact('vegetables'));
    }

    /**
     * Store a newly created vegetable advice in the database.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'description' => 'required|min:3|unique:vegetable_advice,description',
            'vegetables' => 'required|array', // Ensure vegetables is an array
        ]);

        Log::info('Validation successful.', ['validated_data' => $validated]);

        DB::beginTransaction(); // Start database transaction
        try {
            // Create new vegetable advice
            $vegetableAdvice = VegetableAdvice::create([
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Attach selected vegetables
            foreach ($request->vegetables as $vegetableName) {
                $vegetable = Vegetable::where('name', $vegetableName)->first();
                if ($vegetable) {
                    VegetableHasAdvice::create([
                        'advice_id' => $vegetableAdvice->id,
                        'vegetable_id' => $vegetable->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            DB::commit(); // Commit transaction

            return response()->json([
                'success' => true,
                'message' => 'Vegetable Advice added successfully!',
                'data' => $vegetableAdvice,
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on failure
            Log::error('Error storing vegetable advice:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error adding vegetable advice.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified vegetable advice details.
     */
    public function show(VegetableAdvice $vegetableAdvice)
    {
        $vegetableAdvice->load('vegetables');
        return view('pages.admin.advice.vegetable_advice.show', compact('vegetableAdvice'));
    }

    /**
     * Show the form for editing an existing vegetable advice.
     */
    public function edit(VegetableAdvice $vegetableAdvice)
    {
        $vegetables = Vegetable::pluck('name', 'id')->all();
        $associatedVegetables = $vegetableAdvice->vegetables->pluck('id')->all();
        return view('pages.admin.advice.vegetable_advice.edit', compact('vegetableAdvice', 'vegetables', 'associatedVegetables'));
    }

    /**
     * Update the specified vegetable advice in the database.
     */
    public function update(Request $request, VegetableAdvice $vegetableAdvice)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|min:3',
            'vegetables' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction(); // Start transaction
        try {
            // Update description
            $vegetableAdvice->update(['description' => $request->description, 'updated_at' => now()]);

            // Sync associated vegetables
            $vegetableAdvice->vegetables()->sync($request->vegetables);

            DB::commit(); // Commit changes

            return response()->json(['success' => true, 'message' => 'Vegetable advice updated successfully!', 'data' => $vegetableAdvice]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            Log::error('Error updating vegetable advice:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error updating vegetable advice.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified vegetable advice from the database.
     */
    public function destroy($id)
    {
        DB::beginTransaction(); // Start transaction
        try {
            $vegetableAdvice = VegetableAdvice::findOrFail($id);

            // Delete associated image file if exists
            if ($vegetableAdvice->image) {
                File::delete(public_path('uploads/vegetable_advice/' . $vegetableAdvice->image));
            }

            // Delete the vegetable advice record
            $vegetableAdvice->delete();

            DB::commit(); // Commit deletion

            return response()->json(['success' => true, 'message' => 'Vegetable advice deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on failure
            return response()->json(['success' => false, 'message' => 'Error deleting vegetable advice.', 'error' => $e->getMessage()], 500);
        }
    }
}
