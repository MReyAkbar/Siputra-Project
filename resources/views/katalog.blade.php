@extends('layouts.app')

@section('title', 'Katalog Produk - SIPUTRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  <!-- Cart Icon - Pojok Kanan Atas -->
  <div class="fixed top-30 right-6 z-50">
    <a href="/keranjang" id="cartIcon" 
      class="relative flex items-center justify-center w-14 h-14 bg-white text-[#134686] border-[3px] border-[#134686] rounded-full shadow-lg hover:bg-[#0d3566] hover:text-white transition-all transform hover:scale-110">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
      </svg>
      <span id="cartBadge" class="absolute -top-2 -right-2 flex items-center justify-center w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full opacity-0 transition-opacity">
        0
      </span>
    </a>
  </div>

  <div class="flex flex-col lg:flex-row gap-6">
    
    <!-- Sidebar Filter -->
    <aside class="w-full lg:w-72 flex-shrink-0">
      <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter</h2>

        <!-- Category Checkboxes -->
        <div id="activeKeywords" class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Kategori</h3>
          <div class="space-y-2">
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="tuna" class="category-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">Tuna</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="kakap" class="category-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">Kakap</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="barracuda" class="category-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">Barracuda</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="ogos" class="category-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">Ogos</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="kembung" class="category-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">Kembung</span>
            </label>
          </div>
        </div>

        <!-- Price Range -->
        <div class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Harga</h3>
          <div class="space-y-3">
            <div>
              <label class="text-xs text-gray-600">Minimum</label>
              <input type="number" id="minPrice" placeholder="Rp 0" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-[#134686] focus:border-[#134686]">
            </div>
            <div>
              <label class="text-xs text-gray-600">Maximum</label>
              <input type="number" id="maxPrice" placeholder="Rp 25000" 
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-[#134686] focus:border-[#134686]">
            </div>
          </div>
        </div>

        <!-- Size Filter -->
        <div class="mb-6">
          <h3 class="text-sm font-medium text-gray-700 mb-3">Ukuran (cm)</h3>
          <div class="space-y-2">
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="5-6" class="size-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">5-6 cm</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="10-15" class="size-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">10-15 cm</span>
            </label>
            <label class="flex items-center cursor-pointer">
              <input type="checkbox" value="20-25" class="size-filter w-4 h-4 text-[#134686] rounded focus:ring-[#134686]">
              <span class="ml-2 text-sm text-gray-600">20-25 cm</span>
            </label>
          </div>
        </div>

        <button id="clearFilters" class="w-full py-2 px-4 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
          Clear All Filters
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
      <!-- Search & Sort Bar -->
      <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
          <!-- Search Box -->
          <div class="relative w-full sm:w-96">
            <input type="text" id="searchInput" placeholder="Cari produk..." 
              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-[#134686] focus:border-[#134686]">
            <svg class="absolute left-3 top-2.5 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>

          <!-- Sort Options -->
          <div class="flex gap-2 flex-wrap">
            <button class="sort-btn active px-4 py-2 text-sm rounded-md bg-[#2c2c2c] text-white">
              Terbaru
            </button>
            <button class="sort-btn px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-500 hover:bg-gray-200">
              Harga Terendah
            </button>
            <button class="sort-btn px-4 py-2 text-sm font-medium rounded-md bg-gray-100 text-gray-500 hover:bg-gray-200">
              Harga Tertinggi
            </button>
          </div>
        </div>
      </div>

      <!-- Results Count -->
      <div class="mb-4">
        <p class="text-sm text-gray-600">
          Menampilkan <span id="resultCount" class="font-semibold">0</span> produk
        </p>
      </div>

      <!-- Product Grid -->
      <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Products akan ditambahkan via JavaScript -->
      </div>

      <!-- No Results Message -->
      <div id="noResults" class="hidden text-center py-12">
        <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
        <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian</p>
      </div>
    </main>
  </div>
</div>

<script>
// Sample product data
const products = [
  {
    id: 1,
    name: 'Tuna',
    category: 'tuna',
    price: 35000,
    image: 'images/ikan-tuna.png',
    description: 'Iki iwak Tuna rasane enak banbget mantab aselole ahoy ahoy cihuy.',
    size: '10-15',
    stock: 1500,
    rating: 4.5
  },
  {
    id: 2,
    name: 'Kakap Merah',
    category: 'kakap',
    price: 13500,
    image: 'images/ikan-kakap-merah.png',
    description: 'Kakap merah segar dengan kualitas premium.',
    size: '20-25',
    stock: 800,
    rating: 4.7
  },
  {
    id: 3,
    name: 'Barracuda',
    category: 'barracuda',
    price: 13500,
    image: 'images/ikan-barracuda.png',
    description: 'Barracuda segar hasil tangkapan terbaik.',
    size: '20-25',
    stock: 600,
    rating: 4.3
  },
  {
    id: 4,
    name: 'Ogos',
    category: 'ogos',
    price: 13500,
    image: 'images/ikan-ogos.png',
    description: 'Ogos berkualitas tinggi untuk berbagai masakan.',
    size: '5-6',
    stock: 1200,
    rating: 4.6
  },
  {
    id: 5,
    name: 'Kembung',
    category: 'kembung',
    price: 19500,
    image: 'images/ikan-kembung.png',
    description: 'Ikan kembung segar pilihan.',
    size: '10-15',
    stock: 900,
    rating: 4.4
  },
  {
    id: 6,
    name: 'Tuna Sirip Kuning',
    category: 'layang',
    price: 13500,
    image: 'images/ikan-layang.png',
    description: 'Tuna sirip kuning premium quality.',
    size: '20-25',
    stock: 500,
    rating: 4.8
  }
];

let filteredProducts = [...products];

// Render products
function renderProducts(productsToRender) {
  const grid = document.getElementById('productGrid');
  const noResults = document.getElementById('noResults');
  const resultCount = document.getElementById('resultCount');
  
  grid.innerHTML = '';
  resultCount.textContent = productsToRender.length;
  
  if (productsToRender.length === 0) {
    noResults.classList.remove('hidden');
    grid.classList.add('hidden');
    return;
  }
  
  noResults.classList.add('hidden');
  grid.classList.remove('hidden');
  
  productsToRender.forEach(product => {
    const card = document.createElement('a');
    card.href = `/katalog/${product.id}`;
    card.className = 'bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group';
    card.innerHTML = `
      <div class="aspect-w-16 aspect-h-12 bg-gray-200">
        <img src="${product.image}" alt="${product.name}" 
          class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
          onerror="this.src='https://via.placeholder.com/400x300?text=${product.name}'">
      </div>
      <div class="p-4">
        <h3 class="font-semibold text-lg text-gray-900 mb-1">${product.name}</h3>
        <p class="text-sm text-gray-500 mb-2 capitalize">${product.category}</p>
        <p class="text-[#134686] font-semibold text-lg">Rp${product.price.toLocaleString('id-ID')}/Kg</p>
      </div>
    `;
    grid.appendChild(card);
  });
}

// Filter function
function applyFilters() {
  const searchTerm = document.getElementById('searchInput').value.toLowerCase();
  const minPrice = parseFloat(document.getElementById('minPrice').value) || 0;
  const maxPrice = parseFloat(document.getElementById('maxPrice').value) || Infinity;
  
  const selectedCategories = Array.from(document.querySelectorAll('.category-filter:checked'))
    .map(cb => cb.value);
  const selectedSizes = Array.from(document.querySelectorAll('.size-filter:checked'))
    .map(cb => cb.value);
  
  filteredProducts = products.filter(product => {
    const matchesSearch = product.name.toLowerCase().includes(searchTerm) || 
                         product.category.toLowerCase().includes(searchTerm);
    const matchesPrice = product.price >= minPrice && product.price <= maxPrice;
    const matchesCategory = selectedCategories.length === 0 || 
                           selectedCategories.includes(product.category);
    const matchesSize = selectedSizes.length === 0 || 
                       selectedSizes.includes(product.size);
    
    return matchesSearch && matchesPrice && matchesCategory && matchesSize;
  });
  
  updateActiveKeywords();
  renderProducts(filteredProducts);
}

// Update active keywords display
function updateActiveKeywords() {
  const container = document.getElementById('activeKeywords');
  const keywords = [];
  
  document.querySelectorAll('.category-filter:checked').forEach(cb => {
    keywords.push({ text: cb.nextElementSibling.textContent, type: 'category', value: cb.value });
  });
  
  document.querySelectorAll('.size-filter:checked').forEach(cb => {
    keywords.push({ text: cb.nextElementSibling.textContent, type: 'size', value: cb.value });
  });
}

// Clear all filters
document.getElementById('clearFilters').addEventListener('click', () => {
  document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
  document.getElementById('searchInput').value = '';
  document.getElementById('minPrice').value = '';
  document.getElementById('maxPrice').value = '';
  applyFilters();
});

// Real-time search
document.getElementById('searchInput').addEventListener('input', applyFilters);

// Filter change listeners
document.querySelectorAll('.category-filter, .size-filter').forEach(cb => {
  cb.addEventListener('change', applyFilters);
});

document.getElementById('minPrice').addEventListener('input', applyFilters);
document.getElementById('maxPrice').addEventListener('input', applyFilters);

// JavaScript untuk Sort Button
document.querySelectorAll('.sort-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.sort-btn').forEach(b => {
      b.classList.remove('active', 'bg-[#2c2c2c]', 'text-white');
      b.classList.add('bg-gray-100', 'text-gray-500', 'font-medium', 'hover:bg-gray-200');
    });
    this.classList.add('active', 'bg-[#2c2c2c]', 'text-white');
    this.classList.remove('bg-gray-100', 'text-gray-500', 'font-medium', 'hover:bg-gray-200');
  });
});

// Initial render
renderProducts(filteredProducts);
</script>
@endsection