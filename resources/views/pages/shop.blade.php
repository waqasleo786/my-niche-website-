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
                    {{ __('Promotional gifts & branded items — bulk orders welcome') }}
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
<div class="sticky top-16 z-30 bg-white shadow-sm border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-x-1 overflow-x-auto py-3 scrollbar-hide">

            {{-- "All" tab --}}
            @php
                $tabIcons = [
                    'keychains'        => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z',
                    'pens'             => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z',
                    'power-banks'      => 'M13 10V3L4 14h7v7l9-11h-7z',
                    'usb-drives'       => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14',
                    'bottles-tumblers' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8',
                    'clocks'           => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
                $defaultTabIcon = 'M4 6h16M4 10h16M4 14h16M4 18h16';
                $sortParam = $sort !== 'featured' ? '&sort=' . $sort : '';
            @endphp

            <a href="{{ route('shop') }}{{ $sort !== 'featured' ? '?sort=' . $sort : '' }}"
               class="{{ $activeCategory === '' ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}
                      flex shrink-0 items-center gap-x-1.5 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-150">
                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                {{ __('All Categories') }}
                <span class="ms-0.5 rounded-full px-1.5 py-0.5 text-xs font-bold leading-none {{ $activeCategory === '' ? 'bg-white/25 text-white' : 'bg-gray-100 text-gray-700' }}">
                    {{ $totalProducts }}
                </span>
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('shop') }}?category={{ $cat->slug }}{{ $sortParam }}"
                   class="{{ $activeCategory === $cat->slug ? 'bg-primary text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}
                          flex shrink-0 items-center gap-x-1.5 rounded-full px-4 py-2 text-sm font-semibold transition-all duration-150">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $tabIcons[$cat->slug] ?? $defaultTabIcon }}"/>
                    </svg>
                    {{ $cat->name }}
                    <span class="ms-0.5 rounded-full px-1.5 py-0.5 text-xs font-bold leading-none {{ $activeCategory === $cat->slug ? 'bg-white/25 text-white' : 'bg-gray-100 text-gray-700' }}">
                        {{ $cat->products_count }}
                    </span>
                </a>
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
        <form method="GET" action="{{ route('shop') }}">
            @if($activeCategory !== '')
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm text-gray-600">
                    {{ __('Showing') }} <span class="font-bold text-gray-900">{{ $products->total() }}</span> {{ __('products') }}
                </p>
                <div class="flex items-center gap-x-2">
                    <label for="sort" class="text-sm text-gray-600 shrink-0">{{ __('Sort by') }}:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()"
                            class="rounded-lg border border-gray-200 bg-white py-2 ps-3 pe-8 text-sm text-gray-700 shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="featured" {{ $sort === 'featured' ? 'selected' : '' }}>{{ __('Featured') }}</option>
                        <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                        <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                        <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>{{ __('Newest First') }}</option>
                    </select>
                </div>
            </div>
        </form>

        {{-- Products Grid --}}
        @php
            $shopIconMap = [
                'keychains'        => ['icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-500',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                'pens'             => ['icon_bg' => 'from-blue-50 to-blue-100',       'icon_color' => 'text-blue-500',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                'power-banks'      => ['icon_bg' => 'from-green-50 to-green-100',     'icon_color' => 'text-green-500',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                'usb-drives'       => ['icon_bg' => 'from-purple-50 to-purple-100',   'icon_color' => 'text-purple-500',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                'bottles-tumblers' => ['icon_bg' => 'from-cyan-50 to-cyan-100',       'icon_color' => 'text-cyan-500',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                'clocks'           => ['icon_bg' => 'from-rose-50 to-rose-100',       'icon_color' => 'text-rose-500',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            $defaultShopStyle = ['icon_bg' => 'from-gray-50 to-gray-100', 'icon_color' => 'text-gray-400', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'];
        @endphp

        <div class="grid grid-cols-2 gap-4 sm:gap-5 md:grid-cols-3 lg:grid-cols-4">
            @forelse($products as $product)
                @php
                    $sStyle   = $shopIconMap[$product->category->slug] ?? $defaultShopStyle;
                    $hasImage = $product->hasMedia('images');
                @endphp
                <div class="group relative flex flex-col rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-xl hover:ring-primary/20 transition-all duration-300 hover:-translate-y-1.5 overflow-hidden">

                    {{-- Product Image Area --}}
                    <div class="relative overflow-hidden aspect-square flex items-center justify-center {{ $hasImage ? 'bg-gray-100' : 'bg-gradient-to-br ' . $sStyle['icon_bg'] }}">
                        @if($hasImage)
                            <img src="{{ $product->getFirstMediaUrl('images', 'card') }}"
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <svg class="h-16 w-16 sm:h-20 sm:w-20 {{ $sStyle['icon_color'] }} opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $sStyle['icon'] }}"/>
                            </svg>
                        @endif

                        {{-- Top badges --}}
                        <div class="absolute inset-x-0 top-0 flex items-start justify-between p-2.5">
                            <span class="rounded-md bg-white/80 backdrop-blur-sm px-2 py-0.5 text-xs font-semibold text-gray-700 shadow-sm">
                                {{ $product->category->name }}
                            </span>
                            @if($product->is_featured)
                                <span class="rounded-md bg-gold px-2 py-0.5 text-xs font-bold text-white shadow-sm">
                                    {{ __('Featured') }}
                                </span>
                            @endif
                        </div>

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 flex items-center justify-center bg-primary/60 opacity-0 group-hover:opacity-100 transition-opacity duration-200 backdrop-blur-[2px]">
                            <div class="flex gap-x-2">
                                @if ($product->isInStock())
                                    <form method="POST" action="{{ route('cart.add', $product->slug) }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-primary shadow-lg transition hover:bg-gold hover:text-white active:scale-95"
                                                title="{{ __('Add to Cart') }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-primary shadow-lg transition hover:bg-primary hover:text-white active:scale-95"
                                   title="{{ __('View Details') }}">
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
                            {{ $product->name }}
                        </h3>

                        {{-- Prices --}}
                        <div class="mt-2.5 space-y-1">
                            <div class="text-base font-extrabold text-primary">
                                {{ $product->getFormattedPrice() }}
                            </div>
                            @if($product->b2b_price)
                                <div class="text-xs text-gray-500">
                                    <span class="font-semibold text-gold-dark">{{ __('B2B') }}:</span>
                                    {{ $product->getFormattedB2bPrice() }}
                                </div>
                            @endif
                        </div>

                        {{-- Stock + Min Qty --}}
                        <div class="mt-2 flex items-center justify-between">
                            <div class="flex items-center gap-x-1">
                                @if($product->isInStock())
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    <span class="text-xs text-gray-500">{{ __('In Stock') }}</span>
                                @else
                                    <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                    <span class="text-xs text-gray-500">{{ __('Out of Stock') }}</span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-400">
                                {{ __('Min') }} {{ $product->min_b2b_quantity }} {{ __('pcs (B2B)') }}
                            </span>
                        </div>

                        {{-- View Details Button --}}
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="mt-3 block w-full rounded-xl bg-primary py-2.5 text-center text-xs font-bold text-white transition-all hover:bg-primary-dark active:scale-95 group-hover:bg-gold group-hover:shadow-md">
                            {{ __('View Details') }}
                        </a>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <p class="text-gray-400">{{ __('No products found.') }}</p>
                    <a href="{{ route('shop') }}" class="mt-4 inline-block text-sm text-primary hover:underline">
                        {{ __('View all products') }}
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="mt-10">
                {{ $products->links('pagination::tailwind') }}
            </div>
            <p class="mt-3 text-center text-xs text-gray-400">
                {{ __('Showing') }} {{ $products->firstItem() }}–{{ $products->lastItem() }} {{ __('of') }} {{ $products->total() }} {{ __('products') }}
            </p>
        @endif

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


