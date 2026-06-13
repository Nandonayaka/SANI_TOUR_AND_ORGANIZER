<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\TourController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\ScheduleController;

use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() { return redirect()->route('bookings.index'); })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('tours', TourController::class);
    Route::resource('packages', TourPackageController::class);
    Route::resource('schedules', ScheduleController::class);
});
