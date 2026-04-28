<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        SEOMeta::setTitle('My Orders');
        SEOMeta::setDescription('View your order history with Shahid Brothers.');
        SEOMeta::setRobots('noindex,nofollow');

        $orders = $user->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}
