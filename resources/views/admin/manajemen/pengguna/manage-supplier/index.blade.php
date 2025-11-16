@extends('layouts.admin')

@section('title', 'Manajemen Supplier')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
					<p class="mt-1 text-sm text-gray-600">Kelola role, customer, dan supplier</p>
				</div>
			</div>
		</div>
	</div>

	{{-- Tab Menu --}}
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
		<div class="border-b border-gray-200">
			<nav class="-mb-px flex space-x-8">
				<a href="{{ route('manajemen.pengguna.manage-customer.index') }}" class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('manajemen.manage-customer.*') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
					Customer
				</a>
				<a href="{{ route('manajemen.pengguna.manage-supplier.index') }}" class="py-2 px-1 border-b-2 font-medium text-sm {{ request()->routeIs('manajemen.manage-supplier.*') ? 'border-[#134686] text-[#134686]' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
					Supplier
				</a>
			</nav>
		</div>
	</div>

    {{-- Content --}}
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="manageEntity()">
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
					<label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / Email / Perusahaan</label>
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

		<div class="bg-white rounded-xl shadow-lg overflow-hidden">
			<div class="overflow-x-auto">
				<form method="POST" id="bulk-form" action="{{ route('manajemen.pengguna.manage-supplier.bulkDelete') }}" @submit.prevent="confirmBulkDelete">
					@csrf
					<table class="min-w-full divide-y divide-gray-200">
						<thead class="bg-gray-50">
							<tr>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									<input type="checkbox" @click="toggleAll" x-model="selectAll" class="rounded border-gray-300">
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manajemen.pengguna.partials.sort', ['label' => '#', 'field' => 'id', 'route' => 'manajemen.pengguna.manage-supplier.index'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manajemen.pengguna.partials.sort', ['label' => 'Nama', 'field' => 'name', 'route' => 'manajemen.pengguna.manage-supplier.index'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perusahaan</th>
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
										<input type="checkbox" name="ids[]" value="{{ $supplier->id }}" x-model="selected" class="rounded border-gray-300">
									</td>
									<td class="px-6 py-3 text-sm text-gray-900">{{ $supplier->id }}</td>
									<td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $supplier->name }}</td>
									<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->email }}</td>
									<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->company }}</td>
									<td class="px-6 py-3 text-sm text-gray-500">{{ $supplier->created_at->format('d/m/Y') }}</td>
									<td class="px-6 py-3 text-sm font-medium">
										<a href="{{ route('manajemen.manage-supplier.edit', $supplier) }}" class="text-[#134686] hover:text-[#0d3566] mr-3">Edit</a>
										<button type="button" @click="confirmDelete({{ $supplier->id }})" class="text-red-600 hover:text-red-800">Hapus</button>
									</td>
							</tr>
							@empty
							<tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada data supplier.</td></tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>

			<div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
				<div class="text-sm text-gray-700">
					Menampilkan {{ $suppliers->firstItem() }} - {{ $suppliers->lastItem() }} dari {{ $suppliers->total() }} supplier
				</div>
				<div class="flex items-center gap-3">
					<button @click="bulkDelete" :disabled="!selected.length" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg shadow-md transition disabled:opacity-50">
						Hapus Terpilih (<span x-text="selected.length"></span>)
					</button>
					<a href="{{ route('manajemen.pengguna.manage-supplier.export', request()->query()) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition flex items-center gap-2">
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
						</svg>
						Export CSV
					</a>
				</div>
			</div>
		</div>

		<div class="mt-6">
			{{ $suppliers->appends(request()->query())->links('pagination::tailwind') }}
		</div>
	</div>
</div>

<script>
function manageEntity() {
	return {
		selected: [],
		selectAll: false,

		toggleAll() {
			this.selected = this.selectAll ? @js($suppliers->pluck('id')->toArray()) : [];
		},

		confirmDelete(id) {
			if (confirm('Hapus supplier ini?')) {
				document.getElementById(`delete-form-${id}`).submit();
			}
		},

		confirmBulkDelete() {
			if (!this.selected.length) return;
			if (confirm(`Hapus ${this.selected.length} supplier?`)) {
				document.getElementById('bulk-form').submit();
			}
		},

		bulkDelete() {
			this.confirmBulkDelete();
		}
	}
}
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection