@extends('layouts.storefront')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- Page Header --}}
    <div class="bg-[#1e3a5f] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ __('Gift Box Builder') }}</h1>
                    <p class="text-blue-200 text-sm mt-0.5">{{ __('Configure your custom gift box and request a quote') }}</p>
                </div>
            </div>

            {{-- How it works --}}
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <div class="flex items-center gap-3 bg-white/10 rounded-lg px-4 py-3">
                    <span class="w-6 h-6 bg-white text-[#1e3a5f] rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0">1</span>
                    <span>{{ __('Select products for each box') }}</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-lg px-4 py-3">
                    <span class="w-6 h-6 bg-white text-[#1e3a5f] rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0">2</span>
                    <span>{{ __('Choose quantity (min. 50 pcs)') }}</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-lg px-4 py-3">
                    <span class="w-6 h-6 bg-white text-[#1e3a5f] rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0">3</span>
                    <span>{{ __('Submit — we\'ll get back to you') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Builder --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @livewire('gift-box-builder')
    </div>

</div>
@endsection
