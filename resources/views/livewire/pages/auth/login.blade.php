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

<div class="login-container">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">
        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="label" />
            <x-text-input wire:model="form.email" id="email" class="input" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="error-message" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" class="label" />
            <x-text-input wire:model="form.password" id="password" class="input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="error-message" />
        </div>

        <!-- Submit Button -->
        <div class="submit-btn-container">
            <x-primary-button wire:click="login" type="submit" class="submit-btn">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
