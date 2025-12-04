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

  <!-- ALERT MESSAGES -->
  @if(session('success'))
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('success') }}</span>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ session('error') }}</span>
    </div>
  </div>
  @endif

  @if($errors->any())
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif

  <!-- FORM -->
  <div class="flex items-center justify-center p-6">
    <div class="w-full max-w-3xl">
      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden"
           x-data="multiPenjualan({{ $ikan }}, {{ $customer }}, {{ $gudang }})">

        <form method="POST" action="{{ route('admin.penjualan.store') }}" @submit="return validateForm($event)">
          @csrf

          <div class="p-8 bg-[#134686] space-y-6">

            <!-- SELECT CUSTOMER -->
            <div>
              <label class="block text-white text-sm font-semibold mb-2">Customer</label>
              <select name="customer_id" required
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Customer --</option>
                @foreach($customer as $c)
                  <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>
                    {{ $c->display_name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- SELECT GUDANG -->
            <div>
              <label class="block text-white text-sm font-semibold mb-2">Gudang</label>
              <select name="gudang_id" required
                      x-model="selectedGudangId"
                      @change="onGudangChange()"
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Gudang --</option>
                @foreach($gudang as $g)
                  <option value="{{ $g->id }}" {{ old('gudang_id') == $g->id ? 'selected' : '' }}>
                    {{ $g->nama_gudang }}
                  </option>
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
                          required
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
                       class="bg-blue-100 border border-blue-400 p-3 rounded-lg mb-3">
                    <p class="text-blue-900 font-semibold">
                      Stok Tersedia: <span x-text="row.stok + ' kg'"></span>
                    </p>
                  </div>

                  <!-- JUMLAH -->
                  <label class="block text-gray-700 text-sm font-semibold mb-1">Jumlah (Kg)</label>
                  <input type="number" min="0" step="0.01"
                         required
                         class="w-full px-4 py-3 rounded-lg bg-white text-gray-900 mb-2"
                         :name="'jumlah['+index+']'"
                         x-model="row.jumlah"
                         @input="updateSubtotal(index)">

                  <!-- ERROR MESSAGE -->
                  <div x-show="row.error" 
                       class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded mb-2">
                    <p class="text-sm font-semibold" x-text="row.error"></p>
                  </div>

                  <!-- HARGA -->
                  <label class="block text-gray-700 text-sm font-semibold mb-1">Harga/kg (Rp)</label>
                  <input type="number" min="0" step="0.01"
                         required
                         class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
                         :name="'harga_jual['+index+']'"
                         x-model="row.harga"
                         @input="updateSubtotal(index)">

                  <!-- SUBTOTAL -->
                  <div class="bg-green-100 border border-green-400 p-3 rounded-lg mt-3">
                    <p class="text-green-900 font-bold">
                      Subtotal: Rp <span x-text="formatRupiah(row.subtotal)"></span>
                    </p>
                  </div>

                  <!-- HAPUS -->
                  <button type="button"
                          @click="hapus(index)"
                          x-show="rows.length > 1"
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
            <div class="bg-green-600 bg-opacity-30 border-2 border-white p-4 rounded-lg">
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
    selectedGudangId: '{{ old("gudang_id") }}',
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
      if (this.rows.length > 1) {
        this.rows.splice(i, 1);
        this.hitungGrandTotal();
      }
    },

    onGudangChange() {
      // Reset all stock info when warehouse changes
      this.rows.forEach(row => {
        if (row.ikan_id) {
          row.stok = null;
          row.ikan_id = '';
          row.harga = 0;
          row.jumlah = 0;
          row.subtotal = 0;
          row.error = '';
        }
      });
      this.hitungGrandTotal();
    },

    updateSubtotal(i) {
      let r = this.rows[i];
      r.subtotal = (parseFloat(r.jumlah) || 0) * (parseFloat(r.harga) || 0);

      // Validate stock
      if (r.stok !== null && parseFloat(r.jumlah) > parseFloat(r.stok)) {
        r.error = `Jumlah melebihi stok tersedia! Stok: ${r.stok} kg`;
      } else {
        r.error = "";
      }

      this.hitungGrandTotal();
    },

    hitungGrandTotal() {
      this.totalAll = this.rows.reduce((t, r) => t + r.subtotal, 0);
    },

    async cekStok(i) {
      let row = this.rows[i];
      let ikanId = row.ikan_id;
      
      if (!ikanId) {
        row.stok = null;
        row.harga = 0;
        row.subtotal = 0;
        this.hitungGrandTotal();
        return;
      }

      if (!this.selectedGudangId) {
        alert('Pilih gudang terlebih dahulu!');
        row.ikan_id = '';
        return;
      }

      try {
        // Correct URL - match the route definition
        let url = `/admin/api/stok/${ikanId}?gudang_id=${this.selectedGudangId}`;
        console.log('Fetching from:', url); // Debug log
        
        let res = await fetch(url);
        
        if (!res.ok) {
          let errorText = await res.text();
          console.error('Response error:', res.status, errorText);
          throw new Error(`HTTP error! status: ${res.status}`);
        }
        
        let json = await res.json();
        console.log('API Response:', json); // Debug log
        
        // Set stock
        row.stok = json.stok || 0;
        
        // Auto-fill price from harga_beli (this is price per kg)
        if (json.harga_beli) {
          row.harga = parseFloat(json.harga_beli);
          // Recalculate subtotal if quantity already entered
          this.updateSubtotal(i);
        }
        
        // Validate current quantity against stock
        if (row.jumlah > row.stok) {
          row.error = `Jumlah melebihi stok tersedia! Stok: ${row.stok} kg`;
        }
        
      } catch (error) {
        console.error('Error fetching stock:', error);
        alert('Gagal mengambil data stok. Silakan coba lagi.\n\nDetail error: ' + error.message);
        row.stok = null;
        row.harga = 0;
      }
    },

    validateForm(event) {
      // Check if warehouse is selected
      if (!this.selectedGudangId) {
        event.preventDefault();
        alert('Pilih gudang terlebih dahulu!');
        return false;
      }

      // Check if there's at least one item
      if (this.rows.length === 0) {
        event.preventDefault();
        alert('Tambahkan minimal satu item ikan!');
        return false;
      }

      // Validate each row
      for (let i = 0; i < this.rows.length; i++) {
        let row = this.rows[i];
        
        // Check if fish is selected
        if (!row.ikan_id) {
          event.preventDefault();
          alert(`Pilih jenis ikan pada baris ${i + 1}!`);
          return false;
        }

        // Check quantity
        if (!row.jumlah || row.jumlah <= 0) {
          event.preventDefault();
          alert(`Masukkan jumlah yang valid pada baris ${i + 1}!`);
          return false;
        }

        // Check price
        if (!row.harga || row.harga <= 0) {
          event.preventDefault();
          alert(`Masukkan harga yang valid pada baris ${i + 1}!`);
          return false;
        }

        // Check stock availability
        if (row.stok !== null && parseFloat(row.jumlah) > parseFloat(row.stok)) {
          event.preventDefault();
          let ikanName = this.ikanList.find(ikan => ikan.id == row.ikan_id)?.nama || 'Ikan';
          alert(`${ikanName} - Stok tidak mencukupi!\nStok tersedia: ${row.stok} kg\nJumlah diminta: ${row.jumlah} kg`);
          return false;
        }
      }

      return true;
    }
  }
}
</script>

@endsection