@extends('layouts.app')

@section('title', __('Contact Us'))
@section('description', 'Contact Shahid Brothers - Quality promotional items importer in Lahore, Pakistan. Phone: 0308-4570786')

@section('content')

    {{-- Page Header / Breadcrumb --}}
    <div class="bg-[#1e3a5f] py-10 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="mb-2 flex items-center gap-x-2 text-sm text-blue-200" aria-label="Breadcrumb">
                <a href="{{ LaravelLocalization::localizeURL('/') }}" class="hover:text-white">{{ __('Home') }}</a>
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white">{{ __('Contact Us') }}</span>
            </nav>
            <h1 class="text-3xl font-bold">{{ __('Contact Us') }}</h1>
            <p class="mt-1 text-blue-200">{{ __('Get in Touch') }}</p>
        </div>
    </div>

    {{-- Main Content --}}
    <section class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-5">

                {{-- Left: Contact Form (3/5) --}}
                <div class="lg:col-span-3">
                    <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
                        <h2 class="mb-6 text-xl font-bold text-[#1e3a5f]">{{ __('Send Message') }}</h2>
                        @livewire('contact-form')
                    </div>
                </div>

                {{-- Right: Contact Info (2/5) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Info Card --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
                        <h2 class="mb-5 text-lg font-bold text-[#1e3a5f]">{{ __('Get in Touch') }}</h2>

                        <ul class="space-y-4">

                            {{-- Address --}}
                            <li class="flex items-start gap-x-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ __('Our Address') }}</p>
                                    <p class="mt-0.5 text-sm text-gray-700">Masha Allah Plaza, 33 Nisbat Road, Anarkali Bazar, Lahore, Pakistan</p>
                                </div>
                            </li>

                            {{-- Phone --}}
                            <li class="flex items-start gap-x-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ __('Our Phone') }}</p>
                                    <a href="tel:+923084570786" class="mt-0.5 block text-sm font-medium text-[#1e3a5f] hover:underline">
                                        0308-4570786
                                    </a>
                                </div>
                            </li>

                            {{-- Email --}}
                            <li class="flex items-start gap-x-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ __('Our Email') }}</p>
                                    <a href="mailto:waqasleo@gmail.com" class="mt-0.5 block text-sm font-medium text-[#1e3a5f] hover:underline">
                                        waqasleo@gmail.com
                                    </a>
                                </div>
                            </li>

                            {{-- WhatsApp --}}
                            <li class="flex items-start gap-x-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-50 text-green-600">
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">WhatsApp</p>
                                    <a href="https://wa.me/923084570786" target="_blank" rel="noopener noreferrer"
                                       class="mt-0.5 inline-flex items-center gap-x-1 text-sm font-medium text-green-600 hover:underline">
                                        {{ __('Chat on WhatsApp') }}
                                        <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                </div>
                            </li>

                            {{-- Business Hours --}}
                            <li class="flex items-start gap-x-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#1e3a5f]">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ __('Business Hours') }}</p>
                                    <p class="mt-0.5 text-sm text-gray-700">{{ __('Mon - Sat') }}: 9:00 AM – 7:00 PM</p>
                                    <p class="text-sm text-gray-500">{{ __('Sunday') }}: {{ __('Closed') }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Google Map --}}
                    <div class="overflow-hidden rounded-2xl shadow-sm ring-1 ring-gray-100">
                        <iframe
                            src="https://maps.google.com/maps?q=Masha+Allah+Plaza+33+Nisbat+Road+Anarkali+Bazar+Lahore+Pakistan&output=embed"
                            width="100%"
                            height="250"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Shahid Brothers Location"
                        ></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
