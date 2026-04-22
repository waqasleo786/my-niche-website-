<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Models\Order;
use App\Services\Payments\CodStrategy;
use App\Services\Payments\EasyPaisaStrategy;
use App\Services\Payments\JazzCashStrategy;
use App\Services\Payments\PaymentStrategyInterface;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    private function resolveStrategy(PaymentMethod $method): PaymentStrategyInterface
    {
        return match ($method) {
            PaymentMethod::COD       => app(CodStrategy::class),
            PaymentMethod::JazzCash  => app(JazzCashStrategy::class),
            PaymentMethod::EasyPaisa => app(EasyPaisaStrategy::class),
        };
    }

    public function initiate(Order $order): Response
    {
        return $this->resolveStrategy($order->payment_method)->initiate($order);
    }
}
