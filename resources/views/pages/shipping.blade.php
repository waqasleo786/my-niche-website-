@extends('layouts.storefront')

@php
    \Artesaos\SEOTools\Facades\SEOMeta::setTitle('Shipping Information');
    \Artesaos\SEOTools\Facades\SEOMeta::setDescription('Shahid Brothers shipping details — delivery areas, timeframes, charges, and bulk order policies across Pakistan.');
    \Artesaos\SEOTools\Facades\OpenGraph::setTitle('Shipping Information — Shahid Brothers');
    \Artesaos\SEOTools\Facades\OpenGraph::setUrl(route('shipping'));
@endphp

@section('content')

{{-- Page Header --}}
<div class="bg-[#1e3a5f] py-10 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="mb-2 flex items-center gap-x-2 text-sm text-blue-200" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white">{{ __('Home') }}</a>
            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white">{{ __('Shipping Information') }}</span>
        </nav>
        <h1 class="text-3xl font-bold">{{ __('Shipping Information') }}</h1>
        <p class="mt-1 text-blue-200">{{ __('Delivery areas, timeframes & charges') }}</p>
    </div>
</div>

{{-- Content --}}
<section class="py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-[#1e3a5f]">{{ __('Pakistan-Wide') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('We deliver to all major cities and towns across Pakistan.') }}</p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-[#1e3a5f]">{{ __('2–5 Business Days') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('Standard delivery time after order confirmation.') }}</p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-[#1e3a5f]">{{ __('COD Available') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('Pay cash when your order arrives at your door.') }}</p>
            </div>

        </div>

        {{-- Delivery Charges Table --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h2 class="text-lg font-bold text-[#1e3a5f]">{{ __('Delivery Charges') }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ __('Charges are calculated at checkout based on your location.') }}</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">{{ __('Zone') }}</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">{{ __('Cities / Areas') }}</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">{{ __('Standard Charge') }}</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wide text-xs">{{ __('Est. Days') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-[#1e3a5f]">{{ __('Lahore (Local)') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ __('Lahore city & suburbs') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rs. 150</td>
                            <td class="px-6 py-4 text-gray-600">1–2 days</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-[#1e3a5f]">{{ __('Punjab') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ __('Faisalabad, Multan, Rawalpindi, Gujranwala, Sialkot, etc.') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rs. 200</td>
                            <td class="px-6 py-4 text-gray-600">2–3 days</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-[#1e3a5f]">{{ __('Islamabad / Rawalpindi') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ __('Federal capital & twin cities') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rs. 200</td>
                            <td class="px-6 py-4 text-gray-600">2–3 days</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-[#1e3a5f]">{{ __('Karachi') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ __('All Karachi areas') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rs. 250</td>
                            <td class="px-6 py-4 text-gray-600">2–4 days</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-[#1e3a5f]">{{ __('Other Cities') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ __('KPK, Sindh, Balochistan, AJK') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rs. 300</td>
                            <td class="px-6 py-4 text-gray-600">3–5 days</td>
                        </tr>
                        <tr class="bg-green-50 hover:bg-green-100">
                            <td class="px-6 py-4 font-bold text-green-700">{{ __('Free Shipping') }}</td>
                            <td class="px-6 py-4 text-green-700">{{ __('All Pakistan') }}</td>
                            <td class="px-6 py-4 font-bold text-green-700">{{ __('FREE') }}</td>
                            <td class="px-6 py-4 text-green-700">{{ __('On orders above Rs. 5,000') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Two Column Info --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            {{-- Couriers --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <h2 class="mb-4 text-lg font-bold text-[#1e3a5f]">{{ __('Our Courier Partners') }}</h2>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        TCS Courier (Pakistan-wide)
                    </li>
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Leopards Courier
                    </li>
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Swyft Logistics
                    </li>
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('In-house delivery (Lahore only)') }}
                    </li>
                </ul>
                <p class="mt-4 text-xs text-gray-400">{{ __('Courier may vary based on your location and order type.') }}</p>
            </div>

            {{-- B2B / Bulk --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                <h2 class="mb-4 text-lg font-bold text-[#1e3a5f]">{{ __('Bulk & B2B Orders') }}</h2>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start gap-x-2">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#1e3a5f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Bulk orders (50+ units) qualify for negotiated shipping rates.') }}
                    </li>
                    <li class="flex items-start gap-x-2">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#1e3a5f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('Custom/branded items have longer lead times (5–10 business days).') }}
                    </li>
                    <li class="flex items-start gap-x-2">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#1e3a5f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('B2B clients can arrange their own courier pickup from our Lahore office.') }}
                    </li>
                </ul>
                <a href="{{ route('contact') }}"
                   class="mt-5 inline-flex items-center gap-x-1.5 rounded-lg bg-[#1e3a5f] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#152d4a] transition">
                    {{ __('Contact for Bulk Orders') }}
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

        </div>

        {{-- Important Notes --}}
        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">
            <h2 class="mb-3 flex items-center gap-x-2 text-base font-bold text-amber-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ __('Important Notes') }}
            </h2>
            <ul class="space-y-2 text-sm text-amber-800">
                <li>{{ __('Delivery times are estimates and may vary due to courier delays, public holidays, or remote locations.') }}</li>
                <li>{{ __('Orders placed after 3:00 PM will be processed the next business day.') }}</li>
                <li>{{ __('Please ensure your phone number and address are correct — failed deliveries may incur re-delivery charges.') }}</li>
                <li>{{ __('For fragile items, please inspect the package before signing for delivery.') }}</li>
            </ul>
        </div>

        {{-- Tracking CTA --}}
        <div class="rounded-2xl bg-[#1e3a5f] p-8 text-center text-white">
            <h2 class="text-xl font-bold">{{ __('Track Your Order') }}</h2>
            <p class="mt-2 text-blue-200 text-sm">
                {{ __('After dispatch, you will receive a tracking number via WhatsApp or email.') }}
            </p>
            <a href="https://wa.me/923084570786" target="_blank" rel="noopener noreferrer"
               class="mt-5 inline-flex items-center gap-x-2 rounded-lg bg-green-500 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-600 transition">
                <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                </svg>
                {{ __('WhatsApp Us for Tracking') }}
            </a>
        </div>

    </div>
</section>

@endsection
