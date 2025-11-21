@extends('layouts.app')

@section('title', 'Gudang')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

  {{-- HEADER FILTER --}}
  <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">

      {{-- SEARCH --}}
      <div class="relative w-full sm:w-96">
        <input type="text" id="searchInput" placeholder="Cari gudang..." 
          class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-[#134686] focus:border-[#134686]">
        <svg class="absolute left-3 top-2.5 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>

      {{-- SORT --}}
      <div class="flex gap-2 flex-wrap">
        <button class="sort-btn active px-4 py-2 text-sm rounded-md bg-[#2c2c2c] text-white" data-sort="newest">
          Terbaru
        </button>
        <button class="sort-btn px-4 py-2 text-sm bg-gray-100 text-gray-500 hover:bg-gray-200" data-sort="lowest">
          Kapasitas Terendah
        </button>
        <button class="sort-btn px-4 py-2 text-sm bg-gray-100 text-gray-500 hover:bg-gray-200" data-sort="highest">
          Kapasitas Tertinggi
        </button>
      </div>

    </div>
  </div>

  {{-- RESULT COUNT --}}
  <p class="text-sm text-gray-600 mb-4">
    Menampilkan <span id="resultCount" class="font-semibold">{{ count($gudangs) }}</span> gudang
  </p>

  {{-- GRID --}}
  <div id="gudangGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-6">

  </div>

  {{-- NO RESULTS --}}
  <div id="noResults" class="hidden text-center py-12">
    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada gudang ditemukan</h3>
    <p class="text-gray-600">Coba ubah filter atau kata kunci pencarian.</p>
  </div>

</div>

{{-- JAVASCRIPT SEARCH + SORT --}}
<script>
const originalList = @json($gudangs);

function filterList() {
  const grid = document.getElementById('gudangGrid');
  const noResults = document.getElementById('noResults');
  const resultCount = document.getElementById('resultCount');
  const search = document.getElementById('searchInput').value.toLowerCase();

  let sorted = [...originalList];

  // search
  sorted = sorted.filter(g => g.nama_gudang.toLowerCase().includes(search));

  // render ulang
  grid.innerHTML = '';
  resultCount.textContent = sorted.length;

  if (sorted.length === 0) {
    noResults.classList.remove('hidden');
    return;
  }

  noResults.classList.add('hidden');

  sorted.forEach(g => {
    const img = g.gambar ? `/storage/${g.gambar}` : `/images/no-image.png`;

    grid.innerHTML += `
      <a href="/gudang/${g.id}" class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-[#134686] transform hover:-translate-y-2">
        <div class="relative overflow-hidden">
          <div class="aspect-w-16 aspect-h-12 bg-gradient-to-br from-gray-200 to-gray-300">
            <img src="${img}" alt="${g.nama_gudang}" 
              class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
          </div>
          <div class="absolute top-3 right-3">
            <span class="bg-white/90 backdrop-blur-sm text-[#134686] text-xs font-bold px-3 py-1 rounded-full">
              ${g.status_sewa}
            </span>
          </div>
        </div>
        
        <div class="p-5">
          <h3 class="font-bold text-lg text-gray-900 mb-3 group-hover:text-[#134686] transition-colors">${g.nama_gudang}</h3>
          
          <div class="space-y-2 mb-4">
            <div class="flex items-center gap-2 text-sm">
              <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
              <span class="text-gray-600">Kapasitas: <span class="font-semibold text-gray-900">${g.kapasitas_kg}</span></span>
            </div>
            <div class="flex items-center gap-2 text-sm">
              <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              </svg>
              <span class="text-gray-600">Lokasi: <span class="font-semibold text-gray-900">${g.lokasi}</span></span>
            </div>
          </div>
          
          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <span class="text-sm font-semibold text-[#134686]">Lihat Detail</span>
            <div class="w-8 h-8 bg-[#134686] rounded-full flex items-center justify-center group-hover:bg-yellow-400 transition-colors">
              <svg class="w-4 h-4 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
        </div>
      </a>
    `;
  });
}

filterList()

document.getElementById('searchInput').addEventListener('input', () => {
  filterList();
});
</script>

@endsection
