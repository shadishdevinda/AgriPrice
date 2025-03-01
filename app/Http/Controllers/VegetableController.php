<?php

namespace App\Http\Controllers;

use App\Models\Vegetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class VegetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch vegetables ordered by created_at in descending order
        $vegetables = Vegetable::orderBy('created_at', 'DESC')->get();  // Use plural $vegetables for a collection

        // Pass the collection to the view
        return view('pages.admin.category.vegetables.index', [
            'vegetables' => $vegetables  // Use plural form here
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.vegetables.create');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->route('vegetable.create')->withInput()->withErrors($validator);
        }

        // Initialize the vegetable object
        $vegetable = new Vegetable();
        $vegetable->name = $request->name;
        $vegetable->description = $request->description;
        $vegetable->Wholesale_Price = $request->Wholesale_Price;
        $vegetable->Retail_Price = $request->Retail_Price;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Generate a unique filename using Str::random
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            $vegetableName = $request->name; // Get the vegetable name
            $fileName = $vegetableName . '.' . time() . '.' .  $fileExtension;
            $filePath = 'vegetable-photos/' . $fileName;

            // Store the file in the 'public' disk, under the 'vegetable-photos' directory
            Storage::disk('public')->put($filePath, file_get_contents($file));

            // Store the relative file path in the database
            $vegetable->image = $filePath;

            // Log the image upload
            Log::info('New vegetable photo uploaded.', ['path' => $filePath]);
        }

        // Save the vegetable in the database
        try {
            $vegetable->save();
            return redirect()->route('vegetable.index')->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving vegetable: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('vegetable.create')->withInput()->with('error', 'An error occurred while saving the product. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.show', compact('vegetable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vegetable $vegetable)
    {
        return view('pages.admin.category.vegetables.edit', compact('vegetable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vegetable $vegetable)
    {

        $rules = [
            'name' => 'required|min:5',
            'description' => 'required|min:3',
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
            'image' => 'nullable|image' // make sure the image is optional but must be an image file
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('vegetable.edit', $vegetable->id)->withInput()->withErrors($validator);
        }

        //  update product object
        $vegetable->name = $request->name;
        $vegetable->description = $request->description;
        $vegetable->Wholesale_Price = $request->Wholesale_Price;
        $vegetable->Retail_Price = $request->Retail_Price;

        // Handle the image upload if it exists
        if ($request->hasFile('image')) {

            File::delete(public_path('uploads/vegetable/' . $vegetable->image));

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // unique image name

            // Save the image in the 'uploads/products' directory
            $image->move(public_path('uploads/vegetable'), $imageName);

            // Set the image name in the product object
            $vegetable->image = $imageName;
        }

        // Save the product in the database
        $vegetable->save();

        return redirect()->route('vegetable.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vegetable = Vegetable::findOrFail($id);

        File::delete(public_path('uploads/vegetable/' . $vegetable->image));
        $vegetable->delete();

        return redirect()->route('vegetable.index')->with('success', 'Product deleted successfully');
    }
}
