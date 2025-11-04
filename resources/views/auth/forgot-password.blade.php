@extends('layouts.auth')

@section('title', 'Lupa Password - SIPUTRA')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/siputra-logo.png') }}" alt="SIPUTRA" class="h-12 rounded-full mx-auto mb-4">
            <h1 class="text-2xl font-bold text-white">Lupa Password?</h1>
            <p class="text-gray-400">Masukkan email dan kami akan mengirimi anda tautan untuk reset password</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="bg-white rounded-xl shadow-lg p-8 space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-[#134686] focus:border-transparent @error('email') border-red-500 @enderror"
                       placeholder="contoh@email.com" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <button type="submit"
                    class="w-full py-3 bg-[#134686] hover:bg-[#0d3566] text-white font-semibold rounded-lg transition transform">
                Kirim Tautan Reset Password
            </button>

            <p class="text-center text-sm text-gray-600">
                <a href="{{ route('login') }}" class="text-[#134686] font-medium hover:underline">
                    Kembali ke Login
                </a>
            </p>
        </form>
    </div>
</div>
@endsection