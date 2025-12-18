@extends('layouts.app')

@section('title', 'Tentang Kami - SIPUTRA')

@section('content')
<div class="bg-gray-50" x-data="{ activeTab: 'visi' }">

  <section class="relative bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full filter blur-3xl animate-pulse"></div>
      <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-yellow-400 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-32">
      <div class="text-center max-w-4xl mx-auto">
        <div class="inline-block mb-6 animate-fade-in-down">
          <span class="bg-yellow-400 text-[#134686] px-6 py-2 rounded-full text-sm font-bold shadow-lg">
            🏢 Sejak 2009
          </span>
        </div>
        
        <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6 animate-fade-in-up">
          PT Putra Samudra Nusantara
        </h1>
        
        <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
          Partner terpercaya untuk solusi produk laut berkualitas tinggi dan layanan penyimpanan modern di Indonesia
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.4s;">
          <a href="#profil" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[#134686] font-bold rounded-xl hover:bg-yellow-400 transition-all transform hover:scale-105 shadow-xl">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
            Pelajari Lebih Lanjut
          </a>
          <a href="#hubungi-kami" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm border-2 border-white text-white font-bold rounded-xl hover:bg-white hover:text-[#134686] transition-all shadow-xl">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-gray-100 border-y-2 border-gray-200 py-12 transform relative z-10">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-3 gap-8">
        <div class="text-center group cursor-pointer">
          <div class="text-2xl md:text-6xl font-bold text-[#134686] mb-2 group-hover:scale-110 transition-transform">
            15+
          </div>
          <p class="sm:text-xs md:text-base text-gray-600 font-medium">Tahun Pengalaman</p>
        </div>
        <div class="text-center group cursor-pointer">
          <div class="text-2xl md:text-6xl font-bold text-[#134686] mb-2 group-hover:scale-110 transition-transform">
            500+
          </div>
          <p class="sm:text-xs md:text-base text-gray-600 font-medium">Pelanggan Setia</p>
        </div>
        <div class="text-center group cursor-pointer">
          <div class="text-2xl md:text-6xl font-bold text-[#134686] mb-2 group-hover:scale-110 transition-transform">
            50+
          </div>
          <p class="sm:text-xs md:text-base text-gray-600 font-medium">Jenis Produk</p>
        </div>
      </div>
    </div>
  </section>

  <section id="profil" class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="order-2 lg:order-1 space-y-6">
          <div>
            <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
            <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-6">
              Siapa Kami?
            </h2>
          </div>

          <div class="prose prose-lg text-gray-700 space-y-4">
            <p class="text-lg leading-relaxed">
              PT Putra Samudra Nusantara adalah penyedia solusi <strong class="text-[#134686]">ikan segar</strong> dan <strong class="text-[#134686]">penyewaan gudang penyimpanan</strong> terkemuka di Jawa Timur. Dengan pengalaman lebih dari <strong>15 tahun</strong>, kami menghubungkan nelayan dan pembeli melalui pasokan ikan berkualitas tinggi.
            </p>
            <p class="text-lg leading-relaxed">
              Gudang kami dilengkapi teknologi <strong class="text-[#134686]">cold storage modern</strong> dengan suhu terkontrol, sistem keamanan 24 jam, dan akses logistik yang strategis. Kami melayani berbagai skala bisnis, dari UMKM hingga eksportir besar.
            </p>
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-[#134686] p-6 rounded-r-xl">
              <p class="text-[#134686] font-bold text-xl italic">
                "Kesegaran. Keamanan. Kepuasan Pelanggan."
              </p>
              <p class="text-gray-600 text-sm mt-2">— Komitmen Kami</p>
            </div>
          </div>

          <div class="flex flex-wrap gap-4 pt-4">
            <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#134686] text-white font-semibold rounded-xl hover:bg-[#0C3C65] transition-all shadow-lg transform hover:scale-105">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              Lihat Katalog Ikan
            </a>
            <a href="{{ url('/gudang') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-[#134686] text-[#134686] font-semibold rounded-xl hover:bg-[#134686] hover:text-white transition-all shadow-lg">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
              Lihat Katalog Gudang
            </a>
          </div>
        </div>

        <div class="order-1 lg:order-2">
          <div class="relative group">
            <div class="absolute -inset-4 bg-gradient-to-r from-[#134686] to-blue-600 rounded-2xl blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
            <img 
              src="{{ asset('images/gudang-2-2.jpeg') }}" 
              alt="PT Putra Samudra Nusantara Facility" 
              class="relative w-full h-auto rounded-2xl shadow-2xl object-cover transform group-hover:scale-105 transition-transform duration-700"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transform group-hover:scale-105 transition-all duration-700"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Arah & Tujuan</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2">Visi & Misi Kami</h2>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl p-8 md:p-10 text-white shadow-2xl transform hover:scale-105 transition-all duration-300">
          <div class="flex items-start gap-4 mb-6">
            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold mb-2">Visi</h3>
              <div class="w-20 h-1 bg-yellow-400 rounded-full"></div>
            </div>
          </div>
          <p class="text-lg leading-relaxed text-gray-100">
            Menjadi perusahaan distribusi produk laut terdepan di Indonesia yang dikenal karena kualitas, inovasi, dan komitmen terhadap keberlanjutan lingkungan serta kesejahteraan masyarakat maritim.
          </p>
        </div>

        <div class="bg-white border-2 border-[#134686] rounded-2xl p-8 md:p-10 shadow-2xl transform hover:scale-105 transition-all duration-300">
          <div class="flex items-start gap-4 mb-6">
            <div class="w-16 h-16 bg-[#134686] rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold mb-2 text-[#134686]">Misi</h3>
              <div class="w-20 h-1 bg-[#134686] rounded-full"></div>
            </div>
          </div>
          <ul class="space-y-3 text-gray-700">
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="leading-relaxed">Menyediakan produk laut berkualitas tinggi dengan standar keamanan pangan internasional</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="leading-relaxed">Memberikan solusi penyimpanan modern yang mendukung rantai dingin optimal</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="leading-relaxed">Memberdayakan nelayan lokal melalui kemitraan yang adil dan berkelanjutan</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
              <span class="leading-relaxed">Terus berinovasi dalam teknologi penyimpanan dan distribusi produk laut</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Perjalanan Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-4">Sejarah & Pencapaian</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Lebih dari satu dekade melayani industri perikanan Indonesia</p>
      </div>

      <div class="relative">
        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-[#134686] to-blue-300"></div>

        <div class="space-y-12">
          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12 md:text-right">
              <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-[#134686]">
                <span class="inline-block bg-[#134686] text-white px-4 py-1 rounded-full text-sm font-bold mb-3">2009</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Berdirinya Perusahaan</h3>
                <p class="text-gray-600">PT Putra Samudra Nusantara didirikan dengan fokus pada distribusi ikan segar lokal di wilayah Sidoarjo.</p>
              </div>
            </div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#134686] rounded-full border-4 border-white shadow-lg"></div>
            <div class="md:w-5/12"></div>
          </div>

          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12"></div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#134686] rounded-full border-4 border-white shadow-lg"></div>
            <div class="md:w-5/12">
              <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-[#134686]">
                <span class="inline-block bg-[#134686] text-white px-4 py-1 rounded-full text-sm font-bold mb-3">2012</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Ekspansi Fasilitas</h3>
                <p class="text-gray-600">Pembangunan cold storage pertama dengan kapasitas 500 ton untuk menjaga kualitas produk.</p>
              </div>
            </div>
          </div>

          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12 md:text-right">
              <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-[#134686]">
                <span class="inline-block bg-[#134686] text-white px-4 py-1 rounded-full text-sm font-bold mb-3">2015</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Bersertifikasi Halal & BPOM</h3>
                <p class="text-gray-600">Meraih sertifikasi halal dan lulus uji BPOM untuk standar kualitas.</p>
              </div>
            </div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#134686] rounded-full border-4 border-white shadow-lg"></div>
            <div class="md:w-5/12"></div>
          </div>

          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12"></div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#134686] rounded-full border-4 border-white shadow-lg"></div>
            <div class="md:w-5/12">
              <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-[#134686]">
                <span class="inline-block bg-[#134686] text-white px-4 py-1 rounded-full text-sm font-bold mb-3">2018</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Jaringan Distribusi</h3>
                <p class="text-gray-600">Perluasan jaringan distribusi ke seluruh Jawa Timur dengan armada pendingin modern.</p>
              </div>
            </div>
          </div>

          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12 md:text-right">
              <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-[#134686]">
                <span class="inline-block bg-[#134686] text-white px-4 py-1 rounded-full text-sm font-bold mb-3">2021</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Ekspansi Perusahaan</h3>
                <p class="text-gray-600">500+ pelanggan aktif, dan ekspansi ke pasar ekspor internasional.</p>
              </div>
            </div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#134686] rounded-full border-4 border-white shadow-lg"></div>
            <div class="md:w-5/12"></div>
          </div>

          <div class="relative flex items-center md:justify-between">
            <div class="md:w-5/12"></div>
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-yellow-400 rounded-full border-4 border-white shadow-lg animate-pulse"></div>
            <div class="md:w-5/12">
              <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2 border-2 border-yellow-400">
                <span class="inline-block bg-yellow-400 text-[#134686] px-4 py-1 rounded-full text-sm font-bold mb-3">2025</span>
                <h3 class="text-xl font-bold text-[#134686] mb-2">Perkembangan Digital</h3>
                <p class="text-gray-700">Peluncuran sistem SIPUTRA untuk kemudahan akses katalog dan layanan online.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Nilai-Nilai Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-4">Prinsip yang Kami Pegang</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Landasan dalam setiap keputusan dan tindakan kami</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Kualitas</h3>
          <p class="text-gray-600 leading-relaxed">
            Komitmen terhadap standar kualitas tertinggi dalam setiap produk dan layanan yang kami berikan kepada pelanggan.
          </p>
        </div>

        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Integritas</h3>
          <p class="text-gray-600 leading-relaxed">
            Transparansi dan kejujuran dalam setiap aspek bisnis kami, membangun kepercayaan jangka panjang dengan mitra.
          </p>
        </div>

        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Inovasi</h3>
          <p class="text-gray-600 leading-relaxed">
            Terus berinovasi dalam teknologi penyimpanan dan distribusi untuk memberikan solusi terbaik bagi pelanggan.
          </p>
        </div>

        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Keberlanjutan</h3>
          <p class="text-gray-600 leading-relaxed">
            Praktik bisnis yang bertanggung jawab terhadap lingkungan dan pemberdayaan masyarakat maritim lokal.
          </p>
        </div>

        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Fokus Pelanggan</h3>
          <p class="text-gray-600 leading-relaxed">
            Kepuasan pelanggan adalah prioritas utama kami, dengan layanan yang responsif dan solusi yang tepat.
          </p>
        </div>

        <div class="group bg-gradient-to-br from-gray-50 to-white border-2 border-gray-200 rounded-2xl p-8 hover:border-[#134686] hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-[#134686] mb-3">Keunggulan</h3>
          <p class="text-gray-600 leading-relaxed">
            Selalu berupaya mencapai standar keunggulan dalam operasional, pelayanan, dan hasil yang kami berikan.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Layanan Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-4">Apa yang Kami Tawarkan</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Solusi lengkap untuk kebutuhan bisnis perikanan Anda</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="group relative bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8 overflow-hidden border-2 border-blue-200 hover:border-[#134686] transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
          <div class="absolute top-0 right-0 w-32 h-32 bg-[#134686] opacity-5 rounded-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500"></div>
          <div class="relative z-10">
            <div class="flex items-start gap-4 mb-4">
              <div class="w-14 h-14 bg-[#134686] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-[#134686] mb-2">Produk Berkualitas</h3>
                <p class="text-gray-600 leading-relaxed">
                  Menyediakan berbagai jenis ikan beku dengan kualitas terjamin. Dari tangkapan lokal hingga produk import, semua tersedia dengan sistem cold chain yang terjaga.
                </p>
              </div>
            </div>
            <ul class="space-y-2 mt-4">
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>50+ Jenis Ikan Beku</span>
              </li>
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Gudang Berpendingin</span>
              </li>
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Harga Kompetitif</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="group relative bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 overflow-hidden border-2 border-purple-200 hover:border-[#134686] transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl">
          <div class="absolute top-0 right-0 w-32 h-32 bg-[#134686] opacity-5 rounded-full transform translate-x-16 -translate-y-16 group-hover:scale-150 transition-transform duration-500"></div>
          <div class="relative z-10">
            <div class="flex items-start gap-4 mb-4">
              <div class="w-14 h-14 bg-[#134686] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:rotate-6 transition-all">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
              <div>
                <h3 class="text-2xl font-bold text-[#134686] mb-2">Cold Storage & Warehouse</h3>
                <p class="text-gray-600 leading-relaxed">
                  Fasilitas penyimpanan modern dengan teknologi pendingin terkini. Kapasitas besar, suhu terkontrol, dan sistem monitoring 24/7 untuk menjaga kualitas produk Anda.
                </p>
              </div>
            </div>
            <ul class="space-y-2 mt-4">
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Kapasitas 200+ Ton</span>
              </li>
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Suhu -25°C hingga 15°C</span>
              </li>
              <li class="flex items-center gap-2 text-gray-700">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Keamanan 24/7</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Galeri Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-4">Fasilitas & Produk</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Lihat langsung fasilitas modern dan produk berkualitas kami</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
          <div class="aspect-w-16 aspect-h-12 bg-gray-200">
            <img src="{{ asset('images/cold-storage.webp') }}" alt="Cold Storage" class="w-full h-64 object-cover transition-transform duration-500 ease-out group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent group-hover:opacity-0 transition-opacity duration-300"></div>
            <div class="absolute inset-0 flex items-end p-6 transition-transform ease-out group-hover:translate-y-96">
              <div class="text-white transform-gpu">
                <h3 class="text-xl font-bold mb-2">Fasilitas Cold Storage</h3>
                <p class="text-sm">Teknologi pendingin terkini dengan suhu terkontrol</p>
              </div>
            </div>
          </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
          <div class="aspect-w-16 aspect-h-12 bg-gray-200">
            <img src="{{ asset('images/fresh-fish.webp') }}" alt="Fresh Fish" class="w-full h-64 object-cover transition-transform duration-500 ease-out group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent group-hover:opacity-0 transition-opacity duration-300"></div>
            <div class="absolute inset-0 flex items-end p-6 transition-transform ease-out group-hover:translate-y-96">
              <div class="text-white transform-gpu">
                <h3 class="text-xl font-bold mb-2">Produk Ikan Segar</h3>
                <p class="text-sm">Berbagai jenis ikan segar berkualitas premium</p>
              </div>
            </div>
          </div>
        </div>

        <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
          <div class="aspect-w-16 aspect-h-12 bg-gray-200">
            <img src="{{ asset('images/quality-control.webp') }}" alt="Quality Control" class="w-full h-64 object-cover transition-transform duration-500 ease-out group-hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent group-hover:opacity-0 transition-opacity duration-300"></div>
            <div class="absolute inset-0 flex items-end p-6 transition-transform ease-out group-hover:translate-y-96">
              <div class="text-white transform-gpu">
                <h3 class="text-xl font-bold mb-2">Quality Control</h3>
                <p class="text-sm">Proses inspeksi ketat untuk kualitas terbaik</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-12">
        <p class="text-gray-600 mb-4">Ingin melihat lebih banyak?</p>
        <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#134686] text-white font-bold rounded-xl hover:bg-[#0C3C65] transition-all shadow-lg transform hover:scale-105">
          Lihat Semua Produk
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
      </div>
    </div>
  </section>

  <section id="hubungi-kami" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <span class="text-yellow-600 font-semibold text-sm uppercase tracking-wider">Kontak Kami</span>
        <h2 class="text-4xl md:text-5xl font-bold text-[#134686] mt-2 mb-4">Mari Terhubung</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Kami siap membantu dan menjawab pertanyaan Anda</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="space-y-8">
          <div class="space-y-6">
              <h3 class="text-2xl font-bold text-[#134686] mb-6">Informasi Kontak</h3>

              <div class="flex items-start gap-4 group cursor-pointer">
                <div class="w-14 h-14 bg-[#134686] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Telepon / WhatsApp</p>
                  <a href="https://wa.me/6282141451578" target="_blank" class="text-xl font-bold text-[#134686] hover:text-[#0C3C65] transition-colors">
                    082141451578
                  </a>
                </div>
              </div>

              <div class="flex items-start gap-4 group cursor-pointer">
                <div class="w-14 h-14 bg-[#134686] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Email</p>
                  <a href="mailto:putrasamudranusa@gmail.com" class="text-xl font-bold text-[#134686] hover:text-[#0C3C65] transition-colors break-all">
                    putrasamudranusantara@gmail.com
                  </a>
                </div>
              </div>

              <div class="flex items-start gap-4 group cursor-pointer">
                <div class="w-14 h-14 bg-[#134686] rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                  <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-600 font-medium">Alamat</p>
                  <p class="text-lg font-semibold text-gray-900">
                    Rangkah Kidul, Kec. Sidoarjo,<br>Kabupaten Sidoarjo, Jawa Timur 61271
                  </p>
                </div>
              </div>

            <div class="pt-6">
              <a href="https://wa.me/6282141451578?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20SIPUTRA" 
                target="_blank"
                class="inline-flex items-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full shadow-lg transform hover:scale-105 transition-all">
                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#ffffff"></path> </g></svg>
                Chat via WhatsApp
              </a>
            </div>
          </div>
        </div>

        <div class="h-96 lg:h-full min-h-96 rounded-xl overflow-hidden shadow-xl">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.0353144910614!2d112.7510937!3d-7.461345199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1aac1a2dad9%3A0xe529f2d84479a689!2sPT.%20Suplai%20Ikan%20Nasional!5e0!3m2!1sid!2sid!4v1761921973818!5m2!1sid!2sid" 
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <section class="py-20 bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full filter blur-3xl animate-pulse"></div>
      <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-yellow-400 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
      <h2 class="text-4xl md:text-5xl font-bold mb-6">
        Siap Bermitra dengan <span class="text-yellow-300">SIPUTRA</span>?
      </h2>
      
      <p class="text-xl text-gray-200 mb-10 leading-relaxed">
        Bergabunglah dengan ratusan pelanggan yang telah mempercayai kami untuk solusi produk laut berkualitas dan layanan penyimpanan terbaik.
      </p>

      <div class="flex flex-col sm:flex-row gap-5 justify-center">
        <a href="{{ url('/katalog') }}" class="inline-flex items-center justify-center gap-3 px-10 py-5 bg-white text-[#134686] font-bold rounded-xl hover:bg-yellow-400 transition-all transform hover:scale-105 shadow-2xl">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
          Lihat Katalog Produk
        </a>
        
        <a href="https://wa.me/6282141451578?text=Halo,%20saya%20tertarik%20dengan%20layanan%20SIPUTRA" target="_blank" class="inline-flex items-center justify-center gap-3 px-10 py-5 bg-green-500 text-white font-bold rounded-xl hover:bg-green-600 transition-all transform hover:scale-105 shadow-2xl">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
          </svg>
          Hubungi via WhatsApp
        </a>
      </div>

      <div class="flex flex-wrap justify-center gap-8 items-center pt-12 mt-12 border-t border-white/20">
        <div class="flex items-center gap-2 text-gray-200">
          <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span>Produk Berkualitas</span>
        </div>
        <div class="flex items-center gap-2 text-gray-200">
          <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span>Harga Terjangkau</span>
        </div>
        <div class="flex items-center gap-2 text-gray-200">
          <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span>Layanan 24/7</span>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
@keyframes fade-in-down {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-down {
  animation: fade-in-down 0.8s ease-out;
}

.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
        