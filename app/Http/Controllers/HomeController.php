<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fruit;
use App\Models\Vegetable;
use Illuminate\Http\Request;
use App\Models\CenterHasFruits;
use Illuminate\Support\Facades\DB;
use App\Models\CenterHasVegetables;

class HomeController extends Controller
{
    // Render the welcome page
    public function welcome()
    {
        return view('pages.home.welcome');
    }

    // Display the vegetable price index (list of all vegetables)
    public function vegetableIndex()
    {
        // Fetch all vegetables from the database
        $vegetables = Vegetable::all();
        // Return the view with the list of vegetables
        return view('pages.home.prices.vegetable.index', compact('vegetables'));
    }

    // Display the fruit price index (list of all fruits)
    public function fruitIndex()
    {
        // Fetch all fruits from the database
        $fruits = Fruit::all();
        // Return the view with the list of fruits
        return view('pages.home.prices.fruit.index', compact('fruits'));
    }

    // Display detailed price information for a specific vegetable
    public function vegetableDetails(Request $request, $id)
    {
        // Find the vegetable by ID
        $vegetable = Vegetable::findOrFail($id);

        // Get all distinct dates when the vegetable's price was updated
        $dates = CenterHasVegetables::where('vegetable_id', $id)
                    ->selectRaw('DATE(created_at) as date')
                    ->distinct()
                    ->pluck('date');

        // Get all distinct centers that sell this vegetable, including center details
        $centers = CenterHasVegetables::where('vegetable_id', $id)
                    ->with('center')
                    ->select('center_id')
                    ->distinct()
                    ->get();

        // Fetch the latest available date for this vegetable
        $latestDate = CenterHasVegetables::where('vegetable_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->value(DB::raw('DATE(created_at)'));

        // Determine the default selected date (either a specific date or the latest date)
        $selectedDate = $request->has('center_id') && $request->center_id != ''
                        ? null : ($request->input('date') ?? $latestDate);

        // Build the query to fetch the vegetable data
        $query = CenterHasVegetables::where('vegetable_id', $id);

        // If a specific center is filtered, show data for the last 10 days
        if ($request->has('center_id') && $request->center_id != '') {
            $query->where('center_id', $request->center_id)
                  ->whereDate('created_at', '>=', Carbon::now()->subDays(10));
            $isCenterFiltered = true;
        } else {
            // Otherwise, show data for the latest or selected date
            $query->whereDate('created_at', $selectedDate);
            $isCenterFiltered = false;
        }

        // Fetch the filtered vegetable data
        $centerhasvegetable = $query->get();

        // Return the view with all necessary data
        return view('pages.home.prices.vegetable.details', compact(
            'vegetable', 'centerhasvegetable', 'dates', 'centers', 'latestDate', 'selectedDate', 'isCenterFiltered'
        ));
    }

    // Display detailed price information for a specific fruit
    public function fruitDetails(Request $request, $id)
    {
        // Find the fruit by ID
        $fruit = Fruit::findOrFail($id);

        // Get all distinct dates when the fruit's price was updated
        $dates = CenterHasFruits::where('fruit_id', $id)
                    ->selectRaw('DATE(created_at) as date')
                    ->distinct()
                    ->pluck('date');

        // Get all distinct centers that sell this fruit, including center details
        $centers = CenterHasFruits::where('fruit_id', $id)
                    ->with('center')
                    ->select('center_id')
                    ->distinct()
                    ->get();

        // Fetch the latest available date for this fruit
        $latestDate = CenterHasFruits::where('fruit_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->value(DB::raw('DATE(created_at)'));

        // Determine the default selected date (either a specific date or the latest date)
        $selectedDate = $request->has('center_id') && $request->center_id != ''
                        ? null : ($request->input('date') ?? $latestDate);

        // Build the query to fetch the fruit data
        $query = CenterHasFruits::where('fruit_id', $id);

        // If a specific center is filtered, show data for the last 10 days
        if ($request->has('center_id') && $request->center_id != '') {
            $query->where('center_id', $request->center_id)
                  ->whereDate('created_at', '>=', Carbon::now()->subDays(10));
            $isCenterFiltered = true;
        } else {
            // Otherwise, show data for the latest or selected date
            $query->whereDate('created_at', $selectedDate);
            $isCenterFiltered = false;
        }

        // Fetch the filtered fruit data
        $centerhasfruit = $query->get();

        // Return the view with all necessary data
        return view('pages.home.prices.fruit.details', compact(
            'fruit', 'centerhasfruit', 'dates', 'centers', 'latestDate', 'selectedDate', 'isCenterFiltered'
        ));
    }

    // Display a list of fruit advice
    public function fruitAdviceIndex()
    {
        // Fetch all fruits from the database
        $fruits = Fruit::all();
        // Return the view with the list of fruits
        return view('pages.home.advices.fruits.index', compact('fruits'));
    }

    // Show detailed advice for a specific fruit
    public function fruitAdviceShow($id)
    {
        // Find the fruit along with its advice
        $fruit = Fruit::with('advice')->findOrFail($id);
        // Return the view with the fruit and its advice
        return view('pages.home.advices.fruits.show', compact('fruit'));
    }

    // Display a list of vegetable advice
    public function vegetableAdviceIndex()
    {
        // Fetch all vegetables from the database
        $vegetables = Vegetable::all();
        // Return the view with the list of vegetables
        return view('pages.home.advices.vegetable.index', compact('vegetables'));
    }

    // Show detailed advice for a specific vegetable
    public function vegetableAdviceShow($id)
    {
        // Find the vegetable along with its advice
        $vegetable = Vegetable::with('advice')->findOrFail($id);
        // Return the view with the vegetable and its advice
        return view('pages.home.advices.vegetable.show', compact('vegetable'));
    }
}
