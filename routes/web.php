<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Livewire\Booking\CreateBooking;
use App\Http\Livewire\Booking\ShowBooking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');

    ///////////////// Booking routes ////////////////
    Route::prefix('booking')->group(function () {
        Route::get('create', CreateBooking::class)->name('booking.create');
        Route::get('show/{appointment:uuid}', ShowBooking::class)->name('booking.show');
    });
});