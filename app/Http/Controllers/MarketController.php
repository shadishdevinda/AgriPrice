<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\Vegetable;
use Illuminate\Http\Request;
use App\Models\EconomicCenter;
use App\Models\CenterHasFruits;
use App\Models\CenterHasVegetables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the economic center details for the market user
        $economicCenter = null;
        if ($user && $user->user_type === 'market-user') {
            $economicCenter = EconomicCenter::find($user->center_id);
        }

        // Fetch all vegetables and fruits for the dropdown filters
        $vegetables = Vegetable::pluck('name', 'id')->all();
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize the query for vegetables
        $vegetableQuery = Vegetable::orderBy('created_at', 'DESC');

        // Initialize the query for fruits
        $fruitQuery = Fruit::orderBy('created_at', 'DESC');

        // Filter by selected vegetable (if a vegetable is selected)
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $vegetableQuery->where('id', $request->vegetable_id);
        }

        // Filter by selected fruit (if a fruit is selected)
        if ($request->has('fruit_id') && $request->fruit_id) {
            $fruitQuery->where('id', $request->fruit_id);
        }

        // Fetch the filtered vegetables with pagination
        $vegetablesList = $vegetableQuery->paginate(10); // 10 items per page

        // Fetch the filtered fruits with pagination
        $fruitList = $fruitQuery->paginate(10); // 10 items per page

        // Fetch the prices from the center_has_vegetable table
        $vegetablePrices = CenterHasVegetables::where('center_id', $user->center_id)
            ->select('vegetable_id', 'vegetable_wholesale_price', 'vegetable_retail_price')
            ->get()
            ->keyBy('vegetable_id') // Use vegetable_id as the key
            ->toArray();

        $fruitPrices = CenterHasFruits::where('center_id', $user->center_id)
            ->select('fruit_id', 'fruit_wholesale_price', 'fruit_retail_price')
            ->get()
            ->keyBy('fruit_id') // Use fruit_id as the key
            ->toArray();

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'vegetablesList' => view('pages.market.dashboard.vegetable-table', [
                    'vegetablesList' => $vegetablesList,
                    'vegetablePrices' => $vegetablePrices,
                ])->render(),
                'fruitList' => view('pages.market.dashboard.fruit-table',[
                    'fruitList' => $fruitList,
                    'fruitPrices' => $fruitPrices,
                ])->render(),
                'pagination' => [
                    'vegetables' => $vegetablesList->links()->toHtml(),
                    'fruits' => $fruitList->links()->toHtml(),
                ],
            ]);
        }

        // Return full view for normal requests
        return view('pages.market.dashboard.dashboard', [
            'vegetables' => $vegetables, // For the dropdown filter
            'vegetablesList' => $vegetablesList, // For displaying the filtered list
            'vegetablePrices' => $vegetablePrices, // For the prices
            'fruits' => $fruits, // For the dropdown filter
            'fruitPrices' => $fruitPrices, // For the prices
            'fruitList' => $fruitList, // For displaying the filtered list
            'economicCenter' => $economicCenter,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified vegetable prices resource in storage.
     */
    public function vegetableUpdate(Request $request, $id)
    {
        // Log the incoming request data
        Log::info('Update request received:', [
            'id' => $id,
            'data' => $request->all(),
        ]);

        $request->validate([
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
        ]);

        // Get the authenticated user (market user)
        $user = Auth::user();

        // Log the authenticated user
        Log::info('Authenticated user:', [
            'user_id' => $user->id,
            'center_id' => $user->center_id,
        ]);

        try {
            // Ensure the request is for vegetables
            if ($request->is('market/vegetable/*')) {
                // Update the prices in the center_has_vegetable table
                CenterHasVegetables::updateOrCreate(
                    [
                        'center_id' => $user->center_id, // Use the market user's center_id
                        'vegetable_id' => $id,          // Use the vegetable ID
                    ],
                    [
                        'vegetable_wholesale_price' => $request->Wholesale_Price,
                        'vegetable_retail_price' => $request->Retail_Price,
                    ]
                );

                // Log the center_has_vegetable update
                Log::info('center_has_vegetable updated:', [
                    'center_id' => $user->center_id,
                    'vegetable_id' => $id,
                    'vegetable_wholesale_price' => $request->Wholesale_Price,
                    'vegetable_retail_price' => $request->Retail_Price,
                ]);
            } else {
                Log::error('Invalid type specified in the request URL.');
                return response()->json(['success' => false, 'message' => 'Invalid type specified.'], 400);
            }

            // Log success
            Log::info('Prices updated successfully.');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating prices:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'An error occurred while updating the prices.'], 500);
        }
    }

    /**
     * Update the specified fruit prices resource in storage.
     */
    public function fruitUpdate(Request $request, $id)
    {
        // Log the incoming request data
        Log::info('Update request received:', [
            'id' => $id,
            'data' => $request->all(),
        ]);

        $request->validate([
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
        ]);

        // Get the authenticated user (market user)
        $user = Auth::user();

        // Log the authenticated user
        Log::info('Authenticated user:', [
            'user_id' => $user->id,
            'center_id' => $user->center_id,
        ]);

        try {
            // Ensure the request is for fruits
            if ($request->is('market/fruit/*')) {
                // Update the prices in the center_has_fruit table
                CenterHasFruits::updateOrCreate(
                    [
                        'center_id' => $user->center_id, // Use the market user's center_id
                        'fruit_id' => $id,                // Use the fruit ID
                    ],
                    [
                        'fruit_wholesale_price' => $request->Wholesale_Price,
                        'fruit_retail_price' => $request->Retail_Price,
                    ]
                );

                // Log the center_has_fruit update
                Log::info('center_has_fruit updated:', [
                    'center_id' => $user->center_id,
                    'fruit_id' => $id,
                    'fruit_wholesale_price' => $request->Wholesale_Price,
                    'fruit_retail_price' => $request->Retail_Price,
                ]);
            } else {
                Log::error('Invalid type specified in the request URL.');
                return response()->json(['success' => false, 'message' => 'Invalid type specified.'], 400);
            }

            // Log success
            Log::info('Prices updated successfully.');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating prices:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'An error occurred while updating the prices.'], 500);
        }
    }

    /**
     * Display the market profile.
     */
    public function marketProfile()
    {
        return view('pages.market.profile.show');
    }
}

