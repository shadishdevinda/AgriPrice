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
    public function welcome()
    {
        return view('pages.home.welcome');
    }

    // Vegetable Price Index
    public function vegetableIndex()
    {
        $vegetables = Vegetable::all(); // Fetch all vegetables from the database
        return view('pages.home.vegetable.index', compact('vegetables'));
    }

    // Fruit Price Index
    public function fruitIndex()
    {
        $fruits = Fruit::all(); // Fetch all fruits from the database
        return view('pages.home.fruit.index', compact('fruits'));
    }

    // Vegetable Details
    public function vegetableDetails(Request $request, $id)
    {
        $vegetable = Vegetable::findOrFail($id);

        // Get all unique dates and centers
        $dates = CenterHasVegetables::where('vegetable_id', $id)
                    ->selectRaw('DATE(created_at) as date')
                    ->distinct()
                    ->pluck('date');

        $centers = CenterHasVegetables::where('vegetable_id', $id)
                    ->with('center')
                    ->select('center_id')
                    ->distinct()
                    ->get();

        // Fetch latest available date
        $latestDate = CenterHasVegetables::where('vegetable_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->value(DB::raw('DATE(created_at)'));

        // Default selected date (if filtering by "All Centers", use latest date)
        $selectedDate = $request->has('center_id') && $request->center_id != '' ? null : ($request->input('date') ?? $latestDate);

        // Query for data
        $query = CenterHasVegetables::where('vegetable_id', $id);

        if ($request->has('center_id') && $request->center_id != '') {
            // If filtering by a specific center, show data for the last 10 days
            $query->where('center_id', $request->center_id)
                  ->whereDate('created_at', '>=', Carbon::now()->subDays(10));
            $isCenterFiltered = true;
        } else {
            // Otherwise, show data for the latest or selected date
            $query->whereDate('created_at', $selectedDate);
            $isCenterFiltered = false;
        }

        $centerhasvegetable = $query->get();

        return view('pages.home.vegetable.details', compact(
            'vegetable', 'centerhasvegetable', 'dates', 'centers', 'latestDate', 'selectedDate', 'isCenterFiltered'
        ));
    }

    // Fruit Details
    public function fruitDetails(Request $request, $id)
    {
        $fruit = Fruit::findOrFail($id);

        // Get all unique dates and centers
        $dates = CenterHasFruits::where('fruit_id', $id)
                    ->selectRaw('DATE(created_at) as date')
                    ->distinct()
                    ->pluck('date');

        $centers = CenterHasFruits::where('fruit_id', $id)
                    ->with('center')
                    ->select('center_id')
                    ->distinct()
                    ->get();

        // Fetch latest available date
        $latestDate = CenterHasFruits::where('fruit_id', $id)
                        ->orderBy('created_at', 'desc')
                        ->value(DB::raw('DATE(created_at)'));

        // Default selected date (if filtering by "All Centers", use latest date)
        $selectedDate = $request->has('center_id') && $request->center_id != '' ? null : ($request->input('date') ?? $latestDate);

        // Query for data
        $query = CenterHasFruits::where('fruit_id', $id);

        if ($request->has('center_id') && $request->center_id != '') {
            // If filtering by a specific center, show data for the last 10 days
            $query->where('center_id', $request->center_id)
                  ->whereDate('created_at', '>=', Carbon::now()->subDays(10));
            $isCenterFiltered = true;
        } else {
            // Otherwise, show data for the latest or selected date
            $query->whereDate('created_at', $selectedDate);
            $isCenterFiltered = false;
        }

        $centerhasfruit = $query->get();

        return view('pages.home.fruit.details', compact(
            'fruit', 'centerhasfruit', 'dates', 'centers', 'latestDate', 'selectedDate', 'isCenterFiltered'
        ));
    }

    public function fruitAdviceIndex()
    {
       $fruits = Fruit::all();
       return view('pages.home.advices.fruits.index', compact('fruits'));
    }

    public function fruitAdviceShow($id)
    {
        $fruit = Fruit::with('advice')->findOrFail($id);
        return view('pages.home.advices.fruits.show', compact('fruit'));
    }


    public function vegetableAdviceIndex()
    {
        $vegetables = Vegetable::all();
        return view('pages.home.advices.vegetable.index', compact('vegetables'));
    }


    public function vegetableAdviceShow($id)
    {
        $vegetable = Vegetable::with('advice')->findOrFail($id);
        return view('pages.home.advices.vegetable.show', compact('vegetable'));
    }
}
