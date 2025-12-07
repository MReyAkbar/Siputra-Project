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

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		@if(session('status'))
			<div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-2">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
				</svg>
				{{ session('status') }}
			</div>
		@endif

		@if(session('error'))
			<div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center gap-2">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
				</svg>
				{{ session('error') }}
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
									@if(auth()->id() !== $user->id)
										<input type="checkbox" name="ids[]" value="{{ $user->id }}" :checked="selected.includes({{ $user->id }})" @change="toggleSelection({{ $user->id }})" class="rounded border-gray-300">
									@else
										<span class="text-gray-400 text-xs">(You)</span>
									@endif
								</td>
								<td class="px-6 py-3 text-sm text-gray-900">{{ $user->id }}</td>
								<td class="px-6 py-3 text-sm font-medium text-gray-900">
									{{ $user->name }}
									@if(auth()->id() === $user->id)
										<span class="ml-2 px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded">Anda</span>
									@endif
								</td>
								<td class="px-6 py-3 text-sm text-gray-500">{{ $user->email }}</td>
								<td class="px-6 py-3">
									<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
										{{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : ($user->role == 'manager' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
										{{ ucfirst($user->role) }}
									</span>
								</td>
								<td class="px-6 py-3 text-sm text-gray-500">{{ $user->created_at?->format('d/m/Y') }}</td>
								<td class="px-6 py-3 text-sm font-medium">
									<a href="{{ route('admin.manage-user.edit', $user->id) }}" class="text-[#134686] hover:text-[#0d3566] mr-3">Edit</a>
									@if(auth()->id() !== $user->id)
										<button type="button" @click="confirmDelete({{ $user->id }}, '{{ $user->name }}', '{{ route('admin.manage-user.destroy', $user) }}')"
										class="text-red-600 hover:text-red-800">Hapus</button>
									@else
										<span class="text-gray-400 cursor-not-allowed">Hapus</span>
									@endif
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
					Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna
				</div>
				<div class="flex items-center gap-3">
					<button @click="confirmBulkDelete" :disabled="!selected.length" :class="selected.length ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-400 cursor-not-allowed'" class="px-4 py-2 text-white font-medium rounded-lg shadow-md transition">
						Hapus Terpilih (<span x-text="selected.length"></span>)
					</button>
				</div>
			</div>

			<!-- Modern Delete Confirmation Modal -->
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
			{{ $users->appends(request()->query())->links('pagination::tailwind') }}
		</div>
	</div>
</div>

<style>
[x-cloak] { 
	display: none !important; 
}
</style>

<script>
// Define functions BEFORE Alpine.js initializes
document.addEventListener('alpine:init', () => {
	Alpine.data('manageEntity', () => ({
		selected: [],
		selectAll: false,
		showModal: false,
		modalMessage: '',
		deleteAction: null,
		deleteType: 'single',
		deleteUserId: null,
		deleteUrl: '',

		init() {
			this.$nextTick(() => {
				const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
				this.selected = Array.from(checkboxes).map(input => parseInt(input.value));
			});
		},

		toggleAll() {
			const allIds = @json($users->pluck('id')->toArray());
			const currentUserId = {{ auth()->id() }};
			const selectableIds = allIds.filter(id => id !== currentUserId);
			this.selected = this.selectAll ? [...selectableIds] : [];
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
			const currentUserId = {{ auth()->id() }};
			const selectableIds = allIds.filter(id => id !== currentUserId);
			this.selectAll = selectableIds.length > 0 && selectableIds.every(id => this.selected.includes(id));
		},

		confirmDelete(userId, userName, actionUrl) {
			this.deleteType = 'single';
			this.deleteUserId = userId;
			this.deleteUrl = actionUrl;
			this.modalMessage = `Apakah Anda yakin ingin menghapus user <strong>${userName}</strong>?<br><span class="text-red-600">Data akan hilang permanen dan tidak dapat dikembalikan.</span>`;
			this.showModal = true;
		},

		confirmBulkDelete() {
			if (!this.selected.length) {
				alert('Pilih minimal satu user untuk dihapus.');
				return;
			}
			
			this.deleteType = 'bulk';
			this.modalMessage = `Apakah Anda yakin ingin menghapus <strong>${this.selected.length} user</strong>?<br><span class="text-red-600">Data akan hilang permanen dan tidak dapat dikembalikan.</span>`;
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

@endsection