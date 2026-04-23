<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\NewPaymentSlipAlertMail;
use App\Models\Order;
use App\Models\User;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function __construct(
        private readonly CartService    $cartService,
        private readonly OrderService   $orderService,
        private readonly PaymentService $paymentService,
    ) {}

    public function index(): View|RedirectResponse
    {
        $cart = $this->cartService->getCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $cart->load('items.product.media');

        $locations       = config('locations');
        $paymentAccounts = config('payment_accounts');

        return view('checkout.index', compact('cart', 'locations', 'paymentAccounts'));
    }

    public function store(CheckoutRequest $request): Response
    {
        /** @var User $user */
        $user = auth()->user();
        $cart = $this->cartService->getCart();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', __('Your cart is empty.'));
        }

        $cart->load('items.product');

        $data = $request->validated();

        if ($request->hasFile('payment_slip')) {
            $data['payment_slip_path'] = $request->file('payment_slip')
                ->store('payment-slips', 'public');
        }

        $order = $this->orderService->createFromCart($cart, $user, $data);

        if ($order->hasPaymentSlip()) {
            Mail::to(config('payment_accounts.admin_email'))
                ->queue(new NewPaymentSlipAlertMail($order));
        }

        return $this->paymentService->initiate($order);
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
