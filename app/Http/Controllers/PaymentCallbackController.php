<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    /**
     * Handle JazzCash payment callback.
     * JazzCash POSTs back to this URL after payment processing.
     * pp_ResponseCode '000' = success.
     */
    public function jazzcash(Request $request): RedirectResponse
    {
        $orderNumber  = $request->input('pp_BillReference');
        $responseCode = $request->input('pp_ResponseCode');

        $order = Order::where('order_number', $orderNumber)->first();

        if (! $order) {
            return redirect()->route('home')->with('error', __('Order not found.'));
        }

        if ($responseCode === '000') {
            $order->update([
                'payment_status' => PaymentStatus::Paid,
                'status'         => OrderStatus::Processing,
            ]);

            session(['order_placed' => true]);

            return redirect()->route('checkout.confirmation', $order);
        }

        $order->update(['payment_status' => PaymentStatus::Failed]);

        return redirect()->route('cart.index')
            ->with('error', __('JazzCash payment failed. Please try again.'));
    }

    /**
     * Handle EasyPaisa payment callback.
     * EasyPaisa POSTs back to this URL after payment processing.
     * responseCode '0000' = success.
     */
    public function easypaisa(Request $request): RedirectResponse
    {
        $orderNumber  = $request->input('orderRefNum');
        $responseCode = $request->input('responseCode');

        $order = Order::where('order_number', $orderNumber)->first();

        if (! $order) {
            return redirect()->route('home')->with('error', __('Order not found.'));
        }

        if ($responseCode === '0000') {
            $order->update([
                'payment_status' => PaymentStatus::Paid,
                'status'         => OrderStatus::Processing,
            ]);

            session(['order_placed' => true]);

            return redirect()->route('checkout.confirmation', $order);
        }

        $order->update(['payment_status' => PaymentStatus::Failed]);

        return redirect()->route('cart.index')
            ->with('error', __('EasyPaisa payment failed. Please try again.'));
    }
}
