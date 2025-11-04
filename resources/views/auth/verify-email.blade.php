@extends('layouts.auth')

@section('title', 'Verifikasi Email - SIPUTRA')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br px-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('images/siputra-logo.png') }}" alt="SIPUTRA" class="h-12 rounded-full mx-auto mb-4">
            <h1 class="text-2xl font-bold text-white">Verifikasi Email</h1>
            <p class="text-gray-400">Cek inbox Anda untuk mengaktifkan akun</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8 space-y-6 text-center">
            <div class="mx-auto w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>

            @if (session('resent'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                    Link verifikasi baru telah dikirim ke email Anda.
                </div>
            @endif

            <p class="text-gray-600">
                Sebelum melanjutkan, silakan cek email Anda untuk link verifikasi.
            </p>

            <p class="text-sm text-gray-500">
                Jika belum menerima email, klik tombol di bawah ini.
            </p>

            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#134686] hover:bg-[#0d3566] text-white font-medium rounded-lg transition transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Kirim Ulang Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 underline">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection