<?php

namespace App\Http\Controllers;
use App\Models\Vegetable;
use App\Models\Fruit;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vegetable = Vegetable::orderBy('created_at', 'DESC')->get();
        $fruit = Fruit::orderBy('created_at', 'DESC')->get();   // Use plural $vegetables for a collection

        // Pass the collection to the view
        return view('pages.market.dashboard.dashboard', compact('fruit','vegetable'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'Wholesale_Price' => 'required|numeric',
        'Retail_Price' => 'required|numeric',
    ]);

    // Determine the type of item based on the request URL
    if ($request->is('vegetable/*')) {
        $item = Vegetable::findOrFail($id);
    } elseif ($request->is('fruit/*')) {
        $item = Fruit::findOrFail($id);
    } else {
        return response()->json(['success' => false, 'message' => 'Invalid type specified.'], 400);
    }

    // Update the prices
    $item->Wholesale_Price = $request->Wholesale_Price;
    $item->Retail_Price = $request->Retail_Price;
    $item->save();

    return response()->json(['success' => true]);
}

    /**
     * Display the market profile.
     */
    public function marketProfile()
    {
        return view('pages.market.profile.show');
    }
}
