@extends('layouts.admin')

@section('title', 'Manajemen Data Ikan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Ikan</h1>
          <p class="mt-1 text-sm text-gray-600">Kelola data dan informasi ikan</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
          <button onclick="exportToExcel()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Download
          </button>
          <a href="{{ url('admin/manajemen/ikan/tambah-ikan') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#134686] hover:bg-[#103a6a] text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Ikan
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="data-ikan-table">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Ikan</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody x-data="ikanList()" class="bg-white divide-y divide-gray-200">
            <template x-for="ikan in ikans" :key="ikan.id">
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><img :src="ikan.gambar" class="w-16 h-16 object-cover rounded-lg"></td>
                <td class="px-6 py-4 text-sm font-mono" x-text="ikan.id_ikan"></td>
                <td class="px-6 py-4 text-sm" x-text="ikan.jenis"></td>
                <td class="px-6 py-4 text-sm">Rp <span x-text="formatRupiah(ikan.harga)"></span></td>
                <td class="px-6 py-4 text-sm font-medium" x-text="ikan.total + ' kg'"></td>
                <td class="px-6 py-4">
                  <div class="flex gap-3">
                    <a :href="'/admin/manajemen/ikan/' + ikan.id + '/edit-ikan'" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">Edit</a>
                    <button @click="hapus(ikan.id)" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">Hapus</button>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function ikanList() {
  return {
    ikans: JSON.parse(localStorage.getItem('siputra_ikans') || '[]'),
    init() {
      if (this.ikans.length === 0) {
        this.ikans = [
          { id: 1, gambar: "{{ asset('images/ikan-tuna.png') }}", id_ikan: "IKN001", jenis: "Tuna", harga: 35000, total: 1500, deskripsi: "" },
          { id: 2, gambar: "{{ asset('images/ikan-kakap-merah.png') }}", id_ikan: "IKN002", jenis: "Kakap Merah", harga: 800, total: 800, deskripsi: "" },
          { id: 3, gambar: "{{ asset('images/ikan-barracuda.png') }}", id_ikan: "IKN003", jenis: "Barracuda", harga: 13500, total: 600, deskripsi: "" },
          { id: 4, gambar: "{{ asset('images/ikan-ogos.png') }}", id_ikan: "IKN004", jenis: "Ogos", harga: 13500, total: 1200, deskripsi: "" },
          { id: 5, gambar: "{{ asset('images/ikan-kembung.png') }}", id_ikan: "IKN005", jenis: "Kembung", harga: 19500, total: 900, deskripsi: "" },
          { id: 6, gambar: "{{ asset('images/ikan-layang.png') }}", id_ikan: "IKN006", jenis: "Layang", harga: 13500, total: 500, deskripsi: "" },
        ];
        localStorage.setItem('siputra_ikans', JSON.stringify(this.ikans));
      }
    },
    hapus(id) {
      if (confirm('Yakin hapus ikan ini?')) {
        this.ikans = this.ikans.filter(i => i.id !== id);
        localStorage.setItem('siputra_ikans', JSON.stringify(this.ikans));
      }
    },
    formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID').format(angka);
    }
  }
}

function exportToExcel() {
    const table = document.getElementById('data-ikan-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Data Ikan" });
    XLSX.writeFile(wb, `Data_Ikan_SIPUTRA_${new Date().toISOString().slice(0,10)}.xlsx`);
}
</script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection