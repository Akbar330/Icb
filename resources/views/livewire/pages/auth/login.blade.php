<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // Redirect ke /admin setelah login berhasil
        $this->redirect('/admin');
    }
};
?>

<div class="w-full max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg border border-gray-100">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">
        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-gray-800" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-gray-800" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mb-6">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded text-indigo-600 focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button wire:click="login" class="w-full py-2 px-4 text-white font-semibold rounded-md bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-400 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
