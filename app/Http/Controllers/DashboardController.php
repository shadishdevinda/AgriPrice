<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function navigate()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check the user's type and navigate to the appropriate dashboard
        if ($user && $user->user_type === 'system-user') {
            return redirect()->route('admin.dashboard');
        } elseif ($user && $user->user_type === 'market-user') {
            return redirect()->route('market.dashboard');
        } else {
            // Default redirect if user_type does not match expected values
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
    }
}
