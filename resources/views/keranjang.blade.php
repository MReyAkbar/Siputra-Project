@extends('layouts.app')

@section('title', 'Keranjang - SIPUTRA')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-8">
      <a href="/katalog" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Katalog
      </a>
      <h1 class="text-3xl font-bold text-gray-900 mt-4 flex items-center gap-3">
        <svg class="w-8 h-8 text-[#134686]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        Keranjang Belanja Anda
      </h1>
    </div>

    {{-- Tabel Keranjang --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50 border-b border-gray-900">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody id="cartItems" class="divide-y divide-gray-200">
          </tbody>
        </table>
      </div>

      {{-- Pesan jika keranjang kosong --}}
      <div id="emptyCart" class="hidden text-center py-16 px-6">
        <svg class="mx-auto w-20 h-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Keranjang kosong</h3>
        <p class="text-gray-600 mb-6">Yuk, tambahkan ikan favoritmu!</p>
        <a href="/katalog" class="inline-flex items-center gap-2 px-6 py-3 bg-[#134686] text-white font-semibold rounded-lg hover:bg-[#0d3566] transition-all">
          Mulai Belanja
        </a>
      </div>
    </div>

    {{-- Checkout Section --}}
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2"></div>
      <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>
        <div class="space-y-3 mb-6">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Item</span>
            <span id="totalItems" class="font-medium">0</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">Total Berat</span>
            <span id="totalWeight" class="font-medium">0 Kg</span>
          </div>
          <div class="flex justify-between text-lg font-bold text-gray-900 pt-3 border-t">
            <span>Total Harga</span>
            <span id="totalPrice">Rp 0</span>
          </div>
        </div>
        <a href="https://wa.me/6286969696969?text=Halo,%20saya%20ingin%20memesan:%0A" 
           target="_blank" id="checkoutBtn"
           class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-md transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed"
           disabled>
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z" fill="#ffffff"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z" fill="#ffffff"></path> </g></svg>
          Bayar Sekarang
        </a>
        <p class="text-xs text-gray-500 text-center mt-3">
          Pesanan langsung diproses oleh tim kami
        </p>
      </div>
    </div>
  </div>
</div>

<script>
let cart = [
  {
    id: 1,
    name: 'Tuna',
    image: '{{ asset("images/ikan-tuna.png") }}',
    price: 35000,
    quantity: 2,
    size: '10-15'
  },
  {
    id: 5,
    name: 'Kembung',
    image: '{{ asset("images/ikan-kembung.png") }}',
    price: 19500,
    quantity: 3,
    size: '10-15'
  },
  {
    id: 2,
    name: 'Kakap Merah',
    image: '{{ asset("images/ikan-kakap-merah.png") }}',
    price: 13500,
    quantity: 1,
    size: '20-25'
  }
];

function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(angka);
}

function editQuantity(index) {
  const item = cart[index];
  const newQty = prompt(`Masukkan jumlah baru untuk ${item.name} (saat ini: ${item.quantity} Kg):`, item.quantity);

  if (newQty === null) return;

  const qty = parseInt(newQty);
  if (isNaN(qty) || qty < 1) {
    alert('Jumlah harus angka dan minimal 1 Kg');
    return;
  }

  item.quantity = qty;
  renderCartItems();
}

function removeItem(index) {
  const item = cart[index];
  if (confirm(`Hapus ${item.name} dari keranjang?`)) {
    cart.splice(index, 1);
    renderCartItems();
  }
}

function renderCartItems() {
  const tbody = document.getElementById('cartItems');
  const emptyState = document.getElementById('emptyCart');

  tbody.innerHTML = '';

  if (cart.length === 0) {
    emptyState.classList.remove('hidden');
    updateSummary(0, 0, 0);
    document.getElementById('checkoutBtn').disabled = true;
    return;
  }

  emptyState.classList.add('hidden');

  let totalItems = 0;
  let totalWeight = 0;
  let totalPrice = 0;
  let waMessage = "Halo, saya ingin memesan:%0A%0A";

  cart.forEach((item, index) => {
    const subtotal = item.price * item.quantity;
    totalItems += item.quantity;
    totalWeight += item.quantity;
    totalPrice += subtotal;

    waMessage += `${item.quantity}Kg ${item.name} - ${formatRupiah(item.price)}/Kg = ${formatRupiah(subtotal)}%0A`;

    const row = document.createElement('tr');
    row.className = 'hover:bg-gray-50 transition-colors';
    row.innerHTML = `
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center gap-4">
          <img src="${item.image}" alt="${item.name}" 
               class="w-16 h-16 object-cover rounded-lg shadow-sm"
               onerror="this.src='https://via.placeholder.com/64?text=${encodeURIComponent(item.name)}'">
          <div>
            <h4 class="font-semibold text-gray-900">${item.name}</h4>
            <p class="text-sm text-gray-500">Size ${item.size} up</p>
          </div>
        </div>
      </td>
      <td class="px-6 py-4">
        <span class="font-medium text-gray-900">${formatRupiah(item.price)}/Kg</span>
      </td>
      <td class="px-6 py-4 text-center">
        <span class="inline-block w-16 text-center font-medium">${item.quantity} Kg</span>
      </td>
      <td class="px-6 py-4 text-right">
        <span class="font-semibold text-gray-900">${formatRupiah(subtotal)}</span>
      </td>
      <td class="px-6 py-4 text-center">
        <div class="flex items-center justify-center gap-2">
          <!-- Tombol Edit Jumlah -->
          <button onclick="editQuantity(${index})"
                  class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit
          </button>

          <!-- Tombol Hapus -->
          <button onclick="removeItem(${index})"
                  class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Hapus
          </button>
        </div>
      </td>
    `;
    tbody.appendChild(row);
  });

  waMessage += `%0A*Total: ${formatRupiah(totalPrice)}*`;
  const checkoutBtn = document.getElementById('checkoutBtn');
  checkoutBtn.href = `https://wa.me/6286969696969?text=${waMessage}`;
  checkoutBtn.disabled = false;

  updateSummary(totalItems, totalWeight, totalPrice);
}

function updateSummary(items, weight, price) {
  document.getElementById('totalItems').textContent = items;
  document.getElementById('totalWeight').textContent = `${weight} Kg`;
  document.getElementById('totalPrice').textContent = formatRupiah(price);
}

document.addEventListener('DOMContentLoaded', () => {
  renderCartItems();
});
</script>
@endsection