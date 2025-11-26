@extends('layouts.app')

@section('title', 'Detail Produk - SIPUTRA')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

	<nav class="flex mb-6" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
          <a href="{{ url('/katalog') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#134686]">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            Katalog
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="ml-1 text-sm font-medium text-[#134686] md:ml-2">Katalog Ikan</span>
          </div>
        </li>
      </ol>
    </nav>

	<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 lg:p-8">
			<div class="relative">
				<div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden bg-gray-100">
					<img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('images/default-ikan.png') }}" class="w-full h-full object-cover" alt="{{ $item->ikan->nama }}">
				</div>

				<div class="absolute top-4 right-4">
					<span class="inline-flex items-center gap-1 px-4 py-2 bg-[#134686] text-white text-sm font-semibold rounded-full shadow-md">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
							<path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
						</svg>
						Stok Tersedia: {{ $item->ikan->stok ?? 0 }} kg
					</span>
				</div>
			</div>

			<div class="flex flex-col">
				<div class="mb-4">
					<h1 class="text-4xl font-bold text-gray-900 mb-2">
						{{ $item->ikan->nama }}
					</h1>
					<p class="text-lg text-gray-600 capitalize">
						Kategori: {{ $item->ikan->kategori->nama_kategori ?? 'Tidak Diketahui' }}
					</p>
				</div>

				<div class="mb-6">
					<p class="text-4xl font-bold text-[#134686]">
						Rp{{ number_format($item->harga_jual, 0, ',', '.') }}/Kg
					</p>
				</div>

				<div class="mb-6 pb-6 border-b border-gray-200">
					<h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Produk</h3>
					<p class="text-gray-600 leading-relaxed">
						{{ $item->deskripsi ?? '-' }}
					</p>
				</div>

				<div class="mb-6">
					<label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
						Jumlah (Kg)
					</label>
					<div class="flex items-center gap-3">
						<button onclick="decreaseQuantity()" class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
							<svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
							</svg>
						</button>

						<input type="number" id="quantity" value="1" min="1" class="w-32 px-4 py-3 text-center text-lg font-semibold border-2 border-gray-300 rounded-lg focus:ring-[#134686] focus:border-[#134686]">

						<button onclick="increaseQuantity()" 
							class="w-12 h-12 flex items-center justify-center bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
							<svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
							</svg>
						</button>
					</div>
				</div>

				<div class="flex flex-col sm:flex-row gap-3 mt-auto">
					<button onclick="addToCart()" class="flex-1 flex items-center justify-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-[#134686] font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
						</svg>
						Tambah ke Keranjang
					</button>

					<button onclick="orderNow()" class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-4 rounded-xl transition-all shadow-md hover:shadow-lg">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
							<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
						</svg>
						Pesan Sekarang
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
		<div class="group bg-white p-8 text-center rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] transform hover:-translate-y-2">
			<div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
				<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
				</svg>
			</div>
			<h3 class="font-semibold text-gray-900 mb-2">Kualitas Terjamin</h3>
			<p class="text-sm text-gray-600">Produk ikan segar dengan kualitas premium terjamin</p>
		</div>

		<div class="group bg-white p-8 text-center rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] transform hover:-translate-y-2">
			<div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
				<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
				</svg>
			</div>
			<h3 class="font-semibold text-gray-900 mb-2">Sumber Terpercaya</h3>
			<p class="text-sm text-gray-600">Berasal dari nelayan lokal berpengalaman dan perairan yang terkelola</p>
		</div>

		<div class="group bg-white p-8 text-center rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-[#134686] transform hover:-translate-y-2">
			<div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#134686] to-[#0C3C65] rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all">
				<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
				</svg>
			</div>
			<h3 class="font-semibold text-gray-900 mb-2">Harga Terbaik</h3>
			<p class="text-sm text-gray-600">Dapatkan harga terbaik langsung dari sumbernya</p>
		</div>
	</div>
</div>

<script>
// Quantity controls
function increaseQuantity() {
	const input = document.getElementById('quantity');
	const maxStock = {{ $item->ikan->stokGudang()->sum('jumlah_stok') ?? 0 }};
	const currentValue = parseInt(input.value);
	
	if (currentValue < maxStock) {
		input.value = currentValue + 1;
	} else {
		showToast('error', `Maksimal stok tersedia: ${maxStock} kg`);
	}
}

function decreaseQuantity() {
	const input = document.getElementById('quantity');
	const currentValue = parseInt(input.value);
	
	if (currentValue > 1) {
		input.value = currentValue - 1;
	}
}

/**
 * Add to cart with quantity from input
 */
function addToCart() {
	@guest
		showToast('error', 'Silakan login terlebih dahulu untuk menambahkan ke keranjang');
		setTimeout(() => {
			window.location.href = '{{ route("login") }}';
		}, 1500);
		return;
	@endguest

	const quantity = parseInt(document.getElementById('quantity').value);
	const catalogItemId = {{ $item->id }};
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	
	// Validate quantity
	if (quantity < 1) {
		showToast('error', 'Jumlah minimal 1 kg');
		return;
	}
	
	const maxStock = {{ $item->ikan->stokGudang()->sum('jumlah_stok') ?? 0 }};
	if (quantity > maxStock) {
		showToast('error', `Stok tidak mencukupi. Maksimal: ${maxStock} kg`);
		return;
	}
	
	// Get the button and show loading state
	const button = event.target;
	const originalContent = button.innerHTML;
	button.disabled = true;
	button.innerHTML = `
		<svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
					d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
		</svg>
		<span>Menambahkan...</span>
	`;
	
	// Send AJAX request
	fetch('{{ route("cart.add") }}', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': csrfToken,
			'Accept': 'application/json'
		},
		body: JSON.stringify({
			catalog_item_id: catalogItemId,
			jumlah: quantity
		})
	})
	.then(response => response.json())
	.then(data => {
		// Restore button
		button.disabled = false;
		button.innerHTML = originalContent;
		
		if (data.success) {
			// Show success notification
			showToast('success', data.message);
			
			// Update cart badge
			if (typeof updateCartBadge === 'function') {
					updateCartBadge();
			}
			
			// Reset quantity to 1
			document.getElementById('quantity').value = 1;
		} else {
			// Show error notification
			showToast('error', data.message);
		}
	})
	.catch(error => {
		// Restore button
		button.disabled = false;
		button.innerHTML = originalContent;
		
		console.error('Error adding to cart:', error);
		showToast('error', 'Terjadi kesalahan. Silakan coba lagi.');
	});
}

/**
 * Order now - redirect to cart after adding
 */
function orderNow() {
	@guest
		showToast('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan');
		setTimeout(() => {
			window.location.href = '{{ route("login") }}';
		}, 1500);
		return;
	@endguest

	const quantity = parseInt(document.getElementById('quantity').value);
	const catalogItemId = {{ $item->id }};
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
	
	// Validate quantity
	if (quantity < 1) {
		showToast('error', 'Jumlah minimal 1 kg');
		return;
	}
	
	const maxStock = {{ $item->ikan->stokGudang()->sum('jumlah_stok') ?? 0 }};
	if (quantity > maxStock) {
		showToast('error', `Stok tidak mencukupi. Maksimal: ${maxStock} kg`);
		return;
	}
	
	// Get the button and show loading state
	const button = event.target;
	const originalContent = button.innerHTML;
	button.disabled = true;
	button.innerHTML = `
		<svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
						d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
		</svg>
		<span>Memproses...</span>
	`;
	
	// Send AJAX request
	fetch('{{ route("cart.add") }}', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': csrfToken,
			'Accept': 'application/json'
		},
		body: JSON.stringify({
			catalog_item_id: catalogItemId,
			jumlah: quantity
		})
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			// Redirect to cart page
			showToast('success', 'Mengarahkan ke keranjang...');
			setTimeout(() => {
					window.location.href = '{{ route("cart.index") }}';
			}, 800);
		} else {
			// Restore button and show error
			button.disabled = false;
			button.innerHTML = originalContent;
			showToast('error', data.message);
		}
	})
	.catch(error => {
		// Restore button
		button.disabled = false;
		button.innerHTML = originalContent;
		
		console.error('Error:', error);
		showToast('error', 'Terjadi kesalahan. Silakan coba lagi.');
	});
}
</script>

@endsection
