<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fruit;
use App\Models\Vegetable;
use App\Models\EconomicCenter;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Count the number of vegetables, fruits, and economic centers
        $vegetableCount = Vegetable::count();
        $fruitCount = Fruit::count();
        $economicCenter = EconomicCenter::count();

        // Get users and roles if needed
        $users = User::where('user_type', 'system-user')->paginate(10);
        $roles = Role::pluck('name', 'name')->all();

        // Pass the counts and other data to the view
        return view('pages.admin.dashboard.dashboard', compact('vegetableCount', 'fruitCount', 'economicCenter', 'users', 'roles'));
    }

    /**
     * Display the admin profile.
     */
    public function adminProfile()
    {
        return view('pages.admin.profile.show');
    }

}
