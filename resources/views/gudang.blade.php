@extends('layouts.app')

@section('title', 'Gudang')

@section('content')
<div class="bg-gray-50 min-h-screen" x-data="gudangApp()">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <nav class="flex mb-6" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
          <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#134686]">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
            </svg>
            Beranda
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="ml-1 text-sm font-medium text-[#134686] md:ml-2">Katalog Gudang</span>
          </div>
        </li>
      </ol>
    </nav>


    <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
      <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div class="relative">
          <input type="text" x-model="filters.search" @input="applyFilters()" 
            placeholder="Cari nama gudang..." 
            class="w-full sm:w-96 pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
          <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>

        <button @click="mobileFilterOpen = true" class="lg:hidden w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#134686] text-white rounded-xl font-medium hover:bg-[#0C3C65] transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
          </svg>
          <span>Filter</span>
          <span x-show="activeFiltersCount > 0" class="bg-yellow-400 text-[#134686] text-xs font-bold px-2 py-0.5 rounded-full" x-text="activeFiltersCount"></span>
        </button>

        <div class="flex items-center gap-3 w-full sm:w-auto">
          <div class="hidden sm:flex items-center bg-gray-100 rounded-lg p-1">
            <button @click="viewMode = 'grid'" :class="viewMode === 'grid' ? 'bg-white shadow-sm' : ''" 
              class="p-2 rounded-md transition-all">
              <svg class="w-5 h-5" :class="viewMode === 'grid' ? 'text-[#134686]' : 'text-gray-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
              </svg>
            </button>
            <button @click="viewMode = 'list'" :class="viewMode === 'list' ? 'bg-white shadow-sm' : ''" 
              class="p-2 rounded-md transition-all">
              <svg class="w-5 h-5" :class="viewMode === 'list' ? 'text-[#134686]' : 'text-gray-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
            </button>
          </div>

          <div class="relative flex-1 sm:flex-initial" x-data="{ sortOpen: false }">
            <button @click="sortOpen = !sortOpen" class="w-full sm:w-auto inline-flex items-center justify-between gap-3 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium transition-all">
              <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                </svg>
                <span x-text="sortLabel"></span>
              </span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>

            <div x-show="sortOpen" @click.away="sortOpen = false"
                  x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="opacity-0 scale-95"
                  x-transition:enter-end="opacity-100 scale-100"
                  class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl z-10 border border-gray-200 overflow-hidden">
              <button @click="sortBy('newest'); sortOpen = false" 
                class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700">Terbaru</span>
                <svg x-show="filters.sort === 'newest'" class="w-4 h-4 text-[#134686]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </button>
              </button>
              <button @click="sortBy('price-low'); sortOpen = false" 
                class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors flex items-center justify-between border-t border-gray-100">
                <span class="text-sm font-medium text-gray-700">Kapasitas Terendah</span>
                <svg x-show="filters.sort === 'price-low'" class="w-4 h-4 text-[#134686]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </button>
              <button @click="sortBy('price-high'); sortOpen = false" 
                class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors flex items-center justify-between border-t border-gray-100">
                <span class="text-sm font-medium text-gray-700">Kapasitas Tertinggi</span>
                <svg x-show="filters.sort === 'price-high'" class="w-4 h-4 text-[#134686]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-4 pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">
          Menampilkan <span class="font-bold text-[#134686]" x-text="filteredProducts.length"></span> dari 
          <span class="font-semibold" x-text="allGudang.length"></span> gudang
        </p>
      </div>
    </div>

    <div x-show="loading" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <template x-for="i in 6" :key="i">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden animate-pulse">
          <div class="h-48 bg-gray-300"></div>
          <div class="p-4 space-y-3">
            <div class="h-4 bg-gray-300 rounded w-3/4"></div>
            <div class="h-3 bg-gray-200 rounded w-1/2"></div>
            <div class="h-5 bg-gray-300 rounded w-1/3"></div>
            <div class="h-3 bg-gray-200 rounded w-2/3"></div>
          </div>
        </div>
      </template>
    </div>

    <div x-show="!loading && filteredProducts.length > 0">
      <div  x-show="viewMode === 'grid'" 
            class="grid grid-cols-1 sm:grid-cols-2 gap-6"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">
        <template x-for="(product, index) in filteredProducts" :key="product.id">
          <div  x-data="{ hover: false }" 
                @mouseenter="hover = true" 
                @mouseleave="hover = false"
                class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                :style="`transition-delay: ${index * 50}ms`">

              <div class="relative overflow-hidden bg-gray-200">
                <div class="absolute top-4 right-4 z-10">
                  <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all" :class="{
                    'bg-green-500 text-white': product.status_sewa === 'tersedia',
                    'bg-red-500 text-white': product.status_sewa === 'disewa' || product.status_sewa === 'tidak_tersedia',
                    'bg-yellow-500 text-white': !['tersedia', 'disewa', 'tidak_tersedia'].includes(product.status_sewa)
                  }"
                  x-text="
                    product.status_sewa === 'tersedia' ? 'Tersedia' :
                    product.status_sewa === 'disewa' ? 'Disewa' :
                    product.status_sewa === 'tidak_tersedia' ? 'Tidak Tersedia' :
                    product.status_sewa.replace(/_/g, ' ')
                  "></span>
                </div>

                <a :href="`/gudang/${product.id}`">
                  <img :src="`/storage/${product.gambar}`" :alt="product.nama_gudang" 
                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                        onerror="this.src='/images/default-ikan.png'">
                </a>
              </div>

              <div class="p-5">
                <a :href="`/gudang/${product.id}`" class="block">
                  <h3 class="font-bold text-lg text-gray-900 mb-2 hover:text-[#134686] line-clamp-2" 
                      x-text="product.nama_gudang"></h3>
                </a>

                <div class="space-y-2 mb-4">
                  <div class="flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="text-gray-600">Kapasitas: <span class="font-semibold text-gray-900" x-text="product.kapasitas_kg"></span></span>
                  </div>
                  <div class="flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span class="text-gray-600">Lokasi: <span class="font-semibold text-gray-900" x-text="product.lokasi"></span></span>
                  </div>
                </div>

                <a :href="`/gudang/${product.id}`" class="flex items-center justify-between pt-3 border-t border-gray-100">
                  <span class="text-sm font-semibold text-[#134686]">Detail Produk</span>
                  <div class="w-8 h-8 bg-[#134686] rounded-full flex items-center justify-center group-hover:bg-yellow-400 transition-colors">
                    <svg class="w-4 h-4 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </template>
      </div>

      <div x-show="viewMode === 'list'" 
            class="space-y-4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">
        <template x-for="(product, index) in filteredProducts" :key="product.id">
          <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                :style="`transition-delay: ${index * 50}ms`">
            <div class="flex flex-col sm:flex-row">
              
              <div class="relative sm:w-64 flex-shrink-0">
                <div class="absolute top-3 left-3 z-10">
                  <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all" :class="{
                    'bg-green-500 text-white': product.status_sewa === 'tersedia',
                    'bg-red-500 text-white': product.status_sewa === 'disewa' || product.status_sewa === 'tidak_tersedia',
                    'bg-yellow-500 text-white': !['tersedia', 'disewa', 'tidak_tersedia'].includes(product.status_sewa)
                  }"
                  x-text="
                    product.status_sewa === 'tersedia' ? 'Tersedia' :
                    product.status_sewa === 'disewa' ? 'Disewa' :
                    product.status_sewa === 'tidak_tersedia' ? 'Tidak Tersedia' :
                    product.status_sewa.replace(/_/g, ' ')
                  "></span>
                </div>
                <a :href="`/gudang/${product.id}`">
                  <img :src="`/storage/${product.gambar}`" :alt="product.nama_gudng" 
                        class="w-full h-48 sm:h-full object-cover"
                        onerror="this.src='/images/default-ikan.png'">
                </a>
              </div>

              <div class="flex-1 p-6">
                <div class="flex flex-col h-full">
                  <div class="flex-1">
                    <a :href="`/gudang/${product.id}`">
                      <h3 class="font-bold text-xl text-gray-900 mb-2 hover:text-[#134686] transition-colors" x-text="product.nama_gudang"></h3>
                    </a>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="product.deskripsi"></p>

                    <div class="space-y-2 mb-4">
                      <div class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span class="text-gray-600">Kapasitas: <span class="font-semibold text-gray-900" x-text="product.kapasitas_kg"></span></span>
                      </div>
                      <div class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span class="text-gray-600">Lokasi: <span class="font-semibold text-gray-900" x-text="product.lokasi"></span></span>
                      </div>
                    </div>
                  </div>

                  <a :href="`/gudang/${product.id}`" class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <span class="text-sm font-semibold text-[#134686]">Detail Produk</span>
                    <div class="w-8 h-8 bg-[#134686] rounded-full flex items-center justify-center group-hover:bg-yellow-400 transition-colors">
                      <svg class="w-4 h-4 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                      </svg>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>

    <div  x-show="!loading && filteredProducts.length === 0" 
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          class="bg-white rounded-2xl shadow-lg p-12 text-center">
      <div class="max-w-md mx-auto">
        <div class="mb-6">
          <svg class="mx-auto w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Gudang Ditemukan</h3>
        <p class="text-gray-600 mb-6">Maaf, kami tidak dapat menemukan gudang yang sesuai dengan pencarian Anda. Coba ubah kriteria pencarian.</p>
      </div>
    </div>
  </div>
</div>

<script>
function gudangApp() {
  return {
    allGudang: @json($gudangs),
    filteredProducts: [],
    loading: true,
    mobileFilterOpen: false,
    viewMode: 'grid',

    filters: {
      search: '',
      sort: 'newest'
    },

    get activeFiltersCount() {
      let count = 0;
      if (this.filters.search) count++;
      return count;
    },

    get activeFiltersTags() {
      if (this.filters.search) {
        tags.push({ type: 'search', value: 'search', text: `"${this.filters.search}"` });
      }

      return tags;
    },

    get sortLabel() {
      const labels = {
        'newest': 'Terbaru',
        'capacity-low': 'Kapasitas Terendah',
        'capacity-high': 'Kapasitas Tertinggi'
      };
      return labels[this.filters.sort] || 'Urutkan';
    },

    init() {
      setTimeout(() => {
        this.filteredProducts = [...this.allGudang];
        this.loading = false;
      }, 800);
    },

    applyFilters() {
      let result = [...this.allGudang];

      if (this.filters.search.trim()) {
        const term = this.filters.search.toLowerCase();
        result = result.filter(g => 
          g.nama_gudang.toLowerCase().includes(term) ||
          g.lokasi.toLowerCase().includes(term) ||
          (g.deskripsi && g.deskripsi.toLowerCase().includes(term))
        );
      }

      // Sorting
      result.sort((a, b) => {
        switch (this.filters.sort) {
          case 'capacity-low':
            return a.kapasitas_kg - b.kapasitas_kg;
          case 'capacity-high':
            return b.kapasitas_kg - a.kapasitas_kg;
          case 'newest':
          default:
            return b.id - a.id;
        }
      });

      this.filteredProducts = result;
    },

    sortBy(type) {
      this.filters.sort = type;
      this.applyFilters();
    },

    formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', { 
        style: 'currency', 
        currency: 'IDR', 
        minimumFractionDigits: 0 
      }).format(angka);
    },
  }
}
</script>

@endsection
