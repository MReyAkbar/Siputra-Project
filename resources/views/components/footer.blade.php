<footer class="bg-gradient-to-br from-[#134686] via-[#0C3C65] to-[#134686] text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-yellow-400 rounded-full filter blur-3xl"></div>
  </div>

  <div class="max-w-7xl mx-auto px-6 py-12 relative z-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-10">

      <div class="lg:col-span-4 space-y-6">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group">
          <div class="relative">
            <div class="rounded-full opacity-50 group-hover:opacity-75 transition-opacity"></div>
            <img src="{{ asset('images/siputra-logo.png') }}" class="w-16 h-16 rounded-full relative z-10 transition-all" alt="logo siputra">
          </div>
          <div class="flex flex-col">
            <h3 class="text-2xl font-bold tracking-tight">SIPUTRA</h3>
            <p class="text-xs text-gray-300">Sistem Informasi Putra Samudra</p>
          </div>
        </a>

        <p class="text-gray-300 text-sm leading-relaxed">
          Partner terpercaya untuk kebutuhan produk laut berkualitas tinggi. Melayani dengan integritas, profesionalisme, dan komitmen terhadap kepuasan pelanggan sejak 2009.
        </p>

        <a href="https://wa.me/6282141451578" target="_blank"
          class="inline-flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl text-sm font-semibold transition-all transform hover:scale-105 shadow-lg hover:shadow-xl">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
          </svg>
          Chat via WhatsApp
        </a>

        <div class="flex items-center gap-4 pt-4 border-t border-white/10">
          <div class="text-center">
            <div class="w-20 h-20 rounded-lg flex items-center justify-center mb-1">
              <img src="{{ asset('/images/logo-halal.png') }}" alt="Halal">
            </div>
          </div>
          <div class="text-center">
            <div class="w-20 h-20 rounded-lg flex items-center justify-center mb-1 p-1">
              <img src="{{ asset('/images/logo-bpom.png') }}" alt="BPOM">
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-2">
        <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
          <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          Menu Cepat
        </h4>
        <ul class="space-y-3 text-gray-300">
          <li>
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:text-yellow-400 hover:translate-x-1 transition-all group">
              <svg class="w-4 h-4 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
              </svg>
              Beranda
            </a>
          </li>
          <li>
            <a href="{{ url('/katalog') }}" class="flex items-center gap-2 hover:text-yellow-400 hover:translate-x-1 transition-all group">
              <svg class="w-4 h-4 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
              </svg>
              Katalog Ikan
            </a>
          </li>
          <li>
            <a href="{{ url('/gudang') }}" class="flex items-center gap-2 hover:text-yellow-400 hover:translate-x-1 transition-all group">
              <svg class="w-4 h-4 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
              </svg>
              Katalog Gudang
            </a>
          </li>
          <li>
            <a href="{{ url('/tentang-kami') }}" class="flex items-center gap-2 hover:text-yellow-400 hover:translate-x-1 transition-all group">
              <svg class="w-4 h-4 text-yellow-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
              </svg>
              Tentang Kami
            </a>
          </li>
        </ul>
      </div>

      <div class="lg:col-span-3">
        <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
          <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
          </svg>
          Layanan Kami
        </h4>
        <ul class="space-y-3 text-gray-300 text-sm">
          <li class="flex items-start gap-2">
            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>Distribusi Produk Laut Segar</span>
          </li>
          <li class="flex items-start gap-2">
            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>Storage & Warehouse</span>
          </li>
          <li class="flex items-start gap-2">
            <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>Logistik</span>
          </li>
        </ul>

        <div class="mt-6 pt-6 border-t border-white/10">
          <p class="text-gray-400 text-sm mb-2">Butuh bantuan?</p>
          <div class="flex flex-col gap-2">
            <a href="https://wa.me/6281234567890" class="inline-flex items-center gap-2 text-yellow-400 hover:text-yellow-300 font-medium transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
              </svg>
              Hubungi Kami
            </a>
            <a href="{{ url('chatbot') }}" class="inline-flex items-center gap-2 text-yellow-400 hover:text-yellow-300 font-medium transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
              </svg>
              Tanya Melalui Chatbot
            </a>
          </div>
        </div>
      </div>

      <div class="lg:col-span-3">
        <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
          <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          Informasi Kontak
        </h4>
        <ul class="space-y-4 text-gray-300 text-sm">
          <li class="flex items-start gap-3">
            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 border border-white/20">
              <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <div>
              <p class="font-semibold text-white mb-1">Alamat Kantor</p>
              <span>Rangkah Kidul, Kec. Sidoarjo, <br>Kabupaten Sidoarjo, Jawa Timur 61271</span>
            </div>
          </li>

          <li class="flex items-start gap-3">
            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 border border-white/20">
              <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <p class="font-semibold text-white mb-1">Email</p>
              <a href="mailto:info@siputra.co.id" class="text-yellow-400 hover:text-yellow-300 transition-colors">info@siputra.co.id</a>
            </div>
          </li>

          <li class="flex items-start gap-3">
            <div class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 border border-white/20">
              <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <div>
              <p class="font-semibold text-white mb-1">Telepon</p>
              <a href="tel:+6281234567890" class="text-yellow-400 hover:text-yellow-300 transition-colors">+62 821-4145-1578</a>
            </div>
          </li>
        </ul>

        <div class="mt-6 pt-6 border-t border-white/10">
          <p class="font-semibold text-white mb-3">Ikuti Kami</p>
          <div class="flex items-center gap-3">
            <a href="https://www.instagram.com/reeyhann15_?igsh=MW84Z2p5MGx4a2hobg==" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all transform hover:scale-110 border border-white/20" aria-label="Instagram">
              <i class="fa-brands fa-instagram text-xl"></i>
            </a>

            <a href="https://facebook.com/siputra" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-blue-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all transform hover:scale-110 border border-white/20" aria-label="Facebook">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M22 12a10 10 0 10-11.5 9.9v-7H8.9v-2.9h1.6V9.4c0-1.6 1-2.5 2.4-2.5.7 0 1.4.1 1.4.1v1.6h-.8c-.8 0-1 0-1 1v1.2h1.8l-.3 2.9h-1.5v7A10 10 0 0022 12z"/>
              </svg>
            </a>

            <a href="https://linkedin.com/company/siputra" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-blue-700 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all transform hover:scale-110 border border-white/20" aria-label="LinkedIn">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.98 3.5A2.5 2.5 0 102.48 6a2.5 2.5 0 002.5-2.5zM3 8.98h3.96V21H3V8.98zM9.5 8.98H13v1.63h.05c.52-.99 1.8-2.03 3.7-2.03 4 0 4.75 2.63 4.75 6.05V21h-3.96v-5.1c0-1.22-.02-2.79-1.7-2.79-1.7 0-1.96 1.32-1.96 2.68V21H9.5V8.98z"/>
              </svg>
            </a>

            <a href="https://youtube.com/@siputra" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-red-600 backdrop-blur-sm rounded-lg flex items-center justify-center transition-all transform hover:scale-110 border border-white/20" aria-label="YouTube">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-12 pt-8 border-t border-white/10">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="text-gray-300 text-sm text-center md:text-left">
          &copy; {{ date('Y') }} <span class="font-semibold text-white">PT Putra Samudra Nusantara</span>. All rights reserved.
        </p>
        
        <div class="flex items-center gap-6 text-sm text-gray-300">
          <a href="#" class="hover:text-yellow-400 transition-colors">Kebijakan Privasi</a>
          <span class="text-gray-600">•</span>
          <a href="#" class="hover:text-yellow-400 transition-colors">Syarat & Ketentuan</a>
          <span class="text-gray-600">•</span>
          <a href="#" class="hover:text-yellow-400 transition-colors">Sitemap</a>
        </div>
      </div>
    </div>
  </div>
</footer>