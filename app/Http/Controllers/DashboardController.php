<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function navigate()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Check the user's role and navigate to the appropriate dashboard
        if ($user->hasRole('system-admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('market-admin')) {
            return redirect()->route('market.dashboard');
        } else {
            // Default redirect if the user does not have the required roles
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
    }
}
