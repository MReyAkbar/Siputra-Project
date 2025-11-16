@extends('layouts.app')

@section('title', 'Detail Produk - SIPUTRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
        <a href="{{ route('katalog.index') }}" class="hover:text-[#134686] transition-colors">Katalog Ikan</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">{{ $item->ikan->nama }}</span>
    </nav>

    {{-- Wrapper --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-8">

            {{-- Gambar Produk --}}
            <div class="relative">
                <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden bg-gray-100">
                    <img 
                        src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default-ikan.png') }}"
                        class="w-full h-full object-cover"
                        alt="{{ $item->ikan->nama }}"
                    >
                </div>

                {{-- Stok --}}
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center gap-1 px-4 py-2 bg-[#134686] text-white text-sm font-semibold rounded-full shadow-md">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Stok Tersedia: {{ $item->ikan->stok ?? 0 }} kg
                    </span>
                </div>
            </div>

            {{-- Detail Produk --}}
            <div class="flex flex-col">

                <div class="mb-4">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        {{ $item->ikan->nama }}
                    </h1>
                    <p class="text-lg text-gray-600 capitalize">
                        Kategori: {{ $item->ikan->kategori->nama_kategori ?? 'Tidak Diketahui' }}
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-4xl font-bold text-[#134686]">
                        Rp{{ number_format($item->harga_jual, 0, ',', '.') }}/Kg
                    </p>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $item->deskripsi ?? '-' }}
                    </p>
                </div>

                {{-- Jumlah Pesanan --}}
                <div class="mb-6">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah (Kg)
                    </label>
                    <div class="flex items-center gap-3">
                        <button onclick="decreaseQuantity()" 
                            class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20 12H4"></path>
                            </svg>
                        </button>

                        <input type="number" 
                            id="quantity" 
                            value="1" 
                            min="1"
                            class="w-32 px-4 py-3 text-center text-lg font-semibold border-2 border-gray-300 rounded-lg focus:ring-[#134686] focus:border-[#134686]">

                        <button onclick="increaseQuantity()" 
                            class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row gap-3 mt-auto">
                    <button onclick="addToCart()" 
                        class="flex-1 flex items-center justify-center gap-2 bg-[#FFC107] hover:bg-[#FFB300] text-gray-900 font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Tambah ke Keranjang
                    </button>

                    <button onclick="orderNow()" 
                        class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                            <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043..." fill="#ffffff"></path>
                        </svg>
                        Pesan Sekarang
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Komitmen --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Kualitas Terjamin</h3>
            <p class="text-sm text-gray-600">Produk ikan segar dengan kualitas premium terjamin</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Pengiriman Cepat</h3>
            <p class="text-sm text-gray-600">Dikirim langsung dengan sistem cold chain terbaik</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-2">Harga Terbaik</h3>
            <p class="text-sm text-gray-600">Dapatkan harga terbaik langsung dari sumbernya</p>
        </div>
    </div>

</div>

{{-- JS Sederhana --}}
<script>
function increaseQuantity() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) input.value--;
}

function addToCart() {
    alert("Fitur keranjang belum diimplementasikan.");
}

function orderNow() {
    alert("Fitur checkout belum diimplementasikan.");
}
</script>

@endsection
