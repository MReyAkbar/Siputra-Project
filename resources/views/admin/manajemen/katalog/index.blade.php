@extends('layouts.admin')

@section('title', 'Manajemen Katalog Ikan')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Katalog</h1>
                    <p class="mt-1 text-sm text-gray-600">Kelola produk yang tampil di halaman katalog</p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    {{-- Tombol Download Excel --}}
                    <button onclick="exportToExcel()" 
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 
                               text-white font-medium rounded-lg shadow-md transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 
                                     5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download
                    </button>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('admin.katalog.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] 
                               text-white font-medium rounded-lg shadow-md transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Produk
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- TABLE LIST --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="katalog-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ikan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Jual</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($catalog as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <img src="{{ asset('images/default-ikan.png') }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                @endif
                            </td>

                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $item->ikan->nama }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($item->is_active)
                                    <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-lg">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold bg-gray-200 text-gray-700 rounded-lg">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.katalog.edit', $item->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 
                                              text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.katalog.destroy', $item->id) }}"
                                          onsubmit="return confirm('Yakin hapus produk katalog ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 
                                                   text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                        @if ($catalog->isEmpty())
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                Belum ada produk katalog.
                            </td>
                        </tr>
                        @endif
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
    const table = document.getElementById('katalog-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Katalog" });
    XLSX.writeFile(wb, `Katalog_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>

@endsection
