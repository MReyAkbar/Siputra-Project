@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Edit Customer</h1>
					<p class="mt-1 text-sm text-gray-600">Ubah data customer: <span class="font-medium">{{ $customer->nama_customer }}</span></p>
				</div>
				<a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
					</svg>
					Kembali
				</a>
			</div>
		</div>
	</div>

	<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
			<div class="p-8 bg-gradient-to-br from-[#134686] to-[#0d3566]" x-data="editCustomerForm()">
				<form @submit.prevent="submitForm" novalidate>
					@csrf
					@method('PUT')

					<div x-show="errors.length" class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
						<ul class="list-disc pl-5 space-y-1">
							<template x-for="error in errors" :key="error">
								<li x-text="error"></li>
							</template>
						</ul>
					</div>

					<div class="mb-6">
						<label class="block text-white text-sm font-semibold mb-2">
							Nama Customer <span class="text-red-300">*</span>
						</label>
						<input 
							x-model="form.nama_customer" 
							type="text" 
							required 
							placeholder="Masukkan nama lengkap..." 
							class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
							:class="{'ring-2 ring-red-500': errors.some(e => e.toLowerCase().includes('nama'))}"
						>
					</div>

					<div class="mb-6">
						<label class="block text-white text-sm font-semibold mb-2">Nomor HP</label>
						<input 
							x-model="form.no_hp" 
							type="number" 
							placeholder="081234567890" 
							class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
							:class="{'ring-2 ring-red-500': errors.some(e => e.toLowerCase().includes('hp'))}"
						>
					</div>

					<div class="mb-8">
						<label class="block text-white text-sm font-semibold mb-2">Alamat</label>
						<textarea 
							x-model="form.alamat" 
							rows="4"
							placeholder="Masukkan alamat lengkap..." 
							class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 resize-none"
							:class="{'ring-2 ring-red-500': errors.some(e => e.includes('alamat'))}"
						></textarea>
					</div>

					<div class="flex justify-end gap-4">
						<a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
							Batal
						</a>
						<button 
							type="submit" 
							:disabled="loading"
							class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition flex items-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed"
						>
							<span x-show="loading" class="animate-spin">
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
									<path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
								</svg>
							</span>
							<span x-text="loading ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
function editCustomerForm() {
	return {
		loading: false,
		errors: [],

		form: {
			nama_customer: "{{ old('nama_customer', $customer->nama_customer) }}",
			no_hp: "{{ old('no_hp', $customer->no_hp) }}",
			alamat: "{{ old('alamat', $customer->alamat) }}"
		},

		async submitForm() {
			this.errors = [];
			this.loading = true;

			// Client-side validation
			if (!this.form.nama_customer.trim()) {
				this.errors.push('Nama customer wajib diisi.');
			}

			if (this.errors.length > 0) {
				this.loading = false;
				return;
			}

			const formData = new FormData();
			formData.append('nama_customer', this.form.nama_customer);
			formData.append('no_hp', this.form.no_hp || '');
			formData.append('alamat', this.form.alamat || '');
			formData.append('_method', 'PUT');

			try {
				const response = await fetch("{{ route('manajemen.pengguna.manage-customer.update', $customer) }}", {
					method: 'POST',
					body: formData,
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}',
						'Accept': 'application/json'
					}
				});

				const result = await response.json();

				if (response.ok) {
					alert('Customer berhasil diperbarui!');
					window.location.href = '{{ route("manajemen.pengguna.manage-customer.index") }}';
				} else {
					this.errors = Object.values(result.errors || {}).flat();
				}
			} catch (e) {
				this.errors = ['Terjadi kesalahan jaringan. Silakan coba lagi.'];
			} finally {
				this.loading = false;
			}
		}
	}
}
</script>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
@endsection