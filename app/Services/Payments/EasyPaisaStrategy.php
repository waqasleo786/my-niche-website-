<?php

declare(strict_types=1);

namespace App\Services\Payments;

use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use Zfhassaan\Easypaisa\Easypaisa;

class EasyPaisaStrategy implements PaymentStrategyInterface
{
    public function initiate(Order $order): Response
    {
        $ep = new Easypaisa();

        $checkoutUrl = $ep->sendHostedRequest([
            'amount'      => (string) (int) ($order->total * 100),
            'orderRefNum' => $order->order_number,
        ]);

        return redirect($checkoutUrl);
    }
}
