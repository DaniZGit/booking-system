<?php

use App\Http\Controllers\RoomDisplayController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\BookingController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::view('/', 'home')->name('frontend.home');

    Route::middleware('auth')->group(function () {
        Route::get('/rooms', [RoomDisplayController::class, 'index'])->name('frontend.rooms');
        Route::get('/rooms/{slug}', [RoomDisplayController::class, 'show'])->name('frontend.room');
        Route::get('/moje-rezervacije', [BookingController::class, 'index'])->name('frontend.bookings');
    });

    require __DIR__.'/auth.php';
});

Route::prefix(LaravelLocalization::setLocale())->middleware('localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });
});

