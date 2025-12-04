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

  <!-- ALERT MESSAGES -->
  @if(session('success'))
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    </div>
  </div>
  @endif

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

                <td class="px-6 py-4">
                    <a href="{{ route('admin.penjualan.invoice', $p->id) }}"
                      class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                      </svg>
                      Cetak Invoice
                    </a>
                </td>
              </tr>
              @endforeach
            @empty
              <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  <p class="mt-2">Belum ada transaksi penjualan</p>
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
  const table = document.getElementById('penjualan-table');
  if (!table) return alert('Tabel tidak ditemukan!');
  const wb = XLSX.utils.table_to_book(table, { sheet: "Transaksi Penjualan" });
  XLSX.writeFile(wb, `Transaksi_Penjualan_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>
@endsection