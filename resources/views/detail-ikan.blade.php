@extends('layouts.app')

@section('title', 'Detail Produk - SIPUTRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  
  <!-- Back Button -->
  <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 text-white bg-[#EF4444] hover:bg-[#DC2626] px-6 py-3 rounded-full font-medium transition-colors mb-6 shadow-md">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
    </svg>
    Kembali
  </a>

  <!-- Product Detail Card -->
  <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-8">
      
      <!-- Product Image -->
      <div class="relative">
        <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden bg-gray-100">
          <img id="productImage" 
            src="images/ikan-tuna.png" 
            alt="Product Image" 
            class="w-full h-full object-cover">
        </div>
        
        <!-- Stock Badge -->
        <div class="absolute top-4 right-4">
          <span id="stockBadge" class="inline-flex items-center gap-1 px-4 py-2 bg-[#134686] text-white text-sm font-semibold rounded-full shadow-md">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Stok Tersedia: 1500kg
          </span>
        </div>
      </div>

      <!-- Product Info -->
      <div class="flex flex-col">
        <!-- Title & Category -->
        <div class="mb-4">
          <h1 id="productName" class="text-4xl font-bold text-gray-900 mb-2">Tuna</h1>
          <p id="productCategory" class="text-lg text-gray-500 capitalize">Kategori: Tuna</p>
        </div>

        <!-- Price -->
        <div class="mb-6">
          <p id="productPrice" class="text-4xl font-bold text-[#134686]">Rp13.500,00/Kg</p>
        </div>

        <!-- Description -->
        <div class="mb-6 pb-6 border-b border-gray-200">
          <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
          <p id="productDescription" class="text-gray-600 leading-relaxed">
            Iki iwak Tuna rasane enak banbget mantab aselole ahoy ahoy cihuy.
          </p>
        </div>

        <!-- Product Details -->
        <div class="mb-8 grid grid-cols-2">
          <div class="bg-gray-50 rounded-lg p-4">
            <p class="text-sm text-gray-500 mb-1">Ukuran</p>
            <p class="text-lg font-semibold text-gray-900">10-15 cm</p>
          </div>
        </div>

        <!-- Quantity Input -->
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

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 mt-auto">
          <button onclick="addToCart()" class="flex-1 flex items-center justify-center gap-2 bg-[#FFC107] hover:bg-[#FFB300] text-gray-900 font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Tambah ke Keranjang
          </button>
          <button onclick="orderNow()" class="flex-1 flex items-center justify-center gap-2 bg-[#10B981] hover:bg-[#059669] text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Pesan Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Additional Information -->
  <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- Feature Card 1 -->
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
      <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
      <h3 class="font-semibold text-gray-900 mb-2">Kualitas Terjamin</h3>
      <p class="text-sm text-gray-600">Produk ikan segar dengan kualitas premium terjamin</p>
    </div>

    <!-- Feature Card 2 -->
    <div class="bg-white rounded-xl shadow-md p-6 text-center">
      <div class="w-16 h-16 mx-auto mb-4 bg-[#134686] bg-opacity-10 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
      <h3 class="font-semibold text-gray-900 mb-2">Pengiriman Cepat</h3>
      <p class="text-sm text-gray-600">Dikirim langsung dengan sistem cold chain terbaik</p>
    </div>

    <!-- Feature Card 3 -->
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

  <!-- Related Products -->
  <div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Related Product 1 -->
      <a href="/katalog/2" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset('images/ikan-kakap-merah.png') }}" alt="Kakap Merah" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Kakap Merah</h3>
          <p class="text-sm text-gray-500 mb-2">Kakap</p>
          <p class="text-[#134686] font-bold text-base">Rp13.500/Kg</p>
        </div>
      </a>

      <!-- Related Product 2 -->
      <a href="/katalog/3" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-barracuda.png") }}" alt="Barracuda" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Barracuda</h3>
          <p class="text-sm text-gray-500 mb-2">Barracuda</p>
          <p class="text-[#134686] font-bold text-base">Rp13.500/Kg</p>
        </div>
      </a>

      <!-- Related Product 3 -->
      <a href="/katalog/4" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-ogos.png") }}" alt="Ogos" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Ogos</h3>
          <p class="text-sm text-gray-500 mb-2">Ogos</p>
          <p class="text-[#134686] font-bold text-base">Rp13.500/Kg</p>
        </div>
      </a>

      <!-- Related Product 4 -->
      <a href="/katalog/5" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
        <div class="aspect-w-16 aspect-h-12 bg-gray-200">
          <img src="{{ asset("images/ikan-kembung.png") }}" alt="Kembung" 
            class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-4">
          <h3 class="font-semibold text-base text-gray-900 mb-1">Kembung</h3>
          <p class="text-sm text-gray-500 mb-2">Kembung</p>
          <p class="text-[#134686] font-bold text-base">Rp13.500/Kg</p>
        </div>
      </a>
    </div>
  </div>
</div>

<script>
// Sample product data (in real app, this would come from backend)
const productData = {
  1: {
    name: 'Tuna',
    category: 'Tuna',
    price: 13500,
    image: '{{ asset("images/ikan-tuna.png") }}',
    description: 'Iki iwak Tuna rasane enak banbget mantab aselole ahoy ahoy cihuy.',
    size: '10-15 cm',
    stock: 1500,
    rating: 4.5,
  },
  2: {
    name: 'Kakap Merah',
    category: 'Kakap',
    price: 13500,
    image: '{{ asset("images/ikan-kakap-merah.png") }}',
    description: 'Kakap merah segar dengan kualitas premium untuk berbagai olahan masakan.',
    size: '20-25 cm',
    stock: 800,
    rating: 4.7,
  },
  3: {
    name: 'Barracuda',
    category: 'Barracuda',
    price: 13500,
    image: '{{ asset("images/ikan-barracuda.png") }}',
    description: 'Barracuda segar hasil tangkapan terbaik dengan daging yang lezat.',
    size: '20-25 cm',
    stock: 600,
    rating: 4.3,
  },
  4: {
    name: 'Ogos',
    category: 'ogos',
    price: 13500,
    image: '{{ asset("images/ikan-ogos.png") }}',
    description: 'Ogos berkualitas tinggi untuk berbagai masakan.',
    size: '5-6',
    stock: 1200,
    rating: 4.6
  },
  5: {
    name: 'Kembung',
    category: 'kembung',
    price: 19500,
    image: '{{ asset("images/ikan-kembung.png") }}',
    description: 'Ikan kembung segar pilihan.',
    size: '10-15',
    stock: 900,
    rating: 4.4
  },
  6: {
    name: 'Tuna Sirip Kuning',
    category: 'layang',
    price: 13500,
    image: '{{ asset("images/ikan-layang.png") }}',
    description: 'Tuna sirip kuning premium quality.',
    size: '20-25',
    stock: 500,
    rating: 4.8
  }
};

// Get product ID from URL (in real app, this would be passed from Laravel)
function getCurrentProductId() {
  const path = window.location.pathname;
  const matches = path.match(/\/katalog\/(\d+)/);
  return matches ? matches[1] : '1';
}

// Load product data
function loadProductData() {
  const productId = getCurrentProductId();
  const product = productData[productId] || productData[1];
  
  document.getElementById('productName').textContent = product.name;
  document.getElementById('productCategory').textContent = `Kategori: ${product.category}`;
  document.getElementById('productPrice').textContent = `Rp${product.price.toLocaleString('id-ID')},00/Kg`;
  document.getElementById('productDescription').textContent = product.description;
  document.getElementById('productImage').src = product.image;
  document.getElementById('stockBadge').innerHTML = `
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
      <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
    </svg>
    Stok Tersedia: ${product.stock}kg
  `;
  
  // Update size and rating
  document.querySelector('.bg-gray-50:first-of-type p:last-child').textContent = product.size;
  document.querySelector('.flex.items-center.gap-1 span:last-child').textContent = `(${product.reviews} ulasan)`;
}

// Quantity controls
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

// Add to cart function
function addToCart() {
  const quantity = document.getElementById('quantity').value;
  const productName = document.getElementById('productName').textContent;
  
  alert(`Berhasil menambahkan ${quantity}kg ${productName} ke keranjang!\n\nCatatan: Fitur keranjang akan diimplementasikan pada tahap backend.`);
}

// Order now function
function orderNow() {
  const quantity = document.getElementById('quantity').value;
  const productName = document.getElementById('productName').textContent;
  
  if (confirm(`Pesan ${quantity}kg ${productName} sekarang?\n\nAnda akan diarahkan ke halaman checkout.`)) {
    alert('Fitur checkout akan diimplementasikan pada tahap backend.');
  }
}

// Load product data on page load
document.addEventListener('DOMContentLoaded', loadProductData);
</script>
@endsection