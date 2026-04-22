<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService  $cartService,
        private readonly OrderService $orderService,
    ) {}

    public function index(): View|RedirectResponse
    {
        $cart = $this->cartService->getCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $cart->load('items.product.media');

        $locations = config('locations');

        return view('checkout.index', compact('cart', 'locations'));
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $cart = $this->cartService->getCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $cart->load('items.product');

        $order = $this->orderService->createFromCart($cart, $user, $request->validated());

        return redirect()->route('checkout.confirmation', $order)->with('order_placed', true);
    }

    public function confirmation(Order $order): View|RedirectResponse
    {
        if (! session('order_placed')) {
            return redirect()->route('home');
        }

        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }

}
