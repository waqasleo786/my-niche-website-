<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name     = '';
    public string $email    = '';
    public string $phone    = '';
    public string $password = '';
    public string $password_confirmation = '';

    // B2B fields
    public bool   $is_b2b       = false;
    public string $company_name = '';
    public string $ntn_number   = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone'    => ['required', 'string', 'regex:/^03[0-9]{9}$/'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'is_b2b'       => ['boolean'],
            'company_name' => ['required_if:is_b2b,true', 'nullable', 'string', 'max:255'],
            'ntn_number'   => ['required_if:is_b2b,true', 'nullable', 'string', 'max:50'],
        ]);

        $validated['password']    = Hash::make($validated['password']);
        $validated['is_verified'] = false; // B2B needs admin approval

        $user = User::create($validated);

        // Assign role
        if ($user->is_b2b) {
            $user->assignRole('b2b_customer');
        } else {
            $user->assignRole('customer');
        }

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">

        {{-- Required fields note --}}
        <p class="text-xs text-gray-400 mb-4"><span class="text-red-500">*</span> {{ __('Required fields') }}</p>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" :required="true" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" placeholder="{{ __('e.g. Ali Hassan') }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" :required="true" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" placeholder="{{ __('you@example.com') }}" />
            <p class="mt-1 text-xs text-gray-400">{{ __('Used for order updates & password reset') }}</p>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Mobile Number')" :required="true" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="tel" name="phone" required autocomplete="tel" placeholder="03001234567" />
            <p class="mt-1 text-xs text-gray-400">{{ __('Pakistani number starting with 03 — used for delivery & WhatsApp') }}</p>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" :required="true" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <p class="mt-1 text-xs text-gray-400">{{ __('Min. 8 characters — mix letters, numbers & symbols') }}</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" :required="true" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- B2B Toggle -->
        <div class="mt-5 rounded-lg border border-gray-200 bg-gray-50 px-4 py-3">
            <label class="flex items-start gap-3 cursor-pointer">
                <input wire:model.live="is_b2b" type="checkbox" id="is_b2b" class="mt-0.5 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <div>
                    <span class="text-sm font-medium text-gray-800">{{ __('Register as Business (B2B)') }}</span>
                    <p class="text-xs text-gray-500 mt-0.5">{{ __('For companies placing bulk/wholesale orders') }}</p>
                </div>
            </label>
        </div>

        <!-- B2B Fields (show only when is_b2b checked) -->
        @if ($is_b2b)
        <div class="mt-3 p-4 bg-amber-50 rounded-lg border border-amber-200">
            <div class="flex items-start gap-2 mb-3">
                <svg class="h-4 w-4 text-amber-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs text-amber-700">{{ __('B2B accounts need admin approval (within 24 hours) before wholesale pricing is activated.') }}</p>
            </div>

            <div>
                <x-input-label for="company_name" :value="__('Company Name')" :required="true" />
                <x-text-input wire:model="company_name" id="company_name" class="block mt-1 w-full" type="text" name="company_name" autocomplete="organization" placeholder="{{ __('Your company or business name') }}" />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="ntn_number" :value="__('NTN Number')" :required="true" />
                <x-text-input wire:model="ntn_number" id="ntn_number" class="block mt-1 w-full" type="text" name="ntn_number" placeholder="1234567-8" />
                <p class="mt-1 text-xs text-amber-700">{{ __('National Tax Number — required for B2B verification') }}</p>
                <x-input-error :messages="$errors->get('ntn_number')" class="mt-2" />
            </div>
        </div>
        @endif

        <!-- Submit -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5 text-sm">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="mt-4 text-center text-sm text-gray-600">
            {{ __('Already have an account?') }}
            <a class="font-semibold text-indigo-600 hover:text-indigo-500"
               href="{{ route('login') }}" wire:navigate>
                {{ __('Sign in') }}
            </a>
        </p>

    </form>
</div>
