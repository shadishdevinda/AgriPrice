<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        if (in_array($locale, ['en', 'si'])) {
            Session::put('locale', $locale); // Store the selected locale in the session
        }
        return redirect()->back(); // Redirect back to the previous page
    }
}
