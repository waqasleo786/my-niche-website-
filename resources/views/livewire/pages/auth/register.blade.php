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

        $this->redirect(url('/'), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone (03XX-XXXXXXX)')" />
            <x-text-input wire:model="phone" id="phone" class="block mt-1 w-full" type="tel" name="phone" required autocomplete="tel" placeholder="03001234567" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- B2B Toggle -->
        <div class="mt-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input wire:model.live="is_b2b" type="checkbox" id="is_b2b" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                <span class="text-sm text-gray-700">{{ __('Register as Business (B2B)') }}</span>
            </label>
        </div>

        <!-- B2B Fields (show only when is_b2b checked) -->
        @if ($is_b2b)
        <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-xs text-gray-500 mb-3">{{ __('B2B accounts require admin approval before B2B pricing is activated.') }}</p>

            <div>
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input wire:model="company_name" id="company_name" class="block mt-1 w-full" type="text" name="company_name" autocomplete="organization" />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="ntn_number" :value="__('NTN Number')" />
                <x-text-input wire:model="ntn_number" id="ntn_number" class="block mt-1 w-full" type="text" name="ntn_number" placeholder="1234567-8" />
                <x-input-error :messages="$errors->get('ntn_number')" class="mt-2" />
            </div>
        </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

    </form>
</div>
