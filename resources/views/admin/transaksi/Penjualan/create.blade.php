@extends('layouts.admin')

@section('title', 'Input Penjualan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <!-- HEADER -->
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Input Penjualan</h1>
          <p class="mt-1 text-sm text-gray-600">Tambahkan data transaksi penjualan perusahaan</p>
        </div>
        <a href="{{ route('admin.penjualan.index') }}" 
           class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Kembali
        </a>
      </div>
    </div>
  </div>

  <!-- FORM -->
  <div class="flex items-center justify-center p-6">
    <div class="w-full max-w-3xl">
      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden"
           x-data="multiPenjualan({{ $ikan }}, {{ $customer }}, {{ $gudang }})">

        <form method="POST" action="{{ route('admin.penjualan.store') }}">
          @csrf

          <div class="p-8 bg-[#134686] space-y-6">

            <!-- SELECT CUSTOMER -->
            <div>
              <label class="block text-white text-sm font-semibold mb-2">Customer</label>
              <select name="customer_id" required
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Customer --</option>
                @foreach($customer as $c)
                  <option value="{{ $c->id }}">{{ $c->display_name }}</option>
                @endforeach
              </select>
            </div>

            <!-- SELECT GUDANG -->
            <div>
              <label class="block text-white text-sm font-semibold mb-2">Gudang</label>
              <select name="gudang_id" required
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Gudang --</option>
                @foreach($gudang as $g)
                  <option value="{{ $g->id }}">{{ $g->nama_gudang }}</option>
                @endforeach
              </select>
            </div>

            <!-- MULTI IKAN TABLE -->
            <div class="space-y-4">
              <template x-for="(row, index) in rows" :key="index">
                <div class="bg-white p-4 rounded-lg shadow mb-4">

                  <!-- SELECT IKAN -->
                  <label class="block text-gray-700 text-sm font-semibold mb-1">Jenis Ikan</label>
                  <select :name="'ikan_id['+index+']'"
                          class="w-full mb-3 px-4 py-3 rounded-lg bg-gray-100 text-gray-900"
                          x-model="row.ikan_id"
                          @change="cekStok(index)">
                    <option value="">-- Pilih Ikan --</option>
                    <template x-for="i in ikanList" :key="i.id">
                      <option :value="i.id" x-text="i.nama"></option>
                    </template>
                  </select>

                  <!-- STOK TERSEDIA -->
                  <div x-show="row.stok !== null"
                       class="bg-blue-600 bg-opacity-20 p-3 rounded-lg mb-3">
                    <p class="text-blue-900 font-semibold">
                      Stok Tersedia: <span x-text="row.stok + ' kg'"></span>
                    </p>
                  </div>

                  <!-- JUMLAH -->
                  <label class="block text-gray-700 text-sm font-semibold mb-1">Jumlah (Kg)</label>
                  <input type="number" min="0"
                         class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 mb-2"
                         :name="'jumlah['+index+']'"
                         x-model="row.jumlah"
                         @input="updateSubtotal(index)">

                  <p x-show="row.error" class="text-red-500 text-sm" x-text="row.error"></p>

                  <!-- HARGA -->
                  <label class="block text-gray-700 text-sm font-semibold mb-1">Harga/kg (Rp)</label>
                  <input type="number" min="0"
                         class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
                         :name="'harga_jual['+index+']'"
                         x-model="row.harga"
                         @input="updateSubtotal(index)">

                  <!-- SUBTOTAL -->
                  <div class="bg-green-600 bg-opacity-20 p-3 rounded-lg mt-3">
                    <p class="text-green-900 font-bold">
                      Subtotal: Rp <span x-text="formatRupiah(row.subtotal)"></span>
                    </p>
                  </div>

                  <!-- HAPUS -->
                  <button type="button"
                          @click="hapus(index)"
                          class="mt-3 text-red-600 hover:text-red-800 text-sm font-semibold">
                    Hapus Ikan
                  </button>

                </div>
              </template>

              <!-- TAMBAH IKAN -->
              <button type="button"
                      @click="tambah()"
                      class="w-full bg-white text-[#134686] border border-white py-2 px-4 rounded-lg font-semibold hover:bg-gray-50 transition">
                + Tambah Ikan
              </button>
            </div>

            <!-- TOTAL KESELURUHAN -->
            <div class="bg-green-600 bg-opacity-20 p-4 rounded-lg">
              <p class="text-white font-bold text-lg">
                Total Harga: Rp <span x-text="formatRupiah(totalAll)"></span>
              </p>
            </div>

            <!-- SUBMIT -->
            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ route('admin.penjualan.index') }}" 
                 class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>
              <button type="submit"
                      class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                Simpan Penjualan
              </button>
            </div>

          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<script>
function multiPenjualan(ikanList, customerList, gudangList) {
  return {
    ikanList,
    rows: [
      { ikan_id: '', jumlah: 0, harga: 0, stok: null, subtotal: 0, error: '' }
    ],
    totalAll: 0,

    formatRupiah(num) {
      return new Intl.NumberFormat('id-ID').format(num || 0);
    },

    tambah() {
      this.rows.push({ ikan_id:'', jumlah:0, harga:0, stok:null, subtotal:0, error:'' });
    },

    hapus(i) {
      this.rows.splice(i, 1);
      this.hitungGrandTotal();
    },

    updateSubtotal(i) {
      let r = this.rows[i];
      r.subtotal = (r.jumlah || 0) * (r.harga || 0);

      if (r.jumlah > r.stok) {
        r.error = "Jumlah melebihi stok tersedia!";
      } else {
        r.error = "";
      }

      this.hitungGrandTotal();
    },

    hitungGrandTotal() {
      this.totalAll = this.rows.reduce((t, r) => t + r.subtotal, 0);
    },

    async cekStok(i) {
      let ikanId = this.rows[i].ikan_id;
      if (!ikanId) return;

      let res = await fetch(`/admin/api/stok/${ikanId}`);
      let json = await res.json();

      this.rows[i].stok = json.stok;
    }
  }
}
</script>

@endsection
