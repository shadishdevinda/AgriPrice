<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('pages.home.welcome');
    }

    public function vegetableIndex()
    {
        return view('pages.home.vegetable.index');
    }
}
