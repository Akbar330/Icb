<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h1>
        <p class="text-gray-500 mt-2 text-sm font-medium">Silakan masuk ke akun admin Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Input -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm"
                       placeholder="admin@example.com">
            </div>
            @error('email')
                <p class="text-red-500 text-xs font-medium mt-2 ml-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-key text-gray-400"></i>
                </div>
                <input type="password" name="password" id="password" required
                       class="block w-full pl-11 pr-4 py-3 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 shadow-sm"
                       placeholder="••••••••">
            </div>
            @error('password')
                <p class="text-red-500 text-xs font-medium mt-2 ml-1"><i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:-translate-y-0.5 transition-all duration-200">
            Masuk Sekarang
            <i class="fas fa-arrow-right ml-2 mt-0.5"></i>
        </button>
        
        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </form>
</x-guest-layout>
