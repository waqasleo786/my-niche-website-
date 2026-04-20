<header class="sticky top-0 z-40 bg-white shadow-sm" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            {{-- Logo --}}
            <a href="{{ LaravelLocalization::localizeURL('/') }}" class="flex items-center gap-x-2">
                <span class="text-xl font-bold text-[#1e3a5f]">Shahid Brothers</span>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden items-center gap-x-8 md:flex">
                <a href="{{ LaravelLocalization::localizeURL('/') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('home') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/shop') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('shop') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Shop') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/about') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('about') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('About Us') }}
                </a>
                <a href="{{ LaravelLocalization::localizeURL('/contact') }}"
                   class="text-sm font-medium text-gray-700 hover:text-[#1e3a5f] transition-colors {{ request()->routeIs('contact') ? 'text-[#1e3a5f] font-semibold' : '' }}">
                    {{ __('Contact Us') }}
                </a>
            </nav>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center gap-x-3">

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
            <a href="{{ LaravelLocalization::localizeURL('/') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Home') }}
            </a>
            <a href="{{ LaravelLocalization::localizeURL('/shop') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Shop') }}
            </a>
            <a href="{{ LaravelLocalization::localizeURL('/about') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('About Us') }}
            </a>
            <a href="{{ LaravelLocalization::localizeURL('/contact') }}"
               class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[#1e3a5f]">
                {{ __('Contact Us') }}
            </a>
        </nav>
    </div>
</header>
