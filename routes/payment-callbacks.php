<?php

declare(strict_types=1);

use App\Http\Controllers\PaymentCallbackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Payment Gateway Callback Routes
|--------------------------------------------------------------------------
|
| Payment gateways POST to these endpoints after processing a transaction.
| These routes are excluded from CSRF verification in bootstrap/app.php
| because the POST comes from the gateway server, not our forms.
|
*/

Route::post('/payment/jazzcash/callback', [PaymentCallbackController::class, 'jazzcash'])
    ->name('payment.jazzcash.callback');

Route::post('/payment/easypaisa/callback', [PaymentCallbackController::class, 'easypaisa'])
    ->name('payment.easypaisa.callback');
