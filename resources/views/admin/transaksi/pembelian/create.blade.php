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

        <a href="{{ route('admin.pembelian.index') }}" 
           class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
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

          {{-- FORM --}}
          <form action="{{ route('admin.pembelian.store') }}" method="POST">
            @csrf

            <div class="space-y-6">

              {{-- Pilih Gudang --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Gudang Tujuan</label>
                <select name="gudang_id" required
                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                  <option value="">-- Pilih Gudang --</option>
                  @foreach($gudang as $g)
                    <option value="{{ $g->id }}">{{ $g->nama_gudang }} ({{ $g->lokasi }})</option>
                  @endforeach
                </select>
              </div>

              {{-- Pilih Supplier --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Supplier</label>
                <select name="supplier_id" required
                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                  <option value="">-- Pilih Supplier --</option>
                  @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->display_name }}</option>
                  @endforeach
                </select>
              </div>

              {{-- Pilih Ikan --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                <select name="ikan_id" required class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                  <option value="">-- Pilih Ikan --</option>
                  @foreach($ikan as $i)
                    <option value="{{ $i->id }}">{{ $i->kode }} - {{ $i->nama }}</option>
                  @endforeach
                </select>
              </div>

              {{-- Surat Jalan --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jumlah Kirim (Surat Jalan - Kg)</label>
                <input x-model.number="form.kirim" @input="hitungTotal()" 
                       type="number" min="0" required name="jumlah_kirim"
                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900" placeholder="800">
              </div>

              {{-- Tally --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jumlah Terima (Tally - Kg)</label>
                <input x-model.number="form.terima" @input="hitungTotal()" 
                       type="number" min="0" required name="jumlah_terima"
                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900" placeholder="750">
              </div>

              {{-- Harga Beli --}}
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Harga Total (Rp)</label>
                <input type="number" min="0" required name="harga_beli"
                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900" placeholder="50.000.000">
              </div>

              {{-- Total Berat --}}
              <div class="bg-green-600 bg-opacity-20 p-4 rounded-lg">
                <p class="text-white font-bold">Total Berat: 
                  <span x-text="form.total + ' kg'"></span>
                </p>
              </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ route('admin.pembelian.index') }}"
                 class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>

              <button type="submit"
                      class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                Input Pembelian
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
    form: { kirim: 0, terima: 0, total: 0 },

    hitungTotal() {
      this.form.total = (this.form.terima || 0);
    },
  };
}
</script>
@endsection
