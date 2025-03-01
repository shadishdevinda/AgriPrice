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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch vegetables ordered by created_at in descending order
        $fruits = Fruit::orderBy('created_at', 'DESC')->get();  // Use plural $vegetables for a collection

        // Pass the collection to the view
        return view('pages.admin.category.fruits.index', [
            'fruits' => $fruits  // Use plural form here
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
        // Validation rules
        $rules = [
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:1000',
            'Wholesale_Price' => 'required|numeric|min:0',
            'Retail_Price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Ensure the image is valid and has a reasonable size limit
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('fruit.create')->withInput()->withErrors($validator);
        }
        // Initialize the fruit object
        $fruit = new Fruit();
        $fruit->name = $request->name;
        $fruit->description = $request->description;
        $fruit->Wholesale_Price = $request->Wholesale_Price;
        $fruit->Retail_Price = $request->Retail_Price;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Generate a unique filename using Str::random
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            $fruitName = $request->name; // Get the fruit name
            $fileName = $fruitName . '.' . time() . '.' .  $fileExtension;
            $filePath = 'fruit-photos/' . $fileName; // Set the file path

            // Store the file in the 'public' disk, under the 'fruit-photos' directory
            Storage::disk('public')->put($filePath, file_get_contents($file));

            // Store the relative file path in the database
            $fruit->image = $filePath;

            // Log the image upload
            Log::info('New fruit photo uploaded.', ['path' => $filePath]);
        }

        // Save the fruit in the database
        try {
            $fruit->save();
            return redirect()->route('fruit.index')->with('success', 'Fruit added successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving fruit: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('fruit.create')->withInput()->with('error', 'An error occurred while saving the fruit. Please try again.');
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

        $rules = [
            'name' => 'required|min:5',
            'description' => 'required|min:3',
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
            'image' => 'nullable|image' // make sure the image is optional but must be an image file
        ];

        $validator = Fruit::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('fruit.edit', $fruit->id)->withInput()->withErrors($validator);
        }

        //  update product object
        $fruit->name = $request->name;
        $fruit->description = $request->description;
        $fruit->Wholesale_Price = $request->Wholesale_Price;
        $fruit->Retail_Price = $request->Retail_Price;

        // Handle the image upload if it exists
        if ($request->hasFile('image')) {

            File::delete(public_path('uploads/fruit/' . $fruit->image));

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // unique image name

            // Save the image in the 'uploads/products' directory
            $image->move(public_path('uploads/fruit'), $imageName);

            // Set the image name in the product object
            $fruit->image = $imageName;
        }

        // Save the product in the database
        $fruit->save();

        return redirect()->route('fruit.index')->with('success', 'fruit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fruit = Fruit::findOrFail($id);

        File::delete(public_path('uploads/fruit/' . $fruit->image));
        $fruit->delete();

        return redirect()->route('fruit.index')->with('success', 'fruit deleted successfully');
    }
}
