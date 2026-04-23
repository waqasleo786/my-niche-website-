<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function createFromCart(Cart $cart, User $user, array $checkoutData): Order
    {
        return DB::transaction(function () use ($cart, $user, $checkoutData) {
            $subtotal      = $cart->getSubtotal();
            $shipping      = 0.00;
            $paymentMethod = PaymentMethod::from($checkoutData['payment_method']);
            $requiresSlip  = $paymentMethod->requiresSlip();

            $order = Order::create([
                'user_id'                 => $user->id,
                'order_number'            => Order::generateOrderNumber(),
                'is_b2b'                  => $user->hasRole('b2b_customer'),
                'status'                  => $requiresSlip ? OrderStatus::PaymentPending : OrderStatus::Pending,
                'payment_method'          => $paymentMethod,
                'payment_status'          => $requiresSlip ? PaymentStatus::SlipSubmitted : PaymentStatus::Pending,
                'subtotal'                => $subtotal,
                'shipping_cost'           => $shipping,
                'total'                   => $subtotal + $shipping,
                'shipping_name'           => $checkoutData['shipping_name'],
                'shipping_phone'          => $checkoutData['shipping_phone'],
                'shipping_province'       => $checkoutData['shipping_province'],
                'shipping_city'           => $checkoutData['shipping_city'],
                'shipping_area'           => $checkoutData['shipping_area'] ?? null,
                'shipping_address'        => $checkoutData['shipping_address'],
                'notes'                   => $checkoutData['notes'] ?? null,
                'payment_slip_path'       => $checkoutData['payment_slip_path'] ?? null,
                'payment_deadline_at'     => $requiresSlip
                    ? Carbon::now()->addHours(config('payment_accounts.payment_deadline_hours', 24))
                    : null,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id'  => $item->product_id,
                    'quantity'    => $item->quantity,
                    'unit_price'  => $item->unit_price,
                    'total_price' => $item->unit_price * $item->quantity,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);
            }

            $cart->items()->delete();
            $cart->delete();

            return $order;
        });
    }
}
