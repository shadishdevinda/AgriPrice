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
        $vegetable_advice = $query->get();

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
        return view(
            'pages.admin.advice.vegetable_advice.create',
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
            'description' => 'required|min:3',
            'vegetables' => 'required|array', // Ensure vegetables is an array
        ]);

        Log::info('Validation successful.', ['validated_data' => $validated]);

        // Initialize the vegetable advice object
        $vegetableAdvice = new VegetableAdvice();
        $vegetableAdvice->description = $request->description;

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
                ]);
            }
        }

        return redirect()->route('vegetable_advice.index')->with('success', 'Vegetable Advice added successfully');
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
        if ($validator->fails()) {
            return redirect()->route('vegetable_advice.edit', $vegetableAdvice->id)->withInput()->withErrors($validator);
        }

        // Update description
        $vegetableAdvice->description = $request->description;
        $vegetableAdvice->save();

        // Sync the associated vegetables
        $vegetableAdvice->vegetables()->sync($request->vegetables);

        return redirect()->route('vegetable_advice.index')->with('success', 'Vegetable advice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vegetableAdvice = VegetableAdvice::findOrFail($id);

        File::delete(public_path('uploads/vegetable_advice/' . $vegetableAdvice->image));
        $vegetableAdvice->delete();

        return redirect()->route('vegetable_advice.index')->with('success', 'vegetable_advice deleted successfully');
    }
}
