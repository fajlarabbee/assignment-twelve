<?php

use App\Http\Controllers\Dashboard\BusController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\RouteController;
use App\Http\Controllers\Dashboard\TripController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
})->name('myhome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Locations
Route::resource('/dashboard/locations', LocationController::class)->middleware(['auth']);

// Buses
Route::resource('/dashboard/buses', BusController::class)->middleware(['auth']);

// Route
Route::resource('/dashboard/routes', RouteController::class)->middleware(['auth']);

// Trips
Route::resource('/dashboard/trips', TripController::class)->middleware(['auth']);


require __DIR__.'/auth.php';
