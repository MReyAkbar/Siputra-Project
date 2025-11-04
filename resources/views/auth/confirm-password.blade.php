@extends('layouts.auth')

@section('title', 'Konfirmasi Password - SIPUTRA')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/siputra-logo.png') }}" alt="SIPUTRA" class="h-12 rounded-full mx-auto mb-4">
            <h1 class="text-2xl font-bold text-white">Konfirmasi Password</h1>
            <p class="text-gray-400">Masukkan password untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
            @csrf
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        required
                        class="w-full px-4 py-3 pr-12 border rounded-lg focus:ring-2 focus:ring-[#134686] focus:border-transparent @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password"
                    >
                    <button 
                        type="button" 
                        class="toggle-password absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                        aria-label="Toggle password visibility"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.23 2.76-2.82 3.44-4.75C21.27 7.61 17 4.5 12 4.5c-1.54 0-3.03.25-4.41.67l2.04 2.04C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.25 4.41-.67l.46.46L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.77l1.54 1.54C9.04 11.47 9 11.73 9 12c0 1.66 1.34 3 3 3 .27 0 .53-.04.77-.1l1.54 1.54c-.47.16-.97.26-1.5.26-2.76 0-5-2.24-5-5 0-.53.1-1.03.26-1.5z"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full py-3 bg-[#134686] hover:bg-[#0d3566] text-white font-semibold rounded-lg transition transform">
                Konfirmasi
            </button>

            <p class="text-center text-sm text-gray-600">
                <a href="{{ url()->previous() }}" class="text-[#134686] font-medium hover:underline">
                    Kembali
                </a>
            </p>
        </form>
    </div>
</div>
@endsection