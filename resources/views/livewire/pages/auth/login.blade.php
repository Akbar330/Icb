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

<div class="w-full">
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white shadow-lg mb-2">
            <i class="fas fa-lock text-xl"></i>
        </div>
        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h1>
        <p class="text-gray-500 mt-1 text-xs font-medium">Silakan masuk ke akun Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username"
                       class="block w-full pl-10 pr-3 py-2 bg-gray-50/50 border border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm"
                       placeholder="admin@example.com">
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1 text-red-500 text-xs font-medium" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-key text-gray-400 text-sm"></i>
                </div>
                <input wire:model="form.password" id="password" type="password" name="password" required autocomplete="current-password"
                       class="block w-full pl-10 pr-3 py-2 bg-gray-50/50 border border-gray-200 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm"
                       placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1 text-red-500 text-xs font-medium" />
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:-translate-y-0.5 transition-all duration-200 mt-2">
            Masuk Sekarang
            <i class="fas fa-arrow-right ml-2 mt-0.5"></i>
        </button>
    </form>
</div>
