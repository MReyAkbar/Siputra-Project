@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Manage Role</h1>
					<p class="mt-1 text-sm text-gray-600">Kelola role untuk akun admin dan manajer</p>
				</div>
			</div>
		</div>
	</div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="manageUser()">
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
					<label class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / Email</label>
					<input type="text" name="q" value="{{ request('q') }}" placeholder="Masukkan nama atau email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#134686] focus:border-transparent">
				</div>
				<div>
					<label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
					<select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#134686]">
						<option value="">Semua Role</option>
						<option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
						<option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
						<option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
					</select>
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
					<a href="{{ route('admin.manage-user.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg shadow-md transition">
						Reset
					</a>
				</div>
			</div>
		</form>

		<div class="bg-white rounded-xl shadow-lg overflow-hidden" x-data="manageEntity()">
			<div class="overflow-x-auto">
				<form method="POST" id="bulk-form" action="{{ route('admin.manage-user.bulkDelete') }}">
					@csrf
					<table class="min-w-full divide-y divide-gray-200" id="user-table">
						<thead class="bg-gray-50">
							<tr>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									<input type="checkbox" @change="toggleAll" x-model="selectAll" class="rounded border-gray-300">
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manage-user.partials.sort', ['label' => '#', 'field' => 'id'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manage-user.partials.sort', ['label' => 'Nama', 'field' => 'name'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manage-user.partials.sort', ['label' => 'Email', 'field' => 'email'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
									@include('admin.manage-user.partials.sort', ['label' => 'Terdaftar', 'field' => 'created_at'])
								</th>
								<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@forelse($users as $user)
							<tr class="hover:bg-gray-50 transition">
								<td class="px-6 py-3">
									<input type="checkbox" name="ids[]" value="{{ $user->id }}" :checked="selected.includes({{ $user->id }})" @change="toggleSelection({{ $user->id }})" class="rounded border-gray-300">
								</td>
								<td class="px-6 py-3 text-sm text-gray-900">{{ $user->id }}</td>
								<td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
								<td class="px-6 py-3 text-sm text-gray-500">{{ $user->email }}</td>
								<td class="px-6 py-3">
									<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
										{{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 
											($user->role == 'manager' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
										{{ ucfirst($user->role ?? 'customer') }}
									</span>
								</td>
								<td class="px-6 py-3 text-sm text-gray-500">{{ $user->created_at?->format('d/m/Y') }}</td>
								<td class="px-6 py-3 text-sm font-medium">
									<a href="{{ route('admin.manage-user.edit', $user->id) }}" class="text-[#134686] hover:text-[#0d3566] mr-3">Edit</a>
									<button type="button" onclick="deleteSingleUser({{ $user->id }}, '{{ route('admin.manage-user.destroy', $user) }}')"
									class="text-red-600 hover:text-red-800">Hapus</button>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada data pengguna.</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</form>
			</div>

			<div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
				<div class="text-sm text-gray-700">
					Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} pengguna
				</div>
				<div class="flex items-center gap-3">
					<button @click="bulkDelete" :disabled="!selected.length" :class="selected.length ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed'" class="px-4 py-2 text-white font-medium rounded-lg shadow-md transition">
						Hapus Terpilih (<span x-text="selected.length"></span>)
					</button>
				</div>
			</div>
		</div>

		<div class="mt-6">
			{{ $users->appends(request()->query())->links('pagination::tailwind') }}
		</div>
	</div>
</div>

<script>
function deleteSingleUser(id, actionUrl) {
	if (confirm('Hapus user ini? Data akan hilang permanen.')) {
		const form = document.createElement('form');
		form.method = 'POST';
		form.action = actionUrl;
		
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
	}
}

function manageEntity() {
	return {
		selected: [],
		selectAll: false,

		init() {
			this.$nextTick(() => {
				this.selected = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
					.map(input => parseInt(input.value));
			});
		},

		toggleAll() {
			const allIds = @json($users->pluck('id')->toArray());
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
			const allIds = @json($users->pluck('id')->toArray());
			this.selectAll = allIds.length > 0 && allIds.every(id => this.selected.includes(id));
		},

		bulkDelete() {
			if (!this.selected.length) {
				alert('Pilih minimal satu user untuk dihapus.');
				return;
			}
			
			if (confirm(`Hapus ${this.selected.length} user? Data akan hilang permanen.`)) {
				document.querySelectorAll('input[name="ids[]"]').forEach(checkbox => {
					const id = parseInt(checkbox.value);
					checkbox.checked = this.selected.includes(id);
				});
				
				document.getElementById('bulk-form').submit();
			}
		}
	}
}
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection