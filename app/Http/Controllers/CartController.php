<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService) {}

    public function index(): View
    {
        $cart = $this->cartService->getOrCreateCart();
        $cart->load('items.product.media');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => ['integer', 'min:1', 'max:100'],
        ]);

        if (! $product->is_active || ! $product->isInStock()) {
            return back()->with('error', __('This product is not available.'));
        }

        $this->cartService->addItem($product, (int) $request->input('quantity', 1));

        return redirect()->route('cart.index')->with('success', __('Product added to cart!'));
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $this->cartService->updateQuantity($cartItem, (int) $request->input('quantity'));

        return back()->with('success', __('Cart updated.'));
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        $this->cartService->removeItem($cartItem);

        return back()->with('success', __('Item removed from cart.'));
    }

    public function clear(): RedirectResponse
    {
        $this->cartService->clearCart();

        return back()->with('success', __('Cart cleared.'));
    }
}
