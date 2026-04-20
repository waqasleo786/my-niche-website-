<div>
    {{-- Success Message --}}
    @if($submitted)
        <div class="rounded-xl border border-green-200 bg-green-50 p-6 text-center">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-green-800">
                {{ __('Message sent successfully! We will get back to you within 24 hours.') }}
            </h3>
            <button
                wire:click="$set('submitted', false)"
                class="mt-4 text-sm text-green-700 underline hover:text-green-900"
            >
                Send another message
            </button>
        </div>
    @else
        {{-- Error Message --}}
        @if($errorMessage)
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ $errorMessage }}
            </div>
        @endif

        <form wire:submit="submit" class="space-y-5" novalidate>

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    {{ __('Your Name') }} <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    placeholder="{{ __('Your Name') }}"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-[#1e3a5f] focus:outline-none focus:ring-1 focus:ring-[#1e3a5f] @error('name') border-red-400 bg-red-50 @enderror"
                >
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    {{ __('Email Address') }} <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    placeholder="{{ __('Email Address') }}"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-[#1e3a5f] focus:outline-none focus:ring-1 focus:ring-[#1e3a5f] @error('email') border-red-400 bg-red-50 @enderror"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    {{ __('Phone (optional)') }}
                </label>
                <input
                    type="tel"
                    id="phone"
                    wire:model="phone"
                    placeholder="03XX-XXXXXXX"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-[#1e3a5f] focus:outline-none focus:ring-1 focus:ring-[#1e3a5f] @error('phone') border-red-400 bg-red-50 @enderror"
                >
                @error('phone')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Subject --}}
            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">
                    {{ __('Subject') }} <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="subject"
                    wire:model="subject"
                    placeholder="{{ __('Subject') }}"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-[#1e3a5f] focus:outline-none focus:ring-1 focus:ring-[#1e3a5f] @error('subject') border-red-400 bg-red-50 @enderror"
                >
                @error('subject')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">
                    {{ __('Your Message') }} <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="message"
                    wire:model="message"
                    rows="5"
                    placeholder="{{ __('Your Message') }}"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm transition focus:border-[#1e3a5f] focus:outline-none focus:ring-1 focus:ring-[#1e3a5f] @error('message') border-red-400 bg-red-50 @enderror"
                ></textarea>
                @error('message')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="flex w-full items-center justify-center gap-x-2 rounded-lg bg-[#1e3a5f] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#152d4a] focus:outline-none focus:ring-2 focus:ring-[#1e3a5f] focus:ring-offset-2 disabled:opacity-70"
            >
                <span wire:loading.remove>{{ __('Send Message') }}</span>
                <span wire:loading class="flex items-center gap-x-2">
                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    {{ __('Sending...') }}
                </span>
            </button>
        </form>
    @endif
</div>
