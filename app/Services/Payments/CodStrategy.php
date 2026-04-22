<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;

class CodStrategy implements PaymentStrategyInterface
{
    public function initiate(Order $order): Response
    {
        return redirect()
            ->route('checkout.confirmation', $order)
            ->with('order_placed', true);
    }
}
