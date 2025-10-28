@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
{{-- Hero Section --}}
<section class="relative bg-[#134686] text-white py-20">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-8 items-center px-6">
    <div class="w-full md:w-1/2 space-y-6">
      <h1 class="text-xl md:text-4xl font-bold leading-tight">
        Temukan Produk & Cerita Perusahaan Kami
      </h1>
      <p class="text-gray-300">
        Siputra menyajikan katalog produk dan informasi seputar perusahaan yang transparan dan mudah diakses
      </p>
      <a href="{{ url('/katalog') }}" class="inline-block bg-white text-[#134686] font-semibold px-6 py-3 rounded-lg hover:bg-gray-200 transition">
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

{{-- Produk Unggulan Section --}}
<section id="produk" class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-semibold mb-10 text-[#134686]">Produk Unggulan Kami</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach ([
        ['id' => '1', 'name' => 'Ikan Tuna', 'price' => 'Rp. 35.000/kg', 'image' => 'images/ikan-tuna.png'],
        ['id' => '2', 'name' => 'Ikan Kakap Merah', 'price' => 'Rp. 13.500/kg', 'image' => 'images/ikan-kakap-merah.png'],
        ['id' => '5', 'name' => 'Ikan Kembung', 'price' => 'Rp. 19.500/kg', 'image' => 'images/ikan-kembung.png'],
        ['id' => '6', 'name' => 'Ikan Layang', 'price' => 'Rp. 13.500/kg', 'image' => 'images/ikan-layang.png']
      ] as $produk)
        <a href="/katalog/{{ $produk['id'] }}" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow cursor-pointer group">
          <div class="aspect-w-16 aspect-h-12 bg-gray-200">
            <img src="{{ $produk['image'] }}" alt="{{ $produk['name'] }}" 
              class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
          </div>
          <div class="p-4 text-left">
            <h3 class="font-semibold text-base text-gray-900 mb-1">{{ $produk['name'] }}</h3>
            <p class="text-sm text-gray-500 mb-2">{{ $produk['name'] }}</p>
            <p class="text-[#134686] font-bold text-base">{{ $produk['price'] }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

{{-- Kenapa Memilih Kami Section --}}
<section class="py-20 bg-white">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-semibold mb-8 text-[#134686]">Mengapa Memilih SIPUTRA?</h2>
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

{{-- Tombol CTA Section --}}
<section class="py-16 bg-[#134686] text-white text-center">
  <h2 class="text-3xl font-semibold mb-4">Tertarik dengan produk kami?</h2>
  <p class="text-gray-300 mb-8">Lihat katalog lengkap atau pesan via WhatsApp untuk pembelian secara langsung.</p>
  <div class="flex justify-center gap-4">
    <a href="{{ url('/katalog') }}" class="bg-white text-[#134686] font-semibold px-6 py-3 rounded-lg hover:bg-gray-200 transition">Lihat Katalog</a>
    <a href="https://wa.me/6281234567890" target="_blank" class="border border-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:text-[#134686] transition">
      Pesan via WhatsApp
    </a>
  </div>
</section>

{{-- Testimonial Section --}}
<section class="py-20 bg-gray-50">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h2 class="text-3xl font-semibold mb-10 text-[#134686]">Apa Kata Pelanggan Kami?</h2>
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
@endsection