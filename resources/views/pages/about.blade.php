@extends('layouts.app')

@section('title', __('About Us'))
@section('description', __('Learn about Shahid Brothers — Pakistan\'s trusted source for quality promotional gifts and branded items imported directly from China.'))

@section('content')

{{-- ============================================================
     BREADCRUMB
     ============================================================ --}}
<div class="bg-white border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-x-2 py-3.5 text-sm">
            <a href="{{ LaravelLocalization::localizeURL('/') }}"
               class="text-gray-500 hover:text-primary transition-colors">
                {{ __('Home') }}
            </a>
            <svg class="h-4 w-4 text-gray-300 rtl:rotate-180 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-semibold text-primary">{{ __('About Us') }}</span>
        </nav>
    </div>
</div>


{{-- ============================================================
     SECTION 1: HERO
     ============================================================ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-primary via-primary to-[#162e4e] py-20">
    {{-- Decorative background dots --}}
    <div class="absolute inset-0 opacity-5"
         style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 28px 28px;">
    </div>
    <div class="absolute -end-24 -top-24 h-72 w-72 rounded-full bg-gold/10 blur-3xl"></div>
    <div class="absolute -start-24 -bottom-24 h-72 w-72 rounded-full bg-white/5 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-10 text-center lg:flex-row lg:text-start lg:gap-16">

            {{-- Left: Text --}}
            <div class="flex-1">
                <span class="inline-flex items-center gap-x-1.5 rounded-full bg-gold/20 px-4 py-1.5 text-xs font-semibold text-gold mb-5">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    {{ __('Est. 2019, Lahore') }}
                </span>

                <h1 class="text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                    {{ __('Pakistan\'s Trusted') }}<br>
                    <span class="text-gold">{{ __('Promotional Gifts') }}</span><br>
                    {{ __('Partner') }}
                </h1>

                <p class="mt-5 max-w-lg text-base leading-relaxed text-blue-200 mx-auto lg:mx-0">
                    {{ __('We import high-quality promotional and branded gift items directly from China and deliver to businesses and individuals across Pakistan.') }}
                </p>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                    <a href="{{ LaravelLocalization::localizeURL('/shop') }}"
                       class="inline-flex items-center gap-x-2 rounded-xl bg-gold px-6 py-3 text-sm font-bold text-white shadow-lg transition-all hover:bg-gold-dark hover:-translate-y-0.5 active:scale-95">
                        {{ __('Browse Our Products') }}
                        <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ LaravelLocalization::localizeURL('/contact') }}"
                       class="inline-flex items-center gap-x-2 rounded-xl border-2 border-white/30 px-6 py-3 text-sm font-semibold text-white transition-all hover:border-white hover:bg-white/10 active:scale-95">
                        {{ __('Contact Us') }}
                    </a>
                </div>
            </div>

            {{-- Right: Stats Card --}}
            <div class="w-full max-w-sm shrink-0">
                <div class="rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 p-6 shadow-2xl">
                    <h3 class="mb-5 text-sm font-semibold text-white/80 uppercase tracking-wider">
                        {{ __('Our Numbers') }}
                    </h3>
                    @php
                        $heroStats = [
                            ['value' => '5+',   'label' => __('Years in Business'),  'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                            ['value' => '500+', 'label' => __('Happy Clients'),      'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                            ['value' => '50+',  'label' => __('Products'),           'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                            ['value' => '25+',  'label' => __('Cities Served'),      'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                        ];
                    @endphp
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($heroStats as $s)
                            <div class="rounded-xl bg-white/10 p-4 text-center border border-white/10">
                                <div class="flex justify-center mb-2">
                                    <svg class="h-5 w-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $s['icon'] }}"/>
                                    </svg>
                                </div>
                                <div class="text-2xl font-extrabold text-white">{{ $s['value'] }}</div>
                                <div class="mt-0.5 text-xs text-blue-300">{{ $s['label'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 2: OUR STORY
     ============================================================ --}}
<section class="py-20 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-12 lg:flex-row lg:gap-16">

            {{-- Left: Timeline --}}
            <div class="w-full max-w-md shrink-0">
                <span class="inline-block rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary mb-3">
                    {{ __('Our Journey') }}
                </span>
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('How It All Started') }}</h2>
                <div class="mt-3 h-1 w-12 rounded-full bg-gold"></div>

                <div class="mt-10 space-y-0">
                    @php
                        $timeline = [
                            ['year' => '2019', 'title' => __('Founded in Lahore'),           'desc' => __('Started as a small trading business at Anarkali Bazar, Lahore with a vision to bring quality promotional items to Pakistan.'), 'color' => 'bg-primary'],
                            ['year' => '2020', 'title' => __('First China Import'),           'desc' => __('Established direct supply chain from Yiwu, China — bringing cost savings directly to our customers.'), 'color' => 'bg-gold'],
                            ['year' => '2022', 'title' => __('B2B Expansion'),                'desc' => __('Launched dedicated B2B services for corporate clients, offering bulk pricing and custom logo printing.'), 'color' => 'bg-green-600'],
                            ['year' => '2024', 'title' => __('Serving 25+ Cities'),           'desc' => __('Expanded delivery network to cover all major cities across Pakistan including Karachi, Lahore, Islamabad and more.'), 'color' => 'bg-purple-600'],
                            ['year' => '2025', 'title' => __('Going Digital'),                'desc' => __('Launched our professional e-commerce website to serve customers 24/7 with seamless online ordering.'), 'color' => 'bg-amber-500'],
                        ];
                    @endphp

                    @foreach($timeline as $i => $item)
                        <div class="relative flex gap-x-4">
                            {{-- Line --}}
                            @if(!$loop->last)
                                <div class="absolute start-5 top-10 bottom-0 w-0.5 bg-gray-100"></div>
                            @endif

                            {{-- Dot --}}
                            <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $item['color'] }} text-xs font-extrabold text-white shadow-md">
                                {{ substr($item['year'], 2) }}
                            </div>

                            {{-- Content --}}
                            <div class="pb-8">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $item['year'] }}</span>
                                </div>
                                <h4 class="mt-0.5 text-sm font-bold text-gray-900">{{ $item['title'] }}</h4>
                                <p class="mt-1 text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Story Text --}}
            <div class="flex-1">
                <span class="inline-block rounded-full bg-gold/10 px-3.5 py-1 text-xs font-semibold text-gold-dark mb-3">
                    {{ __('About Our Business') }}
                </span>
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Who We Are') }}</h2>
                <div class="mt-3 h-1 w-12 rounded-full bg-gold"></div>

                <div class="mt-8 space-y-5 text-sm leading-relaxed text-gray-600">
                    <p>
                        {{ __('Shahid Brothers is a Lahore-based trading company specializing in high-quality promotional gifts and branded merchandise. We import directly from China, cutting out the middlemen to offer you the best prices without compromising on quality.') }}
                    </p>
                    <p>
                        {{ __('Our product range covers everything a business needs for branding — from custom keychains and pens to power banks, USB drives, bottles, tumblers, and wall clocks. Every item can be personalized with your company logo and colors.') }}
                    </p>
                    <p>
                        {{ __('We serve both individual buyers (B2C) and businesses (B2B). Corporate clients enjoy special wholesale pricing, dedicated account support, and priority order processing.') }}
                    </p>
                </div>

                {{-- Highlight boxes --}}
                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @php
                        $highlights = [
                            ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => __('Quality Guaranteed'),   'desc' => __('All products pass strict quality checks before shipping.'),    'color' => 'text-green-600', 'bg' => 'bg-green-50 border-green-100'],
                            ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',                                           'title' => __('Direct from China'),    'desc' => __('We source directly from Yiwu & Guangzhou factories.'),        'color' => 'text-blue-600',  'bg' => 'bg-blue-50 border-blue-100'],
                            ['icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',           'title' => __('Custom Branding'),     'desc' => __('Logo & text printing on all items for corporate orders.'),    'color' => 'text-amber-600', 'bg' => 'bg-amber-50 border-amber-100'],
                            ['icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0', 'title' => __('Nationwide Delivery'), 'desc' => __('Delivering to 25+ cities across Pakistan.'),                  'color' => 'text-purple-600','bg' => 'bg-purple-50 border-purple-100'],
                        ];
                    @endphp
                    @foreach($highlights as $h)
                        <div class="flex items-start gap-x-3 rounded-xl border {{ $h['bg'] }} p-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white shadow-sm">
                                <svg class="h-5 w-5 {{ $h['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $h['icon'] }}"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-gray-900">{{ $h['title'] }}</div>
                                <div class="mt-0.5 text-xs text-gray-600">{{ $h['desc'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: MISSION & VISION
     ============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-12 text-center">
            <span class="inline-block rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary mb-3">
                {{ __('What Drives Us') }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Mission & Vision') }}</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-gold"></div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- Mission --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-[#162e4e] p-8 shadow-lg">
                <div class="absolute end-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/5"></div>
                <div class="relative">
                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-gold/20">
                        <svg class="h-7 w-7 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest text-gold">{{ __('Our Mission') }}</span>
                    <h3 class="mt-2 text-xl font-extrabold text-white">
                        {{ __('Deliver Value, Build Brands') }}
                    </h3>
                    <p class="mt-4 text-sm leading-relaxed text-blue-200">
                        {{ __('To provide Pakistani businesses and individuals with affordable, high-quality promotional products that help them build their brand identity and leave a lasting impression on their customers.') }}
                    </p>
                    <ul class="mt-6 space-y-2">
                        @foreach([__('Competitive pricing through direct imports'), __('Consistent quality across all orders'), __('Fast, reliable delivery nationwide')] as $point)
                            <li class="flex items-center gap-x-2.5 text-sm text-blue-200">
                                <svg class="h-4 w-4 shrink-0 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Vision --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 p-8 shadow-lg">
                <div class="absolute end-0 top-0 h-32 w-32 translate-x-8 -translate-y-8 rounded-full bg-white/10"></div>
                <div class="relative">
                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-white/20">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest text-white/80">{{ __('Our Vision') }}</span>
                    <h3 class="mt-2 text-xl font-extrabold text-white">
                        {{ __('Pakistan\'s #1 Gifts Platform') }}
                    </h3>
                    <p class="mt-4 text-sm leading-relaxed text-amber-100">
                        {{ __('To become Pakistan\'s most trusted online marketplace for promotional gifts — empowering businesses of all sizes with smart branding solutions at the best prices.') }}
                    </p>
                    <ul class="mt-6 space-y-2">
                        @foreach([__('Expand to 100+ cities by 2026'), __('Launch AI-powered product customization'), __('Serve 2000+ businesses across Pakistan')] as $point)
                            <li class="flex items-center gap-x-2.5 text-sm text-amber-100">
                                <svg class="h-4 w-4 shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $point }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: CORE VALUES
     ============================================================ --}}
<section class="py-20 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-12 text-center">
            <span class="inline-block rounded-full bg-gold/10 px-3.5 py-1 text-xs font-semibold text-gold-dark mb-3">
                {{ __('What We Stand For') }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ __('Our Core Values') }}</h2>
            <div class="mx-auto mt-3 h-1 w-12 rounded-full bg-gold"></div>
        </div>

        @php
            $values = [
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => __('Trust & Honesty'),      'desc' => __('We are transparent with our pricing, delivery timelines, and product quality. No hidden charges, ever.'),                   'bg' => 'bg-blue-600',   'card' => 'bg-blue-50 border-blue-100'],
                ['icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'title' => __('Quality First'),         'desc' => __('Every product we sell is carefully selected and tested to meet our quality standards before reaching you.'),                   'bg' => 'bg-gold',       'card' => 'bg-amber-50 border-amber-100'],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => __('Customer First'),       'desc' => __('Your satisfaction is our priority. We are available on WhatsApp and phone to resolve any issue quickly.'),                    'bg' => 'bg-green-600',  'card' => 'bg-green-50 border-green-100'],
                ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',                                'title' => __('Best Value'),            'desc' => __('By importing directly from Chinese factories, we eliminate middlemen and pass those savings on to our customers.'),            'bg' => 'bg-purple-600', 'card' => 'bg-purple-50 border-purple-100'],
            ];
        @endphp

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($values as $val)
                <div class="group rounded-2xl border {{ $val['card'] }} p-6 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg">
                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl {{ $val['bg'] }} shadow-md transition-transform group-hover:scale-110 group-hover:rotate-3">
                        <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $val['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">{{ $val['title'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $val['desc'] }}</p>
                </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ============================================================
     SECTION 5: WHY IMPORT FROM CHINA
     ============================================================ --}}
<section class="py-20 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-12 lg:flex-row lg:gap-16">

            {{-- Left Text --}}
            <div class="flex-1">
                <span class="inline-block rounded-full bg-primary/10 px-3.5 py-1 text-xs font-semibold text-primary mb-3">
                    {{ __('Our Supply Chain') }}
                </span>
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                    {{ __('Why We Import Directly from China') }}
                </h2>
                <div class="mt-3 h-1 w-12 rounded-full bg-gold"></div>
                <p class="mt-6 text-sm leading-relaxed text-gray-600">
                    {{ __('China is the world\'s largest manufacturer of promotional and gift items. By sourcing directly from factories in Yiwu and Guangzhou, we can offer prices that local wholesalers simply cannot match.') }}
                </p>

                <div class="mt-8 space-y-4">
                    @php
                        $reasons = [
                            ['pct' => '60%', 'label' => __('Lower cost vs local market'),  'color' => 'bg-primary', 'width' => 'w-[60%]'],
                            ['pct' => '90%', 'label' => __('More product variety'),        'color' => 'bg-gold',    'width' => 'w-[90%]'],
                            ['pct' => '80%', 'label' => __('Faster production turnaround'), 'color' => 'bg-green-500', 'width' => 'w-[80%]'],
                        ];
                    @endphp
                    @foreach($reasons as $r)
                        <div>
                            <div class="mb-1.5 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">{{ $r['label'] }}</span>
                                <span class="text-sm font-extrabold text-gray-900">{{ $r['pct'] }}</span>
                            </div>
                            <div class="h-2.5 w-full overflow-hidden rounded-full bg-gray-200">
                                <div class="{{ $r['color'] }} {{ $r['width'] }} h-full rounded-full transition-all duration-1000"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex items-center gap-x-4 rounded-xl bg-primary/5 border border-primary/10 p-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-xl font-black text-white shadow-md">
                        🇨🇳
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-900">{{ __('Sourced from Yiwu & Guangzhou') }}</div>
                        <div class="mt-0.5 text-xs text-gray-600">{{ __('The world\'s largest wholesale markets for promotional products.') }}</div>
                    </div>
                </div>
            </div>

            {{-- Right: Process Steps --}}
            <div class="w-full max-w-sm shrink-0">
                <h3 class="mb-6 text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Our Import Process') }}</h3>
                @php
                    $steps = [
                        ['num' => '01', 'title' => __('Product Selection'),   'desc' => __('We handpick products that meet Pakistani market needs and quality standards.'),     'color' => 'bg-primary text-white'],
                        ['num' => '02', 'title' => __('Factory Inspection'),  'desc' => __('Quality check at the source — we verify factory standards before ordering.'),      'color' => 'bg-gold text-white'],
                        ['num' => '03', 'title' => __('Bulk Shipment'),       'desc' => __('Sea freight from China to Pakistan — cost-effective for large quantities.'),         'color' => 'bg-green-600 text-white'],
                        ['num' => '04', 'title' => __('Quality Control'),     'desc' => __('Every batch is inspected at our Lahore warehouse before dispatch.'),                'color' => 'bg-purple-600 text-white'],
                        ['num' => '05', 'title' => __('Delivered to You'),    'desc' => __('Nationwide delivery via trusted courier partners within 2–5 business days.'),       'color' => 'bg-amber-500 text-white'],
                    ];
                @endphp
                <div class="space-y-0">
                    @foreach($steps as $step)
                        <div class="relative flex gap-x-4">
                            @if(!$loop->last)
                                <div class="absolute start-5 top-10 bottom-0 w-0.5 bg-gray-100"></div>
                            @endif
                            <div class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $step['color'] }} text-xs font-extrabold shadow-md">
                                {{ $step['num'] }}
                            </div>
                            <div class="pb-7">
                                <div class="text-sm font-bold text-gray-900">{{ $step['title'] }}</div>
                                <p class="mt-0.5 text-xs leading-relaxed text-gray-600">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6: PAYMENT METHODS
     ============================================================ --}}
<section class="py-14 bg-white border-y border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-8 text-center sm:flex-row sm:text-start sm:justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900">{{ __('We Accept') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('Safe & secure payment methods') }}</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4 sm:justify-end">
                @php
                    $payments = [
                        ['name' => 'JazzCash',    'color' => 'bg-red-50 border-red-200',    'text' => 'text-red-700',    'icon' => '📱'],
                        ['name' => 'EasyPaisa',   'color' => 'bg-green-50 border-green-200','text' => 'text-green-700',  'icon' => '💳'],
                        ['name' => 'Cash on Delivery', 'color' => 'bg-amber-50 border-amber-200', 'text' => 'text-amber-700', 'icon' => '💵'],
                        ['name' => 'Bank Transfer', 'color' => 'bg-blue-50 border-blue-200', 'text' => 'text-blue-700',  'icon' => '🏦'],
                    ];
                @endphp
                @foreach($payments as $pm)
                    <div class="flex items-center gap-x-2 rounded-xl border {{ $pm['color'] }} px-4 py-2.5 shadow-sm">
                        <span class="text-lg leading-none">{{ $pm['icon'] }}</span>
                        <span class="text-sm font-bold {{ $pm['text'] }}">{{ $pm['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 7: CTA
     ============================================================ --}}
<section class="relative overflow-hidden bg-gradient-to-r from-primary via-primary-light to-primary-dark py-16">
    <div class="absolute -start-16 -top-16 h-64 w-64 rounded-full bg-white/5 blur-xl"></div>
    <div class="absolute -end-16 -bottom-16 h-64 w-64 rounded-full bg-gold/10 blur-xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-extrabold text-white sm:text-3xl">
            {{ __('Ready to Order?') }}
        </h2>
        <p class="mt-3 text-base text-blue-200 max-w-lg mx-auto">
            {{ __('Browse our collection or reach out for a custom bulk quote. We\'re here to help!') }}
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ LaravelLocalization::localizeURL('/shop') }}"
               class="inline-flex items-center gap-x-2 rounded-2xl bg-gold px-8 py-3.5 text-sm font-extrabold text-white shadow-2xl shadow-amber-900/30 transition-all hover:bg-gold-dark hover:-translate-y-0.5 active:scale-95">
                {{ __('Shop Now') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
            <a href="{{ LaravelLocalization::localizeURL('/contact') }}"
               class="inline-flex items-center gap-x-2 rounded-2xl border-2 border-white/30 px-8 py-3.5 text-sm font-semibold text-white transition-all hover:border-white hover:bg-white/10 active:scale-95">
                {{ __('Get in Touch') }}
            </a>
        </div>
    </div>
</section>

@endsection
