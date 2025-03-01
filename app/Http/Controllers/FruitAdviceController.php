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
        $fruit_advice = $query->get();

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

        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice added successfully');
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
        if ($validator->fails()) {
            return redirect()->route('fruit_advice.edit', $fruitAdvice->id)->withInput()->withErrors($validator);
        }

        // Update description
        $fruitAdvice->description = $request->description;
        $fruitAdvice->save();

        // Sync the associated fruits
        $fruitAdvice->fruits()->sync($request->fruits);

        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fruitAdvice = FruitAdvice::findOrFail($id);

        File::delete(public_path('uploads/fruit_advice/' . $fruitAdvice->image));
        $fruitAdvice->delete();

        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice deleted successfully');
    }
}
