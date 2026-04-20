<?php

declare(strict_types=1);

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Localized routes - all URLs will have /en/ or /ur/ prefix
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    // Home page
    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    // Contact Us
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Shop
    Route::get('/shop', function () {
        return view('pages.shop');
    })->name('shop');

    // About Us
    Route::get('/about', function () {
        return view('pages.about');
    })->name('about');

});
