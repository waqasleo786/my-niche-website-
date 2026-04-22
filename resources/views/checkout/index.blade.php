@extends('layouts.storefront')

@section('title', __('Checkout'))
@section('description', __('Complete your order with Shahid Brothers.'))

@section('content')

{{-- ============================================================
     BREADCRUMB
     ============================================================ --}}
<div class="bg-white border-b border-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-x-2 py-3.5 text-sm">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary transition-colors">{{ __('Home') }}</a>
            <svg class="h-4 w-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-primary transition-colors">{{ __('Cart') }}</a>
            <svg class="h-4 w-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-semibold text-primary">{{ __('Checkout') }}</span>
        </nav>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">{{ __('Checkout') }}</h1>

    <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
        @csrf

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- ============================================================
                 LEFT: Shipping + Payment
                 ============================================================ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Shipping Details --}}
                @php
                    $oldProvince = old('shipping_province', '');
                    $oldDistrict = old('shipping_city', '');
                    $oldArea     = old('shipping_area', '');
                @endphp

                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm"
                     x-data="locationPicker({{ Js::from($locations) }}, '{{ $oldProvince }}', '{{ $oldDistrict }}', '{{ $oldArea }}')">

                    <h2 class="text-base font-semibold text-gray-900 mb-5">{{ __('Shipping Details') }}</h2>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        {{-- Full Name --}}
                        <div class="sm:col-span-2">
                            <label for="shipping_name" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Full Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="shipping_name" name="shipping_name"
                                   value="{{ old('shipping_name', auth()->user()->name) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary @error('shipping_name') border-red-400 @enderror"
                                   placeholder="Muhammad Ali" required>
                            @error('shipping_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="sm:col-span-2">
                            <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Phone Number') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="shipping_phone" name="shipping_phone"
                                   value="{{ old('shipping_phone', auth()->user()->phone ?? '') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary @error('shipping_phone') border-red-400 @enderror"
                                   placeholder="03001234567" maxlength="11" required>
                            @error('shipping_phone')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Province --}}
                        <div>
                            <label for="shipping_province" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Province / Territory') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="shipping_province" name="shipping_province"
                                    x-model="selectedProvince"
                                    @change="selectedDistrict = ''"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary @error('shipping_province') border-red-400 @enderror"
                                    required>
                                <option value="">{{ __('Select province') }}</option>
                                @foreach (array_keys($locations) as $province)
                                    <option value="{{ $province }}">{{ $province }}</option>
                                @endforeach
                            </select>
                            @error('shipping_province')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- District (cascades from Province) --}}
                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('District') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="shipping_city" name="shipping_city"
                                    x-model="selectedDistrict"
                                    @change="selectedTehsil = ''"
                                    :disabled="!selectedProvince"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary disabled:bg-gray-50 disabled:text-gray-400 @error('shipping_city') border-red-400 @enderror"
                                    required>
                                <option value="" x-text="selectedProvince ? '{{ __('Select district') }}' : '{{ __('Select province first') }}'"></option>
                                <template x-for="district in districts" :key="district">
                                    <option :value="district" x-text="district"></option>
                                </template>
                            </select>
                            @error('shipping_city')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tehsil (cascades from District) --}}
                        <div>
                            <label for="shipping_area" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Tehsil / Town') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="shipping_area" name="shipping_area"
                                    x-model="selectedTehsil"
                                    :disabled="!selectedDistrict"
                                    class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary disabled:bg-gray-50 disabled:text-gray-400 @error('shipping_area') border-red-400 @enderror"
                                    required>
                                <option value="" x-text="selectedDistrict ? '{{ __('Select tehsil') }}' : '{{ __('Select district first') }}'"></option>
                                <template x-for="tehsil in tehsils" :key="tehsil">
                                    <option :value="tehsil" x-text="tehsil"></option>
                                </template>
                            </select>
                            @error('shipping_area')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Street Address --}}
                        <div class="sm:col-span-2">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Street Address') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="shipping_address" name="shipping_address"
                                   value="{{ old('shipping_address') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary @error('shipping_address') border-red-400 @enderror"
                                   placeholder="{{ __('House #, Street, Mohalla') }}" required>
                            @error('shipping_address')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Order Notes --}}
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Order Notes') }}
                                <span class="text-gray-400 font-normal">({{ __('optional') }})</span>
                            </label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"
                                      placeholder="{{ __('Any special instructions for your order...') }}">{{ old('notes') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-gray-900 mb-5">{{ __('Payment Method') }}</h2>

                    <div class="space-y-3">

                        {{-- COD --}}
                        <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-gray-200 p-4 hover:border-primary hover:bg-blue-50/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-blue-50/40">
                            <input type="radio"
                                   name="payment_method"
                                   value="cod"
                                   {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary border-gray-300 focus:ring-primary">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-green-100">
                                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ __('Cash on Delivery') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('Pay when your order arrives') }}</p>
                                </div>
                            </div>
                        </label>

                        {{-- Coming Soon: JazzCash --}}
                        <div class="flex items-center gap-4 rounded-lg border border-gray-100 bg-gray-50 p-4 opacity-60 cursor-not-allowed">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-100">
                                <span class="text-xs font-bold text-red-600">JC</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">JazzCash</p>
                                <p class="text-xs text-gray-400">{{ __('Coming soon') }}</p>
                            </div>
                        </div>

                        {{-- Coming Soon: EasyPaisa --}}
                        <div class="flex items-center gap-4 rounded-lg border border-gray-100 bg-gray-50 p-4 opacity-60 cursor-not-allowed">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100">
                                <span class="text-xs font-bold text-emerald-600">EP</span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-700">EasyPaisa</p>
                                <p class="text-xs text-gray-400">{{ __('Coming soon') }}</p>
                            </div>
                        </div>

                    </div>

                    @error('payment_method')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- ============================================================
                 RIGHT: Order Summary
                 ============================================================ --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">{{ __('Order Summary') }}</h2>

                    {{-- Items --}}
                    <ul class="divide-y divide-gray-50 mb-4">
                        @foreach ($cart->items as $item)
                            <li class="flex items-center gap-3 py-3">
                                <div class="h-12 w-12 shrink-0 rounded-lg overflow-hidden bg-gray-50 border border-gray-100">
                                    @if ($item->product->hasMedia('images'))
                                        <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                             alt="{{ $item->product->name }}"
                                             class="h-full w-full object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ __('Qty') }}: {{ $item->quantity }}</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 shrink-0">{{ $item->getFormattedLineTotal() }}</p>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Totals --}}
                    <dl class="space-y-2 text-sm border-t border-gray-100 pt-4">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">{{ __('Subtotal') }}</dt>
                            <dd class="font-medium">{{ $cart->getFormattedSubtotal() }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">{{ __('Shipping') }}</dt>
                            <dd class="font-medium text-green-600">{{ __('Free') }}</dd>
                        </div>
                        <div class="flex justify-between border-t border-gray-100 pt-2">
                            <dt class="font-semibold text-gray-900">{{ __('Total') }}</dt>
                            <dd class="font-bold text-primary text-base">{{ $cart->getFormattedSubtotal() }}</dd>
                        </div>
                    </dl>

                    <button type="submit"
                            class="mt-6 w-full rounded-lg bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors disabled:opacity-70"
                            id="place-order-btn">
                        {{ __('Place Order') }}
                    </button>

                    <p class="mt-3 text-center text-xs text-gray-400">
                        {{ __('By placing your order, you agree to our') }}
                        <a href="{{ url('/terms') }}" class="underline hover:text-gray-600">{{ __('Terms') }}</a>.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

@push('scripts')
<script>
    function locationPicker(locations, oldProvince, oldDistrict, oldTehsil) {
        return {
            locations: locations,
            selectedProvince: oldProvince || '',
            selectedDistrict: oldDistrict || '',
            selectedTehsil:   oldTehsil   || '',
            get districts() {
                if (!this.selectedProvince) return [];
                return Object.keys(this.locations[this.selectedProvince] || {});
            },
            get tehsils() {
                if (!this.selectedProvince || !this.selectedDistrict) return [];
                return this.locations[this.selectedProvince][this.selectedDistrict] || [];
            },
        };
    }

    document.getElementById('checkout-form').addEventListener('submit', function () {
        const btn = document.getElementById('place-order-btn');
        btn.disabled = true;
        btn.textContent = '{{ __("Placing order...") }}';
    });
</script>
@endpush

@endsection
