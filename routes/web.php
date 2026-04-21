<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------------
// Storefront Routes
// -------------------------------------------------------------------

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/shop', function () {
    return view('pages.shop');
})->name('shop');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// -------------------------------------------------------------------
// Authenticated Routes
// -------------------------------------------------------------------

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
