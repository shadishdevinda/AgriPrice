<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\EconomicCenterController;
use App\Http\Controllers\ECenterUserManageController;
use App\Http\Controllers\EconomicCenterUserController;

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
Route::resource('users', UserManageController::class);
Route::get('users/{user}/permissions', [UserManageController::class, 'userPermissions'])->name('users.permissions');
Route::put('users/{user}/permissions', [UserManageController::class, 'givePermissions'])->name('users.give-permissions');

// Economic Center Resource Routes
Route::resource('economic-centers', EconomicCenterController::class);
Route::get('economic-centers/assign-user/{economicCenter}', [EconomicCenterController::class, 'assignUserPage'])->name('economic.center.assign.user');
Route::put('economic-centers/add-user/{economicCenterID}', [EconomicCenterController::class, 'assignUser'])->name('economic.center.add.user');


// Economic Center User Mange Routes
Route::resource('economic-center-user', EconomicCenterUserController::class)
    ->parameters(['economic-center-user' => 'user']);
Route::get('users/{userID}/permissions', [EconomicCenterUserController::class, 'userPermissions'])->name('economic.center.user.permissions');
Route::put('users/{userID}/permissions', [EconomicCenterUserController::class, 'givePermissions'])->name('economic.center.user.give-permissions');


// TODO
