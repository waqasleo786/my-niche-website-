@extends('layouts.storefront')

@section('title', $product->name . ' - ' . $product->category->name)
@section('description', Str::limit($product->description ?? '', 160))

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-white border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-x-2 py-3.5 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary transition-colors">{{ __('Home') }}</a>
            <svg class="h-4 w-4 text-gray-300 rtl:rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('shop') }}" class="text-gray-500 hover:text-primary transition-colors">{{ __('Shop') }}</a>
            <svg class="h-4 w-4 text-gray-300 rtl:rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('shop') }}?category={{ $product->category->slug }}"
               class="text-gray-500 hover:text-primary transition-colors">{{ $product->category->name }}</a>
            <svg class="h-4 w-4 text-gray-300 rtl:rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-semibold text-primary truncate max-w-[200px]">{{ $product->name }}</span>
        </nav>
    </div>
</div>


{{-- PRODUCT DETAIL --}}
<section class="py-12 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2">

            {{-- LEFT: Product Image --}}
            <div class="flex flex-col gap-4">
                @php
                    $productIconMap = [
                        'keychains'        => ['icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-400',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                        'pens'             => ['icon_bg' => 'from-blue-50 to-blue-100',       'icon_color' => 'text-blue-400',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                        'power-banks'      => ['icon_bg' => 'from-green-50 to-green-100',     'icon_color' => 'text-green-400',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                        'usb-drives'       => ['icon_bg' => 'from-purple-50 to-purple-100',   'icon_color' => 'text-purple-400',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                        'bottles-tumblers' => ['icon_bg' => 'from-cyan-50 to-cyan-100',       'icon_color' => 'text-cyan-400',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                        'clocks'           => ['icon_bg' => 'from-rose-50 to-rose-100',       'icon_color' => 'text-rose-400',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                    $pStyle   = $productIconMap[$product->category->slug] ?? ['icon_bg' => 'from-gray-50 to-gray-100', 'icon_color' => 'text-gray-300', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'];
                    $hasImage = $product->hasMedia('images');
                @endphp

                {{-- Main image --}}
                <div class="overflow-hidden rounded-2xl aspect-square flex items-center justify-center {{ $hasImage ? 'bg-gray-100' : 'bg-gradient-to-br ' . $pStyle['icon_bg'] }} ring-1 ring-gray-100">
                    @if($hasImage)
                        <img src="{{ $product->getFirstMediaUrl('images', 'card') }}"
                             alt="{{ $product->name }}"
                             class="h-full w-full object-cover">
                    @else
                        <svg class="h-32 w-32 sm:h-48 sm:w-48 {{ $pStyle['icon_color'] }} opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.75" d="{{ $pStyle['icon'] }}"/>
                        </svg>
                    @endif
                </div>

                {{-- Thumbnail gallery --}}
                @if($product->getMedia('images')->count() > 1)
                    <div class="flex gap-3 overflow-x-auto">
                        @foreach($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl('thumb') }}"
                                 alt="{{ $product->name }}"
                                 class="h-20 w-20 shrink-0 rounded-xl object-cover ring-1 ring-gray-200 cursor-pointer hover:ring-primary transition-all">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- RIGHT: Product Info --}}
            <div class="flex flex-col gap-y-6">

                {{-- Category + Featured badge --}}
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('shop') }}?category={{ $product->category->slug }}"
                       class="rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary hover:bg-primary hover:text-white transition-colors">
                        {{ $product->category->name }}
                    </a>
                    @if($product->is_featured)
                        <span class="rounded-full bg-gold px-3.5 py-1 text-xs font-bold text-white">
                            {{ __('Featured') }}
                        </span>
                    @endif
                    @if($product->isInStock())
                        <span class="flex items-center gap-x-1 text-xs text-green-600 font-semibold">
                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                            {{ __('In Stock') }}
                        </span>
                    @else
                        <span class="flex items-center gap-x-1 text-xs text-red-500 font-semibold">
                            <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-400"></span>
                            {{ __('Out of Stock') }}
                        </span>
                    @endif
                </div>

                {{-- Product Name --}}
                <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl leading-tight">
                    {{ $product->name }}
                </h1>

                {{-- SKU --}}
                @if($product->sku)
                    <p class="text-xs text-gray-400">{{ __('SKU') }}: {{ $product->sku }}</p>
                @endif

                {{-- Pricing --}}
                <div class="rounded-2xl bg-gray-50 p-5 space-y-3">
                    <div class="flex items-end gap-x-3">
                        <span class="text-3xl font-extrabold text-primary">{{ $product->getFormattedPrice() }}</span>
                        <span class="mb-1 text-sm text-gray-400">{{ __('per piece (retail)') }}</span>
                    </div>
                    @if($product->b2b_price)
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex items-center gap-x-2">
                                <span class="rounded-md bg-gold/10 px-2 py-0.5 text-xs font-bold text-gold-dark">{{ __('B2B Price') }}</span>
                                <span class="text-xl font-bold text-gray-800">{{ $product->getFormattedB2bPrice() }}</span>
                                <span class="text-sm text-gray-400">/ {{ __('piece') }}</span>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                {{ __('Minimum') }} <strong>{{ $product->min_b2b_quantity }}</strong> {{ __('pieces for B2B pricing') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Description --}}
                @if($product->description)
                    <div>
                        <h2 class="text-sm font-bold text-gray-700 mb-2">{{ __('Product Description') }}</h2>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col gap-3 sm:flex-row">

                    @if ($product->isInStock())
                        <form method="POST" action="{{ route('cart.add', $product->slug) }}" class="flex-1 flex gap-2">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}"
                                   class="w-20 rounded-2xl border border-gray-300 px-3 py-3 text-center text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <button type="submit"
                                    class="flex-1 rounded-2xl bg-primary py-3.5 text-sm font-bold text-white hover:bg-primary/90 transition-colors flex items-center justify-center gap-x-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                {{ __('Add to Cart') }}
                            </button>
                        </form>
                    @else
                        <button disabled
                                class="flex-1 rounded-2xl bg-gray-200 py-3.5 text-sm font-bold text-gray-400 cursor-not-allowed flex items-center justify-center gap-x-2">
                            {{ __('Out of Stock') }}
                        </button>
                    @endif

                    <a href="https://wa.me/923084570786?text={{ urlencode(__('Hi! I am interested in: ') . $product->name . ' (SKU: ' . $product->sku . ')') }}"
                       target="_blank" rel="noopener noreferrer"
                       class="flex-1 rounded-2xl border-2 border-green-500 bg-green-500 py-3.5 text-sm font-bold text-white transition-all hover:bg-green-600 hover:border-green-600 flex items-center justify-center gap-x-2">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        {{ __('Order via WhatsApp') }}
                    </a>
                </div>

                {{-- B2B info note --}}
                <div class="rounded-xl bg-blue-50 border border-blue-100 p-4">
                    <p class="text-xs text-blue-700">
                        <strong>{{ __('B2B Buyers:') }}</strong>
                        {{ __('Contact us for bulk pricing, custom logo printing, and corporate orders.') }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- RELATED PRODUCTS --}}
@if($related->isNotEmpty())
<section class="py-12 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8 text-center">
            <h2 class="text-xl font-bold text-gray-900 sm:text-2xl">{{ __('Related Products') }}</h2>
            <div class="mx-auto mt-2 h-1 w-10 rounded-full bg-gold"></div>
        </div>

        @php
            $relIconMap = [
                'keychains'        => ['icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-500',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                'pens'             => ['icon_bg' => 'from-blue-50 to-blue-100',       'icon_color' => 'text-blue-500',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                'power-banks'      => ['icon_bg' => 'from-green-50 to-green-100',     'icon_color' => 'text-green-500',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                'usb-drives'       => ['icon_bg' => 'from-purple-50 to-purple-100',   'icon_color' => 'text-purple-500',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                'bottles-tumblers' => ['icon_bg' => 'from-cyan-50 to-cyan-100',       'icon_color' => 'text-cyan-500',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                'clocks'           => ['icon_bg' => 'from-rose-50 to-rose-100',       'icon_color' => 'text-rose-500',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            $relDefaultStyle = ['icon_bg' => 'from-gray-50 to-gray-100', 'icon_color' => 'text-gray-400', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'];
        @endphp

        <div class="grid grid-cols-2 gap-4 sm:gap-5 md:grid-cols-4">
            @foreach($related as $item)
                @php
                    $rStyle   = $relIconMap[$item->category->slug] ?? $relDefaultStyle;
                    $rHasImg  = $item->hasMedia('images');
                @endphp
                <a href="{{ route('products.show', $item->slug) }}"
                   class="group flex flex-col rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-xl hover:ring-primary/20 transition-all duration-300 hover:-translate-y-1.5 overflow-hidden">

                    <div class="relative overflow-hidden aspect-square flex items-center justify-center {{ $rHasImg ? 'bg-gray-100' : 'bg-gradient-to-br ' . $rStyle['icon_bg'] }}">
                        @if($rHasImg)
                            <img src="{{ $item->getFirstMediaUrl('images', 'card') }}"
                                 alt="{{ $item->name }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <svg class="h-14 w-14 {{ $rStyle['icon_color'] }} opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $rStyle['icon'] }}"/>
                            </svg>
                        @endif
                    </div>

                    <div class="p-3.5">
                        <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 group-hover:text-primary transition-colors">
                            {{ $item->name }}
                        </h3>
                        <p class="mt-1.5 text-sm font-extrabold text-primary">{{ $item->getFormattedPrice() }}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection
