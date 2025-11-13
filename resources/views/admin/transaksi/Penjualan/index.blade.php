@extends('layouts.admin')

@section('title', 'Transaksi Penjualan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Transaksi Penjualan</h1>
          <p class="mt-1 text-sm text-gray-600">Kelola data transaksi penjualan perusahaan</p>
        </div>
        <div class="flex gap-3">
          <button onclick="exportToExcel()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Download Excel
          </button>
          <a href="{{ url('admin/transaksi/penjualan/input-penjualan') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Input Penjualan
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="penjualan-table">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/kg</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
            </tr>
          </thead>
          <tbody x-data="penjualanList()" class="bg-white divide-y divide-gray-200">
            <template x-for="p in penjualans" :key="p.id">
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-600" x-text="formatTanggal(p.tanggal)"></td>
                <td class="px-6 py-4 text-sm font-mono" x-text="p.id_ikan"></td>
                <td class="px-6 py-4 text-sm font-medium" x-text="p.jenis"></td>
                <td class="px-6 py-4 text-sm" x-text="p.customer"></td>
                <td class="px-6 py-4 text-sm font-medium" x-text="p.jumlah + ' kg'"></td>
                <td class="px-6 py-4 text-sm">Rp <span x-text="formatRupiah(p.harga)"></span></td>
                <td class="px-6 py-4 text-sm font-bold text-green-600">Rp <span x-text="formatRupiah(p.total)"></span></td>
              </tr>
            </template>
            <tr x-show="penjualans.length === 0">
              <td colspan="7" class="px-6 py-12 text-center text-gray-500">Belum ada transaksi penjualan</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-sm text-gray-600">
        Menampilkan <span x-text="pembelians.length"></span> transaksi penjualan
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function penjualanList() {
  return {
    penjualans: JSON.parse(localStorage.getItem('siputra_penjualans') || '[]'),
    init() { 
    if (this.penjualans.length === 0) {
      this.penjualans = [
        { id: 1, tanggal: "2025-11-12", id_ikan: "IKN001", jenis: "Tuna", customer: "Reyhan", jumlah: 1500, harga: 35000, total: 52500000 },
        { id: 2, tanggal: "2025-11-10", id_ikan: "IKN002", jenis: "Kakap Merah", customer: "Dwicky", jumlah: 800, harga: 13500, total: 10800000 },
      ];
      localStorage.setItem('siputra_penjualans', JSON.stringify(this.penjualans));
    }
    },
    formatRupiah(angka) { return new Intl.NumberFormat('id-ID').format(angka); },
    formatTanggal(tanggal) {
      const [y, m, d] = tanggal.split('-');
      return `${d}/${m}/${y}`;
    }
  }
}

function exportToExcel() {
  const table = document.getElementById('penjualan-table');
  if (!table) return alert('Tabel tidak ditemukan!');
  const wb = XLSX.utils.table_to_book(table, { sheet: "Penjualan" });
  XLSX.writeFile(wb, `Penjualan_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection