@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto mt-8">
        <h1 class="text-3xl font-bold text-center mb-6">Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full p-3 border rounded-lg" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full p-3 border rounded-lg" required>
                @error('password')
                    <div class="text-red-500 mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">Login</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('password.request') }}" class="text-blue-600">Forgot your password?</a>
        </div>
    </div>
@endsection
