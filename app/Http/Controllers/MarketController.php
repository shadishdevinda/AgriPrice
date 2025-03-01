<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.market.dashboard.dashboard');
    }

    /**
     * Display the market profile.
     */
    public function marketProfile()
    {
        return view('pages.market.profile.show');
    }
}
