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
                        <button onclick="exportToExcel()"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download Excel
                        </button>
                        <a href="{{ route('admin.pembelian.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
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
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Supplier</th>

                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Ikan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Surat Jalan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tally</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Harga Beli</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse($pembelian as $p)
                                @php $rowspan = $p->detail->count(); @endphp

                                @foreach ($p->detail as $index => $d)
                                    <tr class="hover:bg-gray-50 transition">

                                        {{-- Tanggal (rowspan) --}}
                                        @if ($index === 0)
                                            <td class="px-6 py-4 text-sm text-gray-900" rowspan="{{ $rowspan }}">
                                                {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                            </td>
                                        @endif

                                        {{-- Supplier (rowspan) --}}
                                        @if ($index === 0)
                                            <td class="px-6 py-4 text-sm text-gray-700" rowspan="{{ $rowspan }}">
                                                {{ $p->supplier->nama_supplier }}
                                            </td>
                                        @endif

                                        {{-- Ikan --}}
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $d->ikan->nama }}
                                        </td>

                                        {{-- Jumlah Kirim --}}
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ number_format($d->jumlah_kirim) }} kg
                                        </td>

                                        {{-- Jumlah Terima --}}
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ number_format($d->jumlah_terima) }} kg
                                        </td>

                                        {{-- Harga Beli --}}
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            Rp {{ number_format($d->harga_beli) }}
                                        </td>

                                    </tr>
                                @endforeach

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada transaksi pembelian
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-sm text-gray-600">
                    Menampilkan <b>{{ $pembelian->count() }}</b> transaksi pembelian
                </div>
            </div>

        </div>
    </div>

    <!-- EXPORT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function exportToExcel() {
            const table = document.getElementById("pembelian-table");
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Transaksi Pembelian"
            });
            XLSX.writeFile(wb, `Transaksi_Pembelian_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
        }
    </script>
@endsection
