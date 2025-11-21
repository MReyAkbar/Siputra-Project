@extends('layouts.app')

@section('title', 'Keranjang - SIPUTRA')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8">
      <a href="/katalog" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Katalog
      </a>
      <h1 class="text-3xl font-bold text-gray-900 mt-4 flex items-center gap-3">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Keranjang Belanja Anda
      </h1>
    </div>

    {{-- Tabel Keranjang --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 border-b border-gray-900">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">

            @forelse ($items as $item)
              <tr class="hover:bg-gray-50 transition-colors">

                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/'.$item->ikan->foto) }}"
                         class="w-16 h-16 object-cover rounded-lg shadow-sm">
                    <div>
                      <h4 class="font-semibold text-gray-900">{{ $item->ikan->nama }}</h4>
                      <p class="text-sm text-gray-500">Size {{ $item->ikan->ukuran }}</p>
                    </div>
                  </div>
                </td>

                <td class="px-6 py-4">
                  <span class="font-medium text-gray-900">
                    Rp {{ number_format($item->ikan->harga_beli, 0, ',', '.') }}/Kg
                  </span>
                </td>

                <td class="px-6 py-4 text-center">
                  <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-block">
                    @csrf
                    <input type="number" min="1" name="jumlah" value="{{ $item->jumlah }}"
                           class="w-20 border rounded-md text-center p-1">
                    <button class="text-blue-600 text-xs font-medium">Update</button>
                  </form>
                </td>

                <td class="px-6 py-4 text-right">
                  <span class="font-semibold text-gray-900">
                    Rp {{ number_format($item->jumlah * $item->ikan->harga_beli, 0, ',', '.') }}
                  </span>
                </td>

                <td class="px-6 py-4 text-center">
                  <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 bg-red-500 text-white rounded-md text-xs hover:bg-red-600">
                      Hapus
                    </button>
                  </form>
                </td>

              </tr>
            @empty
            <tr class="bg-white">
              <td colspan="5" class="py-16 px-6">
                <div class="text-center">
                  {{-- Ikon Keranjang dari keranjang.blade3.txt --}}
                  <svg class="mx-auto w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang kosong</h3>
                  <p class="text-gray-600 mb-6">Yuk, tambahkan ikan favoritmu!</p>
                  <a href="/katalog" class="inline-flex items-center gap-2 px-6 py-3 bg-[#134686] text-white font-semibold rounded-lg hover:bg-[#0d3566] transition-all">
                    Mulai Belanja
                  </a>
                </div>
              </td>
            </tr>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>

    {{-- Checkout --}}
    @if ($items->count() > 0)
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2"></div>
      <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

        @php
            $totalItems = $items->sum('jumlah');
            $totalWeight = $items->sum('jumlah');
            $totalPrice = $items->sum(function ($i) {
                return $i->jumlah * $i->ikan->harga_beli;
            });

            $waText = "Halo, saya ingin memesan:%0A%0A";

            foreach ($items as $i) {
                $waText .= "{$i->jumlah}Kg {$i->ikan->nama} - Rp ".number_format($i->ikan->harga_beli,0,',','.')."/Kg = Rp ".number_format($i->jumlah * $i->ikan->harga_beli,0,',','.')."%0A";
            }

            $waText .= "%0A*Total: Rp ".number_format($totalPrice,0,',','.')."*";
        @endphp

        <div class="space-y-3 mb-6">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Item</span>
            <span class="font-medium">{{ $totalItems }}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Berat</span>
            <span class="font-medium">{{ $totalWeight }} Kg</span>
          </div>
          <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t">
            <span>Total Harga</span>
            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
          </div>
        </div>

        <a href="https://wa.me/6286969696969?text={{ $waText }}"
           target="_blank"
           class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition-all
                  {{ $items->count() == 0 ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
          Bayar Sekarang
        </a>

        <p class="text-xs text-gray-500 text-center mt-3">
          Pesanan langsung diproses oleh tim kami
        </p>

      </div>
    </div>
    @endif

  </div>
</div>
@endsection