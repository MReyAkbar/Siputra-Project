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
    @foreach ($gudangs as $g)
      <a href="{{ route('gudang.detail', $g->id) }}" 
         class="block bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition shadow group">

        {{-- IMAGE --}}
        <div class="relative overflow-hidden">
          <img src="{{ $g->gambar ? asset('storage/'.$g->gambar) : asset('images/no-image.png') }}"
               class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

          {{-- BADGE STATUS --}}
          <span class="absolute top-3 right-3 px-3 py-1.5 text-xs font-semibold rounded-full text-white shadow-md
            {{ $g->status_sewa == 'tersedia' ? 'bg-emerald-500' : 'bg-red-500' }}">
            {{ $g->status_sewa == 'tersedia' ? 'Bisa Disewa' : 'Tidak Bisa Disewa' }}
          </span>
        </div>

        {{-- INFO --}}
        <div class="p-4">
          <p class="text-gray-600 text-sm mb-1">{{ $g->nama_gudang }}</p>
          <p class="font-semibold text-lg text-gray-900">{{ $g->lokasi }}</p>

          <div class="mt-2">
            <p class="text-sm text-gray-700">
              Kapasitas: <span class="font-semibold">{{ number_format($g->kapasitas_kg) }} kg</span>
            </p>
          </div>
        </div>
      </a>
    @endforeach
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
      <a href="/gudang/${g.id}" class="block bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition shadow group">
        <div class="relative overflow-hidden">
          <img src="${img}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">

          <span class="absolute top-3 right-3 px-3 py-1.5 text-xs font-semibold rounded-full text-white shadow-md
            ${g.status_sewa === 'tersedia' ? 'bg-emerald-500' : 'bg-red-500'}">
            ${g.status_sewa === 'tersedia' ? 'Bisa Disewa' : 'Tidak Bisa Disewa'}
          </span>
        </div>
        <div class="p-4">
          <p class="text-gray-600 text-sm mb-1">${g.nama_gudang}</p>
          <p class="font-semibold text-lg text-gray-900">${g.lokasi}</p>
          <p class="text-sm text-gray-700 mt-2">Kapasitas: <b>${Intl.NumberFormat().format(g.kapasitas_kg)} kg</b></p>
        </div>
      </a>
    `;
  });
}

document.getElementById('searchInput').addEventListener('input', () => {
  filterList();
});
</script>

@endsection
