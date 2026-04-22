@extends('layouts.storefront')

@section('title', __('Your Cart'))
@section('description', __('Review your cart and proceed to checkout.'))

@section('content')

{{-- ============================================================
     BREADCRUMB
     ============================================================ --}}
<div class="bg-white border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-x-2 py-3.5 text-sm">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary transition-colors">{{ __('Home') }}</a>
            <svg class="h-4 w-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-semibold text-primary">{{ __('Cart') }}</span>
        </nav>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if ($cart->items->isEmpty())

        {{-- ============================================================
             EMPTY CART
             ============================================================ --}}
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <svg class="h-20 w-20 text-gray-200 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
            </svg>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Your cart is empty') }}</h1>
            <p class="text-gray-500 mb-8">{{ __('Looks like you have not added anything yet.') }}</p>
            <a href="{{ route('shop') }}"
               class="inline-flex items-center gap-x-2 rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors">
                {{ __('Continue Shopping') }}
            </a>
        </div>

    @else

        {{-- ============================================================
             CART WITH ITEMS
             ============================================================ --}}
        <h1 class="text-2xl font-bold text-gray-900 mb-8">{{ __('Shopping Cart') }}
            <span class="text-base font-normal text-gray-500">({{ $cart->getTotalItems() }} {{ __('items') }})</span>
        </h1>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">

                @foreach ($cart->items as $item)
                    <div class="flex gap-4 rounded-xl border border-gray-100 bg-white p-4 shadow-sm">

                        {{-- Product Image --}}
                        <div class="h-24 w-24 shrink-0 overflow-hidden rounded-lg bg-gray-50 border border-gray-100">
                            @if ($item->product->hasMedia('images'))
                                <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                     alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover object-center"
                                     loading="lazy">
                            @else
                                <div class="flex h-full w-full items-center justify-center">
                                    <svg class="h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="flex flex-1 flex-col justify-between">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <a href="{{ route('products.show', $item->product->slug) }}"
                                       class="font-semibold text-gray-900 hover:text-primary transition-colors line-clamp-2">
                                        {{ $item->product->name }}
                                    </a>
                                    <p class="mt-1 text-sm text-gray-500">{{ __('Unit Price') }}: {{ 'Rs. ' . number_format((float) $item->unit_price, 2) }}</p>
                                </div>
                                {{-- Remove --}}
                                <form method="POST" action="{{ route('cart.remove', $item) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-gray-400 hover:text-red-500 transition-colors"
                                            title="{{ __('Remove') }}">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between">
                                {{-- Quantity Controls --}}
                                <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-x-2">
                                    @csrf @method('PATCH')
                                    <label for="qty-{{ $item->id }}" class="sr-only">{{ __('Quantity') }}</label>
                                    <div class="flex items-center rounded-lg border border-gray-200 overflow-hidden">
                                        <button type="button"
                                                onclick="const el=this.nextElementSibling; if(el.value>1){el.value=parseInt(el.value)-1; el.closest('form').submit()}"
                                                class="flex h-8 w-8 items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                                            &minus;
                                        </button>
                                        <input type="number"
                                               id="qty-{{ $item->id }}"
                                               name="quantity"
                                               value="{{ $item->quantity }}"
                                               min="1"
                                               max="{{ $item->product->stock_quantity }}"
                                               class="w-12 border-x border-gray-200 text-center text-sm py-1 focus:outline-none"
                                               onchange="this.closest('form').submit()">
                                        <button type="button"
                                                onclick="const el=this.previousElementSibling; if(el.value<{{ $item->product->stock_quantity }}){el.value=parseInt(el.value)+1; el.closest('form').submit()}"
                                                class="flex h-8 w-8 items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                                            &#43;
                                        </button>
                                    </div>
                                </form>

                                {{-- Line Total --}}
                                <p class="font-semibold text-primary">{{ $item->getFormattedLineTotal() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Clear Cart --}}
                <div class="flex justify-end pt-2">
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="text-sm text-gray-400 hover:text-red-500 transition-colors underline underline-offset-2"
                                onclick="return confirm('{{ __('Clear entire cart?') }}')">
                            {{ __('Clear cart') }}
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Order Summary') }}</h2>

                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">{{ __('Subtotal') }}</dt>
                            <dd class="font-medium text-gray-900">{{ $cart->getFormattedSubtotal() }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">{{ __('Shipping') }}</dt>
                            <dd class="font-medium text-gray-900">{{ __('Calculated at checkout') }}</dd>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <dt class="font-semibold text-gray-900">{{ __('Estimated Total') }}</dt>
                            <dd class="font-bold text-primary text-base">{{ $cart->getFormattedSubtotal() }}</dd>
                        </div>
                    </dl>

                    @auth
                        <a href="{{ route('checkout.index') }}"
                           class="mt-6 block w-full rounded-lg bg-primary px-4 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors">
                            {{ __('Proceed to Checkout') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="mt-6 block w-full rounded-lg bg-primary px-4 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors">
                            {{ __('Login to Checkout') }}
                        </a>
                        <p class="mt-2 text-center text-xs text-gray-400">
                            {{ __('Your cart will be saved.') }}
                        </p>
                    @endauth

                    <a href="{{ route('shop') }}"
                       class="mt-3 block w-full rounded-lg border border-gray-200 px-4 py-3 text-center text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>

        </div>
    @endif
</div>

@endsection
