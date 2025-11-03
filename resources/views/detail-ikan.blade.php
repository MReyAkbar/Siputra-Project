@extends('layouts.app')

@section('title', 'Detail Produk - SIPUTRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  {{-- Navigasi Katalog Ikan --}}
  <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
    <a href="/katalog" class="hover:text-[#134686] transition-colors">Katalog Ikan</a>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
    <span class="text-gray-900 font-medium">Detail Ikan</span>
  </nav>

  {{-- Product Content --}}
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-8">
      
      <div class="relative">
        <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden bg-gray-100">
          <img id="productImage" 
            src="images/ikan-tuna.png" 
            alt="Product Image" 
            class="w-full h-full object-cover">
        </div>
        
        <div class="absolute top-4 right-4">
          <span id="stockBadge" class="inline-flex items-center gap-1 px-4 py-2 bg-[#134686] text-white text-sm font-semibold rounded-full shadow-md">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Stok Tersedia: 1500kg
          </span>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="mb-4">
          <h1 id="productName" class="text-4xl font-bold text-gray-900 mb-2">Tuna</h1>
          <p id="productCategory" class="text-lg text-gray-500 capitalize">Kategori: Tuna</p>
        </div>

        <div class="mb-6">
          <p id="productPrice" class="text-4xl font-bold text-[#134686]">Rp13.500,00/Kg</p>
        </div>

        <div class="mb-6 pb-6 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
          <p id="productDescription" class="text-gray-600 leading-relaxed">
            Iki iwak Tuna rasane enak banbget mantab aselole ahoy ahoy cihuy.
          </p>
        </div>

        <div class="mb-8 grid grid-cols-2">
          <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500 mb-1">Ukuran</p>
            <p class="text-lg font-semibold text-gray-900">10-15 cm</p>
          </div>
        </div>

        <div class="mb-6">
          <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
            Jumlah (Kg)
          </label>
          <div class="flex items-center gap-3">
            <button onclick="decreaseQuantity()" class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
              <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
              </svg>
            </button>
            <input type="number" 
              id="quantity" 
              value="1" 
              min="1" 
              class="w-32 px-4 py-3 text-center text-lg font-semibold border-2 border-gray-300 rounded-lg focus:ring-[#134686] focus:border-[#134686]">
            <button onclick="increaseQuantity()" class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
              <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
            </button>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 mt-auto">
          <button onclick="addToCart()" class="flex-1 flex items-center justify-center gap-2 bg-[#FFC107] hover:bg-[#FFB300] text-gray-900 font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Tambah ke Keranjang
          </button>
          <button onclick="orderNow()" class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#ffffff"></path> </g></svg>
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
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
      <h3 class="font-semibold text-gray-900 mb-2">Kualitas Terjamin</h3>
      <p class="text-sm text-gray-600">Produk ikan segar dengan kualitas premium terjamin</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center">
      <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
      <h3 class="font-semibold text-gray-900 mb-2">Pengiriman Cepat</h3>
      <p class="text-sm text-gray-600">Dikirim langsung dengan sistem cold chain terbaik</p>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 text-center">
      <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
      </div>
      <h3 class="font-semibold text-gray-900 mb-2">Harga Terbaik</h3>
      <p class="text-sm text-gray-600">Dapatkan harga terbaik langsung dari sumbernya</p>
    </div>
  </div>

  {{-- Produk Terkait --}}
  <div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <a href="/katalog/2" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset('images/ikan-kakap-merah.png') }}" alt="Kakap Merah" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Kakap Merah</h3>
          <p class="text-sm text-gray-500 mb-2">Kakap</p>
          
          <div class="mt-3">
            <p class="text-[#134686] font-bold">Rp13.500 <span class="text-sm text-gray-500">/ kg</span></p>
            <p class="text-sm text-gray-600">Stok Tersedia: 800 kg</p>
          </div>
        </div>
      </a>

      <a href="/katalog/3" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-barracuda.png") }}" alt="Barracuda" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Barracuda</h3>
          <p class="text-sm text-gray-500 mb-2">Barracuda</p>
          
          <div class="mt-3">
            <p class="text-[#134686] font-bold">Rp13.500 <span class="text-sm text-gray-500">/ kg</span></p>
            <p class="text-sm text-gray-600">Stok Tersedia: 600 kg</p>
          </div>
        </div>
      </a>

      <a href="/katalog/4" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-ogos.png") }}" alt="Ogos" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Ogos</h3>
          <p class="text-sm text-gray-500 mb-2">Ogos</p>
          
          <div class="mt-3">
            <p class="text-[#134686] font-bold">Rp13.500 <span class="text-sm text-gray-500">/ kg</span></p>
            <p class="text-sm text-gray-600">Stok Tersedia: 1.200 kg</p>
          </div>
        </div>
      </a>

      <a href="/katalog/5" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-kembung.png") }}" alt="Kembung" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Kembung</h3>
          <p class="text-sm text-gray-500 mb-2">Kembung</p>
          
          <div class="mt-3">
            <p class="text-[#134686] font-bold">Rp13.500 <span class="text-sm text-gray-500">/ kg</span></p>
            <p class="text-sm text-gray-600">Stok Tersedia: 900 kg</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<script>
const productData = {
  1: {
    nama: 'Tuna',
    kategori: 'Tuna',
    harga: 13500,
    gambar: '{{ asset("images/ikan-tuna.png") }}',
    deskripsi: 'Iki iwak Tuna rasane enak banbget mantab aselole ahoy ahoy cihuy.',
    ukuran: '10-15 cm',
    stok: 1500,
  },
  2: {
    nama: 'Kakap Merah',
    kategori: 'Kakap',
    harga: 13500,
    gambar: '{{ asset("images/ikan-kakap-merah.png") }}',
    deskripsi: 'Kakap merah segar dengan kualitas premium untuk berbagai olahan masakan.',
    ukuran: '20-25 cm',
    stok: 800,
  },
  3: {
    nama: 'Barracuda',
    kategori: 'Barracuda',
    harga: 13500,
    gambar: '{{ asset("images/ikan-barracuda.png") }}',
    deskripsi: 'Barracuda segar hasil tangkapan terbaik dengan daging yang lezat.',
    ukuran: '20-25 cm',
    stok: 600,
  },
  4: {
    nama: 'Ogos',
    kategori: 'ogos',
    harga: 13500,
    gambar: '{{ asset("images/ikan-ogos.png") }}',
    deskripsi: 'Ogos berkualitas tinggi untuk berbagai masakan.',
    ukuran: '5-6',
    stok: 1200,
  },
  5: {
    nama: 'Kembung',
    kategori: 'kembung',
    harga: 19500,
    gambar: '{{ asset("images/ikan-kembung.png") }}',
    deskripsi: 'Ikan kembung segar pilihan.',
    ukuran: '10-15',
    stok: 900,
  },
  6: {
    nama: 'Tuna Sirip Kuning',
    kategori: 'layang',
    harga: 13500,
    gambar: '{{ asset("images/ikan-layang.png") }}',
    deskripsi: 'Tuna sirip kuning premium quality.',
    ukuran: '20-25',
    stok: 500,
  }
};

function getCurrentProductId() {
  const path = window.location.pathname;
  const matches = path.match(/\/katalog\/(\d+)/);
  return matches ? matches[1] : '1';
}

function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
}

function formatStok(kg) {
  const num = kg.replace(/[^0-9]/g, '');
  return `${num.replace(/\B(?=(\d{3})+(?!\d))/g, ".")} kg`;
}

function loadProductData() {
  const productId = getCurrentProductId();
  const product = productData[productId] || productData[1];
  
  document.getElementById('productName').textContent = product.nama;
  document.getElementById('productCategory').textContent = `Kategori: ${product.kategori}`;
  document.getElementById('productPrice').textContent = `${formatRupiah(product.harga)},00/kg`;
  document.getElementById('productDescription').textContent = product.deskripsi;
  document.getElementById('productImage').src = product.gambar;
  document.getElementById('stockBadge').innerHTML = `
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
    </svg>
    Stok Tersedia: ${formatStok(product.stok)}
  `;
  
  
  document.querySelector('.bg-gray-50:first-of-type p:last-child').textContent = product.ukuran;
}

function increaseQuantity() {
  const input = document.getElementById('quantity');
  input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
  const input = document.getElementById('quantity');
  if (parseInt(input.value) > 1) {
    input.value = parseInt(input.value) - 1;
  }
}

function addToCart() {
  const quantity = document.getElementById('quantity').value;
  const productName = document.getElementById('productName').textContent;
  
  alert(`Berhasil menambahkan ${quantity}kg ${productName} ke keranjang!\n\nCatatan: Fitur keranjang akan diimplementasikan pada tahap backend.`);
}

function orderNow() {
  const quantity = document.getElementById('quantity').value;
  const productName = document.getElementById('productName').textContent;
  
  if (confirm(`Pesan ${quantity}kg ${productName} sekarang?\n\nAnda akan diarahkan ke halaman checkout.`)) {
    alert('Fitur checkout akan diimplementasikan pada tahap backend.');
  }
}

document.addEventListener('DOMContentLoaded', loadProductData);
</script>
@endsection