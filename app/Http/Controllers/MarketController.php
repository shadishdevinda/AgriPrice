<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fruit;
use App\Models\Vegetable;
use Illuminate\Http\Request;
use App\Models\MarketRequest;
use App\Models\EconomicCenter;
use App\Models\CenterHasFruits;
use App\Models\CenterHasVegetables;
use Illuminate\Support\Facades\Log;
use App\Models\MarketRequestMessage;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminContactNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    /**
     * Display the market dashboard with filtered vegetables and fruits.
     */
    public function index(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the economic center details for the market user (if the user is a market-admin)
        $economicCenter = null;
        if ($user && $user->hasRole('market-admin')) {
            $economicCenter = EconomicCenter::find($user->center_id);
        }

        // Fetch all vegetables and fruits for the dropdown filters
        $vegetables = Vegetable::pluck('name', 'id')->all();
        $fruits = Fruit::pluck('name', 'id')->all();

        // Initialize queries for filtering vegetables and fruits
        $vegetableQuery = Vegetable::orderBy('created_at', 'DESC');
        $fruitQuery = Fruit::orderBy('created_at', 'DESC');

        // Apply vegetable filter if specified in the request
        if ($request->has('vegetable_id') && $request->vegetable_id) {
            $vegetableQuery->where('id', $request->vegetable_id);
        }

        // Apply fruit filter if specified in the request
        if ($request->has('fruit_id') && $request->fruit_id) {
            $fruitQuery->where('id', $request->fruit_id);
        }

        // Paginate the filtered lists of vegetables and fruits
        $vegetablesList = $vegetableQuery->paginate(10); // 10 items per page
        $fruitList = $fruitQuery->paginate(10); // 10 items per page

        // Fetch prices from the center_has_vegetable and center_has_fruit tables
        $vegetablePrices = CenterHasVegetables::where('center_id', $user->center_id)
            ->select('vegetable_id', 'vegetable_wholesale_price', 'vegetable_retail_price')
            ->get()
            ->keyBy('vegetable_id')
            ->toArray();

        $fruitPrices = CenterHasFruits::where('center_id', $user->center_id)
            ->select('fruit_id', 'fruit_wholesale_price', 'fruit_retail_price')
            ->get()
            ->keyBy('fruit_id')
            ->toArray();

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'vegetablesList' => view('pages.market.dashboard.vegetable-table', [
                    'vegetablesList' => $vegetablesList,
                    'vegetablePrices' => $vegetablePrices,
                ])->render(),
                'fruitList' => view('pages.market.dashboard.fruit-table', [
                    'fruitList' => $fruitList,
                    'fruitPrices' => $fruitPrices,
                ])->render(),
                'pagination' => [
                    'vegetables' => $vegetablesList->links()->toHtml(),
                    'fruits' => $fruitList->links()->toHtml(),
                ],
            ]);
        }

        // Return the full view for normal requests
        return view('pages.market.dashboard.dashboard', [
            'vegetables' => $vegetables, // Dropdown filter for vegetables
            'vegetablesList' => $vegetablesList, // Filtered vegetable list
            'vegetablePrices' => $vegetablePrices, // Vegetable prices
            'fruits' => $fruits, // Dropdown filter for fruits
            'fruitPrices' => $fruitPrices, // Fruit prices
            'fruitList' => $fruitList, // Filtered fruit list
            'economicCenter' => $economicCenter,
            'user' => $user,
        ]);
    }

    /**
     * Update vegetable prices in the database with transactions for safe operations.
     */
    public function vegetableUpdate(Request $request, $id)
    {
        // Log incoming request data for debugging purposes
        Log::info('Update request received:', [
            'id' => $id,
            'data' => $request->all(),
        ]);

        // Validate the incoming request data
        $request->validate([
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
        ]);

        // Get the authenticated user (market user)
        $user = Auth::user();

        // Log authenticated user details for debugging
        Log::info('Authenticated user:', [
            'user_id' => $user->id,
            'center_id' => $user->center_id,
        ]);

        // Use database transactions to ensure safe updates
        DB::beginTransaction();

        try {
            // Ensure the request is for updating vegetable prices
            if ($request->is('market/vegetable/*')) {
                // Update or create the prices in the center_has_vegetable table
                CenterHasVegetables::updateOrCreate(
                    [
                        'center_id' => $user->center_id, // Market user's center_id
                        'vegetable_id' => $id,            // Vegetable ID
                    ],
                    [
                        'vegetable_wholesale_price' => $request->Wholesale_Price,
                        'vegetable_retail_price' => $request->Retail_Price,
                    ]
                );

                // Log the update for center_has_vegetable
                Log::info('center_has_vegetable updated:', [
                    'center_id' => $user->center_id,
                    'vegetable_id' => $id,
                    'vegetable_wholesale_price' => $request->Wholesale_Price,
                    'vegetable_retail_price' => $request->Retail_Price,
                ]);
            } else {
                // Log error if the URL does not match the expected format
                Log::error('Invalid type specified in the request URL.');
                return response()->json(['success' => false, 'message' => 'Invalid type specified.'], 400);
            }

            // Commit the transaction after a successful update
            DB::commit();

            // Log success
            Log::info('Prices updated successfully.');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error details
            Log::error('Error updating prices:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'An error occurred while updating the prices.'], 500);
        }
    }

    /**
     * Update fruit prices in the database with transactions for safe operations.
     */
    public function fruitUpdate(Request $request, $id)
    {
        // Log incoming request data for debugging purposes
        Log::info('Update request received:', [
            'id' => $id,
            'data' => $request->all(),
        ]);

        // Validate the incoming request data
        $request->validate([
            'Wholesale_Price' => 'required|numeric',
            'Retail_Price' => 'required|numeric',
        ]);

        // Get the authenticated user (market user)
        $user = Auth::user();

        // Log authenticated user details for debugging
        Log::info('Authenticated user:', [
            'user_id' => $user->id,
            'center_id' => $user->center_id,
        ]);

        // Use database transactions to ensure safe updates
        DB::beginTransaction();

        try {
            // Ensure the request is for updating fruit prices
            if ($request->is('market/fruit/*')) {
                // Update or create the prices in the center_has_fruit table
                CenterHasFruits::updateOrCreate(
                    [
                        'center_id' => $user->center_id, // Market user's center_id
                        'fruit_id' => $id,                // Fruit ID
                    ],
                    [
                        'fruit_wholesale_price' => $request->Wholesale_Price,
                        'fruit_retail_price' => $request->Retail_Price,
                    ]
                );

                // Log the update for center_has_fruit
                Log::info('center_has_fruit updated:', [
                    'center_id' => $user->center_id,
                    'fruit_id' => $id,
                    'fruit_wholesale_price' => $request->Wholesale_Price,
                    'fruit_retail_price' => $request->Retail_Price,
                ]);
            } else {
                // Log error if the URL does not match the expected format
                Log::error('Invalid type specified in the request URL.');
                return response()->json(['success' => false, 'message' => 'Invalid type specified.'], 400);
            }

            // Commit the transaction after a successful update
            DB::commit();

            // Log success
            Log::info('Prices updated successfully.');

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error details
            Log::error('Error updating prices:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['success' => false, 'message' => 'An error occurred while updating the prices.'], 500);
        }
    }

    /**
     * Display the market profile page.
     */
    public function marketProfile()
    {
        return view('pages.market.profile.show');
    }

    /**
     * Display the admin contact page.
     */
    public function adminContactIndex()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the economic center details for the market admin
        $economicCenter = null;
        if ($user && $user->hasRole('market-admin')) {
            $economicCenter = EconomicCenter::find($user->center_id);
        }

        return view('pages.market.admin-contact.index', [
            'economicCenter' => $economicCenter,
            'user' => $user,
        ]);
    }
}
