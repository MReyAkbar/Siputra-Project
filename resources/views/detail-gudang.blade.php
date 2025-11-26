@extends('layouts.app')

@section('title', 'Detail Gudang - ' . $gudang->nama_gudang)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  <nav class="flex mb-6" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
          <a href="{{ route('gudang.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#134686]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Katalog Gudang
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="ml-1 text-sm font-medium text-[#134686] md:ml-2">{{ $gudang->nama_gudang }}</span>
          </div>
        </li>
      </ol>
    </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <img src="{{ $gudang->gambar ? asset('storage/'.$gudang->gambar) : asset('images/no-image.png') }}" class="w-full h-96 object-cover" alt="Gambar Gudang">
      </div>
    </div>

    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-start justify-between mb-4">
          <h1 class="text-2xl font-bold text-gray-900">{{ $gudang->nama_gudang }}</h1>

          <span class="px-3 py-1.5 text-xs font-semibold rounded-full shadow-md
            {{ $gudang->status_sewa == 'tersedia' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
            {{ $gudang->status_sewa == 'tersedia' ? 'Bisa Disewa' : 'Tidak Bisa Disewa' }}
          </span>
        </div>

        <p class="text-gray-700 text-lg mb-4">
          {{ $gudang->lokasi }}
        </p>

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

        <a href="https://wa.me/6282141451578?text={{ urlencode('Halo, saya ingin menanyakan ketersediaan Gudang '.$gudang->nama_gudang) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition-all">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
          </svg>
          Hubungi via WhatsApp
        </a>

        <button onclick="history.back()" class="mt-3 w-full px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
          Kembali ke Katalog
        </button>
      </div>
    </div>

  </div>

  <div class="mt-12 bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Gudang</h2>
    <p class="text-gray-700 leading-relaxed">
      {{ $gudang->deskripsi ?? 'Tidak ada deskripsi.' }}
    </p>
  </div>

</div>
@endsection
