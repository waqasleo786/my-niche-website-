<?php

declare(strict_types=1);

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// -------------------------------------------------------------------
// Storefront Routes
// -------------------------------------------------------------------

Route::get('/', HomeController::class)->name('home');

Route::get('/sitemap.xml', function () {
    if (! file_exists(public_path('sitemap.xml'))) {
        \Artisan::call('sitemap:generate');
    }
    return response()->file(public_path('sitemap.xml'), ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::get('/shop', ShopController::class)->name('shop');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/shipping', 'pages.shipping')->name('shipping');
Route::view('/faq', 'pages.faq')->name('faq');

// -------------------------------------------------------------------
// Cart Routes (guests + auth)
// -------------------------------------------------------------------

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product:slug}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// -------------------------------------------------------------------
// Checkout Routes (guests allowed)
// -------------------------------------------------------------------

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// -------------------------------------------------------------------
// Authenticated Routes
// -------------------------------------------------------------------

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('/profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
require __DIR__ . '/payment-callbacks.php';
