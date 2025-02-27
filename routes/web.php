<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\VegetableController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\VegetableAdviceController;
use App\Http\Controllers\FruitAdviceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EconomicCenterUserController;
use App\Http\Controllers\EconomicCenterController;

// Home page
Route::get('/', [HomeController::class, 'welcome'])->name('home');


// Login route
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'navigate'])->name('dashboard');


// Admin Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
});


// Market Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/market/dashboard', [MarketController::class, 'index'])->name('market.dashboard');
    Route::get('/market/profile', [MarketController::class, 'marketProfile'])->name('market.profile');
});


// Permissions Routes
Route::resource('permissions', PermissionController::class);

// Roles Routes
Route::resource('roles', RoleController::class);
Route::put('roles/{roleId}/permissions', [RoleController::class, 'givePermissions'])->name('roles.give-permissions');

// System Users Manage Routes
Route::prefix('system')->group(function () {
    Route::resource('users', UserManageController::class);
});
Route::get('system-users/{user}/permissions', [UserManageController::class, 'userPermissions'])->name('system.users.permissions');
Route::put('system-users/{user}/permissions', [UserManageController::class, 'givePermissions'])->name('system.users.give-permissions');

// Economic Center User Mange Routes
Route::resource('economic-center-user', EconomicCenterUserController::class)
    ->parameters(['economic-center-user' => 'user']);
// Economic Center User Manage Routes
Route::get('economic-center-users/{user}/permissions', [EconomicCenterUserController::class, 'userPermissions'])->name('economic.center.users.permissions');
Route::put('economic-center-users/{user}/permissions', [EconomicCenterUserController::class, 'givePermissions'])->name('economic.center.users.give-permissions');


// Economic Center Resource Routes
Route::resource('economic-centers', EconomicCenterController::class);
Route::get('economic-centers/assign-user/{economicCenter}', [EconomicCenterController::class, 'assignUserPage'])->name('economic.center.assign.user');
Route::put('economic-centers/add-user/{economicCenterID}', [EconomicCenterController::class, 'assignUser'])->name('economic.center.add.user');



// Vegetables Routes
Route::resource('/vegetable',VegetableController::class);

// Fruit Routes
Route::resource('/fruit',FruitController::class);

// vegetable_advice Routes
Route::resource('/vegetable_advice',VegetableAdviceController::class);

// fruit_advice Routes
Route::resource('/fruit_advice',FruitAdviceController::class);
