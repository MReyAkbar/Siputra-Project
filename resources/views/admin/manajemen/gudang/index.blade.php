@extends('layouts.admin')

@section('title', 'Manajemen Data Gudang')

@section('content')
    <div class="min-h-screen bg-gray-50">
        {{-- HEADER --}}
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Gudang</h1>
                        <p class="mt-1 text-sm text-gray-600">Kelola data dan informasi gudang</p>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="exportToExcel()"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download
                        </button>

                        <a href="{{ route('admin.gudang.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Gudang
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="data-gudang-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Nama Gudang</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Kapasitas</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status Sewa</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status
                                    Operasional</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>


                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($gudangs as $g)
                                <tr class="hover:bg-gray-50">

                                    {{-- Gambar --}}
                                    <td class="px-6 py-4">
                                        <img src="{{ $g->gambar ? asset('storage/' . $g->gambar) : asset('images/no-image.jpg') }}"
                                            class="w-16 h-16 object-cover rounded-lg border" />
                                    </td>

                                    {{-- ID --}}
                                    <td class="px-6 py-4 text-sm font-mono text-gray-700">
                                        GDG{{ str_pad($g->id, 3, '0', STR_PAD_LEFT) }}
                                    </td>

                                    {{-- Nama --}}
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $g->nama_gudang }}
                                    </td>

                                    {{-- Lokasi --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $g->lokasi }}
                                    </td>

                                    {{-- Kapasitas --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ number_format($g->kapasitas_kg) }} kg
                                    </td>

                                    {{-- Status Sewa --}}
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        @if ($g->status_sewa == 'tersedia')
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-xs">Tersedia</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-lg text-xs">Tidak
                                                Tersedia</span>
                                        @endif
                                    </td>

                                    {{-- Status Operasional --}}
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        @if ($g->status_operasional === 'aktif')
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs">Aktif</span>
                                        @else
                                            <span
                                                class="px-2 py-1 bg-gray-200 text-gray-700 rounded-lg text-xs">Nonaktif</span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4">
                                        <div class="flex gap-3">
                                            <a href="{{ route('admin.gudang.edit', $g->id) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition shadow-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.gudang.destroy', $g->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus gudang ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition shadow-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-6 text-gray-500">
                                        Tidak ada data gudang.
                                    </td>
                                </tr>
                            @endforelse
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
            const table = document.getElementById('data-gudang-table');
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Data Gudang"
            });
            XLSX.writeFile(wb, `Data_Gudang_SIPUTRA_${new Date().toISOString().slice(0, 10)}.xlsx`);
        }
    </script>

@endsection
