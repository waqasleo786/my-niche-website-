@extends('layouts.storefront')

@section('title', __('Quality Imports, Trusted Service'))
@section('description', __('We import quality promotional and gift items from China and deliver across Pakistan.'))

@section('content')

{{-- ============================================================
     SECTION 0: TOP ANNOUNCEMENT BAR
     ============================================================ --}}
<div class="bg-primary text-white text-xs py-2.5 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-1 text-center">
            <span class="flex items-center gap-x-1.5">
                <svg class="h-3.5 w-3.5 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Free delivery on orders above') }} <strong class="ms-1 text-gold">Rs. 5,000</strong>
            </span>
            <span class="hidden sm:block text-white/30">|</span>
            <span class="flex items-center gap-x-1.5">
                <svg class="h-3.5 w-3.5 text-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Cash on Delivery available') }}
            </span>
            <span class="hidden sm:block text-white/30">|</span>
            <a href="https://wa.me/923084570786" class="flex items-center gap-x-1.5 text-white hover:text-gold transition-colors">
                <svg class="h-3.5 w-3.5 text-green-400 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                {{ __('WhatsApp Us') }}: <span class="font-semibold ms-1">0308-4570786</span>
            </a>
        </div>
    </div>
</div>


{{-- ============================================================
     SECTION 1: HERO SLIDER
     ============================================================ --}}
<section
    class="relative overflow-hidden"
    x-data="{
        current: 0,
        total: 3,
        timer: null,
        pgTimer: null,
        progress: 0,
        next() { this.current = (this.current + 1) % this.total; this.restart(); },
        prev() { this.current = (this.current - 1 + this.total) % this.total; this.restart(); },
        goTo(i) { this.current = i; this.restart(); },
        stop() { clearInterval(this.timer); clearInterval(this.pgTimer); },
        start() {
            this.stop();
            this.timer   = setInterval(() => this.next(), 5000);
            this.pgTimer = setInterval(() => { this.progress = Math.min(100, this.progress + 1); }, 50);
        },
        restart() { this.progress = 0; this.start(); }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
>
    @php
        $slides = [
            [
                'bg'         => 'from-[#1e3a5f] via-[#1e3a5f] to-[#162e4e]',
                'badge'      => __('#1 Promotional Gifts Brand'),
                'heading'    => __('Premium Promotional Gifts for Every Occasion'),
                'sub'        => __('Bulk orders for businesses. Fast delivery across Pakistan.'),
                'text_color' => 'text-blue-200',
                'trust'      => ['JazzCash & EasyPaisa', __('Cash on Delivery available'), __('Free delivery above Rs. 5,000')],
                'products'   => [
                    ['icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z', 'name' => __('Keychains'), 'price' => 'Rs. 180+', 'color' => 'bg-amber-500/20 text-amber-300'],
                    ['icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z', 'name' => __('Pens'), 'price' => 'Rs. 120+', 'color' => 'bg-blue-500/20 text-blue-300'],
                    ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'name' => __('Power Banks'), 'price' => 'Rs. 1,800+', 'color' => 'bg-green-500/20 text-green-300'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'name' => __('Clocks'), 'price' => 'Rs. 1,200+', 'color' => 'bg-purple-500/20 text-purple-300'],
                ],
            ],
            [
                'bg'         => 'from-[#064e3b] via-[#065f46] to-[#047857]',
                'badge'      => __('Minimum 50 pieces per order'),
                'heading'    => __('Branded Gifts for Your Business'),
                'sub'        => __('Custom logo printing on keychains, pens, power banks & more.'),
                'text_color' => 'text-emerald-200',
                'trust'      => [__('Minimum 50 pieces per order'), __('Custom logo printing available'), __('Up to 40% off retail price')],
                'products'   => [
                    ['icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14', 'name' => __('USB Drives'), 'price' => 'Rs. 720+', 'color' => 'bg-cyan-500/20 text-cyan-300'],
                    ['icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8', 'name' => __('Bottles & Tumblers'), 'price' => 'Rs. 950+', 'color' => 'bg-teal-500/20 text-teal-300'],
                    ['icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z', 'name' => __('Keychains'), 'price' => 'Rs. 320+', 'color' => 'bg-rose-500/20 text-rose-300'],
                    ['icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z', 'name' => __('Pens'), 'price' => 'Rs. 120+', 'color' => 'bg-indigo-500/20 text-indigo-300'],
                ],
            ],
            [
                'bg'         => 'from-[#312e81] via-[#3730a3] to-[#4338ca]',
                'badge'      => __('Delivery across Pakistan'),
                'heading'    => __('Quality Imports, Trusted Service'),
                'sub'        => __('B2B wholesale prices for registered business customers.'),
                'text_color' => 'text-indigo-200',
                'trust'      => [__('25+ cities served'), __('5+ years experience'), __('500+ satisfied clients')],
                'products'   => [
                    ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'name' => __('Power Banks'), 'price' => 'Rs. 1,400+', 'color' => 'bg-emerald-500/20 text-emerald-300'],
                    ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'name' => __('Clocks'), 'price' => 'Rs. 1,200+', 'color' => 'bg-violet-500/20 text-violet-300'],
                    ['icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14', 'name' => __('USB Drives'), 'price' => 'Rs. 720+', 'color' => 'bg-orange-500/20 text-orange-300'],
                    ['icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8', 'name' => __('Bottles & Tumblers'), 'price' => 'Rs. 950+', 'color' => 'bg-sky-500/20 text-sky-300'],
                ],
            ],
        ];
    @endphp

    {{-- Slides --}}
    @foreach($slides as $i => $slide)
    <div
        x-show="current === {{ $i }}"
        x-transition:enter="transition-all duration-700 ease-in-out"
        x-transition:enter-start="opacity-0 translate-x-4"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition-all duration-300 ease-in-out"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="bg-gradient-to-br {{ $slide['bg'] }}"
        style="{{ $i > 0 ? 'display:none;' : '' }}"
    >
        {{-- Subtle dot pattern overlay --}}
        <div class="absolute inset-0 opacity-5"
             style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-[520px] flex-col items-center gap-8 py-14 sm:py-16 lg:flex-row lg:min-h-[580px] lg:gap-12">

                {{-- Left: Text Content --}}
                <div class="flex-1 text-center lg:text-start" data-aos="fade-right">
                    {{-- Badge --}}
                    <span class="inline-flex items-center gap-x-1.5 rounded-full bg-white/10 px-4 py-1.5 text-xs font-medium text-white backdrop-blur-sm ring-1 ring-white/20 mb-5">
                        {{ $slide['badge'] }}
                    </span>

                    {{-- Heading --}}
                    <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl max-w-lg">
                        {{ $slide['heading'] }}
                    </h1>

                    {{-- Subtext --}}
                    <p class="mt-4 text-base {{ $slide['text_color'] }} max-w-md mx-auto lg:mx-0">
                        {{ $slide['sub'] }}
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                        <a href="{{ url('/shop') }}"
                           class="inline-flex items-center gap-x-2 rounded-xl bg-gold px-6 py-3 text-sm font-bold text-white shadow-lg shadow-amber-900/30 transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-xl active:scale-95">
                            {{ __('Shop Now') }}
                            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ url('/contact') }}"
                           class="inline-flex items-center gap-x-2 rounded-xl border-2 border-white/30 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition-all hover:border-white hover:bg-white/10 active:scale-95">
                            {{ __('Get Bulk Quote') }}
                        </a>
                    </div>

                    {{-- Trust Badges --}}
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-x-5 gap-y-2 lg:justify-start">
                        @foreach($slide['trust'] as $trustLabel)
                            <span class="flex items-center gap-x-1.5 text-xs {{ $slide['text_color'] }}">
                                <svg class="h-3.5 w-3.5 text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $trustLabel }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Product Showcase (desktop only) --}}
                <div class="hidden lg:flex flex-shrink-0 items-center justify-center">
                    <div class="relative w-80">
                        {{-- Main product grid card --}}
                        <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-5 shadow-2xl">
                            <div class="mb-3 flex items-center justify-between">
                                <span class="text-xs font-semibold text-white/80">{{ __('Our Products') }}</span>
                                <span class="rounded-full bg-gold/90 px-2.5 py-0.5 text-xs font-bold text-white">{{ __('Best Seller') }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2.5">
                                @foreach($slide['products'] as $prod)
                                    <div class="rounded-xl {{ $prod['color'] }} border border-white/10 p-3 transition-all hover:scale-105">
                                        <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-lg bg-white/10">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $prod['icon'] }}"/>
                                            </svg>
                                        </div>
                                        <div class="text-xs font-semibold text-white leading-tight">{{ $prod['name'] }}</div>
                                        <div class="mt-0.5 text-xs font-bold text-gold-light">{{ $prod['price'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- Bottom stats --}}
                            <div class="mt-4 grid grid-cols-2 gap-2 border-t border-white/10 pt-4">
                                <div class="text-center">
                                    <div class="text-lg font-extrabold text-white">500+</div>
                                    <div class="text-xs text-blue-300">{{ __('Satisfied Clients') }}</div>
                                </div>
                                <div class="text-center border-s border-white/10">
                                    <div class="text-lg font-extrabold text-white">25+</div>
                                    <div class="text-xs text-blue-300">{{ __('Cities Served') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Floating rating badge --}}
                        <div class="absolute -top-4 -end-4 flex items-center gap-x-1.5 rounded-full bg-white px-3.5 py-2 shadow-xl">
                            <div class="flex gap-x-0.5">
                                @for($s = 0; $s < 5; $s++)
                                    <svg class="h-3.5 w-3.5 text-gold" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs font-bold text-gray-800">4.9</span>
                        </div>

                        {{-- Floating delivery badge --}}
                        <div class="absolute -bottom-4 -start-4 flex items-center gap-x-2 rounded-full bg-green-500 px-3.5 py-2 shadow-xl">
                            <svg class="h-4 w-4 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-xs font-bold text-white">{{ __('Fast Delivery') }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach

    {{-- Prev / Next arrows --}}
    <button @click="prev()"
        class="absolute start-3 sm:start-5 top-1/2 -translate-y-1/2 flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm ring-1 ring-white/20 transition hover:bg-white/20 hover:scale-105">
        <svg class="h-4 w-4 sm:h-5 sm:w-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button @click="next()"
        class="absolute end-3 sm:end-5 top-1/2 -translate-y-1/2 flex h-9 w-9 sm:h-11 sm:w-11 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm ring-1 ring-white/20 transition hover:bg-white/20 hover:scale-105">
        <svg class="h-4 w-4 sm:h-5 sm:w-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Slide indicators --}}
    <div class="absolute bottom-5 start-1/2 -translate-x-1/2 flex items-center gap-x-2">
        @foreach($slides as $i => $slide)
            <button @click="goTo({{ $i }})"
                :class="current === {{ $i }} ? 'w-7 bg-gold' : 'w-2 bg-white/40 hover:bg-white/70'"
                class="h-2 rounded-full transition-all duration-300 ease-out">
            </button>
        @endforeach
    </div>

    {{-- Progress bar at very bottom of hero --}}
    <div class="absolute bottom-0 start-0 end-0 h-0.5 bg-white/10">
        <div class="h-full bg-gold/70 transition-all duration-75 ease-linear" :style="'width: ' + progress + '%'"></div>
    </div>
</section>


{{-- ============================================================
     SECTION 2: STATS STRIP
     ============================================================ --}}
<section class="bg-primary-dark py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
            @php
                $stats = [
                    ['number' => '500+', 'label' => __('Satisfied Clients'),    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['number' => '50+',  'label' => __('Products Available'),   'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                    ['number' => '5+',   'label' => __('Years Experience'),     'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                    ['number' => '25+',  'label' => __('Cities Served'),        'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
            @endphp
            @foreach($stats as $stat)
                <div class="flex flex-col items-center gap-y-2 text-center sm:flex-row sm:items-center sm:gap-x-3 sm:text-start">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white/10">
                        <svg class="h-5 w-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-white">{{ $stat['number'] }}</div>
                        <div class="text-xs text-blue-300">{{ $stat['label'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: SHOP BY CATEGORY
     ============================================================ --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="mb-10 text-center">
            <span class="inline-block rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary mb-3">
                {{ __('Browse Products') }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Shop by Category') }}</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-gold"></div>
        </div>

        {{-- Category Grid --}}
        @php
            $catStyles = [
                'keychains'        => ['bg' => 'bg-amber-50',  'hover' => 'hover:bg-amber-100 hover:border-amber-300',  'icon_bg' => 'bg-amber-100 group-hover:bg-amber-200',  'icon_color' => 'text-amber-600',  'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                'pens'             => ['bg' => 'bg-blue-50',   'hover' => 'hover:bg-blue-100 hover:border-blue-300',    'icon_bg' => 'bg-blue-100 group-hover:bg-blue-200',    'icon_color' => 'text-blue-600',   'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                'power-banks'      => ['bg' => 'bg-green-50',  'hover' => 'hover:bg-green-100 hover:border-green-300',  'icon_bg' => 'bg-green-100 group-hover:bg-green-200',  'icon_color' => 'text-green-600',  'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                'usb-drives'       => ['bg' => 'bg-purple-50', 'hover' => 'hover:bg-purple-100 hover:border-purple-300','icon_bg' => 'bg-purple-100 group-hover:bg-purple-200', 'icon_color' => 'text-purple-600', 'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                'bottles-tumblers' => ['bg' => 'bg-cyan-50',   'hover' => 'hover:bg-cyan-100 hover:border-cyan-300',    'icon_bg' => 'bg-cyan-100 group-hover:bg-cyan-200',    'icon_color' => 'text-cyan-600',   'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                'clocks'           => ['bg' => 'bg-rose-50',   'hover' => 'hover:bg-rose-100 hover:border-rose-300',    'icon_bg' => 'bg-rose-100 group-hover:bg-rose-200',    'icon_color' => 'text-rose-600',   'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            $defaultCatStyle = ['bg' => 'bg-gray-50', 'hover' => 'hover:bg-gray-100 hover:border-gray-300', 'icon_bg' => 'bg-gray-100 group-hover:bg-gray-200', 'icon_color' => 'text-gray-600', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'];
        @endphp

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @forelse($categories as $cat)
                @php $style = $catStyles[$cat->slug] ?? $defaultCatStyle; @endphp
                <a href="{{ route('shop') }}?category={{ $cat->slug }}"
                   class="group flex flex-col items-center gap-y-3 rounded-2xl border-2 border-transparent {{ $style['bg'] }} {{ $style['hover'] }} p-5 sm:p-6 text-center transition-all duration-200 hover:-translate-y-1.5 hover:shadow-md">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl {{ $style['icon_bg'] }} transition-all duration-200">
                        <svg class="h-7 w-7 {{ $style['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $style['icon'] }}"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block text-sm font-bold text-gray-800 group-hover:text-primary transition-colors leading-tight">
                            {{ $cat->name }}
                        </span>
                        <span class="mt-0.5 block text-xs text-gray-500">
                            {{ $cat->products_count }} {{ __('items') }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-sm text-gray-400">{{ __('No categories available yet.') }}</p>
            @endforelse
        </div>

        {{-- Browse All Link --}}
        <div class="mt-8 text-center">
            <a href="{{ route('shop') }}"
               class="inline-flex items-center gap-x-1.5 text-sm font-semibold text-primary hover:text-gold transition-colors group">
                {{ __('Browse all') }} {{ $categories->count() }} {{ __('categories') }}
                <svg class="h-4 w-4 rtl:rotate-180 transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 4: FEATURED PRODUCTS
     ============================================================ --}}
<section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="mb-10 flex flex-col items-center gap-4 text-center sm:flex-row sm:justify-between sm:text-start">
            <div>
                <span class="inline-block rounded-full bg-gold/10 px-3.5 py-1 text-xs font-semibold text-gold-dark mb-2">
                    {{ __('Hand Picked') }}
                </span>
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Featured Products') }}</h2>
                <div class="mt-3 h-1 w-12 rounded-full bg-gold sm:mx-0 mx-auto"></div>
            </div>
            <a href="{{ url('/shop') }}"
               class="inline-flex items-center gap-x-1.5 rounded-xl border border-primary/20 bg-primary/5 px-4 py-2 text-sm font-semibold text-primary transition hover:bg-primary hover:text-white group">
                {{ __('View All Products') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Products Grid --}}
        @php
            $productIconMap = [
                'keychains'        => ['icon_bg' => 'from-amber-50 to-amber-100',    'icon_color' => 'text-amber-500',   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                'pens'             => ['icon_bg' => 'from-blue-50 to-blue-100',       'icon_color' => 'text-blue-500',    'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                'power-banks'      => ['icon_bg' => 'from-green-50 to-green-100',     'icon_color' => 'text-green-500',   'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                'usb-drives'       => ['icon_bg' => 'from-purple-50 to-purple-100',   'icon_color' => 'text-purple-500',  'icon' => 'M9 3v10m3-7l-3 3-3-3m9 4a3 3 0 11-6 0 3 3 0 016 0z M5 20h14'],
                'bottles-tumblers' => ['icon_bg' => 'from-cyan-50 to-cyan-100',       'icon_color' => 'text-cyan-500',    'icon' => 'M9 3h6l1 3H8L9 3zM8 6v14a1 1 0 001 1h6a1 1 0 001-1V6H8z M8 10h8'],
                'clocks'           => ['icon_bg' => 'from-rose-50 to-rose-100',       'icon_color' => 'text-rose-500',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ];
            $defaultProductStyle = ['icon_bg' => 'from-gray-50 to-gray-100', 'icon_color' => 'text-gray-400', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'];
        @endphp

        <div class="grid grid-cols-2 gap-4 sm:gap-5 md:grid-cols-3 lg:grid-cols-4">
            @forelse($featuredProducts as $product)
                @php
                    $pStyle   = $productIconMap[$product->category->slug] ?? $defaultProductStyle;
                    $hasImage = $product->hasMedia('images');
                @endphp
                <div class="group relative flex flex-col rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 hover:shadow-xl hover:ring-primary/20 transition-all duration-300 hover:-translate-y-1.5 overflow-hidden">

                    {{-- Product Image Area --}}
                    <div class="relative overflow-hidden aspect-square flex items-center justify-center {{ $hasImage ? 'bg-gray-100' : 'bg-gradient-to-br ' . $pStyle['icon_bg'] }}">
                        @if($hasImage)
                            <img src="{{ $product->getFirstMediaUrl('images', 'card') }}"
                                 alt="{{ $product->name }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <svg class="h-16 w-16 sm:h-20 sm:w-20 {{ $pStyle['icon_color'] }} opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="{{ $pStyle['icon'] }}"/>
                            </svg>
                        @endif

                        {{-- Top badges row --}}
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
                                    <span class="text-gray-400">/ {{ __('bulk') }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Stock indicator --}}
                        <div class="mt-2 flex items-center gap-x-1.5">
                            @if($product->isInStock())
                                <span class="inline-block h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                <span class="text-xs text-gray-500">{{ __('In Stock') }}</span>
                            @else
                                <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                <span class="text-xs text-gray-500">{{ __('Out of Stock') }}</span>
                            @endif
                        </div>

                        {{-- View Details Button --}}
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="mt-3 block w-full rounded-xl bg-primary py-2.5 text-center text-xs font-bold text-white transition-all hover:bg-primary-dark active:scale-95 group-hover:bg-gold group-hover:shadow-md">
                            {{ __('View Details') }}
                        </a>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-gray-400">{{ __('No featured products available yet.') }}</p>
                </div>
            @endforelse
        </div>

        {{-- View All CTA --}}
        <div class="mt-12 text-center">
            <a href="{{ url('/shop') }}"
               class="inline-flex items-center gap-x-2 rounded-2xl border-2 border-primary px-10 py-3.5 text-sm font-bold text-primary transition-all hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                {{ __('View All Products') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 5: WHY CHOOSE US
     ============================================================ --}}
<section class="py-16 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="mb-12 text-center">
            <span class="inline-block rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary mb-3">
                {{ __('Our Promise') }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Why Choose Us') }}</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-gold"></div>
        </div>

        @php
            $features = [
                [
                    'step'   => '01',
                    'title'  => __('Bulk Orders Welcome'),
                    'desc'   => __('Minimum order quantities for wholesale pricing'),
                    'icon'   => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                    'bg'     => 'bg-blue-50',
                    'border' => 'border-blue-100',
                    'icon_bg' => 'bg-blue-600',
                    'step_color' => 'text-blue-200',
                ],
                [
                    'step'   => '02',
                    'title'  => __('Fast Delivery'),
                    'desc'   => __('Delivery across all major cities in Pakistan'),
                    'icon'   => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0',
                    'bg'     => 'bg-green-50',
                    'border' => 'border-green-100',
                    'icon_bg' => 'bg-green-600',
                    'step_color' => 'text-green-200',
                ],
                [
                    'step'   => '03',
                    'title'  => __('Custom Branding'),
                    'desc'   => __('Logo printing on all promotional items'),
                    'icon'   => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
                    'bg'     => 'bg-amber-50',
                    'border' => 'border-amber-100',
                    'icon_bg' => 'bg-amber-600',
                    'step_color' => 'text-amber-200',
                ],
                [
                    'step'   => '04',
                    'title'  => __('Secure Payments'),
                    'desc'   => __('JazzCash, EasyPaisa & Cash on Delivery'),
                    'icon'   => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'bg'     => 'bg-purple-50',
                    'border' => 'border-purple-100',
                    'icon_bg' => 'bg-purple-600',
                    'step_color' => 'text-purple-200',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($features as $feature)
                <div class="group relative rounded-2xl border {{ $feature['border'] }} {{ $feature['bg'] }} p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg overflow-hidden">
                    {{-- Step number (decorative) --}}
                    <span class="absolute end-4 top-4 text-5xl font-black {{ $feature['step_color'] }} leading-none select-none">
                        {{ $feature['step'] }}
                    </span>

                    {{-- Icon --}}
                    <div class="relative mb-5 flex h-14 w-14 items-center justify-center rounded-2xl {{ $feature['icon_bg'] }} shadow-md transition-transform group-hover:scale-110 group-hover:rotate-3">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"/>
                        </svg>
                    </div>

                    {{-- Content --}}
                    <h3 class="relative text-base font-bold text-gray-900">{{ $feature['title'] }}</h3>
                    <p class="relative mt-2 text-sm text-gray-600 leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- About Us CTA --}}
        <div class="mt-10 text-center">
            <a href="{{ url('/about') }}"
               class="inline-flex items-center gap-x-2 rounded-2xl border-2 border-primary px-8 py-3 text-sm font-bold text-primary transition-all hover:bg-primary hover:text-white hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                {{ __('Learn More About Us') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 6: B2B CTA BANNER
     ============================================================ --}}
<section class="relative overflow-hidden bg-gradient-to-r from-primary via-primary-light to-primary-dark py-16">
    {{-- Decorative circles --}}
    <div class="absolute -start-16 -top-16 h-64 w-64 rounded-full bg-white/5 blur-xl"></div>
    <div class="absolute -end-16 -bottom-16 h-64 w-64 rounded-full bg-gold/10 blur-xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-8 lg:flex-row">

            {{-- Left: Content --}}
            <div class="text-center lg:text-start max-w-xl">
                <div class="mb-3 inline-flex items-center gap-x-2 rounded-full bg-gold/20 px-4 py-1.5 text-xs font-semibold text-gold">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    B2B Wholesale
                </div>
                <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
                    {{ __('Are you a Business?') }}
                </h2>
                <p class="mt-3 text-base text-blue-200">
                    {{ __('Get exclusive wholesale prices for bulk orders. Register as a B2B customer today.') }}
                </p>
                <ul class="mt-5 grid grid-cols-1 gap-y-2 sm:grid-cols-2 text-sm text-blue-200">
                    @foreach([
                        __('Up to 40% off retail price'),
                        __('Dedicated account manager'),
                        __('Custom logo printing'),
                        __('Priority order processing'),
                    ] as $perk)
                        <li class="flex items-center gap-x-2">
                            <svg class="h-4 w-4 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $perk }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Right: CTA --}}
            <div class="flex flex-col items-center gap-y-3 shrink-0">
                <a href="{{ url('/register') }}"
                   class="inline-flex items-center gap-x-2.5 rounded-2xl bg-gold px-8 py-4 text-base font-extrabold text-white shadow-2xl shadow-amber-900/30 transition-all hover:bg-gold-dark hover:-translate-y-0.5 hover:shadow-xl active:scale-95">
                    {{ __('Register as B2B Customer') }}
                    <svg class="h-5 w-5 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <p class="text-xs text-blue-300">
                    {{ __('Free registration') }} · {{ __('No hidden charges') }}
                </p>
                <div class="flex items-center gap-x-1.5">
                    @for($i = 0; $i < 3; $i++)
                        <div class="h-7 w-7 rounded-full bg-primary ring-2 ring-primary-dark flex items-center justify-center text-xs font-bold text-white"
                             style="margin-inline-start: {{ $i > 0 ? '-8px' : '0' }}">
                            {{ ['A', 'B', 'C'][$i] }}
                        </div>
                    @endfor
                    <span class="ms-2 text-xs text-blue-300">{{ __('Join 200+ businesses') }}</span>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 7: TESTIMONIALS
     ============================================================ --}}
<section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="mb-12 text-center">
            <span class="inline-block rounded-full bg-gold/10 px-3.5 py-1 text-xs font-semibold text-gold-dark mb-3">
                {{ __('Customer Stories') }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('What Our Customers Say') }}</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-gold"></div>
        </div>

        @php
            $testimonials = [
                [
                    'name'    => 'Ahmed Raza',
                    'company' => 'TechSolutions Pvt Ltd, Lahore',
                    'stars'   => 5,
                    'color'   => 'bg-primary',
                    'text'    => 'Excellent quality power banks with our company logo. Ordered 500 pieces, delivered within a week. Will definitely order again for our next corporate event.',
                ],
                [
                    'name'    => 'Sarah Khan',
                    'company' => 'Individual Customer, Karachi',
                    'stars'   => 5,
                    'color'   => 'bg-gold',
                    'text'    => 'Bought a few keychains and pens as gifts. Quality is amazing and the prices are very reasonable. Fast delivery to Karachi as well!',
                ],
                [
                    'name'    => 'Muhammad Bilal',
                    'company' => 'Al-Faisal Enterprises, Islamabad',
                    'stars'   => 4,
                    'color'   => 'bg-green-600',
                    'text'    => 'We regularly order promotional items from Shahid Brothers. Their B2B prices are unbeatable and the custom branding service is top-notch.',
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach($testimonials as $review)
                <div class="group relative rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 hover:shadow-lg hover:ring-primary/10 transition-all duration-300">

                    {{-- Decorative quote mark --}}
                    <div class="absolute end-5 top-5 text-5xl font-black text-gray-100 leading-none select-none group-hover:text-primary/10 transition-colors">
                        "
                    </div>

                    {{-- Stars --}}
                    <div class="mb-4 flex gap-x-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-4 w-4 {{ $i < $review['stars'] ? 'text-gold' : 'text-gray-200' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review Text --}}
                    <p class="relative text-sm leading-relaxed text-gray-600">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="mt-5 flex items-center gap-x-3 border-t border-gray-50 pt-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $review['color'] }} text-sm font-extrabold text-white shadow-sm">
                            {{ strtoupper(substr($review['name'], 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-gray-900">{{ $review['name'] }}</div>
                            <div class="text-xs text-gray-500">{{ $review['company'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

@endsection


