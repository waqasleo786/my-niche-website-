<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    // -------------------------------------------------------------------
    // Cart Resolution
    // -------------------------------------------------------------------

    /**
     * Get or create a cart for the current visitor.
     * Logged-in users get a user cart; guests get a session cart.
     */
    public function getOrCreateCart(): Cart
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = Session::getId();

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function getCart(): ?Cart
    {
        if (Auth::check()) {
            return Cart::with('items.product.media')->where('user_id', Auth::id())->first();
        }

        return Cart::with('items.product.media')->where('session_id', Session::getId())->first();
    }

    public function getItemCount(): int
    {
        $cart = $this->getCart();

        return $cart ? $cart->getTotalItems() : 0;
    }

    // -------------------------------------------------------------------
    // Cart Operations
    // -------------------------------------------------------------------

    public function addItem(Product $product, int $quantity = 1): CartItem
    {
        $cart = $this->getOrCreateCart();

        $user     = Auth::user();
        $price    = (float) $product->getPriceForUser($user instanceof User ? $user : null);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $quantity;
            $cartItem->update(['quantity' => min($newQty, $product->stock_quantity)]);
        } else {
            $cartItem = $cart->items()->create([
                'product_id' => $product->id,
                'quantity'   => min($quantity, $product->stock_quantity),
                'unit_price' => $price,
            ]);
        }

        return $cartItem->fresh();
    }

    public function updateQuantity(CartItem $item, int $quantity): CartItem
    {
        $maxQty = $item->product->stock_quantity;
        $item->update(['quantity' => min(max(1, $quantity), $maxQty)]);

        return $item->fresh();
    }

    public function removeItem(CartItem $item): void
    {
        $item->delete();
    }

    public function clearCart(): void
    {
        $cart = $this->getCart();

        if ($cart) {
            $cart->items()->delete();
        }
    }

    // -------------------------------------------------------------------
    // Guest → User Merge (called on login)
    // -------------------------------------------------------------------

    /**
     * Merge the guest session cart into the authenticated user's cart.
     * Called from the Login listener after successful login.
     */
    public function mergeGuestCartToUser(User $user): void
    {
        $sessionId = Session::getId();

        $guestCart = Cart::with('items')->where('session_id', $sessionId)->first();

        if (! $guestCart || $guestCart->items->isEmpty()) {
            return;
        }

        $userCart = Cart::firstOrCreate(['user_id' => $user->id]);

        foreach ($guestCart->items as $guestItem) {
            $existing = $userCart->items()->where('product_id', $guestItem->product_id)->first();

            if ($existing) {
                $newQty = $existing->quantity + $guestItem->quantity;
                $existing->update(['quantity' => min($newQty, $guestItem->product->stock_quantity)]);
            } else {
                $userCart->items()->create([
                    'product_id' => $guestItem->product_id,
                    'quantity'   => $guestItem->quantity,
                    'unit_price' => $guestItem->unit_price,
                ]);
            }
        }

        $guestCart->delete();
    }
}
