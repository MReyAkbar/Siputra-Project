@extends('layouts.admin')

@section('title', 'Input Penjualan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Input Penjualan</h1>
          <p class="mt-1 text-sm text-gray-600">Tambahkan data transaksi penjualan perusahaan</p>
        </div>
        <a href="{{ url('/admin/transaksi/penjualan/index') }}" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
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
        <div class="p-8 bg-[#134686]" x-data="formPenjualan()">
          <form @submit.prevent="simpan()">
            <div class="space-y-6">
              <div>
                <label class="block text-white text-sm font-semibold mb-2">ID Ikan</label>
                <input x-model="form.id_ikan" @blur="cariIkan()" type="text" required placeholder="IKN009" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                <input x-model="form.jenis" type="text" placeholder="Tuna" class="w-full px-4 py-3 rounded-lg bg-gray-100 text-gray-700">
              </div>

              <div x-show="stokTersedia !== null" class="bg-blue-600 bg-opacity-20 p-4 rounded-lg">
                <p class="text-white font-bold">Stok Tersedia: <span x-text="stokTersedia + ' kg'"></span></p>
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">Customer</label>
                <input x-model="form.customer" type="text" required placeholder="Nama customer" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jumlah (kg)</label>
                <input x-model.number="form.jumlah" @input="hitungTotal(); cekStok()" type="number" min="0" required placeholder="500" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <p x-show="errorStok" class="mt-2 text-red-300 text-sm" x-text="errorStok"></p>
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">Harga/kg (Rp)</label>
                <input x-model.number="form.harga" @input="hitungTotal()" type="number" min="0" required placeholder="75.000" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>

              <div class="bg-green-600 bg-opacity-20 p-4 rounded-lg">
                <p class="text-white font-bold text-lg">Total Harga: Rp <span x-text="formatRupiah(form.total)"></span></p>
              </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ url('/admin/transaksi/penjualan/index') }}" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>
              <button type="submit" :disabled="loading || !stokCukup" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition flex items-center gap-3 disabled:opacity-70">
                <span x-show="loading" class="animate-spin">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                  </svg>
                </span>
                <span x-text="loading ? 'Menyimpan...' : 'Input Penjualan'"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function formPenjualan() {
  return {
    loading: false,
    errorStok: '',
    stokTersedia: null,
    stokCukup: true,
    form: { id_ikan: '', jenis: '', customer: '', jumlah: 0, harga: 0, total: 0 },

    formatRupiah(angka) {
      return new Intl.NumberFormat('id-ID').format(angka);
    },

    hitungTotal() {
      this.form.total = (this.form.jumlah || 0) * (this.form.harga || 0);
    },

    async simpan() {
      if (!this.form.id_ikan || !this.form.jenis || !this.form.customer) {
        alert('ID Ikan, Jenis, dan Customer wajib diisi!');
        return;
      }
      if (!this.stokCukup) {
        alert('Jumlah melebihi stok tersedia!');
        return;
      }

      this.loading = true;
      await new Promise(r => setTimeout(r, 800));

      const tanggal = new Date().toISOString().slice(0, 10);
      let penjualans = JSON.parse(localStorage.getItem('siputra_penjualans') || '[]');
      const newId = penjualans.length ? Math.max(...penjualans.map(i => i.id)) + 1 : 1;

      penjualans.push({ ...this.form, id: newId, tanggal });
      localStorage.setItem('siputra_penjualans', JSON.stringify(penjualans));

      let ikans = JSON.parse(localStorage.getItem('siputra_ikans') || '[]');
      const index = ikans.findIndex(i => i.id_ikan === this.form.id_ikan);
      if (index !== -1) {
        ikans[index].total -= this.form.jumlah;
        localStorage.setItem('siputra_ikans', JSON.stringify(ikans));
      }

      alert('Penjualan berhasil! Stok ikan otomatis berkurang.');
      window.location.href = '/admin/transaksi/penjualan/index';
    }
  }
}
</script>
@endsection