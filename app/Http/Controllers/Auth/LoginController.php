<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'), $request->has('remember'))) {
            // Authentication was successful
            $user = Auth::user();

            // Redirect based on user role
            if ($user->hasRole('system-admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('market-admin')) {
                return redirect()->route('market.dashboard');
            } else {
                // Default redirect if the user does not have the required roles
                return redirect()->route('home')->with('error', 'Unauthorized access.');
            }
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
