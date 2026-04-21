@extends('layouts.storefront')

@section('title', __('Shop - All Products'))
@section('description', __('Browse our full collection of promotional gifts and items. Keychains, pens, power banks, USB drives, bottles, tumblers and clocks.'))

@section('content')

{{-- ============================================================
     BREADCRUMB
     ============================================================ --}}
<div class="bg-white border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-x-2 py-3.5 text-sm">
            <a href="{{ url('/') }}"
               class="text-gray-500 hover:text-primary transition-colors">
                {{ __('Home') }}
            </a>
            <svg class="h-4 w-4 text-gray-300 rtl:rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-semibold text-primary">{{ __('Shop') }}</span>
        </nav>
    </div>
</div>


{{-- ============================================================
     SHOP HEADER
     ============================================================ --}}
<section class="bg-gradient-to-br from-primary via-primary to-[#162e4e] py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-6 text-center lg:flex-row lg:justify-between lg:text-start">

            {{-- Title --}}
            <div>
                <h1 class="text-2xl font-extrabold text-white sm:text-3xl">
                    {{ __('All Products') }}
                </h1>
                <p class="mt-1.5 text-sm text-blue-200">
                    {{ __('Promotional gifts & branded items â€” bulk orders welcome') }}
                </p>
            </div>

            {{-- Search Bar --}}
            <div class="w-full max-w-md">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-4">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        placeholder="{{ __('Search products...') }}"
                        class="w-full rounded-xl border-0 bg-white/10 py-3 ps-10 pe-4 text-sm text-white placeholder-blue-200 backdrop-blur-sm ring-1 ring-white/20 transition focus:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/40"
                    >
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     CATEGORY FILTER TABS
     ============================================================ --}}
<div class="sticky top-16 z-30 bg-white shadow-sm border-b border-gray-100" x-data="{ active: 'all' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-x-1 overflow-x-auto py-3 scrollbar-hide">

            {{-- "All" tab --}}
            <button
                @click="active = 'all'"
                :class="active === 'all' ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                class="flex shrink-0 items-center gap-x-1.5 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-150">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                {{ __('All Categories') }}
                <span class="ms-0.5 rounded-full bg-white/20 px-1.5 py-0.5 text-xs font-bold leading-none"
                      :class="active === 'all' ? 'bg-white/25 text-white' : 'bg-gray-100 text-gray-700'">
                    48
                </span>
            </button>

            @php
                $filterCats = [
                    ['slug' => 'keychains',        'label' => __('Keychains'),        'count' => 12, 'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                    ['slug' => 'pens',             'label' => __('Pens'),             'count' => 8,  'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                    ['slug' => 'power-banks',      'label' => __('Power Banks'),      'count' => 6,  'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['slug' => 'usb-drives',       'label' => __('USB Drives'),       'count' => 5,  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                    ['slug' => 'bottles-tumblers', 'label' => __('Bottles & Tumblers'), 'count' => 10, 'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                    ['slug' => 'clocks',           'label' => __('Clocks'),           'count' => 7,  'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];
            @endphp

            @foreach($filterCats as $cat)
                <button
                    @click="active = '{{ $cat['slug'] }}'"
                    :class="active === '{{ $cat['slug'] }}' ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900'"
                    class="flex shrink-0 items-center gap-x-1.5 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-150">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $cat['icon'] }}"/>
                    </svg>
                    {{ $cat['label'] }}
                    <span class="ms-0.5 rounded-full px-1.5 py-0.5 text-xs font-bold leading-none"
                          :class="active === '{{ $cat['slug'] }}' ? 'bg-white/25 text-white' : 'bg-gray-100 text-gray-700'">
                        {{ $cat['count'] }}
                    </span>
                </button>
            @endforeach
        </div>
    </div>
</div>


{{-- ============================================================
     MAIN CONTENT: SORT BAR + PRODUCTS
     ============================================================ --}}
<section class="py-10 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Sort / Info Bar --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <p class="text-sm text-gray-600">
                {{ __('Showing') }} <span class="font-bold text-gray-900">48</span> {{ __('products') }}
            </p>
            <div class="flex items-center gap-x-2">
                <label for="sort" class="text-sm text-gray-600 shrink-0">{{ __('Sort by') }}:</label>
                <select id="sort"
                        class="rounded-lg border border-gray-200 bg-white py-2 ps-3 pe-8 text-sm text-gray-700 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="featured">{{ __('Featured') }}</option>
                    <option value="price_asc">{{ __('Price: Low to High') }}</option>
                    <option value="price_desc">{{ __('Price: High to Low') }}</option>
                    <option value="newest">{{ __('Newest First') }}</option>
                </select>
            </div>
        </div>

        {{-- Products Grid --}}
        @php
            $allProducts = [
                ['name' => 'Premium Metal Keychain',   'price' => 450,  'b2b_price' => 320,  'min_b2b' => 100, 'category' => 'keychains',        'cat_label' => __('Keychains'),          'badge' => __('Best Seller'), 'badge_color' => 'bg-gold',          'icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-500',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                ['name' => 'Zinc Alloy Logo Keychain', 'price' => 380,  'b2b_price' => 270,  'min_b2b' => 100, 'category' => 'keychains',        'cat_label' => __('Keychains'),          'badge' => null,              'badge_color' => '',                 'icon_bg' => 'from-orange-50 to-orange-100',  'icon_color' => 'text-orange-500',  'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                ['name' => 'Leather Keychain with Clip','price' => 520, 'b2b_price' => 390,  'min_b2b' => 50,  'category' => 'keychains',        'cat_label' => __('Keychains'),          'badge' => __('New'),         'badge_color' => 'bg-green-500',     'icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-600',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                ['name' => 'Executive Ballpoint Pen',  'price' => 180,  'b2b_price' => 120,  'min_b2b' => 200, 'category' => 'pens',             'cat_label' => __('Pens'),               'badge' => __('Popular'),     'badge_color' => 'bg-purple-500',    'icon_bg' => 'from-blue-50 to-blue-100',      'icon_color' => 'text-blue-500',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                ['name' => 'Metal Roller Pen (Engraved)','price' => 320,'b2b_price' => 230,  'min_b2b' => 100, 'category' => 'pens',             'cat_label' => __('Pens'),               'badge' => __('New'),         'badge_color' => 'bg-green-500',     'icon_bg' => 'from-blue-50 to-blue-100',      'icon_color' => 'text-blue-600',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                ['name' => 'Gel Ink Pens (Set of 5)',  'price' => 250,  'b2b_price' => 175,  'min_b2b' => 200, 'category' => 'pens',             'cat_label' => __('Pens'),               'badge' => null,              'badge_color' => '',                 'icon_bg' => 'from-indigo-50 to-indigo-100',  'icon_color' => 'text-indigo-500',  'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                ['name' => '10000mAh Power Bank',      'price' => 1800, 'b2b_price' => 1400, 'min_b2b' => 50,  'category' => 'power-banks',      'cat_label' => __('Power Banks'),        'badge' => __('Best Seller'), 'badge_color' => 'bg-gold',          'icon_bg' => 'from-green-50 to-green-100',    'icon_color' => 'text-green-500',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['name' => 'Slim USB-C Power Bank 5000mAh','price' => 2200,'b2b_price' => 1750,'min_b2b' => 50, 'category' => 'power-banks',     'cat_label' => __('Power Banks'),        'badge' => __('Popular'),     'badge_color' => 'bg-emerald-500',   'icon_bg' => 'from-emerald-50 to-emerald-100','icon_color' => 'text-emerald-500', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['name' => 'Wireless Charging Power Bank','price' => 3500,'b2b_price' => 2800,'min_b2b' => 25, 'category' => 'power-banks',      'cat_label' => __('Power Banks'),        'badge' => __('New'),         'badge_color' => 'bg-green-500',     'icon_bg' => 'from-green-50 to-green-100',    'icon_color' => 'text-green-600',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['name' => '32GB Metal USB Drive',     'price' => 950,  'b2b_price' => 720,  'min_b2b' => 100, 'category' => 'usb-drives',       'cat_label' => __('USB Drives'),         'badge' => __('Popular'),     'badge_color' => 'bg-purple-500',    'icon_bg' => 'from-purple-50 to-purple-100',  'icon_color' => 'text-purple-500',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                ['name' => '64GB Card-Style USB Drive','price' => 1200, 'b2b_price' => 950,  'min_b2b' => 100, 'category' => 'usb-drives',       'cat_label' => __('USB Drives'),         'badge' => __('New'),         'badge_color' => 'bg-green-500',     'icon_bg' => 'from-violet-50 to-violet-100',  'icon_color' => 'text-violet-500',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                ['name' => 'Stainless Steel Tumbler',  'price' => 1200, 'b2b_price' => 950,  'min_b2b' => 50,  'category' => 'bottles-tumblers', 'cat_label' => __('Bottles & Tumblers'), 'badge' => __('Best Seller'), 'badge_color' => 'bg-gold',          'icon_bg' => 'from-cyan-50 to-cyan-100',      'icon_color' => 'text-cyan-500',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                ['name' => 'Insulated Water Bottle 700ml','price' => 850,'b2b_price' => 650, 'min_b2b' => 100, 'category' => 'bottles-tumblers', 'cat_label' => __('Bottles & Tumblers'), 'badge' => __('Popular'),     'badge_color' => 'bg-teal-500',      'icon_bg' => 'from-teal-50 to-teal-100',      'icon_color' => 'text-teal-500',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                ['name' => 'Digital Desk Clock',       'price' => 1500, 'b2b_price' => 1200, 'min_b2b' => 25,  'category' => 'clocks',           'cat_label' => __('Clocks'),             'badge' => __('Popular'),     'badge_color' => 'bg-purple-500',    'icon_bg' => 'from-rose-50 to-rose-100',      'icon_color' => 'text-rose-500',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['name' => 'Wall Clock with Logo Print','price' => 1800,'b2b_price' => 1450, 'min_b2b' => 25,  'category' => 'clocks',           'cat_label' => __('Clocks'),             'badge' => __('New'),         'badge_color' => 'bg-green-500',     'icon_bg' => 'from-pink-50 to-pink-100',      'icon_color' => 'text-pink-500',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['name' => 'Copper Keyring with Box',  'price' => 650,  'b2b_price' => 480,  'min_b2b' => 50,  'category' => 'keychains',        'cat_label' => __('Keychains'),          'badge' => null,              'badge_color' => '',                 'icon_bg' => 'from-yellow-50 to-yellow-100',  'icon_color' => 'text-yellow-600',  'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                ['name' => 'Soft Touch Matte Pen',     'price' => 220,  'b2b_price' => 155,  'min_b2b' => 200, 'category' => 'pens',             'cat_label' => __('Pens'),               'badge' => null,              'badge_color' => '',                 'icon_bg' => 'from-sky-50 to-sky-100',        'icon_color' => 'text-sky-500',     'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
            ];
        @endphp

        <div class="grid grid-cols-2 gap-4 sm:gap-5 md:grid-cols-3 lg:grid-cols-4">
            @foreach($allProducts as $product)
                <div class="group relative flex flex-col rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-xl hover:ring-primary/20 transition-all duration-300 hover:-translate-y-1.5 overflow-hidden">

                    {{-- Product Image Area --}}
                    <div class="relative overflow-hidden bg-gradient-to-br {{ $product['icon_bg'] }} aspect-square flex items-center justify-center">
                        <svg class="h-16 w-16 sm:h-20 sm:w-20 {{ $product['icon_color'] }} opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $product['icon'] }}"/>
                        </svg>

                        {{-- Top badges --}}
                        <div class="absolute inset-x-0 top-0 flex items-start justify-between p-2.5">
                            <span class="rounded-md bg-white/80 backdrop-blur-sm px-2 py-0.5 text-xs font-semibold text-gray-700 shadow-sm">
                                {{ $product['cat_label'] }}
                            </span>
                            @if($product['badge'])
                                <span class="rounded-md {{ $product['badge_color'] }} px-2 py-0.5 text-xs font-bold text-white shadow-sm">
                                    {{ $product['badge'] }}
                                </span>
                            @endif
                        </div>

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-primary/60 opacity-0 group-hover:opacity-100 transition-opacity duration-200 backdrop-blur-[2px]">
                            <div class="flex gap-x-2">
                                <button class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-primary shadow-lg transition hover:bg-gold hover:text-white active:scale-95"
                                        title="{{ __('Add to Cart') }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
                                <a href="#"
                                   class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-primary shadow-lg transition hover:bg-primary hover:text-white active:scale-95"
                                   title="{{ __('Quick View') }}">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="flex flex-1 flex-col p-3.5 sm:p-4">
                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 leading-snug group-hover:text-primary transition-colors flex-1">
                            {{ $product['name'] }}
                        </h3>

                        {{-- Prices --}}
                        <div class="mt-2.5 space-y-1">
                            <div class="text-base font-extrabold text-primary">
                                {{ __('Rs.') }} {{ number_format($product['price'], 0) }}
                            </div>
                            <div class="text-xs text-gray-500">
                                <span class="font-semibold text-gold-dark">{{ __('B2B Price') }}:</span>
                                {{ __('Rs.') }} {{ number_format($product['b2b_price'], 0) }}
                            </div>
                        </div>

                        {{-- Min B2B Qty + Stock --}}
                        <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center gap-x-1">
                                <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                <span class="text-xs text-gray-500">{{ __('In Stock') }}</span>
                            </div>
                            <span class="text-xs text-gray-400">
                                {{ __('Min') }} {{ $product['min_b2b'] }} {{ __('pcs (B2B)') }}
                            </span>
                        </div>

                        {{-- Add to Cart Button --}}
                        <button class="mt-3 w-full rounded-xl bg-primary py-2.5 text-xs font-bold text-white transition-all hover:bg-primary-dark active:scale-95 group-hover:bg-gold group-hover:shadow-md">
                            {{ __('Add to Cart') }}
                        </button>
                    </div>

                </div>
            @endforeach
        </div>

        {{-- Load More Button --}}
        <div class="mt-12 text-center">
            <button class="inline-flex items-center gap-x-2 rounded-2xl border-2 border-primary px-10 py-3.5 text-sm font-bold text-primary transition-all hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                {{ __('Load More Products') }}
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <p class="mt-3 text-xs text-gray-400">{{ __('Showing 16 of 48 products') }}</p>
        </div>

    </div>
</section>


{{-- ============================================================
     B2B BULK QUOTE CTA
     ============================================================ --}}
<section class="relative overflow-hidden bg-gradient-to-r from-primary via-primary-light to-primary-dark py-14">
    <div class="absolute -start-16 -top-16 h-64 w-64 rounded-full bg-white/5 blur-xl"></div>
    <div class="absolute -end-16 -bottom-16 h-64 w-64 rounded-full bg-gold/10 blur-xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-6 text-center lg:flex-row lg:justify-between lg:text-start">

            <div class="max-w-xl">
                <div class="mb-3 inline-flex items-center gap-x-2 rounded-full bg-gold/20 px-4 py-1.5 text-xs font-semibold text-gold">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    {{ __('Bulk Orders') }}
                </div>
                <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
                    {{ __('Need a Custom Bulk Order?') }}
                </h2>
                <p class="mt-3 text-base text-blue-200">
                    {{ __('Get special wholesale pricing for orders of 50+ pieces. Custom logo printing available.') }}
                </p>
            </div>

            <div class="flex shrink-0 flex-col items-center gap-y-3 sm:flex-row sm:gap-x-3">
                <a href="{{ url('/contact') }}"
                   class="inline-flex items-center gap-x-2 rounded-2xl bg-gold px-8 py-3.5 text-sm font-extrabold text-white shadow-xl shadow-amber-900/30 transition-all hover:bg-gold-dark hover:-translate-y-0.5 active:scale-95">
                    {{ __('Get Bulk Quote') }}
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <a href="https://wa.me/923084570786"
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-x-2 rounded-2xl border-2 border-white/30 px-8 py-3.5 text-sm font-semibold text-white transition-all hover:border-white hover:bg-white/10 active:scale-95">
                    <svg class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    {{ __('WhatsApp Us') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection


