@extends('layouts.storefront')

@section('title', __('Order Confirmed!'))

@section('content')

<div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 py-16">

    {{-- Success Header --}}
    <div class="text-center mb-10">
        <div class="mx-auto mb-5 flex h-20 w-20 items-center justify-center rounded-full bg-green-100">
            <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900">{{ __('Order Confirmed!') }}</h1>
        <p class="mt-2 text-gray-500">{{ __('Thank you for your order. We will contact you shortly.') }}</p>
    </div>

    {{-- Order Card --}}
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">

        {{-- Order Header --}}
        <div class="bg-primary/5 border-b border-gray-100 px-6 py-4 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">{{ __('Order Number') }}</p>
                <p class="text-lg font-bold text-primary">{{ $order->order_number }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">{{ __('Date') }}</p>
                <p class="text-sm font-semibold text-gray-700">{{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">{{ __('Payment') }}</p>
                <p class="text-sm font-semibold text-gray-700">{{ $order->payment_method->label() }}</p>
            </div>
            <div>
                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                    {{ $order->status->label() }}
                </span>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="px-6 py-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">{{ __('Items Ordered') }}</h2>
            <ul class="divide-y divide-gray-50">
                @foreach ($order->items as $item)
                    <li class="flex items-center gap-4 py-3">
                        <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg bg-gray-50 border border-gray-100">
                            @if ($item->product && $item->product->hasMedia('images'))
                                <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                     alt="{{ $item->product->name }}"
                                     class="h-full w-full object-cover">
                            @else
                                <div class="flex h-full w-full items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900">{{ $item->product->name ?? __('Product') }}</p>
                            <p class="text-xs text-gray-500">{{ __('Qty') }}: {{ $item->quantity }} &times; {{ $item->getFormattedUnitPrice() }}</p>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 shrink-0">{{ $item->getFormattedTotalPrice() }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Totals --}}
        <div class="border-t border-gray-100 px-6 py-4 bg-gray-50/50">
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-500">{{ __('Subtotal') }}</dt>
                    <dd class="font-medium">Rs. {{ number_format((float) $order->subtotal, 2) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">{{ __('Shipping') }}</dt>
                    <dd class="font-medium text-green-600">
                        {{ $order->shipping_cost > 0 ? 'Rs. ' . number_format((float) $order->shipping_cost, 2) : __('Free') }}
                    </dd>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-2">
                    <dt class="font-semibold text-gray-900">{{ __('Total') }}</dt>
                    <dd class="font-bold text-primary text-base">{{ $order->getFormattedTotal() }}</dd>
                </div>
            </dl>
        </div>

        {{-- Shipping Info --}}
        <div class="border-t border-gray-100 px-6 py-4">
            <h2 class="text-sm font-semibold text-gray-700 mb-3">{{ __('Shipping To') }}</h2>
            <address class="not-italic text-sm text-gray-600 space-y-0.5">
                <p class="font-medium text-gray-900">{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address }}</p>
                @if ($order->shipping_area)
                    <p>{{ $order->shipping_area }}, {{ $order->shipping_city }}, {{ $order->shipping_province }}</p>
                @else
                    <p>{{ $order->shipping_city }}, {{ $order->shipping_province }}</p>
                @endif
                <p>{{ $order->shipping_phone }}</p>
            </address>
        </div>

    </div>

    {{-- Actions --}}
    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('shop') }}"
           class="inline-flex items-center justify-center rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors">
            {{ __('Continue Shopping') }}
        </a>
        <a href="https://wa.me/923084570786?text={{ urlencode('Hi! I just placed order ' . $order->order_number . '. Please confirm.') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="inline-flex items-center justify-center gap-x-2 rounded-lg border border-green-300 bg-green-50 px-6 py-3 text-sm font-semibold text-green-700 hover:bg-green-100 transition-colors">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            {{ __('Confirm via WhatsApp') }}
        </a>
    </div>

</div>

@endsection
