@extends('layouts.app')

@section('title', 'Tentang Kami - SIPUTRA')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
  
  {{-- Section Profil Perusahaan --}}
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
      <div class="order-2 lg:order-1">
        <div class="relative group">
          <div class="absolute -inset-1 bg-gradient-to-r from-[#134686] to-[#1e40af] rounded-xl blur opacity-20 group-hover:opacity-40 transform group-hover:scale-[1.02] transition-all duration-1000"></div>
          <img 
            src="{{ asset('images/gudang-2-2.jpeg') }}" 
            alt="Gudang PT Putra Samudera Nusantara" 
            class="relative w-full h-auto rounded-xl shadow-xl object-cover transform group-hover:scale-[1.02] transition-transform duration-700"
          >
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent rounded-xl opacity-0 group-hover:opacity-100 transform group-hover:scale-[1.02] transition-all duration-500"></div>
        </div>
      </div>

      <div class="order-1 lg:order-2 space-y-6">
        <div>
          <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
            PT Putra Samudera Nusantara
          </h1>
          <p class="text-xl text-[#134686] font-semibold mt-2">Sidoarjo</p>
        </div>

        <div class="prose prose-lg text-gray-700 space-y-4">
          <p>
            Kami adalah penyedia solusi ikan segar dan penyewaan gudang penyimpanan terkemuka di Jawa Timur. 
            Dengan pengalaman lebih dari <strong>15 tahun</strong>, kami menghubungkan nelayan dan pembeli melalui pasokan ikan berkualitas tinggi, sekaligus menyediakan gudang penyimpanan modern ideal untuk menjaga kesegaran produk laut.
          </p>
          <p>
            Gudang kami dilengkapi teknologi <strong>cold storage modern</strong> dengan suhu terkontrol, 
            sistem keamanan 24 jam, dan akses logistik yang strategis. Kami melayani berbagai skala bisnis, 
            dari UMKM hingga eksportir besar.
          </p>
          <p class="text-[#134686] font-medium">
            Komitmen kami: <em>Kesegaran. Keamanan. Kepuasan Pelanggan.</em>
          </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <a href="#hubungi-kami" 
             class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#134686] hover:bg-[#0d3566] text-white font-semibold rounded-lg shadow-md transition-all transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            Hubungi Kami
          </a>
          <a href="/gudang" 
             class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-[#134686] text-[#134686] font-semibold rounded-lg shadow-md hover:bg-[#134686] hover:text-white transition-all">
            Lihat Katalog Gudang
          </a>
        </div>
      </div>
    </div>
  </section>

  {{-- Hubungi Kami Section --}}
  <section id="hubungi-kami" class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="space-y-8">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Hubungi Kami</h2>
            <p class="text-lg text-gray-600">Kami siap membantu & melayani kebutuhan Anda kapan saja.</p>
          </div>

          <div class="space-y-6">
            <div class="flex items-center gap-4 group">
              <div class="w-12 h-12 bg-[#134686] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm text-gray-500">Telepon / WhatsApp</p>
                <a href="https://wa.me/6286969696969" target="_blank" class="text-xl font-semibold text-gray-900 hover:text-[#134686] transition-colors">
                  0869696969
                </a>
              </div>
            </div>

            <div class="flex items-center gap-4 group">
              <div class="w-12 h-12 bg-[#134686] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="text-sm text-gray-500">Email</p>
                <a href="mailto:putrasamudranusa@gmail.com" class="text-xl font-semibold text-gray-900 hover:text-[#134686] transition-colors">
                  putrasamudranusa@gmail.com
                </a>
              </div>
            </div>

            <div class="flex items-center gap-4 group">
              <div class="w-12 h-12 bg-[#134686] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                </svg>
              </div>
              <div>
                <p class="text-sm text-gray-500">Instagram</p>
                <a href="https://instagram.com/putrasamudranusa" target="_blank" class="text-xl font-semibold text-gray-900 hover:text-[#134686] transition-colors">
                  @putrasamudranusa
                </a>
              </div>
            </div>
          </div>

          <div class="pt-6">
            <a href="https://wa.me/6286969696969?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20SIPUTRA" 
               target="_blank"
               class="inline-flex items-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full shadow-lg transform hover:scale-105 transition-all">
              <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#ffffff"></path> </g></svg>
              Chat via WhatsApp
            </a>
          </div>
        </div>

        {{-- Embed Link Google Maps Perusahaan --}}
        <div class="h-96 lg:h-full min-h-96 rounded-xl overflow-hidden shadow-xl">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.0353144910614!2d112.7510937!3d-7.461345199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1aac1a2dad9%3A0xe529f2d84479a689!2sPT.%20Suplai%20Ikan%20Nasional!5e0!3m2!1sid!2sid!4v1761921973818!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            class="w-full h-full">
          </iframe>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection