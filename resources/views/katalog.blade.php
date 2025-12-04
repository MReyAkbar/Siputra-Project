@extends('layouts.app')

@section('title', 'Katalog Produk - SIPUTRA')

@section('content')
<div class="bg-gray-50 min-h-screen" x-data="catalogApp()">
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
            <span class="ml-1 text-sm font-medium text-[#134686] md:ml-2">Katalog Ikan</span>
          </div>
        </li>
      </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-6">
      <aside class="hidden lg:block w-80 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#134686] flex items-center gap-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
              </svg>
              Filter Produk
            </h2>
            <button @click="clearFilters()" class="text-sm text-red-500 hover:text-red-700 font-medium">
              Reset
            </button>
          </div>

          <div x-show="activeFiltersCount > 0" class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <span class="text-sm font-medium text-gray-700">Filter Aktif</span>
              <span class="text-xs bg-[#134686] text-white px-2 py-1 rounded-full" x-text="activeFiltersCount"></span>
            </div>
            <div class="flex flex-wrap gap-2">
              <template x-for="filter in activeFilterTags" :key="filter.value">
                <button @click="removeFilter(filter)" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium hover:bg-blue-200 transition-colors">
                  <span x-text="filter.text"></span>
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </template>
            </div>
          </div>

          <div class="mb-6">
            <label class="text-sm font-semibold text-gray-700 mb-2 block">Cari Produk</label>
            <div class="relative">
              <input type="text" x-model="filters.search" @input="applyFilters()" 
                placeholder="Cari nama ikan..." 
                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#134686] focus:border-[#134686] transition-all">
              <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
          </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
              <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
              </svg>
              Kategori
            </h3>
            <div class="space-y-2.5">
              <template x-for="category in categories" :key="category">
                <label class="flex items-center cursor-pointer group">
                  <input type="checkbox" :value="category" x-model="filters.categories" @change="applyFilters()"
                    class="w-4 h-4 text-[#134686] border-gray-300 rounded focus:ring-[#134686]">
                  <span class="ml-3 text-sm text-gray-700 group-hover:text-[#134686] transition-colors" x-text="category"></span>
                </label>
              </template>
            </div>
          </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
              <svg class="w-4 h-4 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Rentang Harga
            </h3>
            <div class="space-y-3">
              <div>
                <label class="text-xs text-gray-600 mb-1 block">Minimum</label>
                <input type="number" x-model="filters.minPrice" @input="applyFilters()" 
                  placeholder="Rp 0" 
                  class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
              </div>
              <div>
                <label class="text-xs text-gray-600 mb-1 block">Maximum</label>
                <input type="number" x-model="filters.maxPrice" @input="applyFilters()" 
                  placeholder="Rp 100000" 
                  class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
              </div>
            </div>
          </div>

          <button @click="clearFilters()" class="w-full py-3 px-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-xl text-sm font-semibold hover:from-gray-200 hover:to-gray-300 transition-all shadow-sm">
            <span class="flex items-center justify-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
              Reset Semua Filter
            </span>
          </button>
        </div>
      </aside>

      <div x-show="mobileFilterOpen" 
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           class="fixed inset-0 bg-black bg-opacity-50 z-50 lg:hidden"
           @click="mobileFilterOpen = false">
      </div>

      <div x-show="mobileFilterOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed left-0 top-0 bottom-0 w-80 bg-white z-50 shadow-2xl overflow-y-auto lg:hidden"
           @click.stop>
        
        <div class="p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#134686] flex items-center gap-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
              </svg>
              Filter Produk
            </h2>
            <button @click="mobileFilterOpen = false" class="text-gray-500 hover:text-gray-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>

          <div x-show="activeFiltersCount > 0" class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex items-center justify-between mb-3">
              <span class="text-sm font-medium text-gray-700">Filter Aktif</span>
              <span class="text-xs bg-[#134686] text-white px-2 py-1 rounded-full" x-text="activeFiltersCount"></span>
            </div>
            <div class="flex flex-wrap gap-2">
              <template x-for="filter in activeFilterTags" :key="filter.value">
                <button @click="removeFilter(filter)" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                  <span x-text="filter.text"></span>
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </template>
            </div>
          </div>

          <div class="mb-6">
            <label class="text-sm font-semibold text-gray-700 mb-2 block">Cari Produk</label>
            <div class="relative">
              <input type="text" x-model="filters.search" @input="applyFilters()" 
                placeholder="Cari nama ikan..." 
                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
              <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
          </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Kategori</h3>
            <div class="space-y-2.5">
              <template x-for="category in categories" :key="category">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" :value="category" x-model="filters.categories" @change="applyFilters()"
                    class="w-4 h-4 text-[#134686] border-gray-300 rounded focus:ring-[#134686]">
                  <span class="ml-3 text-sm text-gray-700" x-text="category"></span>
                </label>
              </template>
            </div>
          </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Rentang Harga</h3>
            <div class="space-y-3">
              <div>
                <label class="text-xs text-gray-600 mb-1 block">Minimum</label>
                <input type="number" x-model="filters.minPrice" @input="applyFilters()" 
                  placeholder="Rp 0" 
                  class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
              </div>
              <div>
                <label class="text-xs text-gray-600 mb-1 block">Maximum</label>
                <input type="number" x-model="filters.maxPrice" @input="applyFilters()" 
                  placeholder="Rp 100000" 
                  class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#134686] focus:border-[#134686]">
              </div>
            </div>
          </div>

          <div class="sticky bottom-0 bg-white pt-4 border-t border-gray-200 space-y-2">
            <button @click="clearFilters()" class="w-full py-3 px-4 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-all">
              Reset Filter
            </button>
            <button @click="mobileFilterOpen = false" class="w-full py-3 px-4 bg-[#134686] text-white rounded-xl text-sm font-semibold hover:bg-[#0C3C65] transition-all">
              Terapkan Filter
            </button>
          </div>
        </div>
      </div>

      <main class="flex-1 min-w-0">
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
          <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">

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
                    <span class="text-sm font-medium text-gray-700">Harga Terendah</span>
                    <svg x-show="filters.sort === 'price-low'" class="w-4 h-4 text-[#134686]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                  </button>
                  <button @click="sortBy('price-high'); sortOpen = false" 
                    class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors flex items-center justify-between border-t border-gray-100">
                    <span class="text-sm font-medium text-gray-700">Harga Tertinggi</span>
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
              <span class="font-semibold" x-text="allProducts.length"></span> produk
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
          <div x-show="viewMode === 'grid'" 
               class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0"
               x-transition:enter-end="opacity-100">
            <template x-for="(product, index) in filteredProducts" :key="product.id">
              <div x-data="{ hover: false }" 
                   @mouseenter="hover = true" 
                   @mouseleave="hover = false"
                   class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 translate-y-4"
                   x-transition:enter-end="opacity-100 translate-y-0"
                   :style="`transition-delay: ${index * 50}ms`">

                <div class="relative overflow-hidden bg-gray-200">
                  <div class="absolute top-3 left-3 z-10">
                    <span :class="product.stok > 100 ? 'bg-green-500' : product.stok > 50 ? 'bg-yellow-500' : product.stok == 0 ? 'bg-red-500' : 'bg-orange-500'" 
                          class="text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                      <span x-show="product.stok > 100">Stok Banyak</span>
                      <span x-show="product.stok <= 100 && product.stok > 50">Stok Terbatas</span>
                      <span x-show="product.stok <= 50 && product.stok > 0">Stok Sedikit</span>
                      <span x-show="product.stok == 0">Produk Tidak Tersedia</span>
                    </span>
                  </div>

                  <div x-show="hover" 
                       x-transition:enter="transition ease-out duration-200"
                       x-transition:enter-start="opacity-0"
                       x-transition:enter-end="opacity-100"
                       class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center z-10">
                    <a :href="`/katalog/${product.id}`" 
                       class="px-6 py-3 bg-white text-[#134686] rounded-xl font-semibold hover:bg-yellow-400 hover:text-[#134686] transition-all transform hover:scale-110 shadow-xl">
                      Lihat Detail
                    </a>
                  </div>

                  <a :href="`/katalog/${product.id}`">
                    <img :src="product.gambar" :alt="product.nama" 
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='/images/default-ikan.png'">
                  </a>
                </div>

                <div class="p-5">
                  <a :href="`/katalog/${product.id}`" class="block">
                    <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-[#134686] transition-colors line-clamp-1" x-text="product.nama"></h3>
                  </a>
                  
                  <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-medium">
                      <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                      </svg>
                      <span x-text="product.kategori"></span>
                    </span>
                  </div>

                  <div class="flex items-baseline gap-2 mb-3">
                    <p class="text-2xl font-bold text-[#134686]" x-text="formatRupiah(product.harga)"></p>
                    <span class="text-sm text-gray-500">/ kg</span>
                  </div>

                  <div class="flex items-center gap-2 text-sm text-gray-600 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Stok: <span class="font-semibold" x-text="product.stok"></span> kg</span>
                  </div>

                  <div class="flex gap-2">
                    <a :href="`/katalog/${product.id}`" 
                      class="flex-1 py-2.5 px-4 bg-[#134686] text-white rounded-xl text-sm font-semibold hover:bg-[#0C3C65] transition-all text-center">
                      Detail Produk
                    </a>
                    
                    @auth
                    <button @click="addToCart(product)" class="px-4 py-2.5 bg-yellow-400 text-[#134686] rounded-xl hover:bg-yellow-500 transition-all flex items-center justify-center group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </button>
                    @endauth
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
              <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 translate-x-4"
                   x-transition:enter-end="opacity-100 translate-x-0"
                   :style="`transition-delay: ${index * 50}ms`">
                <div class="flex flex-col sm:flex-row">
                  <div class="relative sm:w-64 flex-shrink-0">
                    <div class="absolute top-3 left-3 z-10">
                      <span :class="product.stok > 100 ? 'bg-green-500' : product.stok > 50 ? 'bg-yellow-500' : 'bg-red-500'" 
                            class="text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        <span x-show="product.stok > 100">Stok Banyak</span>
                        <span x-show="product.stok <= 100 && product.stok > 50">Stok Terbatas</span>
                        <span x-show="product.stok <= 50">Stok Sedikit</span>
                      </span>
                    </div>
                    <a :href="`/katalog/${product.id}`">
                      <img :src="product.gambar" :alt="product.nama" 
                           class="w-full h-48 sm:h-full object-cover"
                           onerror="this.src='/images/default-ikan.png'">
                    </a>
                  </div>

                  <div class="flex-1 p-6">
                    <div class="flex flex-col h-full">
                      <div class="flex-1">
                        <a :href="`/katalog/${product.id}`">
                          <h3 class="font-bold text-xl text-gray-900 mb-2 hover:text-[#134686] transition-colors" x-text="product.nama"></h3>
                        </a>
                        
                        <div class="flex items-center gap-2 mb-3">
                          <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm font-medium">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span x-text="product.kategori"></span>
                          </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="product.deskripsi"></p>

                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                          <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span>Stok: <span class="font-semibold" x-text="product.stok"></span> kg</span>
                          </div>
                        </div>
                      </div>

                      <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div>
                          <p class="text-3xl font-bold text-[#134686]" x-text="formatRupiah(product.harga)"></p>
                          <p class="text-sm text-gray-500">per kilogram</p>
                        </div>
                        
                        <div class="flex gap-2">
                          <a :href="`/katalog/${product.id}`" 
                            class="px-6 py-3 bg-[#134686] text-white rounded-xl text-sm font-semibold hover:bg-[#0C3C65] transition-all">
                            Detail Produk
                          </a>
                          
                          @auth
                          <button @click="addToCart(product)" 
                                  class="px-4 py-3 bg-yellow-400 text-[#134686] rounded-xl hover:bg-yellow-500 transition-all flex items-center justify-center group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                          </button>
                          @endauth
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </template>
          </div>
        </div>

        <div x-show="!loading && filteredProducts.length === 0" 
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
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Tidak Ada Produk Ditemukan</h3>
            <p class="text-gray-600 mb-6">Maaf, kami tidak dapat menemukan produk yang sesuai dengan filter Anda. Coba ubah kriteria pencarian atau reset filter.</p>
            <button @click="clearFilters()" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-[#134686] text-white rounded-xl font-semibold hover:bg-[#0C3C65] transition-all shadow-lg">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
              Reset Semua Filter
            </button>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>

<script>
function catalogApp() {
  return {
    allProducts: @json($items).map(item => ({
      id: item.id,
      nama: item.ikan.nama,
      kategori: item.ikan.kategori?.nama_kategori || 'Tidak diketahui',
      harga: item.harga_jual,
      gambar: item.gambar ? `/storage/${item.gambar}` : `/images/default-ikan.png`,
      deskripsi: item.deskripsi || 'Produk ikan segar berkualitas tinggi',
      stok: parseFloat(item.ikan.jumlah_stok) || 0
    })),
    
    filteredProducts: [],
    loading: true,
    mobileFilterOpen: false,
    viewMode: 'grid',
    
    filters: {
      search: '',
      categories: [],
      sizes: [],
      minPrice: '',
      maxPrice: '',
      sort: 'newest'
    },

    categories: [],
    sizes: ['5-6', '10-15', '20-25'],
    
    get activeFiltersCount() {
      let count = 0;
      if (this.filters.search) count++;
      count += this.filters.categories.length;
      count += this.filters.sizes.length;
      if (this.filters.minPrice) count++;
      if (this.filters.maxPrice) count++;
      return count;
    },
    
    get activeFilterTags() {
      const tags = [];
      
      if (this.filters.search) {
        tags.push({ type: 'search', value: 'search', text: `"${this.filters.search}"` });
      }
      
      this.filters.categories.forEach(cat => {
        tags.push({ type: 'category', value: cat, text: cat });
      });
      
      this.filters.sizes.forEach(size => {
        tags.push({ type: 'size', value: size, text: `${size} cm` });
      });
      
      if (this.filters.minPrice) {
        tags.push({ type: 'minPrice', value: 'minPrice', text: `Min: ${this.formatRupiah(this.filters.minPrice)}` });
      }
      
      if (this.filters.maxPrice) {
        tags.push({ type: 'maxPrice', value: 'maxPrice', text: `Max: ${this.formatRupiah(this.filters.maxPrice)}` });
      }
      
      return tags;
    },
    
    get sortLabel() {
      const labels = {
        'newest': 'Terbaru',
        'price-low': 'Harga Terendah',
        'price-high': 'Harga Tertinggi'
      };
      return labels[this.filters.sort] || 'Urutkan';
    },
    
    init() {
      this.categories = [...new Set(this.allProducts.map(p => p.kategori))].filter(c => c !== 'Tidak diketahui');
      
      setTimeout(() => {
        this.loading = false;
        this.applyFilters();
      }, 800);
    },
    
    applyFilters() {
      let products = [...this.allProducts];
      
      if (this.filters.search) {
        const search = this.filters.search.toLowerCase();
        products = products.filter(p => 
          p.nama.toLowerCase().includes(search) || 
          p.kategori.toLowerCase().includes(search)
        );
      }
      
      if (this.filters.categories.length > 0) {
        products = products.filter(p => this.filters.categories.includes(p.kategori));
      }
      
      const minPrice = parseFloat(this.filters.minPrice) || 0;
      const maxPrice = parseFloat(this.filters.maxPrice) || Infinity;
      products = products.filter(p => p.harga >= minPrice && p.harga <= maxPrice);

      this.sortProducts(products);
      
      this.filteredProducts = products;
    },
    
    sortProducts(products) {
      switch(this.filters.sort) {
        case 'price-low':
          products.sort((a, b) => a.harga - b.harga);
          break;
        case 'price-high':
          products.sort((a, b) => b.harga - a.harga);
          break;
        case 'newest':
        default:
          products.sort((a, b) => b.id - a.id);
          break;
      }
    },
    
    sortBy(type) {
      this.filters.sort = type;
      this.applyFilters();
    },
    
    removeFilter(filter) {
      switch(filter.type) {
        case 'search':
          this.filters.search = '';
          break;
        case 'category':
          this.filters.categories = this.filters.categories.filter(c => c !== filter.value);
          break;
        case 'size':
          this.filters.sizes = this.filters.sizes.filter(s => s !== filter.value);
          break;
        case 'minPrice':
          this.filters.minPrice = '';
          break;
        case 'maxPrice':
          this.filters.maxPrice = '';
          break;
      }
      this.applyFilters();
    },
    
    clearFilters() {
      this.filters = {
        search: '',
        categories: [],
        sizes: [],
        minPrice: '',
        maxPrice: '',
        sort: 'newest'
      };
      this.applyFilters();
    },
    
    formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID', { 
        style: 'currency', 
        currency: 'IDR', 
        minimumFractionDigits: 0 
      }).format(angka);
    }
  }
}

function addToCart(product) {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  const button = event.target.closest('button');
  const originalContent = button.innerHTML;
  button.disabled = true;
  button.innerHTML = `
    <svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
    </svg>
  `;
  
  fetch('{{ route("cart.add") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      catalog_item_id: product.id,
      jumlah: 1
    })
  })
  .then(response => response.json())
  .then(data => {
    button.disabled = false;
    button.innerHTML = originalContent;
    
    if (data.success) {
      showToast('success', data.message);
      
      if (typeof updateCartBadge === 'function') {
        updateCartBadge();
      }
    } else {
      showToast('error', data.message);
    }
  })
  .catch(error => {
    button.disabled = false;
    button.innerHTML = originalContent;
    
    console.error('Error adding to cart:', error);
    showToast('error', 'Terjadi kesalahan. Silakan coba lagi.');
  });
}

window.addToCart = addToCart;
</script>
@endsection