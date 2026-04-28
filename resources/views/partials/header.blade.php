<header class="sticky top-0 z-40 bg-white shadow-sm" x-data="{ open: false, userMenu: false }">
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

                {{-- User Menu (Desktop) --}}
                @auth
                    <div class="relative hidden md:block" @click.outside="userMenu = false">
                        <button @click="userMenu = !userMenu"
                                class="flex items-center gap-x-2 rounded-lg px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                            {{-- Avatar initials --}}
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                            <svg class="h-3.5 w-3.5 text-gray-400 transition-transform duration-200"
                                 :class="userMenu ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        {{-- Dropdown --}}
                        <div x-show="userMenu"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute right-0 top-full mt-2 w-48 rounded-xl bg-white shadow-lg ring-1 ring-gray-200 py-1.5 z-50"
                             style="display:none;">

                            <div class="border-b border-gray-100 px-4 py-2.5 mb-1">
                                <p class="text-xs font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <a href="{{ route('dashboard') }}"
                               class="flex items-center gap-x-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                {{ __('My Account') }}
                            </a>

                            <a href="{{ route('orders.index') }}"
                               class="flex items-center gap-x-2.5 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                {{ __('My Orders') }}
                            </a>

                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="flex w-full items-center gap-x-2.5 px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Login Link (guest, desktop) --}}
                    <a href="{{ route('login') }}"
                       class="hidden md:inline-flex items-center gap-x-1.5 rounded-lg border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        {{ __('Login') }}
                    </a>
                @endauth

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

            {{-- Mobile: User links --}}
            @auth
                <div class="border-t border-gray-100 mt-1 pt-2 space-y-1">
                    <div class="flex items-center gap-x-2 px-3 py-2">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-primary text-xs font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <div>
                            <p class="text-xs font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-x-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        {{ __('My Account') }}
                    </a>
                    <a href="{{ route('orders.index') }}"
                       class="flex items-center gap-x-2 rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-primary">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        {{ __('My Orders') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-x-2 rounded-md px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-100 mt-1 pt-2">
                    <a href="{{ route('login') }}"
                       class="flex items-center gap-x-2 rounded-md px-3 py-2 text-sm font-medium text-primary hover:bg-primary/5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        {{ __('Login / Register') }}
                    </a>
                </div>
            @endauth
        </nav>
    </div>
</header>
