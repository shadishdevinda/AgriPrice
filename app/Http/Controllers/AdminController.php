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
     * Display the admin dashboard.
     *
     * This method fetches the total count of vegetables, fruits, and economic centers.
     * It also retrieves a paginated list of users who are not assigned to any economic center (`center_id` is NULL).
     * Additionally, it fetches all available roles from the database.
     *
     * @return \Illuminate\View\View The admin dashboard view with necessary data.
     */
    public function index()
    {
        // Get the total count of vegetables, fruits, and economic centers
        $vegetableCount = Vegetable::count();
        $fruitCount = Fruit::count();
        $economicCenter = EconomicCenter::count();

        // Retrieve users who do not belong to any economic center (center_id is NULL)
        $users = User::whereNull('center_id')->paginate(10);

        // Fetch all available roles as an associative array [name => name]
        $roles = Role::pluck('name', 'name')->all();

        // Pass the retrieved data to the dashboard view
        return view('pages.admin.dashboard.dashboard', compact('vegetableCount', 'fruitCount', 'economicCenter', 'users', 'roles'));
    }

    /**
     * Display the admin profile page.
     *
     * @return \Illuminate\View\View The admin profile view.
     */
    public function adminProfile()
    {
        return view('pages.admin.profile.show');
    }
}
