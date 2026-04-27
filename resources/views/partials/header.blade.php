<header class="sticky top-0 z-40 bg-white shadow-sm" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logo-header.png') }}"
                     alt="Shahid Brothers"
                     class="h-10 w-auto"
                     loading="eager">
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden items-center gap-x-8 md:flex">
                <a href="{{ url('/') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('home') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ url('/shop') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('shop') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Shop') }}
                </a>
                <a href="{{ url('/about') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('about') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('About Us') }}
                </a>
                <a href="{{ url('/contact') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('contact') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Contact Us') }}
                </a>
            </nav>

            {{-- Right Side Actions --}}
            <div class="flex items-center gap-x-1">

                {{-- Cart Icon --}}
                <a href="{{ route('cart.index') }}"
                   class="relative flex items-center rounded-md p-2 text-gray-600 hover:bg-gray-100 transition-colors"
                   aria-label="{{ __('Cart') }}">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                    </svg>
                    @if (($cartItemCount ?? 0) > 0)
                        <span class="absolute -top-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white leading-none">
                            {{ $cartItemCount > 9 ? '9+' : $cartItemCount }}
                        </span>
                    @endif
                </a>

                {{-- Mobile Menu Toggle --}}
                <button
                    @click="open = !open"
                    class="rounded-md p-2 text-gray-600 hover:bg-gray-100 md:hidden"
                    aria-label="Toggle menu"
                >
                    <svg x-show="!open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div x-show="open" x-transition class="border-t border-gray-100 md:hidden" style="display:none;">
        <nav class="flex flex-col space-y-1 px-4 py-3">
            <a href="{{ url('/') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Home') }}
            </a>
            <a href="{{ url('/shop') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Shop') }}
            </a>
            <a href="{{ url('/about') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('About Us') }}
            </a>
            <a href="{{ url('/contact') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Contact Us') }}
            </a>
        </nav>
    </div>
</header>

