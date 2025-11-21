@extends('layouts.app')

@section('title', 'Detail Gudang - ' . $gudang->nama_gudang)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  {{-- Breadcrumb --}}
  <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
    <a href="{{ route('gudang.index') }}" class="hover:text-[#134686] transition">Katalog Gudang</a>
    <svg class="w-4 h-4" fill="none" stroke="currentColor"><path stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span class="text-gray-900 font-medium">{{ $gudang->nama_gudang }}</span>
  </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- GAMBAR --}}
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <img 
          src="{{ $gudang->gambar ? asset('storage/'.$gudang->gambar) : asset('images/no-image.png') }}"
          class="w-full h-96 object-cover"
          alt="Gambar Gudang">
      </div>
    </div>

    {{-- PANEL INFORMASI --}}
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-sm p-6">

        {{-- Nama + Status --}}
        <div class="flex items-start justify-between mb-4">
          <h1 class="text-2xl font-bold text-gray-900">{{ $gudang->nama_gudang }}</h1>

          <span class="px-3 py-1.5 text-xs font-semibold rounded-full shadow-md
            {{ $gudang->status_sewa == 'tersedia' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
            {{ $gudang->status_sewa == 'tersedia' ? 'Bisa Disewa' : 'Tidak Bisa Disewa' }}
          </span>
        </div>

        {{-- Lokasi --}}
        <p class="text-gray-700 text-lg mb-4">
          {{ $gudang->lokasi }}
        </p>

        {{-- Spesifikasi --}}
        <div class="space-y-3 mb-6 pb-6 border-b">
          <div class="flex justify-between">
            <span class="text-gray-600">Kapasitas</span>
            <span class="font-medium">{{ number_format($gudang->kapasitas_kg) }} kg</span>
          </div>

          <div class="flex justify-between">
            <span class="text-gray-600">Status Operasional</span>
            <span class="font-medium">
              {{ ucfirst($gudang->status_operasional) }}
            </span>
          </div>
        </div>

        {{-- WA Button (opsional, ganti nomor jika dibutuhkan) --}}
        <a href="https://wa.me/6282141451578?text={{ urlencode('Halo, saya ingin menanyakan ketersediaan Gudang '.$gudang->nama_gudang) }}"
           class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition transform hover:scale-105">
            Hubungi via WhatsApp
        </a>

        <button onclick="history.back()" 
                class="mt-3 w-full px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
          Kembali ke Katalog
        </button>

      </div>
    </div>

  </div>

  {{-- DESKRIPSI --}}
  <div class="mt-12 bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Gudang</h2>
    <p class="text-gray-700 leading-relaxed">
      {{ $gudang->deskripsi ?? 'Tidak ada deskripsi.' }}
    </p>
  </div>

</div>
@endsection
