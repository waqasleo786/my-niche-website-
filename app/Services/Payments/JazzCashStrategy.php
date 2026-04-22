<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use zfhassaan\JazzCash\JazzCash;

class JazzCashStrategy implements PaymentStrategyInterface
{
    public function initiate(Order $order): Response
    {
        $jc = new JazzCash();

        $jc->setAmount($order->total)
           ->setBillReference($order->order_number)
           ->setProductDescription('Shahid Brothers Order #' . $order->order_number);

        return $jc->sendRequest();
    }
}
