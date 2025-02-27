<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\FruitAdvice;
use Illuminate\Http\Request;

class FruitAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruitAdvice = FruitAdvice::orderBy('created_at', 'DESC')->get();  // Use plural $vegetables for a collection
    
    // Pass the collection to the view
    return view('pages.admin.advice.fruit_advice.index', [
        'fruit_advice' => $fruitAdvice  // Use plural form here
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.advice.fruit_advice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'description' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('fruit_advice.create')->withInput()->withErrors($validator);
        }
    
        // Initialize the product object
        $fruitAdvice = new FruitAdvice();
        $fruitAdvice->description = $request->description;
    
        // Save the vegetable_advice in the database
        $fruitAdvice->save();
        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FruitAdvice $fruitAdvice)
    {
        return view('pages.admin.advice.fruit_advice.show', compact('fruitAdvice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FruitAdvice $fruitAdvice)
    {
        return view('pages.admin.advice.fruit_advice.edit', compact('fruitAdvice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FruitAdvice $fruitAdvice)
    {
        $rules = [
            'description' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('fruit_advice.edit',$fruitAdvice->id)->withInput()->withErrors($validator);
        }
        //  update description
        $fruitAdvice->description = $request->description;
    
        // Save the product in the database
        $fruitAdvice->save();
    
        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fruitAdvice = FruitAdvice::findOrFail($id);

        File::delete(public_path('uploads/fruit_advice/'.$fruitAdvice->image));
        $fruitAdvice->delete();

        return redirect()->route('fruit_advice.index')->with('success', 'Fruit Advice deleted successfully');
    }
}
