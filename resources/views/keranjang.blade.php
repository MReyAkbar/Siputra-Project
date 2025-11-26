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
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Keranjang Belanja Anda
      </h1>
    </div>

    {{-- Tabel Keranjang --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah (Kg)</th>
              <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">

            @forelse ($items as $item)
              @php
                $productName = $item->getProductName();
                $productPrice = $item->getProductPrice();
                $productImage = $item->getProductImage();
                $subtotal = $item->getSubtotal();
              @endphp
              
              <tr class="hover:bg-gray-50 transition-colors">

                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-4">
                    <img src="{{ $productImage ? asset('storage/'.$productImage) : asset('images/default-ikan.png') }}" class="w-16 h-16 object-cover rounded-lg shadow-sm" alt="{{ $productName }}">
                    <div>
                      <h4 class="font-semibold text-gray-900">{{ $productName }}</h4>
                      @if($item->catalogItem)
                        <p class="text-sm text-gray-500">{{ $item->catalogItem->ikan->kategori->nama_kategori ?? '' }}</p>
                      @endif
                    </div>
                  </div>
                </td>

                <td class="px-6 py-4">
                  <span class="font-medium text-gray-900">
                    Rp {{ number_format($productPrice, 0, ',', '.') }}/Kg
                  </span>
                </td>

                <td class="px-6 py-4 text-center">
                  <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline-flex items-center gap-2">
                    @csrf
                    <input type="number" min="1" name="jumlah" value="{{ $item->jumlah }}" class="w-20 border border-gray-300 rounded-md text-center py-1 focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
                    <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded-md text-xs font-medium hover:bg-blue-600 transition-colors">
                      Update
                    </button>
                  </form>
                </td>

                <td class="px-6 py-4 text-right">
                  <span class="font-semibold text-gray-900">
                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                  </span>
                </td>

                <td class="px-6 py-4 text-center">
                  <form action="{{ route('cart.delete', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md text-xs font-medium hover:bg-red-600 transition-colors">
                      Hapus
                    </button>
                  </form>
                </td>

              </tr>
            @empty
            <tr class="bg-white">
              <td colspan="5" class="py-16 px-6">
                <div class="text-center">
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

    {{-- Checkout Summary --}}
    @if ($items->count() > 0)
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2"></div>
      <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

        @php
            $totalItems = $items->count();
            $totalQuantity = $items->sum('jumlah');
            $totalPrice = $items->sum(function ($item) {
                return $item->getSubtotal();
            });

            $waText = "Halo, saya ingin memesan:%0A%0A";

            foreach ($items as $item) {
                $name = $item->getProductName();
                $price = $item->getProductPrice();
                $qty = $item->jumlah;
                $subtotal = $item->getSubtotal();
                
                $waText .= "{$qty}Kg {$name} - Rp ".number_format($price,0,',','.')."/Kg = Rp ".number_format($subtotal,0,',','.')."%0A";
            }

            $waText .= "%0A*Total: Rp ".number_format($totalPrice,0,',','.')."*";
        @endphp

        <div class="space-y-3 mb-6">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Item</span>
            <span class="font-medium">{{ $totalItems }} produk</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Berat</span>
            <span class="font-medium">{{ $totalQuantity }} Kg</span>
          </div>
          <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t">
            <span>Total Harga</span>
            <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
          </div>
        </div>

        <a href="https://wa.me/6282141451578?text={{ $waText }}" target="_blank" class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition-all">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
          </svg>
          Pesan via WhatsApp
        </a>

        <p class="text-xs text-gray-500 text-center mt-3">
          Pesanan langsung diproses oleh tim kami
        </p>

      </div>
    </div>
    @endif

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  if (typeof updateCartBadge === 'function') {
    updateCartBadge();
  }
});
</script>
@endsection