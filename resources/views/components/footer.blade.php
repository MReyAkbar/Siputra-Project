<footer class="bg-[#134686] text-white">
  <div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-6 gap-8">
      <div class="space-y-4 col-span-2">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
          <img src="images/siputra-logo.png" class="w-12 h-auto rounded-full" alt="logo siputra">
          <div class="flex flex-col">
            <h3 class="text-2xl font-semibold">SIPUTRA</h3>
            <p class="text-sm font-semibold">Sistem Informasi Putra Samudra</p>
          </div>
        </a>
        <p class="text-gray-300 text-sm max-w-xs">
          SIPUTRA — Sistem informasi produk & profil perusahaan. Temukan katalog, info, dan layanan kami dengan mudah.
        </p>
        <a href="https://wa.me/6281234567890" target="_blank"
          class="inline-flex items-center gap-2 bg-green-500 text-white px-3 py-2 rounded-md text-sm hover:opacity-95">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M20.52 3.48A11.9 11.9 0 0012 .5 11.9 11.9 0 003.48 3.48 11.9 11.9 0 00.5 12c0 2.1.55 4.06 1.6 5.8L.5 23l5.4-1.4A11.9 11.9 0 0012 23.5c2.1 0 4.06-.55 5.8-1.6A11.9 11.9 0 0023.5 12a11.9 11.9 0 00-1-4.52zM12 21a9 9 0 01-4.6-1.17l-.33-.2-3.2.83.85-3.12-.21-.32A9 9 0 1121 12 9 9 0 0112 21z"/>
          </svg>
          Chat via WhatsApp
        </a>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-4">Navigasi</h4>
        <ul class="space-y-3 text-gray-300">
          <li><a href="{{ url('/') }}" class="hover:text-white">Beranda</a></li>
          <li><a href="#produk" class="hover:text-white">Katalog</a></li>
          <li><a href="{{ url('/') }}" class="hover:text-white">Tentang Kami</a></li>
        </ul>
      </div>

      <div>
        <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
        <div class="flex items-center gap-4">
          <a href="https://instagram.com/yourprofile" target="_blank" class="text-gray-300 hover:text-white" aria-label="Instagram">
            <i class="fa-brands fa-instagram text-2xl"></i>
          </a>
          <a href="https://facebook.com/yourpage" target="_blank" class="text-gray-300 hover:text-white" aria-label="Facebook">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7H8.9v-2.9h1.6V9.4c0-1.6 1-2.5 2.4-2.5.7 0 1.4.1 1.4.1v1.6h-.8c-.8 0-1 0-1 1v1.2h1.8l-.3 2.9h-1.5v7A10 10 0 0022 12z"/></svg>
          </a>
          <a href="#" class="text-gray-300 hover:text-white" aria-label="LinkedIn">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5A2.5 2.5 0 102.48 6a2.5 2.5 0 002.5-2.5zM3 8.98h3.96V21H3V8.98zM9.5 8.98H13v1.63h.05c.52-.99 1.8-2.03 3.7-2.03 4 0 4.75 2.63 4.75 6.05V21h-3.96v-5.1c0-1.22-.02-2.79-1.7-2.79-1.7 0-1.96 1.32-1.96 2.68V21H9.5V8.98z"/></svg>
          </a>
        </div>
        <p class="text-gray-400 text-sm mt-4">Butuh bantuan? <a href="/contact" class="text-white underline">Hubungi Kami</a></p>
      </div>

      <div class="col-span-2">
        <h4 class="text-white font-semibold mb-4">Informasi Kontak</h4>
        <p class="text-gray-300 text-sm">Jl. Contoh No.123, Kota Sidoarjo</p>
        <p class="text-gray-300 text-sm mt-3">Email: <a href="mailto:info@siputra.example" class="text-white underline">info@siputra.example</a></p>
        <p class="text-gray-300 text-sm mt-3">Telepon: <a href="tel:+6281234567890" class="text-white underline">+62 812-3456-7890</a></p>
      </div>
    </div>

    <div class="mt-10 border-t pt-6 text-center">
      <p class="text-gray-300 text-sm">
        &copy; {{ date('Y') }} SIPUTRA Project. All rights reserved.
      </p>
    </div>
  </div>
</footer>