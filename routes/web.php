<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\EconomicCenterController;

// Home page
Route::get('/', [HomeController::class, 'welcome'])->name('home');

// Login route
Route::post('/login', [LoginController::class, 'login'])->name('login');

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

// Users Manage Routes
Route::resource('users', UserManageController::class);
Route::get('users/{userID}/permissions', [UserManageController::class, 'userPermissions'])->name('users.permissions');
Route::put('users/{userID}/permissions', [UserManageController::class, 'givePermissions'])->name('users.give-permissions');

// Market Users Manage Routes CURD
Route::get('market/users', [UserManageController::class, 'marketUsers'])->name('market.users');
Route::get('market/users/create', [UserManageController::class, 'createMarketUser'])->name('market.users.create');
Route::post('market/users', [UserManageController::class, 'storeMarketUser'])->name('market.users.store');
Route::get('market/users/{userID}/edit', [UserManageController::class, 'editMarketUser'])->name('market.users.edit');
Route::put('market/users/{userID}', [UserManageController::class, 'updateMarketUser'])->name('market.users.update');
Route::get('market/users/{userID}/permissions', [UserManageController::class, 'marketUserPermissions'])->name('market.users.permissions');



// Economic Center Resource Route
Route::resource('economic-centers', EconomicCenterController::class);
// Route for assigning users
Route::get('economic-centers/assign-user/{economicCenter}', [EconomicCenterController::class, 'assignUserPage'])->name('economic.center.assign.user');
Route::put('economic-centers/add-user/{economicCenterID}', [EconomicCenterController::class, 'assignUser'])->name('economic.center.add.user');
