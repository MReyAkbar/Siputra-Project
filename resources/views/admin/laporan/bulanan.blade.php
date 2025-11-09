@extends('layouts.admin')
@section('title', 'Laporan Bulanan - Admin SIPUTRA')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Laporan Bulanan</h1>
          <p class="mt-1 text-sm text-gray-600">Ringkasan transaksi dari bulan November 2025</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
          <button onclick="exportToExcel()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition transform hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Download
          </button>
          <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
              Filter
              <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
              <a href="{{ url('admin/laporan/harian') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">Harian</a>
              <a href="{{ url('admin/laporan/mingguan') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100">Mingguan</a>
              <a href="{{ url('admin/laporan/bulanan') }}" class="block px-4 py-3 text-sm font-medium bg-blue-50 text-blue-700">Bulanan</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="laporan-table">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaksi</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Total</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @php
              $data = [
                ['2025-11-12', 'IKN016', 'Ikan Tongkol', 'Pembelian', 2150],
                ['2025-10-07', 'IKN017', 'Ikan Tuna', 'Penjualan', 1820],
                ['2025-09-10', 'IKN018', 'Ikan Salmon', 'Pembelian', 3200],
                ['2025-08-13', 'IKN019', 'Ikan Kerapu', 'Penjualan', 2800],
                ['2025-07-23', 'IKN020', 'Ikan Gurame', 'Pembelian', 4100],
                ['2025-06-25', 'IKN021', 'Ikan Kakap', 'Penjualan', 3600],
                ['2025-05-03', 'IKN022', 'Ikan Lele', 'Pembelian', 5200],
              ];
            @endphp
            @foreach($data as $i => $row)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $i + 1 }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($row[0])->format('d M Y') }}</td>
              <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $row[1] }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $row[2] }}</td>
              <td class="px-6 py-4"><span class="px-3 py-1 textasp text-xs font-semibold rounded-full {{ $row[3] == 'Pembelian' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">{{ $row[3] }}</span></td>
              <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ number_format($row[4], 0, ',', '.') }} kg</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
        <div class="text-sm text-gray-700">
          Menampilkan 1 sampai 10 dari 7 hasil (November 2025)
        </div>
        <div class="flex space-x-2">
					<button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm text-gray-500 hover:bg-gray-100">Previous</button>
					<button class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm">1</button>
					<button class="px-3 py-1 bg-white border border-gray-300 rounded-md text-sm text-gray-500 hover:bg-gray-100 cursor-not-allowed" disabled>Next</button>
				</div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
    const table = document.getElementById('laporan-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Laporan Bulanan" });
    XLSX.writeFile(wb, `Laporan_Bulanan_November_2025_SIPUTRA.xlsx`);
}
</script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection