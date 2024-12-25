<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.dashboard.dashboard');
    }

    /**
     * Display the admin profile.
     */
    public function adminProfile()
    {
        return view('pages.admin.profile.show');
    }
}
