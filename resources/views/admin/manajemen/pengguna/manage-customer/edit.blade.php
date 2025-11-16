@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Edit Pengguna</h1>
					<p class="mt-1 text-sm text-gray-600">Ubah data pengguna: <span class="font-medium">{{ $user->name }}</span></p>
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
			<div class="p-8 bg-[#134686]" x-data="editUserForm()">
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
						<label class="block text-white text-sm font-semibold mb-2">Nama Lengkap</label>
						<input 
								x-model="form.name" 
								type="text" 
								required 
								placeholder="Masukkan nama lengkap..." 
								class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 focus:ring-4 focus:ring-green-400 transition"
								:class="{'ring-2 ring-red-500': errors.includes('Nama wajib diisi.')}"
						>
					</div>

					<div class="mb-6">
						<label class="block text-white text-sm font-semibold mb-2">Email</label>
						<input 
								x-model="form.email" 
								type="email" 
								required 
								placeholder="contoh@email.com" 
								class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 focus:ring-4 focus:ring-green-400 transition"
								:class="{'ring-2 ring-red-500': errors.includes('Email tidak valid.') || errors.includes('Email sudah digunakan.')}"
						>
					</div>

					<div class="mb-6">
						<label class="block text-white text-sm font-semibold mb-2">Role</label>
						<select 
							x-model="form.role" 
							:disabled="isOwnAccount"
							class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 focus:ring-4 focus:ring-green-400 transition disabled:bg-gray-100 disabled:cursor-not-allowed"
						>
							<option value="customer">Customer</option>
							<option value="manager">Manager</option>
							<option value="admin">Admin</option>
						</select>
						<p x-show="isOwnAccount" class="mt-2 text-xs text-yellow-300">
							<svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
							</svg>
							Anda tidak dapat mengubah role akun sendiri.
						</p>
					</div>

					<div class="flex justify-end gap-4">
						<a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
							Batal
						</a>
						<button 
							type="submit" 
							:disabled="loading || isOwnAccount && form.role !== originalRole"
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
function editUserForm() {
	return {
		loading: false,
		errors: [],
		isOwnAccount: {{ auth()->id() === $user->id ? 'true' : 'false' }},
		originalRole: "{{ $user->role ?? 'customer' }}",

		form: {
			name: "{{ old('name', $user->name) }}",
			email: "{{ old('email', $user->email) }}",
			role: "{{ old('role', $user->role ?? 'customer') }}"
		},

		async submitForm() {
			this.errors = [];
			this.loading = true;

			// Client-side validation
			if (!this.form.name.trim()) this.errors.push('Nama wajib diisi.');
			if (!this.form.email.includes('@')) this.errors.push('Email tidak valid.');

			if (this.errors.length > 0) {
				this.loading = false;
				return;
			}

			const formData = new FormData();
			formData.append('name', this.form.name);
			formData.append('email', this.form.email);
			if (!this.isOwnAccount) {
				formData.append('role', this.form.role);
			}
			formData.append('_method', 'PUT');

			try {
				const response = await fetch("{{ route('manajemen.pengguna.manage-customer.update', $user->id) }}", {
					method: 'POST',
					body: formData,
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
				});

				const result = await response.json();

				if (response.ok) {
					alert('Pengguna berhasil diperbarui!');
					window.location.href = '{{ route('manajemen.pengguna.manage-customer.index') }}';
				} else {
					this.errors = Object.values(result.errors || {}).flat();
				}
			} catch (e) {
				this.errors = ['Terjadi kesalahan jaringan.'];
			} finally {
				this.loading = false;
			}
		}
	}
}
</script>
@endsection