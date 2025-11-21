@extends('layouts.admin')

@section('title', 'Transaksi Penjualan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <!-- HEADER -->
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Transaksi Penjualan</h1>
          <p class="mt-1 text-sm text-gray-600">Kelola data transaksi penjualan perusahaan</p>
        </div>

        <div class="flex gap-3">
          <button onclick="exportToExcel()" 
                  class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Download Excel
          </button>

          <a href="{{ route('admin.penjualan.create') }}"
             class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Input Penjualan
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="penjualan-table">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/kg</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>

          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($penjualan as $p)
              @foreach ($p->detail as $detail)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-700">
                  {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                </td>

                <td class="px-6 py-4 text-sm">{{ $p->customer->nama_customer }}</td>

                <td class="px-6 py-4 text-sm font-medium">
                  {{ $detail->ikan->nama }}
                </td>

                <td class="px-6 py-4 text-sm font-medium">
                  {{ number_format($detail->jumlah, 0, ',', '.') }} kg
                </td>

                <td class="px-6 py-4 text-sm">
                  Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}
                </td>

                <td class="px-6 py-4 text-sm font-bold text-green-600">
                  Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                </td>

                <td>
                    <a href="{{ route('admin.penjualan.invoice', $p->id) }}"
                      class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                      Cetak Invoice
                    </a>
                </td>
              </tr>
              @endforeach
            @empty
              <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                  Belum ada transaksi penjualan
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-sm text-gray-600">
        Menampilkan <b>{{ $penjualan->count() }}</b> transaksi penjualan
      </div>
    </div>
  </div>
</div>

<!-- EXPORT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
	const table = document.getElementById('pembelian-table');
	if (!table) return alert('Tabel tidak ditemukan!');
	const wb = XLSX.utils.table_to_book(table, { sheet: "Transaksi Pembelian" });
	XLSX.writeFile(wb, Transaksi_Pembelian_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx);
}
</script>
@endsection
