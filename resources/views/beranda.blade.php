@extends('layouts.app')

@section('title', 'Beranda - SIPUTRA')

@section('content')
<section class="relative bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white py-16 md:py-24 overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
  </div>
  
  {{-- Hero Section --}}
  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
      <div class="w-full lg:w-1/2 space-y-6">
        <div class="inline-block">
          <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium border border-white/30">
            🐟 Produk Berkualitas Tinggi
          </span>
        </div>
        
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight">
          Solusi Terpercaya untuk Kebutuhan <span class="text-yellow-300">Produk Laut</span> Anda
        </h1>
        
        <p class="text-lg md:text-xl text-gray-200 leading-relaxed">
          SIPUTRA menyediakan sistem informasi lengkap tentang produk berkualitas, gudang penyimpanan modern, dan layanan profesional untuk memenuhi kebutuhan bisnis Anda.
        </p>
        
        <div class="grid grid-cols-3 gap-4 pt-6">
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
            <div class="text-2xl md:text-3xl font-bold text-yellow-300">15+</div>
            <div class="text-xs md:text-sm text-gray-300 mt-1">Tahun Pengalaman</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
            <div class="text-2xl md:text-3xl font-bold text-yellow-300">500+</div>
            <div class="text-xs md:text-sm text-gray-300 mt-1">Pelanggan Setia</div>
          </div>
          <div class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
            <div class="text-2xl md:text-3xl font-bold text-yellow-300">50+</div>
            <div class="text-xs md:text-sm text-gray-300 mt-1">Jenis Produk</div>
          </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <a href="{{ url('/katalog') }}" class="inline-flex items-center justify-center gap-2 bg-yellow-400 text-[#134686] font-bold px-8 py-4 rounded-xl hover:bg-yellow-300 transition-all transform hover:scale-105 shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Jelajahi Produk
          </a>
          <a href="{{ url('/tentang-kami') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-sm border-2 border-white text-white font-semibold px-8 py-4 rounded-xl hover:bg-white hover:text-[#134686] transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tentang Kami
          </a>
        </div>
      </div>
      
      <div class="w-full lg:w-1/2">
        <div class="relative perspective-1000">
          <div class="absolute -inset-4 bg-gradient-to-r from-yellow-400 via-yellow-300 to-yellow-400 rounded-2xl blur-2xl opacity-20 animate-pulse"></div>
          
          <div class="relative bg-white/10 backdrop-blur-sm border-4 border-white/30 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-[1.02] hover:rotate-1">
            <div class="relative aspect-w-16 aspect-h-10 bg-gradient-to-br from-gray-300 to-gray-400 overflow-hidden group">
              <img src="{{ asset('/images/ikan-tuna.png') }}" alt="PT Putra Samudra Nusantara - Fresh Seafood Quality" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
              
              <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20"></div>

              <div class="absolute top-4 left-4 flex flex-col gap-3 z-10">
                <div class="bg-white/95 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg transform transition-all hover:scale-105 hover:bg-white">
                  <div class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm font-bold text-gray-800">Premium Quality</span>
                  </div>
                </div>
                
                <div class="bg-yellow-400/95 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg transform transition-all hover:scale-105 hover:bg-yellow-400">
                  <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#134686]" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-bold text-[#134686]">Halal & BPOM</span>
                  </div>
                </div>
              </div>
              
              {{-- <div class="absolute bottom-4 right-4 left-4 z-10">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl p-4 shadow-xl transform transition-all hover:scale-[1.02]">
                  <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="border-r border-gray-300 last:border-r-0">
                      <div class="text-xl font-bold text-[#134686]">15+</div>
                      <div class="text-xs text-gray-600">Tahun</div>
                    </div>
                    <div class="border-r border-gray-300 last:border-r-0">
                      <div class="text-xl font-bold text-[#134686]">500+</div>
                      <div class="text-xs text-gray-600">Pelanggan</div>
                    </div>
                    <div>
                      <div class="text-xl font-bold text-[#134686]">50+</div>
                      <div class="text-xs text-gray-600">Produk</div>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
            
            <div class="absolute top-0 right-0 w-20 h-20 border-t-4 border-r-4 border-yellow-400 rounded-tr-2xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 border-b-4 border-l-4 border-yellow-400 rounded-bl-2xl opacity-50"></div>
          </div>
          
          <div class="absolute -top-8 -right-8 w-24 h-24 bg-yellow-400/20 rounded-full blur-xl animate-bounce-slow"></div>
          <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-blue-400/20 rounded-full blur-xl animate-pulse"></div>
        </div>
      </div>

      <style>
        @keyframes bounce-slow {
          0%, 100% {
            transform: translateY(0);
          }
          50% {
            transform: translateY(-20px);
          }
        }
        
        .animate-bounce-slow {
          animation: bounce-slow 3s ease-in-out infinite;
        }
        
        .perspective-1000 {
          perspective: 1000px;
        }
      </style>
    </div>
  </div>
</section>

{{-- Tentang Kami Singkat --}}
<section class="py-12 bg-white border-b-2 border-gray-200">
  <div class="max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row items-center justify-between gap-8">
      <div class="flex-1">
        <h3 class="text-2xl font-bold text-[#134686] mb-3">PT Putra Samudra Nusantara</h3>
        <p class="text-gray-700 leading-relaxed">
          Perusahaan terkemuka di bidang distribusi produk laut berkualitas tinggi dengan komitmen terhadap kesegaran, keamanan pangan, dan kepuasan pelanggan. Kami melayani kebutuhan bisnis retail, restaurant, dan industri di seluruh Indonesia.
        </p>
      </div>
      
      <div class="flex flex-wrap justify-center md:justify-end gap-6 items-center">
        <div class="text-center">
          <div class="w-20 h-20 rounded-lg flex items-center justify-center mb-2">
            <img src="{{ asset('/images/logo-halal.png') }}" alt="Halal">
          </div>
          <p class="text-xs text-gray-600">Bersertifikasi<br/>Halal</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 rounded-lg flex items-center justify-center mb-2">
            <img src="{{ asset('/images/logo-bpom.png') }}" alt="BPOM">
          </div>
          <p class="text-xs text-gray-600">Lulus Uji <br>BPOM</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Produk Kami --}}
<section id="produk" class="py-20 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mb-4">Produk Kami</h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Jelajahi berbagai pilihan produk laut segar berkualitas tinggi dan fasilitas gudang penyimpanan modern yang kami sediakan untuk kebutuhan bisnis Anda.
      </p>
    </div>

    {{-- Ikan --}}
    <div class="mb-16">
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-[#134686] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-[#134686]">Katalog Ikan</h3>
            <p class="text-sm text-gray-600">Produk laut segar pilihan terbaik</p>
          </div>
        </div>
        <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 text-[#134686] font-semibold hover:gap-3 transition-all">
          Lihat Semua
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <div id="ikanGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      </div>
    </div>

    {{-- Gudang --}}
    <div>
      <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-[#134686] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-[#134686]">Katalog Gudang</h3>
            <p class="text-sm text-gray-600">Fasilitas penyimpanan modern dan aman</p>
          </div>
        </div>
        <a href="{{ url('/gudang') }}" class="inline-flex items-center gap-2 text-[#134686] font-semibold hover:gap-3 transition-all">
          Lihat Semua
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>

      <div id="gudangGrid" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      </div>
    </div>
  </div>
</section>

{{-- Kenapa Memilih Kami --}}
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mb-4">Mengapa Memilih SIPUTRA?</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Kami memberikan nilai lebih untuk bisnis Anda dengan berbagai keunggulan kompetitif
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Kualitas Terjamin</h3>
        <p class="text-gray-600 leading-relaxed">
          Setiap produk melalui kontrol kualitas ketat dengan standar internasional. Kami berkomitmen menyediakan produk segar, aman, dan berkualitas premium untuk kepuasan pelanggan.
        </p>
      </div>

      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Sumber Terpercaya</h3>
        <p class="text-gray-600 leading-relaxed">
          Produk kami berasal dari nelayan lokal berpengalaman dan perairan yang dikelola secara bertanggung jawab. Kemitraan jangka panjang memastikan pasokan stabil dan berkelanjutan.
        </p>
      </div>

      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Layanan Cepat</h3>
        <p class="text-gray-600 leading-relaxed">
          Sistem SIPUTRA memudahkan proses pemesanan, Tim profesional kami siap membantu kebutuhan Anda dengan respons cepat dan layanan prima.
        </p>
      </div>

      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Harga Kompetitif</h3>
        <p class="text-gray-600 leading-relaxed">
          Dapatkan harga terbaik tanpa mengorbankan kualitas. Sistem distribusi efisien kami memastikan value for money maksimal untuk bisnis Anda.
        </p>
      </div>

      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Fasilitas Terjaga</h3>
        <p class="text-gray-600 leading-relaxed">
          Fasilitas modern dengan teknologi canggih menjaga kesegaran produk dari gudang hingga ke tangan Anda dengan standar suhu terkontrol.
        </p>
      </div>

      <div class="group p-8 bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl hover:border-[#134686] hover:shadow-xl transition-all duration-300">
        <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </div>
        <h3 class="font-bold text-xl mb-3 text-[#134686]">Dukungan Pelanggan</h3>
        <p class="text-gray-600 leading-relaxed">
          Tim customer service profesional siap membantu Anda 24/7. Konsultasi produk, informasi seputar perusahaan, hingga after-sales service untuk kepuasan maksimal.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- Cara Pemesanan --}}
<section class="py-20 bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
  </div>

  <div class="max-w-7xl mx-auto px-6 relative z-10">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold mb-4">Cara Pemesanan</h2>
      <p class="text-lg text-gray-200 max-w-2xl mx-auto">
        Proses mudah dan cepat untuk mendapatkan produk berkualitas kami
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      {{-- Step 1 --}}
      <div class="relative">
        <div class="bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 h-full">
          <div class="flex items-center justify-center mb-6">
            <div class="relative">
              <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-3xl font-bold text-[#134686]">1</span>
              </div>
              <div class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="text-xl font-bold mb-3 text-center">Jelajahi Katalog</h3>
          <p class="text-gray-200 text-center leading-relaxed">
            Browse koleksi lengkap produk ikan segar dan fasilitas gudang kami melalui sistem SIPUTRA
          </p>
        </div>
        <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-yellow-400 transform -translate-y-1/2"></div>
      </div>

      {{-- Step 2 --}}
      <div class="relative">
        <div class="bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 h-full">
          <div class="flex items-center justify-center mb-6">
            <div class="relative">
              <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-3xl font-bold text-[#134686]">2</span>
              </div>
              <div class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="text-xl font-bold mb-3 text-center">Pilih Produk</h3>
          <p class="text-gray-200 text-center leading-relaxed">
            Pilih produk sesuai kebutuhan, lihat detail spesifikasi, harga, dan ketersediaan stok real-time
          </p>
        </div>
        <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-yellow-400 transform -translate-y-1/2"></div>
      </div>

      <div class="relative">
        <div class="bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 h-full">
          <div class="flex items-center justify-center mb-6">
            <div class="relative">
              <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-3xl font-bold text-[#134686]">3</span>
              </div>
              <div class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="text-xl font-bold mb-3 text-center">Proses Pemesanan</h3>
          <p class="text-gray-200 text-center leading-relaxed">
            Pemesanan dapat diproses melalui WhatsApp, setelah anda menekan tombol pesan sekarang
          </p>
        </div>
        <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-0.5 bg-yellow-400 transform -translate-y-1/2"></div>
      </div>

      <div class="relative">
        <div class="bg-white/10 backdrop-blur-sm border-2 border-white/30 rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 h-full">
          <div class="flex items-center justify-center mb-6">
            <div class="relative">
              <div class="w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center">
                <span class="text-3xl font-bold text-[#134686]">4</span>
              </div>
              <div class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="text-xl font-bold mb-3 text-center">Terima Pesanan</h3>
          <p class="text-gray-200 text-center leading-relaxed">
            Produk dikemas dengan standar kualitas tinggi dan siap untuk anda terima 
          </p>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <a href="https://wa.me/6282141451578" target="_blank" class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold px-8 py-4 rounded-xl transition-all transform hover:scale-105 shadow-xl">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
        </svg>
        Mulai Pesan Sekarang
      </a>
    </div>
  </div>
</section>

{{-- Testimoni --}}
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mb-4">Testimoni Pelanggan</h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Kepercayaan pelanggan adalah prioritas kami. Lihat apa kata mereka tentang layanan SIPUTRA
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      {{-- Review 1 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Sistem SIPUTRA sangat membantu dalam proses pemesanan. Informasi produk lengkap, stok real-time, dan customer service yang responsif. Kualitas ikan selalu segar!"
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">R</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Reyhan Akbar</h4>
            <p class="text-sm text-gray-600">Restaurant Owner</p>
          </div>
        </div>
      </div>

      {{-- Review 2 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Tampilan website modern dan user-friendly. Fitur katalog gudang sangat membantu untuk planning inventory kami. Layanan storage gudang juga sangat terpercaya!"
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">D</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Ahmad Dwicky</h4>
            <p class="text-sm text-gray-600">Retail Business</p>
          </div>
        </div>
      </div>

      {{-- Review 3 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Produk berkualitas premium dengan harga kompetitif! Packaging rapi, pengiriman tepat waktu, dan kesegaran terjaga. SIPUTRA adalah partner bisnis yang sangat recommended!"
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">S</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Shevina Sheril</h4>
            <p class="text-sm text-gray-600">Hotel Procurement</p>
          </div>
        </div>
      </div>

      {{-- Review 4 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Sudah langganan 3 tahun lebih. Kualitas konsisten, harga stabil, dan pelayanan memuaskan. Tim SIPUTRA sangat profesional dalam handling komplain dan request khusus!"
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">A</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Ferdi Dwana</h4>
            <p class="text-sm text-gray-600">Distributor Seafood</p>
          </div>
        </div>
      </div>

      {{-- Review 5 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Platform digital yang sangat membantu! Tracking stok mudah, dokumentasi lengkap, dan proses order efisien. Sangat cocok untuk bisnis yang butuh supply rutin dan terpercaya."
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">M</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Ahmed Wadee</h4>
            <p class="text-sm text-gray-600">Catering Services</p>
          </div>
        </div>
      </div>

      {{-- Review 6 --}}
      <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] relative">
        <div class="absolute -top-4 -left-4 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-[#134686]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
          </svg>
        </div>

        <div class="flex items-center gap-1 mb-4">
          @for($i = 0; $i < 5; $i++)
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>

        <p class="text-gray-700 italic mb-6 leading-relaxed">
          "Excellent service! Produknya fresh, pengiriman cepat, dan komunikasi lancar. Tim sales sangat helpful dalam memberikan rekomendasi produk sesuai kebutuhan kami. Top!"
        </p>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200">
          <div class="w-12 h-12 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-lg">B</span>
          </div>
          <div>
            <h4 class="font-bold text-[#134686]">Bu Heni</h4>
            <p class="text-sm text-gray-600">Supermarket Chain</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Statistik Review --}}
    <div class="mt-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-3xl p-8 md:p-12 text-white">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
        <div>
          <div class="text-5xl font-bold text-yellow-400 mb-2">4.9/5</div>
          <p class="text-gray-200">Rating Rata-rata</p>
        </div>
        <div>
          <div class="text-5xl font-bold text-yellow-400 mb-2">1,250+</div>
          <p class="text-gray-200">Total Review</p>
        </div>
        <div>
          <div class="text-5xl font-bold text-yellow-400 mb-2">98%</div>
          <p class="text-gray-200">Kepuasan Pelanggan</p>
        </div>
        <div>
          <div class="text-5xl font-bold text-yellow-400 mb-2">24/7</div>
          <p class="text-gray-200">Customer Support</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Call To Action --}}
<section class="py-20 bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-yellow-400 rounded-full filter blur-3xl"></div>
  </div>

  <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
    <div class="inline-block mb-6">
      <span class="bg-yellow-400 text-[#134686] px-6 py-2 rounded-full text-sm font-bold">
        🎉 Penawaran Spesial
      </span>
    </div>

    <h2 class="text-4xl md:text-5xl font-bold mb-6">
      Siap Bermitra dengan <span class="text-yellow-300">SIPUTRA</span>?
    </h2>
    
    <p class="text-xl text-gray-200 mb-10 max-w-3xl mx-auto leading-relaxed">
      Dapatkan akses ke produk berkualitas tinggi, harga kompetitif, dan layanan profesional. Hubungi kami sekarang untuk penawaran spesial!
    </p>

    <div class="flex flex-col sm:flex-row gap-5 justify-center items-center mb-8">
      <a href="{{ url('/katalog') }}" class="inline-flex items-center justify-center gap-3 bg-white text-[#134686] font-bold px-10 py-5 rounded-xl hover:bg-gray-100 transition-all transform hover:scale-105 shadow-2xl w-full sm:w-auto">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        Lihat Katalog Lengkap
      </a>
      
      <a href="https://wa.me/6282141451578" target="_blank" class="inline-flex items-center justify-center gap-3 bg-green-500 text-white font-bold px-10 py-5 rounded-xl hover:bg-green-600 transition-all transform hover:scale-105 shadow-2xl w-full sm:w-auto">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
        </svg>
        Konsultasi via WhatsApp
      </a>
    </div>

    <div class="flex flex-wrap justify-center gap-8 items-center pt-8 border-t border-white/20">
      <div class="flex items-center gap-2">
        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm">Response Cepat</span>
      </div>
      <div class="flex items-center gap-2">
        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm">Gratis Konsultasi</span>
      </div>
      <div class="flex items-center gap-2">
        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="text-sm">Penawaran Khusus</span>
      </div>
    </div>
  </div>
</section>

{{-- FAQ --}}
<section class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-6">
    <div class="text-center mb-12">
      <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mb-4">Pertanyaan Umum</h2>
      <p class="text-lg text-gray-600">
        Temukan jawaban untuk pertanyaan yang sering diajukan
      </p>
    </div>

    <div class="space-y-4" x-data="{ open: null }">
      {{-- FAQ 1 --}}
      <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#134686] transition-colors">
        <button @click="open = open === 1 ? null : 1" class="w-full px-6 py-5 text-left flex items-center justify-between">
          <span class="font-bold text-lg text-[#134686]">Bagaimana cara melakukan pemesanan?</span>
          <svg class="w-6 h-6 text-[#134686] transition-transform" :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="open === 1" x-transition class="px-6 pb-5">
          <p class="text-gray-700 leading-relaxed">
            Anda dapat menjelajahi katalog produk kami di website, memilih produk yang diinginkan, kemudian melanjutkan proses pemesanan melalui WhatsApp untuk konfirmasi pesanan dan detail pembayaran. Tim kami akan membantu proses pemesanan hingga produk sampai ke tangan Anda.
          </p>
        </div>
      </div>

      {{-- FAQ 2 --}}
      <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#134686] transition-colors">
        <button @click="open = open === 2 ? null : 2" class="w-full px-6 py-5 text-left flex items-center justify-between">
          <span class="font-bold text-lg text-[#134686]">Apakah produk dijamin segar?</span>
          <svg class="w-6 h-6 text-[#134686] transition-transform" :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="open === 2" x-transition class="px-6 pb-5">
          <p class="text-gray-700 leading-relaxed">
            Ya, semua produk kami dijamin segar dan berkualitas. Kami menggunakan sistem yang terjaga mulai dari penangkapan dan penyimpanan di storage bersuhu terkontrol. Setiap produk melalui quality control ketat sebelum dijual ke pelanggan.
          </p>
        </div>
      </div>

      {{-- FAQ 3 --}}
      <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#134686] transition-colors">
        <button @click="open = open === 3 ? null : 3" class="w-full px-6 py-5 text-left flex items-center justify-between">
          <span class="font-bold text-lg text-[#134686]">Berapa minimum order yang harus dipenuhi?</span>
          <svg class="w-6 h-6 text-[#134686] transition-transform" :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="open === 3" x-transition class="px-6 pb-5">
          <p class="text-gray-700 leading-relaxed">
            Minimum order berbeda-beda tergantung jenis produk. Untuk informasi detail mengenai minimum order, harga khusus untuk pembelian dalam jumlah besar, dan term & condition lainnya, silakan hubungi tim sales kami melalui WhatsApp atau telepon.
          </p>
        </div>
      </div>

      {{-- FAQ 4 --}}
      <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#134686] transition-colors">
        <button @click="open = open === 4 ? null : 4" class="w-full px-6 py-5 text-left flex items-center justify-between">
          <span class="font-bold text-lg text-[#134686]">Apakah tersedia layanan penyimpanan?</span>
          <svg class="w-6 h-6 text-[#134686] transition-transform" :class="{ 'rotate-180': open === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="open === 4" x-transition class="px-6 pb-5">
          <p class="text-gray-700 leading-relaxed">
            Ya, kami menyediakan layanan storage atau gudang dengan berbagai kapasitas dan lokasi strategis. Anda dapat melihat detail fasilitas gudang kami di halaman Katalog Gudang. Fasilitas kami dilengkapi dengan teknologi pendingin modern dan sistem monitoring 24/7 untuk menjaga kualitas produk Anda.
          </p>
        </div>
      </div>

      {{-- FAQ 5 --}}
      <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-200 hover:border-[#134686] transition-colors">
        <button @click="open = open === 5 ? null : 5" class="w-full px-6 py-5 text-left flex items-center justify-between">
          <span class="font-bold text-lg text-[#134686]">Wilayah mana saja yang dilayani?</span>
          <svg class="w-6 h-6 text-[#134686] transition-transform" :class="{ 'rotate-180': open === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div x-show="open === 5" x-transition class="px-6 pb-5">
          <p class="text-gray-700 leading-relaxed">
            Untuk saat ini kami melayani pemesanan untuk wilayah sidoarjo dan sekitarnya, karena lokasi tempat kami yang berada di sidoarjo. Bukan tidak mungkin juga kami akan melakukan ekspansi ke daerah lain atau menambah fitur pengiriman, agar kami dapat mendistribusikan produk kami ke berbagai daerah di indonesia
          </p>
        </div>
      </div>
    </div>

    <div class="text-center mt-12">
      <p class="text-gray-600 mb-4">Masih ada pertanyaan lain?</p>
      <div class="flex flex-col items-center gap-4">
        <a href="https://wa.me/6282141451578" target="_blank" class="inline-flex items-center gap-2 text-[#134686] font-semibold hover:text-[#0C3C65] transition">
          Hubungi Customer Service Kami
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
        <a href="{{ url('chatbot') }}"class="inline-flex items-center gap-2 text-[#134686] font-semibold hover:text-[#0C3C65] transition">
          Tanya Melalui Chatbot
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<script>
  /* Render IKan */
  let productsIkan = @json($items).map(item => ({
      id: item.id,
      nama: item.ikan.nama,
      kategori: item.ikan.kategori?.nama_kategori ?? 'Tidak diketahui',
      harga: item.harga_jual,
      gambar: item.gambar ? `/storage/${item.gambar}` : `/images/default-ikan.png`,
      deskripsi: item.deskripsi,
      ukuran: item.ikan.ukuran ?? 'Unknown',
      stok: item.ikan.stok ?? 0
    }));

  function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
  }

  function formatStok(kg) {
    const num = kg.replace(/[^0-9]/g, '');
    return `${num.replace(/\B(?=(\d{3})+(?!\d))/g, ".")} kg`;
  }

  function renderProductIkan(productsToRender) {
    const grid = document.getElementById('ikanGrid');
    
    grid.innerHTML = '';
    
    productsToRender.forEach(ikan => {
      const card = document.createElement('a');
      card.href = `/katalog/${ikan.id}`;
      card.className = 'group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-[#134686] transform hover:-translate-y-2';
      card.innerHTML = `
        <div class="relative overflow-hidden">
          <div class="aspect-w-16 aspect-h-12 bg-gradient-to-br from-gray-200 to-gray-300">
            <img src="${ikan.gambar}" alt="${ikan.nama}" 
              class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
        
        <div class="p-5">
          <h3 class="font-bold text-lg text-gray-900 mb-2 group-hover:text-[#134686] transition-colors">${ikan.nama}</h3>
          <p class="text-sm text-gray-600 mb-3 line-clamp-1">${ikan.deskripsi}</p>
          
          <div class="flex items-center justify-between">
            <div>
              <p class="text-xs text-gray-500 mb-1">Harga</p>
              <p class="text-[#134686] font-bold text-lg">${formatRupiah(ikan.harga)}<span class="text-sm text-gray-500">/ kg</span></p>
            </div>
            <div class="w-10 h-10 bg-[#134686] rounded-full flex items-center justify-center group-hover:bg-yellow-400 transition-colors">
              <svg class="w-5 h-5 text-white group-hover:text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
        </div>
      `;
      grid.appendChild(card);
    });
  }

  renderProductIkan(productsIkan);

  /* Render Gudang */
  let productsGudang = @json($gudangs); 

  function renderGudang(productsToRender) {
    const grid = document.getElementById('gudangGrid');

    grid.innerHTML = '';

    productsToRender.forEach(g => {
      const img = g.gambar ? `/storage/${g.gambar}` : `/images/no-image.png`;

      let statusSewa = '';
      let statusClass = '';

      if (g.status_sewa === 'tersedia') {
        statusSewa = 'Tersedia';
        statusClass = 'bg-green-500 text-white';
      } else if (g.status_sewa === 'disewa') {
        statusSewa = 'Disewa';
        statusClass = 'bg-red-500 text-white';
      } else if (g.status_sewa === 'tidak_tersedia') {
        statusSewa = 'Tidak Tersedia';
        statusClass = 'bg-red-500 text-white';
      } else {
        statusSewa = g.status_sewa.replace(/_/g, ' ');
        statusClass = 'bg-yellow-500 text-white';
      }

      grid.innerHTML += `
        <a href="/gudang/${g.id}" class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-[#134686] transform hover:-translate-y-2">
          <div class="relative overflow-hidden">
            <div class="aspect-w-16 aspect-h-12 bg-gradient-to-br from-gray-200 to-gray-300">
              <img src="${img}" alt="${g.nama_gudang}" 
                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
            </div>
            <div class="absolute top-3 right-3">
              <span class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-full shadow-md transition-all ${statusClass}">${statusSewa}</span>
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

  renderGudang(productsGudang)
</script>
@endsection