@extends('layouts.admin')

@section('title', 'Manajemen Supplier')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Manajemen Data Klien</h1>
					<p class="mt-1 text-sm text-gray-600">Kelola data customer dan supplier perusahaan</p>
				</div>
				<a href="{{ route('manajemen.pengguna.manage-supplier.create') }}"
					class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
					</svg>
					Tambah Supplier
				</a>
			</div>
		</div>
	</div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
		<div class="border-b border-gray-200">
			<nav class="-mb-px flex space-x-8">
				<a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('manajemen.pengguna.manage-customer.*') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
					Customer
				</a>
				<a href="{{ route('manajemen.pengguna.manage-supplier.index') }}" class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('manajemen.pengguna.manage-supplier.*') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
					Supplier
				</a>
			</nav>
		</div>
	</div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		@if(session('status'))
			<div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
				</svg>
				{{ session('status') }}
			</div>
		@endif

		<form method="GET" class="mb-6 bg-white p-4 rounded-xl shadow-md">
			<div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / Nomor HP / Alamat</label>
					<input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#134686]">
				</div>
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Per Halaman</label>
					<select name="per_page" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#134686]">
						@foreach([10,15,25,50] as $n)
							<option value="{{ $n }}" {{ request('per_page', 15) == $n ? 'selected' : '' }}>{{ $n }}</option>
						@endforeach
					</select>
				</div>
				<div class="flex gap-2">
					<button type="submit" class="px-5 py-2 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
						Cari
					</button>
					<a href="{{ route('manajemen.pengguna.manage-supplier.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg shadow-md transition">
						Reset
					</a>
				</div>
			</div>
		</form>

			<div class="bg-white rounded-xl shadow-lg overflow-hidden" x-data="manageEntity()">
				<div class="overflow-x-auto">
					<form method="POST" id="bulk-form" action="{{ route('manajemen.pengguna.manage-supplier.bulkDelete') }}">
						@csrf
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										<input type="checkbox" @change="toggleAll" x-model="selectAll" class="rounded border-gray-300">
									</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										@include('admin.manajemen.pengguna.partials.sort', ['label' => '#', 'field' => 'id', 'route' => 'manajemen.pengguna.manage-supplier.index'])
									</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										@include('admin.manajemen.pengguna.partials.sort', ['label' => 'Nama', 'field' => 'nama_supplier', 'route' => 'manajemen.pengguna.manage-supplier.index'])
									</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor HP</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										@include('admin.manajemen.pengguna.partials.sort', ['label' => 'Terdaftar', 'field' => 'created_at', 'route' => 'manajemen.pengguna.manage-supplier.index'])
									</th>
									<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								@forelse($suppliers as $supplier)
									<tr class="hover:bg-gray-50">
										<td class="px-6 py-3">
											<input type="checkbox" name="ids[]" value="{{ $supplier->id }}" :checked="selected.includes({{ $supplier->id }})" @click="toggleSelection({{ $supplier->id }})" class="rounded border-gray-300">
										</td>
										<td class="px-6 py-3 text-sm text-gray-900">{{ $supplier->id }}</td>
										<td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $supplier->nama_supplier }}</td>
										<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->no_hp }}</td>
										<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->alamat }}</td>
										<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->created_at->format('d/m/Y') }}</td>
										<td class="px-6 py-3 text-sm font-medium">
											<a href="{{ route('manajemen.pengguna.manage-supplier.edit', $supplier) }}" 
												class="text-[#134686] hover:text-[#0d3566] mr-3">
												Edit
											</a>
											@php
												$nama = html_entity_decode($supplier->nama_supplier, ENT_QUOTES);
											@endphp
											<button type="button" @click="confirmDelete({{ $supplier->id }}, '{{ addslashes($nama) }}', '{{ route('manajemen.pengguna.manage-supplier.destroy', $supplier) }}')" class="text-red-600 hover:text-red-800">
												Hapus
											</button>
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada data supplier.</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</form>
				</div>

				<div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
					<div class="text-sm text-gray-700">
						Menampilkan {{ $suppliers->firstItem() ?? 0 }} - {{ $suppliers->lastItem() ?? 0 }} dari {{ $suppliers->total() }} supplier
					</div>
					<div class="flex items-center gap-3">
						<button type="button" @click="confirmBulkDelete" :disabled="!selected.length" :class="selected.length ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed'" class="px-4 py-2 text-white font-medium rounded-lg shadow-md transition">
								Hapus Terpilih (<span x-text="selected.length"></span>)
						</button>

							<a href="{{ route('manajemen.pengguna.manage-supplier.export') }}?{{ http_build_query(request()->query()) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition flex items-center gap-2">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
								</svg>
								Export CSV
							</a>
					</div>
				</div>

				<div x-show="showModal" 
					x-cloak
					@click.away="showModal = false"
					class="fixed inset-0 z-50 overflow-y-auto" 
					style="display: none;">
					<div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
						<!-- Background overlay -->
						<div x-show="showModal"
							x-transition:enter="ease-out duration-300"
							x-transition:enter-start="opacity-0"
							x-transition:enter-end="opacity-100"
							x-transition:leave="ease-in duration-200"
							x-transition:leave-start="opacity-100"
							x-transition:leave-end="opacity-0"
							class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

						<span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

						<!-- Modal panel -->
						<div x-show="showModal"
							x-transition:enter="ease-out duration-300"
							x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
							x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
							x-transition:leave="ease-in duration-200"
							x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
							x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
							class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
							
							<div class="sm:flex sm:items-start">
								<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
									<svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
									</svg>
								</div>
								<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
									<h3 class="text-lg leading-6 font-medium text-gray-900">
										Konfirmasi Hapus
									</h3>
									<div class="mt-2">
										<p class="text-sm text-gray-500" x-html="modalMessage"></p>
									</div>
								</div>
							</div>

							<div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse gap-3">
								<button @click="executeDelete" 
									type="button" 
									class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition">
									Hapus
								</button>
								<button @click="showModal = false" 
									type="button" 
									class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#134686] sm:mt-0 sm:w-auto sm:text-sm transition">
									Batal
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-6">
				{{ $suppliers->appends(request()->query())->links('pagination::tailwind') }}
			</div>
	</div>
</div>

<script>
document.addEventListener('alpine:init', () => {
	Alpine.data('manageEntity', () => ({
		selected: [],
		selectAll: false,
		showModal: false,
		modalMessage: '',
		deleteAction: null,
		deleteType: 'single',
		deleteSupplierId: null,
		deleteUrl: '',

		init() {
			this.$nextTick(() => {
				this.selected = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
					.map(input => parseInt(input.value));
			});
		},

		toggleAll() {
			const allIds = @json($suppliers->pluck('id')->toArray());
			this.selected = this.selectAll ? [...allIds] : [];
			this.syncCheckboxes();
		},

		toggleSelection(id) {
			const index = this.selected.indexOf(id);
			if (index === -1) {
				this.selected.push(id);
			} else {
				this.selected.splice(index, 1);
			}
			this.updateSelectAll();
		},

		syncCheckboxes() {
			this.$nextTick(() => {
				document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
					checkbox.checked = this.selected.includes(parseInt(checkbox.value));
				});
				this.updateSelectAll();
			});
		},

		updateSelectAll() {
			const allIds = @json($suppliers->pluck('id')->toArray());
			this.selectAll = allIds.length > 0 && allIds.every(id => this.selected.includes(id));
		},

		confirmDelete(supplierId, supplierName, actionUrl) {
			this.deleteType = 'single';
			this.deleteSupplierId = supplierId;
			this.deleteUrl = actionUrl;
			this.modalMessage = `Apakah Anda yakin ingin menghapus supplier <strong>${supplierName}</strong>?<br><span class="text-red-600">Data akan hilang permanen dan tidak dapat dikembalikan.</span>`;
			this.showModal = true;
		},

		confirmBulkDelete() {
			if (!this.selected.length) {
				alert('Pilih minimal satu akun untuk dihapus.');
				return;
			}
			
			this.deleteType = 'bulk';
			this.modalMessage = `Apakah Anda yakin ingin menghapus <strong>${this.selected.length} akun</strong>?<br><span class="text-red-600">Data akan hilang permanen dan tidak dapat dikembalikan.</span>`;
			this.showModal = true;
		},

		executeDelete() {
			if (this.deleteType === 'single') {
				this.executeSingleDelete();
			} else {
				this.executeBulkDelete();
			}
		},

		executeSingleDelete() {
			const form = document.createElement('form');
			form.method = 'POST';
			form.action = this.deleteUrl;
			form.style.display = 'none';

			const csrfInput = document.createElement('input');
			csrfInput.type = 'hidden';
			csrfInput.name = '_token';
			csrfInput.value = '{{ csrf_token() }}';
			form.appendChild(csrfInput);

			const methodInput = document.createElement('input');
			methodInput.type = 'hidden';
			methodInput.name = '_method';
			methodInput.value = 'DELETE';
			form.appendChild(methodInput);

			document.body.appendChild(form);
			form.submit();
		},

		executeBulkDelete() {
			document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
				const id = parseInt(checkbox.value);
				checkbox.checked = this.selected.includes(id);
			});
			
			document.getElementById('bulk-form').submit();
		}
	}));
});
</script>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
@endsection