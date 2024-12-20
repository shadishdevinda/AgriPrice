<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function adminProfile()
    {
        return view('pages.admin.profile.show');
    }

    public function marketProfile()
    {
        return view('pages.market.profile.show');
    }
}
