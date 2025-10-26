<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIPUTRA | Beranda</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/c751376482.js" crossorigin="anonymous"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="antialiased bg-gray-100 text-gray-900">

    <header class="bg-[#134686] text-white sticky top-0 z-50">
      <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
        <a href="/" class="flex items-center gap-3">
          <img src="images/siputra-logo.png" class="w-12 h-auto rounded-full" alt="logo siputra">
          <div class="flex flex-col">
            <h3 class="text-2xl font-semibold">SIPUTRA</h3>
            <p class="text-sm font-semibold">Sistem Informasi Putra Samudra</p>
          </div>
        </a>
        <nav>
          <ul class="flex space-x-6">
            <li><a href="#" class="font-bold hover:text-gray-200 hover:font-medium">Beranda</a></li>
            <li><a href="#" class="font-bold hover:text-gray-200 hover:font-medium">Katalog</a></li>
            <li><a href="#" class="font-bold hover:text-gray-200 hover:font-medium">Gudang</a></li>
            <li><a href="#" class="font-bold hover:text-gray-200 hover:font-medium">Tentang Kami</a></li>
          </ul>
        </nav>

        <div class="flex space-x-4">
          <button class="font-bold px-4 py-1 rounded hover:bg-[#0C3C65] hover:rounded-xl transition-all duration-200">Sign Up</button>
          <button class="bg-[#0C3C65] font-bold px-5 py-2 rounded-xl hover:bg-white hover:text-[#134686] transition-all duration-200">Log In</button>
        </div>
      </div>
    </header>

    <main>
      <section class="relative bg-[#134686] text-white py-20">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-1 items-center px-6">
          <div class="w-full md:w-1/2 space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
              Temukan Produk & Cerita Perusahaan Kami
            </h1>
            <p class="text-gray-300 text-lg">
              Siputra menyajikan katalog produk dan informasi seputar perusahaan yang transparan dan mudah diakses
            </p>
            <a href="#produk" class="inline-block bg-white text-[#134686] font-semibold px-6 py-3 rounded-lg hover:bg-gray-200 transition">
              Lihat Katalog
            </a>
          </div>
          <div class="w-full md:w-1/2 mt-10 md:mt-0">
            <div class="bg-gray-300 w-full h-64 rounded-lg flex items-center justify-center">
              <p class="text-blue-950 font-semibold">[ Gambar Hero / Poster ]</p>
            </div>
          </div>
        </div>
      </section>

      <section id="produk" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
          <h2 class="text-3xl font-bold mb-10 text-[#134686]">Produk Unggulan Kami</h2>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ([
              ['name' => 'Ikan Tuna', 'price' => 'Rp. 35.000/kg', 'image' => 'images/ikan-tuna.png'],
              ['name' => 'Ikan Kakap Merah', 'price' => 'Rp. 13.500/kg', 'image' => 'images/ikan-kakap-merah.png'],
              ['name' => 'Ikan Kembung', 'price' => 'Rp. 19.500/kg', 'image' => 'images/ikan-kembung.png'],
              ['name' => 'Ikan Layang', 'price' => 'Rp. 13.500/kg', 'image' => 'images/ikan-layang.png']
            ] as $produk)
              <div class="bg-white rounded-xl shadow-md overflow-hidden hover:scale-105 transition transform">
                <img src="{{ $produk['image'] }}" alt="{{ $produk['name'] }}" class="w-full h-40 object-cover">
                <div class="p-4">
                  <h3 class="text-lg font-semibold">{{ $produk['name'] }}</h3>
                  <p class="text-[#134686] font-bold mt-2">{{ $produk['price'] }}</p>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>

      <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
          <h2 class="text-3xl font-bold mb-8 text-[#134686]">Mengapa Memilih SIPUTRA?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-10">
            <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition">
              <h3 class="font-semibold text-xl mb-2 text-[#134686]">✅ Kualitas Terjamin</h3>
              <p class="text-gray-600">Kami berkomitmen untuk selalu memastikan setiap produk yang Anda terima aman, bersih, dan berkualitas premium.</p>
            </div>
            <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition">
              <h3 class="font-semibold text-xl mb-2 text-[#134686]0">⛵ Sumber Terpercaya</h3>
              <p class="text-gray-600"> Ikan kami berasal dari nelayan lokal dan perairan yang kami kelola secara bertanggung jawab.</p>
            </div>
            <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition">
              <h3 class="font-semibold text-xl mb-2 text-[#134686]">⚡ Layanan Cepat</h3>
              <p class="text-gray-600">SIPUTRA dirancang untuk membantu Anda, mulai dari pemilihan produk hingga informasi pengiriman.</p>
            </div>
          </div>
        </div>
      </section>

      <section class="py-16 bg-[#134686] text-white text-center">
        <h2 class="text-3xl font-semibold mb-4">Tertarik dengan produk kami?</h2>
        <p class="text-gray-300 mb-8">Lihat katalog lengkap atau pesan via WhatsApp untuk pembelian secara langsung.</p>
        <div class="flex justify-center gap-4">
          <a href="#produk" class="bg-white text-[#134686] font-semibold px-6 py-3 rounded-lg hover:bg-gray-200 transition">Lihat Katalog</a>
          <a href="https://wa.me/6281234567890" target="_blank" class="border border-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-[#134686] transition">
            Pesan via WhatsApp
          </a>
        </div>
      </section>

      <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
          <h2 class="text-3xl font-bold mb-10 text-[#134686]">Apa Kata Pelanggan Kami?</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
              <p class="text-gray-600 italic">“Sangat terbantu oleh sistem ini dalam memesan produk!”</p>
              <h4 class="mt-4 font-semibold text-[#134686]">— Reyhan</h4>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
              <p class="text-gray-600 italic">“Tampilan modern dan fitur yang lengkap. Saya Suka!”</p>
              <h4 class="mt-4 font-semibold text-[#134686]">— Dwicky</h4>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
              <p class="text-gray-600 italic">“Barangnya berkualitas dan aman sampai tujuan. Recommended banget!”</p>
              <h4 class="mt-4 font-semibold text-[#134686]">— Sheril</h4>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="bg-[#134686] text-white">
      <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-8">
          <div class="space-y-4 col-span-2">
            <a href="/" class="inline-flex items-center gap-3">
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
              <li><a href="/" class="hover:text-white">Beranda</a></li>
              <li><a href="#produk" class="hover:text-white">Katalog</a></li>
              <li><a href="/" class="hover:text-white">Tentang Kami</a></li>
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
  </body>
</html>
