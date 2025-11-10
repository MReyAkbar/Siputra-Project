@extends('layouts.admin')

@section('title', 'Manajemen Data Gudang')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Gudang</h1>
          <p class="mt-1 text-sm text-gray-600">Kelola data dan informasi gudang</p>
        </div>
        <div>
          <button onclick="exportToExcel()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-md transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
              Download
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="data-gudang-table">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gudang</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kapasitas</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody x-data="gudangList()" class="bg-white divide-y divide-gray-200">
            <template x-for="gudang in gudangs" :key="gudang.id">
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4"><img :src="gudang.gambar" class="w-16 h-16 object-cover rounded-lg"></td>
                <td class="px-6 py-4 text-sm font-mono" x-text="gudang.id_gudang"></td>
                <td class="px-6 py-4 text-sm" x-text="gudang.nama"></td>
                <td class="px-6 py-4 text-sm" x-text="gudang.lokasi"></td>
                <td class="px-6 py-4 text-sm" x-text="gudang.kapasitas + ' kg'"></td>
                <td class="px-6 py-4 text-sm" x-text="gudang.status"></td>
                <td class="px-6 py-4">
                  <div class="flex gap-3">
                    <a :href="'/admin/manajemen/gudang/' + gudang.id + '/edit-gudang'" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">Edit</a>
                    <button @click="hapus(gudang.id)" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition transform hover:scale-105 shadow-sm">Hapus</button>
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
  function gudangList() {
    return {
      gudangs: JSON.parse(localStorage.getItem('siputra_gudangs') || '[]'),
      init() {
        if (this.gudangs.length === 0) {
          this.gudangs = [
            {id: 1, gambar: "{{ asset('images/gudang-1.png') }}", id_gudang: 'GDG001', nama: 'Gudang 1', lokasi: 'Sidoarjo', kapasitas: 20000, status: 'Tersedia', deskripsi:''},
            {id: 2, gambar: "{{ asset('images/gudang-2-2.jpeg') }}", id_gudang: 'GDG002', nama: 'Gudang 2', lokasi: 'Sidoarjo', kapasitas: 40000, status: 'Tidak Tersedia', deskripsi:''},
          ];
          localStorage.setItem('siputra_gudangs', JSON.stringify(this.gudangs));
        }
      },
      hapus(id) {
        if (confirm('Yakin hapus gudang ini?')) {
          this.gudangs = this.gudangs.filter(i => i.id !== id);
          localStorage.setItem('siputra_gudangs', JSON.stringify(this.gudangs))
        }
      }
    }
  }

  function exportToExcel() {
    const table = document.getElementById('data-gudang-table');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Data Gudang "});
    XLSX.writeFile(wb, `Data_Gudang_SIPUTRA_${new Date().toISOString().slice(0, 10)}.xlsx`);
  }
</script>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection