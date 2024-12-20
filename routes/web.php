<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

// Home page
Route::get('/', [HomeController::class, 'welcome'])->name('home');



// Admin Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/profile', [ProfileController::class, 'adminProfile'])->name('admin.profile');
});


// Market Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/market/dashboard', [MarketController::class, 'index'])->name('market.dashboard');
    Route::get('/market/profile', [ProfileController::class, 'marketProfile'])->name('market.profile');
});


// Permissions Routes
Route::resource('permissions', PermissionController::class);

// Roles Routes
Route::resource('roles', RoleController::class);
Route::put('roles/{roleId}/permissions', [RoleController::class, 'givePermissions'])->name('roles.give-permissions');

