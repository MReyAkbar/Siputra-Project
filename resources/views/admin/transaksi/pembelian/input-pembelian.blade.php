@extends('layouts.admin')

@section('title', 'Input Pembelian')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Input Pembelian</h1>
          <p class="mt-1 text-sm text-gray-600">Tambahkan data transaksi pembelian perusahaan</p>
        </div>
        <a href="{{ url('/admin/transaksi/pembelian/index') }}" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Kembali
        </a>
      </div>
    </div>
  </div>

  <div class="flex items-center justify-center p-6">
    <div class="w-full max-w-2xl">
      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="p-8 bg-[#134686]" x-data="formPembelian()">
          <form @submit.prevent="simpan()">
            <div class="space-y-6">
              <div>
                <label class="block text-white text-sm font-semibold mb-2">ID Ikan</label>
                <input x-model="form.id_ikan" type="text" required placeholder="IKN009" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                <input x-model="form.jenis" type="text" required placeholder="Ikan Salmon" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Supplier</label>
                <input x-model="form.supplier" type="text" required placeholder="PT. Laut Jaya" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Surat Jalan (Kg)</label>
                <input x-model.number="form.surat_jalan" @input="hitungTotal()" type="number" min="0" required placeholder="800" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Tally (Kg)</label>
                <input x-model.number="form.tally" @input="hitungTotal()" type="number" min="0" required placeholder="750" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Harga Total (Rp)</label>
                <input x-model.number="form.harga" type="number" min="0" required placeholder="50.000.000" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div class="bg-green-600 bg-opacity-20 p-4 rounded-lg">
                <p class="text-white font-bold">Total Berat: <span x-text="form.total + ' kg'"></span></p>
              </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ url('/admin/transaksi/pembelian/index') }}" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>
              <button type="submit" :disabled="loading" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition flex items-center gap-3 disabled:opacity-70">
                <span x-show="loading" class="animate-spin">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                  </svg>
                </span>
                <span x-text="loading ? 'Menyimpan...' : 'Input Pembelian'"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function formPembelian() {
  return {
    loading: false,
    form: {
      id_ikan: '', jenis: '', supplier: '', surat_jalan: 0, tally: 0, harga: 0, total: 0
    },

    hitungTotal() {
      this.form.total = (this.form.surat_jalan || 0) + (this.form.tally || 0);
    },

    async simpan() {
      if (!this.form.id_ikan || !this.form.jenis || !this.form.supplier) {
        alert('ID Ikan, Jenis, dan Supplier wajib diisi!');
        return;
      }

      this.loading = true;
      await new Promise(r => setTimeout(r, 800));

      const tanggal = new Date().toISOString().slice(0, 10);
      let data = JSON.parse(localStorage.getItem('siputra_pembelians') || '[]');
      const newId = data.length ? Math.max(...data.map(i => i.id)) + 1 : 1;

      data.push({ ...this.form, id: newId, tanggal });
      localStorage.setItem('siputra_pembelians', JSON.stringify(data));

      alert('Transaksi pembelian berhasil di-input!');
      window.location.href = '/admin/transaksi/pembelian/index';
    }
  }
}
</script>
@endsection