@extends('layouts.admin')

@section('title', 'Laporan Harian')

@section('content')
<div class="min-h-screen bg-gray-50">

  {{-- HEADER --}}
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
          <h1 class="text-2xl font-bold text-gray-900">Laporan Harian</h1>
          <p class="mt-1 text-sm text-gray-600">Ringkasan transaksi hari ini</p>
        </div>

        <div class="flex gap-3">
          
          <a href="{{ route('laporan.harian') }}" 
             class="px-5 py-2.5 rounded-lg font-medium shadow {{ request()->is('admin/laporan/harian') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border' }}">
            Harian
          </a>

          <a href="{{ route('laporan.mingguan') }}" 
             class="px-5 py-2.5 rounded-lg font-medium shadow {{ request()->is('admin/laporan/mingguan') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border' }}">
            Mingguan
          </a>

          <a href="{{ route('laporan.bulanan') }}" 
             class="px-5 py-2.5 rounded-lg font-medium shadow {{ request()->is('admin/laporan/bulanan') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 border' }}">
            Bulanan
          </a>

          <button onclick="exportToExcel()" 
                  class="px-5 py-2.5 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
            Download
          </button>

        </div>
      </div>
    </div>
  </div>

  {{-- TABEL --}}
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
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah (kg)</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga (Rp/kg)</th>
            </tr>
          </thead>

          <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data as $i => $row)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-sm text-gray-900">{{ $i+1 }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d M Y') }}</td>
              <td class="px-6 py-4 text-sm font-mono">{{ $row['kode'] }}</td>
              <td class="px-6 py-4 text-sm">{{ $row['nama'] }}</td>
              <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                {{ $row['tipe']=='Pembelian' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                  {{ $row['tipe'] }}
                </span>
              </td>
              <td class="px-6 py-4 text-sm font-medium">{{ number_format($row['jumlah'],0,',','.') }}</td>
              <td class="px-6 py-4 text-sm font-medium">Rp {{ number_format($row['harga'],0,',','.') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
    const table = document.getElementById('laporan-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Laporan" });
    XLSX.writeFile(wb, `Laporan_Harian_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>
@endsection
