@extends('layouts.storefront')

@section('title', __('My Orders'))

@section('content')

<div class="bg-gray-50 min-h-screen py-10">
<div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900">{{ __('My Orders') }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ __('Your complete order history') }}</p>
        </div>
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-x-1.5 text-sm font-semibold text-primary hover:text-gold transition-colors">
            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('Back to Dashboard') }}
        </a>
    </div>

    @if ($orders->isEmpty())
        {{-- Empty state --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 px-5 py-16 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
            <p class="mt-4 text-sm text-gray-400">{{ __('You have not placed any orders yet.') }}</p>
            <a href="{{ route('shop') }}"
               class="mt-4 inline-flex items-center gap-x-1.5 rounded-xl bg-primary px-5 py-2.5 text-xs font-bold text-white hover:bg-primary/90 transition">
                {{ __('Start Shopping') }}
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                @php
                    $statusColors = [
                        'pending'          => 'bg-amber-100 text-amber-700',
                        'payment_pending'  => 'bg-orange-100 text-orange-700',
                        'payment_rejected' => 'bg-red-100 text-red-700',
                        'confirmed'        => 'bg-blue-100 text-blue-700',
                        'processing'       => 'bg-indigo-100 text-indigo-700',
                        'shipped'          => 'bg-cyan-100 text-cyan-700',
                        'delivered'        => 'bg-green-100 text-green-700',
                        'cancelled'        => 'bg-red-100 text-red-700',
                    ];
                    $statusClass = $statusColors[$order->status->value] ?? 'bg-gray-100 text-gray-700';
                @endphp

                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">

                    {{-- Order Header --}}
                    <div class="flex items-center justify-between gap-x-4 border-b border-gray-100 px-5 py-4">
                        <div>
                            <div class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm font-extrabold text-primary">{{ $order->getFormattedTotal() }}</div>
                            <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold mt-1 {{ $statusClass }}">
                                {{ $order->status->label() }}
                            </span>
                        </div>
                    </div>

                    {{-- Order Items --}}
                    <div class="divide-y divide-gray-50 px-5">
                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-x-3 py-3">
                                <div class="h-10 w-10 shrink-0 rounded-lg overflow-hidden bg-gray-50 border border-gray-100">
                                    @if ($item->product && $item->product->hasMedia('images'))
                                        <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $item->product->name }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $item->product->name ?? __('Product Unavailable') }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ __('Qty') }}: {{ $item->quantity }}</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 shrink-0">
                                    Rs. {{ number_format((float) $item->total_price, 2) }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Order Footer --}}
                    <div class="flex items-center justify-between bg-gray-50 px-5 py-3">
                        <div class="text-xs text-gray-500">
                            {{ $order->items->count() }} {{ __('item(s)') }} &middot;
                            {{ __('Payment') }}: {{ $order->payment_method->label() }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ __('Deliver to') }}: {{ $order->shipping_city }}, {{ $order->shipping_province }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $orders->links('pagination::tailwind') }}
        </div>
    @endif

</div>
</div>

@endsection
