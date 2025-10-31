@extends('layouts.app')

@section('title', 'Gudang')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
  <div id="gudangGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
  </div>

  <!-- No Results Message -->
  <div id="noResults" class="hidden text-center py-12">
    <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
    <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian</p>
  </div>
</div>

<script>
const products = [
  {
    id: 1,
    nama: 'Gudang 1',
    alamat: 'Sidoarjo',
    gambar: '{{ asset("images/gudang-1.png") }}',
    harga: 2000000,
    kapasitas: '5000kg',
    status: 'Bisa Disewa'
  },
  {
    id: 2,
    nama: 'Gudang 2',
    alamat: 'Sidoarjo',
    gambar: '{{ asset("images/gudang-2.png") }}',
    harga: 4000000,
    kapasitas: '1000kg',
    status: 'Tidak Bisa Disewa'
  }
];

function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
}

function formatKapasitas(kg) {
  const num = kg.replace(/[^0-9]/g, '');
  return `${num.replace(/\B(?=(\d{3})+(?!\d))/g, ".")} kg`;
}

function renderGudang(gudangToRender) {
  const grid = document.getElementById('gudangGrid');
  const noResults = document.getElementById('noResults');
  const resultCount = document.getElementById('resultCount');
  
  grid.innerHTML = '';
  resultCount.textContent = gudangToRender.length;
  
  if (gudangToRender.length === 0) {
    noResults.classList.remove('hidden');
    grid.classList.add('hidden');
    return;
  }
  
  noResults.classList.add('hidden');
  grid.classList.remove('hidden');
  
  gudangToRender.forEach(gudang => {
    const card = document.createElement('a');
    card.href = `/gudang/${gudang.id}`;
    card.className = 'block relative bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group';
    
    card.innerHTML = `
      <div class="relative aspect-w-16 aspect-h-9 bg-gray-200 overflow-hidden">
        <img src="${gudang.gambar}" alt="${gudang.nama}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
             onerror="this.src='https://via.placeholder.com/400x300?text=${encodeURIComponent(gudang.nama)}'">

        <div class="absolute top-3 right-3 z-10">
          <span class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-full shadow-md
            ${gudang.status === 'Bisa Disewa' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              ${gudang.status === 'Bisa Disewa' 
                ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' 
                : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
            </svg>
            ${gudang.status}
          </span>
        </div>
      </div>

      <div class="p-4">
        <p class="text-gray-500 text-sm mb-1">${gudang.nama}</p>
        <p class="font-semibold text-lg text-gray-900">${gudang.alamat}</p>
        
        <div class="mt-3">
          <div>
            <p class="text-xl font-bold text-[#134686]">${formatRupiah(gudang.harga)} <span class="text-sm text-gray-500">/ bulan</span></p>
            <p class="text-sm text-gray-600">Kapasitas: ${formatKapasitas(gudang.kapasitas)}</p>
          </div>
        </div>
      </div>
    `;
    grid.appendChild(card);
  });
}

function searchBox() {
  const searchTerm = document.getElementById('searchInput').value.toLowerCase();

  const filteredProducts = products.filter(gudang => {
    const matchesSearch = gudang.nama.toLowerCase().includes(searchTerm);

    return matchesSearch;
  })

  renderGudang(filteredProducts);
}

// Event Listeners
let searchTimeout;
document.getElementById('searchInput').addEventListener('input', () => {
  clearTimeout(searchTimeout);
  searchTimeout = setTimeout(searchBox, 300);
});

document.querySelectorAll('.sort-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.sort-btn').forEach(b => {
      b.classList.remove('active', 'bg-[#2c2c2c]', 'text-white');
      b.classList.add('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200');
    });
    this.classList.add('active', 'bg-[#2c2c2c]', 'text-white');
    this.classList.remove('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200');
  });
});

// Initial render
renderGudang(products);
</script>
@endsection