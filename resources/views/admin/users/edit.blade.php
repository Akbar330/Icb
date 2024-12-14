@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Sapaan</h1>
        <form action="{{ route('admin.pengguna.update',$user->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <!-- sapaan Artikel -->
          <!-- Nama -->
    <div class="mb-4">
        <label for="name" class="block text-gray-700 font-semibold">Nama</label>
        <input type="text" id="name" name="name" value="{{ old('name',$user->name) }}"
               class="w-full p-2 border border-gray-300 rounded mt-1" required>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-semibold">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email',$user->email) }}"
               class="w-full p-2 border border-gray-300 rounded mt-1" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label for="password" class="block text-gray-700 font-semibold">Password</label>
        <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded mt-1" >
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password Confirmation -->
    <div class="mb-4">
        <label for="password_confirmation" class="block text-gray-700 font-semibold">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded mt-1" >
        @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="mb-4">
        <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
    </div>

            {{-- <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Sapaan
            </button> --}}
        </form>
    </div>
@endsection
