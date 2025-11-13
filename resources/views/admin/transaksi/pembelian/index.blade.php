@extends('layouts.admin')

@section('title', 'Transaksi Pembelian')

@section('content')
<div class="min-h-screen bg-gray-50">
	<div class="bg-white shadow-sm border-b border-gray-200">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
				<div>
					<h1 class="text-2xl font-bold text-gray-900">Transaksi Pembelian</h1>
					<p class="mt-1 text-sm text-gray-600">Kelola data transaksi pembelian perusahaan</p>
				</div>
				<div class="flex gap-3">
					<button onclick="exportToExcel()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
						</svg>
							Download
					</button>
					<a href="{{ url('admin/transaksi/pembelian/input-pembelian') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
						<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
						</svg>
						Input Pembelian
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
		<div class="bg-white rounded-xl shadow-lg overflow-hidden">
			<div class="overflow-x-auto">
				<table class="min-w-full divide-y divide-gray-200" id="pembelian-table">
					<thead class="bg-gray-50">
						<tr>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ikan</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Ikan</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Surat Jalan</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tally</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
							<th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total (Kg)</th>
						</tr>
					</thead>
					<tbody x-data="pembelianList()" class="bg-white divide-y divide-gray-200">
						<template x-for="p in pembelians" :key="p.id">
							<tr class="hover:bg-gray-50 transition">
								<td class="px-6 py-4 text-sm text-gray-600" x-text="formatTanggal(p.tanggal)"></td>
								<td class="px-6 py-4 text-sm font-mono" x-text="p.id_ikan"></td>
								<td class="px-6 py-4 text-sm font-medium" x-text="p.jenis"></td>
								<td class="px-6 py-4 text-sm" x-text="p.supplier"></td>
								<td class="px-6 py-4 text-sm" x-text="p.surat_jalan + ' kg'"></td>
								<td class="px-6 py-4 text-sm" x-text="p.tally + ' kg'"></td>
								<td class="px-6 py-4 text-sm font-medium">Rp <span x-text="formatRupiah(p.harga)"></span></td>
								<td class="px-6 py-4 text-sm font-bold text-green-600" x-text="p.total + ' kg'"></td>
							</tr>
						</template>
						<tr x-show="pembelians.length === 0">
							<td colspan="8" class="px-6 py-12 text-center text-gray-500">Belum ada transaksi pembelian</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-sm text-gray-600">
				Menampilkan <span x-text="pembelians.length"></span> transaksi pembelian
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function pembelianList() {
	return {
		pembelians: JSON.parse(localStorage.getItem('siputra_pembelians') || '[]'),

		init() {
			if (this.pembelians.length === 0) {
				this.pembelians = [
					{ id: 1, tanggal: "2025-11-12", id_ikan: "IKN001", jenis: "Tuna", supplier: "PT. Laut Jaya", surat_jalan: 1500, tally: 1490, harga: 75000000, total: 2990 },
					{ id: 2, tanggal: "2025-11-10", id_ikan: "IKN002", jenis: "Kakap Merah", supplier: "CV. Samudra", surat_jalan: 800, tally: 795, harga: 40000000, total: 1595 },
				];
				localStorage.setItem('siputra_pembelians', JSON.stringify(this.pembelians));
			}
		},

		formatRupiah(angka) {
			return new Intl.NumberFormat('id-ID').format(angka);
		},

		formatTanggal(tanggal) {
			const [y, m, d] = tanggal.split('-');
			return `${d}/${m}/${y}`;
		}
	}
}

function exportToExcel() {
	const table = document.getElementById('pembelian-table');
	if (!table) return alert('Tabel tidak ditemukan!');
	const wb = XLSX.utils.table_to_book(table, { sheet: "Transaksi Pembelian" });
	XLSX.writeFile(wb, `Transaksi_Pembelian_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection