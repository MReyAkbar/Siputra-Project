@extends('layouts.admin')

@section('title', 'Laporan Bulanan - Admin SIPUTRA')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Laporan Bulanan</h1>
                    <p class="mt-1 text-sm text-gray-600">Ringkasan transaksi bulan ini</p>
                </div>

                <div class="flex items-center gap-3">

                    {{-- NAVIGASI --}}
                    <div class="flex gap-2">
                        <a href="{{ route('laporan.harian') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            Harian
                        </a>
                        <a href="{{ route('laporan.mingguan') }}"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100">
                            Mingguan
                        </a>
                        <a href="{{ route('laporan.bulanan') }}"
                            class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow">
                            Bulanan
                        </a>
                              {{-- EXPORT EXCEL --}}
                          <button onclick="exportToExcel()"
                              class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                              Download
                          </button>
                    </div>

                </div>
            </div>

        </div>
    </div>


    {{-- TABEL LAPORAN --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="laporan-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">ID Ikan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Jenis Ikan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Transaksi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Harga (Rp)</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Jumlah (Kg)</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($data as $i => $row)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $i + 1 }}</td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($row['tanggal'])->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $row['kode'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $row['nama'] }}</td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $row['tipe'] === 'Pembelian'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-blue-100 text-blue-800'
                                    }}">
                                    {{ $row['tipe'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                Rp {{ number_format($row['harga'], 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ number_format($row['jumlah'], 0, ',', '.') }} kg
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

{{-- EXPORT EXCEL --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function exportToExcel() {
    const table = document.getElementById('laporan-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Laporan Bulanan" });
    XLSX.writeFile(wb, `Laporan_Bulanan_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>

@endsection
