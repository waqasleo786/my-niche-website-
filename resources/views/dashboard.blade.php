@extends('layouts.storefront')

@section('title', __('My Account'))

@section('content')

<div class="bg-gray-50 min-h-screen py-10">
<div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-gray-900">
            {{ __('Welcome back') }}, <span class="text-primary">{{ $user->name }}</span>
        </h1>
        <p class="mt-1 text-sm text-gray-500">{{ $user->email }}</p>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Left column --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- B2B Status Card --}}
            @if($user->hasRole('b2b_customer'))
            <div class="rounded-2xl border-2 {{ $user->is_verified ? 'border-green-200 bg-green-50' : 'border-amber-200 bg-amber-50' }} p-5">
                <div class="flex items-start gap-x-4">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $user->is_verified ? 'bg-green-600' : 'bg-amber-500' }}">
                        @if($user->is_verified)
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @else
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm font-bold {{ $user->is_verified ? 'text-green-800' : 'text-amber-800' }}">
                            {{ $user->is_verified ? __('B2B Account Verified') : __('B2B Approval Pending') }}
                        </h3>
                        <p class="mt-0.5 text-xs {{ $user->is_verified ? 'text-green-700' : 'text-amber-700' }}">
                            @if($user->is_verified)
                                {{ __('Your wholesale account is active. Contact us for bulk pricing on any product.') }}
                            @else
                                {{ __('Our team will verify your account within 24 hours. You will receive an email confirmation.') }}
                            @endif
                        </p>
                        @if($user->is_verified)
                            <a href="{{ url('/contact') }}"
                               class="mt-3 inline-flex items-center gap-x-1.5 rounded-lg bg-green-600 px-3 py-1.5 text-xs font-bold text-white hover:bg-green-700 transition">
                                {{ __('Request Bulk Quote') }}
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Recent Orders --}}
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                    <h2 class="text-sm font-bold text-gray-900">{{ __('Recent Orders') }}</h2>
                    <a href="{{ url('/orders') }}" class="text-xs font-semibold text-primary hover:text-gold transition-colors">
                        {{ __('View All') }} →
                    </a>
                </div>

                @forelse($orders as $order)
                    <div class="flex items-center justify-between gap-x-4 px-5 py-4 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                        <div>
                            <div class="text-sm font-bold text-gray-800">#{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">
                                {{ $order->created_at->format('d M Y') }} &middot;
                                {{ $order->items->count() }} {{ __('items') }}
                            </div>
                        </div>
                        @php
                            $statusColors = [
                                'pending'    => 'bg-amber-100 text-amber-700',
                                'confirmed'  => 'bg-blue-100 text-blue-700',
                                'processing' => 'bg-indigo-100 text-indigo-700',
                                'shipped'    => 'bg-cyan-100 text-cyan-700',
                                'delivered'  => 'bg-green-100 text-green-700',
                                'cancelled'  => 'bg-red-100 text-red-700',
                            ];
                            $statusClass = $statusColors[$order->status->value] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <div class="text-right">
                            <div class="text-sm font-extrabold text-primary">{{ $order->getFormattedTotal() }}</div>
                            <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-semibold mt-1 {{ $statusClass }}">
                                {{ ucfirst($order->status->value) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <p class="mt-3 text-sm text-gray-400">{{ __('No orders yet.') }}</p>
                        <a href="{{ url('/shop') }}"
                           class="mt-3 inline-flex items-center gap-x-1.5 rounded-xl bg-primary px-4 py-2 text-xs font-bold text-white hover:bg-primary-dark transition">
                            {{ __('Start Shopping') }}
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        {{-- Right column: Quick Actions --}}
        <div class="space-y-4">

            {{-- Account Info --}}
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                <h3 class="text-sm font-bold text-gray-900 mb-4">{{ __('My Account') }}</h3>
                <div class="space-y-3">
                    <div>
                        <div class="text-xs text-gray-400">{{ __('Name') }}</div>
                        <div class="text-sm font-semibold text-gray-800">{{ $user->name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400">{{ __('Phone') }}</div>
                        <div class="text-sm font-semibold text-gray-800">{{ $user->phone ?? '—' }}</div>
                    </div>
                    @if($user->company_name)
                    <div>
                        <div class="text-xs text-gray-400">{{ __('Company') }}</div>
                        <div class="text-sm font-semibold text-gray-800">{{ $user->company_name }}</div>
                    </div>
                    @endif
                    <div>
                        <div class="text-xs text-gray-400">{{ __('Account Type') }}</div>
                        <span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-bold
                            {{ $user->hasRole('b2b_customer') ? 'bg-gold/10 text-gold-dark' : 'bg-primary/10 text-primary' }}">
                            {{ $user->hasRole('b2b_customer') ? 'B2B Wholesale' : 'Retail Customer' }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('profile') }}"
                   class="mt-4 block w-full rounded-xl border border-gray-200 py-2 text-center text-xs font-semibold text-gray-600 hover:bg-gray-50 transition">
                    {{ __('Edit Profile') }}
                </a>
            </div>

            {{-- Quick Links --}}
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                <h3 class="text-sm font-bold text-gray-900 mb-3">{{ __('Quick Links') }}</h3>
                <div class="space-y-2">
                    @foreach([
                        ['icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'label' => __('Browse Products'), 'url' => '/shop'],
                        ['icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'label' => __('My Cart'), 'url' => '/cart'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => __('Contact Us'), 'url' => '/contact'],
                    ] as $link)
                        <a href="{{ url($link['url']) }}"
                           class="flex items-center gap-x-3 rounded-xl p-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition group">
                            <svg class="h-4 w-4 text-gray-400 group-hover:text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $link['icon'] }}"/>
                            </svg>
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-x-3 rounded-xl p-2.5 text-sm text-red-500 hover:bg-red-50 transition group">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
</div>

@endsection
