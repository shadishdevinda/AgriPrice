<?php

namespace App\Http\Controllers;

use App\Models\VegetableAdvice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class VegetableAdviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vegetableAdvice = VegetableAdvice::orderBy('created_at', 'DESC')->get();  // Use plural $vegetables for a collection
    
    // Pass the collection to the view
    return view('pages.admin.advice.vegetable_advice.index', [
        'vegetable_advice' => $vegetableAdvice  // Use plural form here
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.advice.vegetable_advice.create');
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
            return redirect()->route('vegetable_advice.create')->withInput()->withErrors($validator);
        }
    
        // Initialize the product object
        $vegetableAdvice = new VegetableAdvice();
        $vegetableAdvice->description = $request->description;
    
        // Save the vegetable_advice in the database
        $vegetableAdvice->save();
        return redirect()->route('vegetable_advice.index')->with('success', 'Vegetable Advice added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(VegetableAdvice $vegetableAdvice)
    {
        return view('pages.admin.advice.vegetable_advice.show', compact('vegetableAdvice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VegetableAdvice $vegetableAdvice)
    {
        return view('pages.admin.advice.vegetable_advice.edit', compact('vegetableAdvice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VegetableAdvice $vegetableAdvice)
    {
        $rules = [
            'description' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('vegetable_advice.edit',$vegetableAdvice->id)->withInput()->withErrors($validator);
        }
        //  update description
        $vegetableAdvice->description = $request->description;
    
        // Save the product in the database
        $vegetableAdvice->save();
    
        return redirect()->route('vegetable_advice.index')->with('success', 'vegetable_advice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $vegetableAdvice = VegetableAdvice::findOrFail($id);

        File::delete(public_path('uploads/vegetable_advice/'.$vegetableAdvice->image));
        $vegetableAdvice->delete();

        return redirect()->route('vegetable_advice.index')->with('success', 'vegetable_advice deleted successfully');
    }
}
