<footer class="bg-[#134686] text-white">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8">

      <div class="lg:col-span-4 space-y-5">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
          <img src="{{ asset("images/siputra-logo.png") }}" class="w-14 h-auto rounded-full" alt="logo siputra">
          <div class="flex flex-col">
            <h3 class="text-2xl font-bold tracking-tight">SIPUTRA</h3>
            <p class="text-xs opacity-80">Sistem Informasi Putra Samudra</p>
          </div>
        </a>

        <p class="text-gray-300 text-sm leading-relaxed max-w-xs">
          SIPUTRA — Sistem informasi produk & profil perusahaan. Temukan katalog, info, dan layanan kami dengan mudah.
        </p>

        <a href="https://wa.me/6281234567890" target="_blank"
          class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition transform hover:scale-105 shadow-md">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
          </svg>
          Chat via WhatsApp
        </a>
      </div>

      <div class="lg:col-span-2">
        <h4 class="font-semibold mb-4 text-lg">Navigasi</h4>
        <ul class="space-y-2 text-gray-300">
          <li><a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a></li>
          <li><a href="{{ url('/katalog') }}" class="hover:text-white transition">Katalog</a></li>
          <li><a href="{{ url('/gudang') }}" class="hover:text-white transition">Gudang</a></li>
          <li><a href="{{ url('/tentang-kami') }}" class="hover:text-white transition">Tentang Kami</a></li>
        </ul>
      </div>

      <div class="lg:col-span-3">
        <h4 class="font-semibold mb-4 text-lg">Ikuti Kami</h4>
        <div class="flex items-center gap-4 mb-4">
          <a href="https://instagram.com/yourprofile" target="_blank" class="text-gray-300 hover:text-white transition transform hover:scale-110" aria-label="Instagram">
            <i class="fa-brands fa-instagram text-2xl"></i>
          </a>

          <a href="https://facebook.com/yourpage" target="_blank" class="text-gray-300 hover:text-white transition transform hover:scale-110" aria-label="Facebook">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7H8.9v-2.9h1.6V9.4c0-1.6 1-2.5 2.4-2.5.7 0 1.4.1 1.4.1v1.6h-.8c-.8 0-1 0-1 1v1.2h1.8l-.3 2.9h-1.5v7A10 10 0 0022 12z"/></svg>
          </a>

          <a href="#" class="text-gray-300 hover:text-white transition transform hover:scale-110" aria-label="LinkedIn">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5A2.5 2.5 0 102.48 6a2.5 2.5 0 002.5-2.5zM3 8.98h3.96V21H3V8.98zM9.5 8.98H13v1.63h.05c.52-.99 1.8-2.03 3.7-2.03 4 0 4.75 2.63 4.75 6.05V21h-3.96v-5.1c0-1.22-.02-2.79-1.7-2.79-1.7 0-1.96 1.32-1.96 2.68V21H9.5V8.98z"/></svg>
          </a>
        </div>
        
        <p class="text-gray-400 text-sm">Butuh bantuan? <a href="/contact" class="text-white underline hover:text-green-300">Hubungi Kami</a></p>
      </div>

      <div class="lg:col-span-3">
        <h4 class="font-semibold mb-4 text-lg">Informasi Kontak</h4>
        <ul class="space-y-3 text-gray-300 text-sm">
          <li class="flex items-start gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>Jl. Contoh No.123, Kota Sidoarjo</span>
          </li>

          <li class="flex items-start gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <a href="mailto:info@siputra.example" class="text-white underline">info@siputra.example</a>
          </li>

          <li class="flex items-start gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <a href="tel:+6281234567890" class="text-white underline">+62 812-3456-7890</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-10 border-t pt-6 text-center">
      <p class="text-gray-300 text-sm">
        &copy; {{ date('Y') }} SIPUTRA Project. All rights reserved.
      </p>
    </div>
  </div>
</footer>