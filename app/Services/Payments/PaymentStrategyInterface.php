<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;

interface PaymentStrategyInterface
{
    public function initiate(Order $order): Response;
}
