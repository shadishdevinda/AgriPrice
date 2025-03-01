<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vegetable;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('pages.home.welcome');
    }

    public function vegetableIndex()
    {
        $vegetables = Vegetable::all(); // Fetch all vegetables from the database
        return view('pages.home.vegetable.index', compact('vegetables'));
    }

    public function vegetableDetails($id)
    {
        $vegetable = Vegetable::findOrFail($id); // Get vegetable by ID
        return view('pages.home.vegetable.details', compact('vegetable'));
    }
}
