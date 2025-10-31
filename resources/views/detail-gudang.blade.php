@extends('layouts.app')

@section('title', 'Detail Gudang ')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <!-- Breadcrumb -->
  <nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
    <a href="/gudang" class="hover:text-[#134686] transition-colors">Katalog Gudang</a>
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
    <span class="text-gray-900 font-medium">Detail Gudang</span>
  </nav>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Image Gallery -->
    <div class="lg:col-span-2">
      <div class="bg-white rounded-xl shadow-sm overflow-hidden h-full">
        <!-- Main Image -->
        <div class="relative aspect-w-16 aspect-h-10 bg-gray-100">
          <img id="mainImage" src="" alt="" class="w-full h-96 object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>

        <!-- Thumbnails -->
        <div class="p-4 border-t">
          <div id="thumbnailContainer" class="flex gap-2 overflow-x-auto scrollbar-hide">
            <!-- Thumbnails akan diisi JS -->
          </div>
        </div>
      </div>
    </div>

    <!-- Info Panel -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">
        <!-- Status Badge -->
        <div class="flex justify-between items-start mb-4">
          <h1 id="gudangNama" class="text-2xl font-bold text-gray-900"></h1>
          <span id="statusBadge" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-full shadow-md">
            <!-- JS akan isi -->
          </span>
        </div>

        <p id="gudangAlamat" class="text-lg text-gray-700 mb-4"></p>

        <!-- Price -->
        <div class="mb-6">
          <p class="text-3xl font-bold text-[#134686]" id="gudangHarga"></p>
          <p class="text-sm text-gray-500">per bulan</p>
        </div>

        <!-- Specs -->
        <div class="space-y-3 mb-6 pb-6 border-b">
          <div class="flex justify-between">
            <span class="text-gray-600">Kapasitas</span>
            <span id="gudangKapasitas" class="font-medium"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Luas Gudang</span>
            <span id="luasGudang" class="font-medium"></span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Tipe Penyimpanan</span>
            <span id="tipePenyimpanan" class="font-medium"></span>
          </div>
        </div>

        <!-- WhatsApp Button -->
        <a id="whatsappBtn" href="#" target="_blank"
           class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition-all transform hover:scale-105">
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#ffffff"></path> </g></svg>
          Hubungi via WhatsApp
        </a>

        <!-- Back Button -->
        <button onclick="history.back()" 
                class="mt-3 w-full px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
          Kembali ke Katalog
        </button>
      </div>
    </div>
  </div>

  <!-- Description & Specs -->
  <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Description -->
    <div class="bg-white rounded-xl shadow-sm p-6">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi Gudang</h2>
      <p id="deskripsi" class="text-gray-700 leading-relaxed"></p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Fasilitas & Keamanan</h2>
      <ul id="fasilitasList" class="space-y-3 text-gray-700">
        <!-- JS akan isi -->
      </ul>
    </div>
  </div>
</div>

<script>
// === DATA GUDANG (Nanti dari backend, sekarang dari URL atau JS) ===
const gudangData = {
  1: {
    id: 1,
    nama: 'Gudang 1',
    alamat: 'Jl. Raya Gelora Bumiputera No. 12, Sidoarjo',
    gambar: ['gudang-1.png', 'isi-gudang-1.jpeg', 'isi-gudang-1-2.jpeg'],
    harga: 20000000,
    kapasitas: '5000kg',
    status: 'Bisa Disewa',
    luas: '250 m²',
    tipe: 'Cold Storage',
    deskripsi: 'Gudang modern dengan sistem pendingin otomatis, ideal untuk penyimpanan ikan segar dan produk beku. Dilengkapi CCTV 24 jam, akses truk 24 jam, dan tim keamanan profesional.',
    fasilitas: [
      'Sistem pendingin -18°C',
      'CCTV 24 jam & security',
      'Loading dock 2 pintu',
      'Akses truk kontainer',
      'Listrik 3 phase',
      'Drainase anti banjir'
    ],
    whatsapp: '+6281234567890'
  },
  2: {
    id: 2,
    nama: 'Gudang 2',
    alamat: 'Jl. Industri Raya No. 45, Sidoarjo',
    gambar: ['gudang-2.png', 'gudang-2-2.jpeg'],
    harga: 40000000,
    kapasitas: '1000kg',
    status: 'Tidak Bisa Disewa',
    luas: '100 m²',
    tipe: 'Dry Storage',
    deskripsi: 'Gudang kering untuk penyimpanan produk non-perishable. Cocok untuk ikan kaleng, kemasan, atau barang tahan lama.',
    fasilitas: [
      'Ventilasi alami',
      'Rak penyimpanan 3 tingkat',
      'Akses forklift',
      'Area bongkar muat tertutup'
    ],
    whatsapp: '+6281234567890'
  }
};

function getGudangId() {
  const path = window.location.pathname;
  const matches = path.match(/\/gudang\/(\d+)/);
  return matches ? matches[1] : '1';
}

// === Format Helper ===
function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(angka);
}

function formatKapasitas(kg) {
  const num = kg.replace(/[^0-9]/g, '');
  return `${num.replace(/\B(?=(\d{3})+(?!\d))/g, ".")} kg`;
}

// === Render Detail ===
function renderDetail() {
  const id = getGudangId();
  const gudang = gudangData[id];

  if (!gudang) {
    document.body.innerHTML = '<div class="text-center py-20"><h1 class="text-2xl font-bold text-red-600">Gudang tidak ditemukan</h1></div>';
    return;
  }

  // Update title
  document.title = `Detail Gudang - ${gudang.nama} | SIPUTRA`;

  // Main Image & Thumbnails
  const mainImg = document.getElementById('mainImage');
  const thumbContainer = document.getElementById('thumbnailContainer');

  mainImg.src = `{{ asset('images') }}/${gudang.gambar[0]}`;
  mainImg.alt = gudang.nama;

  thumbContainer.innerHTML = '';
  gudang.gambar.forEach((img, index) => {
    const thumb = document.createElement('button');
    thumb.className = `flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all ${index === 0 ? 'border-[#134686]' : 'border-gray-300'}`;
    thumb.innerHTML = `<img src="{{ asset('images') }}/${img}" alt="Thumb ${index+1}" class="w-full h-full object-cover">`;
    thumb.onclick = () => {
      mainImg.src = `{{ asset('images') }}/${img}`;
      document.querySelectorAll('#thumbnailContainer button').forEach(t => t.classList.remove('border-[#134686]'));
      thumb.classList.add('border-[#134686]');
    };
    thumbContainer.appendChild(thumb);
  });

  // Info
  document.getElementById('gudangNama').textContent = gudang.nama;
  document.getElementById('gudangAlamat').textContent = gudang.alamat;
  document.getElementById('gudangHarga').textContent = formatRupiah(gudang.harga);
  document.getElementById('gudangKapasitas').textContent = formatKapasitas(gudang.kapasitas);

  // Status Badge
  const statusBadge = document.getElementById('statusBadge');
  statusBadge.innerHTML = `
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      ${gudang.status === 'Bisa Disewa' 
        ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' 
        : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'}
    </svg>
    ${gudang.status}
  `;
  statusBadge.className = `inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-full shadow-md transition-colors
    ${gudang.status === 'Bisa Disewa' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'}`;

  // Spesifikasi
  document.getElementById('luasGudang').textContent = gudang.luas;
  document.getElementById('tipePenyimpanan').textContent = gudang.tipe;

  // Deskripsi
  document.getElementById('deskripsi').textContent = gudang.deskripsi;

  // Fasilitas
  const fasilitasList = document.getElementById('fasilitasList');
  fasilitasList.innerHTML = '';
  gudang.fasilitas.forEach(fas => {
    const li = document.createElement('li');
    li.className = 'flex items-center gap-2';
    li.innerHTML = `
      <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      <span>${fas}</span>
    `;
    fasilitasList.appendChild(li);
  });

  // WhatsApp Link
  const waMsg = encodeURIComponent(`Halo, saya tertarik menyewa *${gudang.nama}* di ${gudang.alamat}. Harga: ${formatRupiah(gudang.harga)}/bulan. Apakah masih tersedia?`);
  document.getElementById('whatsappBtn').href = `https://wa.me/${gudang.whatsapp.replace(/[^0-9]/g, '')}?text=${waMsg}`;
}

// === Inisialisasi ===
document.addEventListener('DOMContentLoaded', renderDetail);
</script>
@endsection