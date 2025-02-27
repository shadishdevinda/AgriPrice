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
use App\Http\Controllers\ECenterUserManageController;
use App\Http\Controllers\EconomicCenterUserController;
use App\Http\Controllers\VegetableController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\VegetableAdviceController;
use App\Http\Controllers\FruitAdviceController;

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
    Route::get('/admin/dashboard', [AdminController::class, 'cal'])->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    
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
Route::get('users/{user}/permissions', [UserManageController::class, 'userPermissions'])->name('users.permissions');
Route::put('users/{user}/permissions', [UserManageController::class, 'givePermissions'])->name('users.give-permissions');





// Economic Center Resource Routes
Route::resource('economic-centers', EconomicCenterController::class);
Route::get('economic-centers/assign-user/{economicCenter}', [EconomicCenterController::class, 'assignUserPage'])->name('economic.center.assign.user');
Route::put('economic-centers/add-user/{economicCenterID}', [EconomicCenterController::class, 'assignUser'])->name('economic.center.add.user');
Route::get('/admin/dashboard/economicCentersShow', [EconomicCenterController::class, 'showDashboard'])->name('admin.dashboard.economicCentersShow');


Route::get('market/users', [UserManageController::class, 'marketUsers'])->name('market.users');


// TODO
// Vegetables Routes
Route::resource('/vegetable',VegetableController::class);

Route::get('/admin/dashboard/vegetableShow', [VegetableController::class, 'showDashboard'])->name('admin.dashboard.vegetableShow');


// Fruit Routes
Route::resource('/fruit',FruitController::class);
Route::get('/admin/dashboard/fruitShow', [FruitController::class, 'showDashboard'])->name('admin.dashboard.fruitShow');

// vegetable_advice Routes
Route::resource('/vegetable_advice',VegetableAdviceController::class);

// fruit_advice Routes
Route::resource('/fruit_advice',FruitAdviceController::class);








