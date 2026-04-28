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

    {{-- enctype required for file upload --}}
    <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3"
             x-data="checkoutForm({{ Js::from($paymentAccounts) }})">

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
                                   value="{{ old('shipping_name', auth()->user()?->name ?? '') }}"
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
                                   value="{{ old('shipping_phone', auth()->user()?->phone ?? '') }}"
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

                {{-- ============================================================
                     PAYMENT METHOD
                     ============================================================ --}}
                <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm">
                    <h2 class="text-base font-semibold text-gray-900 mb-5">{{ __('Payment Method') }}</h2>

                    <div class="space-y-3">

                        {{-- COD --}}
                        <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-gray-200 p-4 hover:border-primary hover:bg-blue-50/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-blue-50/40">
                            <input type="radio"
                                   name="payment_method"
                                   value="cod"
                                   x-model="paymentMethod"
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

                        {{-- JazzCash --}}
                        <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-gray-200 p-4 hover:border-primary hover:bg-blue-50/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-blue-50/40">
                            <input type="radio"
                                   name="payment_method"
                                   value="jazzcash"
                                   x-model="paymentMethod"
                                   {{ old('payment_method') === 'jazzcash' ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary border-gray-300 focus:ring-primary">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-100">
                                    <span class="text-xs font-bold text-red-600">JC</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">JazzCash</p>
                                    <p class="text-xs text-gray-500">{{ __('Transfer to our JazzCash account & upload slip') }}</p>
                                </div>
                            </div>
                        </label>

                        {{-- EasyPaisa --}}
                        <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-gray-200 p-4 hover:border-primary hover:bg-blue-50/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-blue-50/40">
                            <input type="radio"
                                   name="payment_method"
                                   value="easypaisa"
                                   x-model="paymentMethod"
                                   {{ old('payment_method') === 'easypaisa' ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary border-gray-300 focus:ring-primary">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-100">
                                    <span class="text-xs font-bold text-emerald-600">EP</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">EasyPaisa</p>
                                    <p class="text-xs text-gray-500">{{ __('Transfer to our EasyPaisa account & upload slip') }}</p>
                                </div>
                            </div>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="flex cursor-pointer items-center gap-4 rounded-lg border border-gray-200 p-4 hover:border-primary hover:bg-blue-50/30 transition-colors has-[:checked]:border-primary has-[:checked]:bg-blue-50/40">
                            <input type="radio"
                                   name="payment_method"
                                   value="bank_transfer"
                                   x-model="paymentMethod"
                                   {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}
                                   class="h-4 w-4 text-primary border-gray-300 focus:ring-primary">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 6l9-4 9 4M3 6v12l9 4 9-4V6M12 2v20"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ __('Bank Transfer') }}</p>
                                    <p class="text-xs text-gray-500">{{ __('Direct bank transfer & upload deposit slip') }}</p>
                                </div>
                            </div>
                        </label>

                    </div>

                    @error('payment_method')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    {{-- ============================================================
                         PAYMENT DETAILS PANEL (shows for non-COD methods)
                         ============================================================ --}}
                    <div x-show="requiresSlip"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak
                         class="mt-5">

                        {{-- Account Details Box --}}
                        <div class="rounded-lg border-2 border-dashed border-primary/30 bg-primary/5 p-5">

                            <p class="text-sm font-semibold text-primary mb-3 flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ __('Send payment to this account:') }}
                            </p>

                            {{-- JazzCash details --}}
                            <div x-show="paymentMethod === 'jazzcash'" class="space-y-2 text-sm">
                                <div class="flex justify-between items-center py-2 border-b border-primary/10">
                                    <span class="text-gray-500">{{ __('Account Name') }}</span>
                                    <span class="font-bold text-gray-900" x-text="accounts.jazzcash.account_name"></span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-500">{{ __('JazzCash Number') }}</span>
                                    <button type="button"
                                            @click="copyToClipboard(accounts.jazzcash.account_number)"
                                            class="flex items-center gap-1.5 font-bold text-primary hover:text-primary/70 transition-colors">
                                        <span x-text="accounts.jazzcash.account_number"></span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- EasyPaisa details --}}
                            <div x-show="paymentMethod === 'easypaisa'" class="space-y-2 text-sm">
                                <div class="flex justify-between items-center py-2 border-b border-primary/10">
                                    <span class="text-gray-500">{{ __('Account Name') }}</span>
                                    <span class="font-bold text-gray-900" x-text="accounts.easypaisa.account_name"></span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-500">{{ __('EasyPaisa Number') }}</span>
                                    <button type="button"
                                            @click="copyToClipboard(accounts.easypaisa.account_number)"
                                            class="flex items-center gap-1.5 font-bold text-primary hover:text-primary/70 transition-colors">
                                        <span x-text="accounts.easypaisa.account_number"></span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Bank Transfer details --}}
                            <div x-show="paymentMethod === 'bank_transfer'" class="space-y-2 text-sm">
                                <div class="flex justify-between items-center py-2 border-b border-primary/10">
                                    <span class="text-gray-500">{{ __('Bank Name') }}</span>
                                    <span class="font-bold text-gray-900" x-text="accounts.bank.bank_name"></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-primary/10">
                                    <span class="text-gray-500">{{ __('Account Name') }}</span>
                                    <span class="font-bold text-gray-900" x-text="accounts.bank.account_name"></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-primary/10">
                                    <span class="text-gray-500">{{ __('Account Number') }}</span>
                                    <button type="button"
                                            @click="copyToClipboard(accounts.bank.account_number)"
                                            class="flex items-center gap-1.5 font-bold text-primary hover:text-primary/70 transition-colors">
                                        <span x-text="accounts.bank.account_number"></span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-gray-500">{{ __('IBAN') }}</span>
                                    <button type="button"
                                            @click="copyToClipboard(accounts.bank.iban)"
                                            class="flex items-center gap-1.5 font-bold text-primary hover:text-primary/70 transition-colors text-xs">
                                        <span x-text="accounts.bank.iban"></span>
                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Copied notification --}}
                            <div x-show="copied"
                                 x-transition
                                 class="mt-2 text-center text-xs text-green-600 font-medium">
                                ✓ {{ __('Copied to clipboard!') }}
                            </div>
                        </div>

                        {{-- ============================================================
                             SLIP UPLOAD
                             ============================================================ --}}
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('Upload Payment Receipt / Slip') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <p class="text-xs text-gray-500 mb-3">
                                {{ __('After transferring the amount, take a screenshot of the confirmation and upload it here. Accepted: JPG, PNG, PDF (max 5MB)') }}
                            </p>

                            {{-- Drop zone --}}
                            <label for="payment_slip"
                                   class="relative flex flex-col items-center justify-center w-full h-36 rounded-lg border-2 border-dashed cursor-pointer transition-colors"
                                   :class="slipFile ? 'border-green-400 bg-green-50' : 'border-gray-300 bg-gray-50 hover:border-primary hover:bg-blue-50/30'">

                                {{-- No file selected --}}
                                <div x-show="!slipFile" class="text-center px-4">
                                    <svg class="mx-auto mb-2 h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">
                                        <span class="font-semibold text-primary">{{ __('Click to upload') }}</span>
                                        {{ __('or drag & drop') }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF — max 5MB</p>
                                </div>

                                {{-- File selected --}}
                                <div x-show="slipFile" class="text-center px-4">
                                    <svg class="mx-auto mb-2 h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <p class="text-sm font-semibold text-green-700" x-text="slipFile"></p>
                                    <p class="text-xs text-green-600 mt-1">{{ __('Slip attached ✓ — Click to change') }}</p>
                                </div>

                                <input type="file"
                                       id="payment_slip"
                                       name="payment_slip"
                                       accept=".jpg,.jpeg,.png,.webp,.pdf"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       @change="handleSlipUpload($event)">
                            </label>

                            @error('payment_slip')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Instruction note --}}
                        <div class="mt-3 flex items-start gap-2 rounded-lg bg-amber-50 border border-amber-200 px-4 py-3">
                            <svg class="h-4 w-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <p class="text-xs text-amber-700">
                                {{ __('Your order will be confirmed after our team manually verifies your payment (usually within a few hours). You will receive an email notification once verified.') }}
                            </p>
                        </div>
                    </div>

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

                    {{-- Place Order Button --}}
                    <button type="submit"
                            id="place-order-btn"
                            :disabled="requiresSlip && !slipFile"
                            class="mt-6 w-full rounded-lg bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!requiresSlip">{{ __('Place Order') }}</span>
                        <span x-show="requiresSlip && !slipFile">{{ __('Attach Slip to Place Order') }}</span>
                        <span x-show="requiresSlip && slipFile">{{ __('Place Order & Submit Slip') }}</span>
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

    function checkoutForm(accounts) {
        return {
            accounts: accounts,
            paymentMethod: '{{ old('payment_method', 'cod') }}',
            slipFile: null,
            copied: false,

            get requiresSlip() {
                return ['jazzcash', 'easypaisa', 'bank_transfer'].includes(this.paymentMethod);
            },

            handleSlipUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.slipFile = file.name;
                }
            },

            copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => {
                    this.copied = true;
                    setTimeout(() => { this.copied = false; }, 2000);
                });
            },
        };
    }

    document.getElementById('checkout-form').addEventListener('submit', function () {
        const btn = document.getElementById('place-order-btn');
        if (!btn.disabled) {
            btn.disabled = true;
            btn.textContent = '{{ __("Placing order...") }}';
        }
    });
</script>
@endpush

@endsection
