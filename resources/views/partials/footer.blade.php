<footer class="bg-[#1e3a5f] text-white">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            {{-- Brand --}}
            <div>
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-footer.png') }}"
                         alt="Shahid Brothers"
                         class="h-10 w-auto"
                         loading="lazy">
                </a>
                <p class="mt-3 text-sm text-blue-200">
                    {{ __('We import quality promotional and gift items from China and deliver across Pakistan.') }}
                </p>
            </div>

            {{-- Quick Links + Policies (side by side) --}}
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-blue-300">{{ __('Quick Links') }}</h4>
                    <ul class="mt-3 space-y-2">
                        <li><a href="{{ url('/') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Home') }}</a></li>
                        <li><a href="{{ url('/shop') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Shop') }}</a></li>
                        <li><a href="{{ url('/about') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('About Us') }}</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Contact Us') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-blue-300">{{ __('Policies') }}</h4>
                    <ul class="mt-3 space-y-2">
                        <li><a href="{{ route('shipping') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Shipping Info') }}</a></li>
                        <li><a href="{{ route('faq') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('FAQ') }}</a></li>
                        <li><a href="{{ route('terms') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Terms & Conditions') }}</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-sm text-blue-200 hover:text-white transition-colors">{{ __('Privacy Policy') }}</a></li>
                    </ul>
                </div>
            </div>

            {{-- Contact Info --}}
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-blue-300">{{ __('Contact Us') }}</h4>
                <ul class="mt-3 space-y-2 text-sm text-blue-200">
                    <li class="flex items-start gap-x-2">
                        <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Masha Allah Plaza, 33 Nisbat Road, Anarkali Bazar, Lahore</span>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+923084570786" class="hover:text-white">0308-4570786</a>
                    </li>
                    <li class="flex items-center gap-x-2">
                        <svg class="h-4 w-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/>
                        </svg>
                        <a href="https://wa.me/923084570786" target="_blank" rel="noopener noreferrer" class="hover:text-white">{{ __('Chat on WhatsApp') }}</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 border-t border-blue-800 pt-6 text-center text-xs text-blue-300">
            &copy; {{ date('Y') }} Shahid Brothers. All rights reserved.
        </div>
    </div>
</footer>

