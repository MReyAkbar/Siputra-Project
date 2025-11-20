@extends('layouts.admin')

@section('title', 'Input Pembelian')

@section('content')
<div class="min-h-screen bg-gray-50">

  {{-- HEADER --}}
  <div class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Input Pembelian</h1>
          <p class="mt-1 text-sm text-gray-600">Tambahkan data transaksi pembelian perusahaan</p>
        </div>

        <a href="{{ route('admin.pembelian.index') }}"
           class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Kembali
        </a>
      </div>
    </div>
  </div>


  {{-- FORM PEMBELIAN --}}
  <div class="flex items-center justify-center p-6">
    <div class="w-full max-w-3xl">

      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

        <div class="p-8 bg-[#134686]">

          <form method="POST" action="{{ route('admin.pembelian.store') }}">
            @csrf

            {{-- PILIH GUDANG --}}
            <div class="mb-6">
              <label class="block text-white text-sm font-semibold mb-2">Gudang</label>
              <select name="gudang_id" required 
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Gudang --</option>
                @foreach($gudang as $g)
                  <option value="{{ $g->id }}">{{ $g->nama_gudang }} ({{ $g->lokasi }})</option>
                @endforeach
              </select>
            </div>

            {{-- PILIH SUPPLIER --}}
            <div class="mb-6">
              <label class="block text-white text-sm font-semibold mb-2">Supplier</label>
              <select name="supplier_id" required 
                      class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                <option value="">-- Pilih Supplier --</option>
                @foreach($supplier as $s)
                  <option value="{{ $s->id }}">{{ $s->display_name }}</option>
                @endforeach
              </select>
            </div>


            {{-- ================= MULTI IKAN SECTION ================= --}}
            <div id="rows-container" class="space-y-6">

              {{-- ROW TEMPLATE --}}
              <div class="row-item bg-white rounded-xl shadow p-4">

                {{-- Jenis Ikan --}}
                <label class="block text-sm text-gray-700 font-semibold mb-2">Jenis Ikan</label>
                <select name="ikan_id[0]" class="input-ikan w-full px-4 py-3 rounded-lg bg-gray-100 mb-3">
                  <option value="">-- Pilih Ikan --</option>
                  @foreach($ikan as $i)
                    <option value="{{ $i->id }}">{{ $i->kode }} - {{ $i->nama }}</option>
                  @endforeach
                </select>

                {{-- Jumlah Kirim --}}
                <label class="block text-sm text-gray-700 font-semibold mb-2">Jumlah Kirim (Kg)</label>
                <input type="number" min="0" name="jumlah_kirim[0]" 
                       class="input-kirim w-full px-4 py-3 rounded-lg bg-white mb-3">

                {{-- Jumlah Terima --}}
                <label class="block text-sm text-gray-700 font-semibold mb-2">Jumlah Terima (Kg)</label>
                <input type="number" min="0" name="jumlah_terima[0]"
                       class="input-terima w-full px-4 py-3 rounded-lg bg-white mb-3">

                {{-- Harga Beli --}}
                <label class="block text-sm text-gray-700 font-semibold mb-2">Harga Beli (Rp)</label>
                <input type="number" min="0" name="harga_beli[0]"
                       class="input-harga w-full px-4 py-3 rounded-lg bg-white mb-3">

                {{-- Total --}}
                <div class="bg-green-600 bg-opacity-20 p-3 rounded-lg">
                  <p class="text-white font-bold">Total Berat:
                    <span class="total-text">0 kg</span>
                  </p>
                </div>

                {{-- HAPUS --}}
                <button type="button"
                        class="hapus-btn text-red-600 mt-3 text-sm font-semibold hover:text-red-800">
                  Hapus
                </button>

              </div>
            </div>

            {{-- BUTTON TAMBAH IKAN --}}
            <button type="button" id="btnTambah"
                    class="w-full mt-4 bg-white border border-white py-2 px-4 rounded-lg text-[#134686] font-semibold hover:bg-gray-50 transition">
              + Tambah Ikan
            </button>



            {{-- SUBMIT --}}
            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ route('admin.pembelian.index') }}"
                 class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>
              <button type="submit"
                 class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                Simpan Pembelian
              </button>
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>


{{-- ================= JAVASCRIPT DINAMIS ================= --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

  const container = document.getElementById('rows-container');
  const btnTambah = document.getElementById('btnTambah');

  // Tambah Row Baru
  btnTambah.addEventListener('click', function () {
    const index = container.children.length;
    const template = container.children[0].cloneNode(true);

    // Reset isi input
    template.querySelectorAll('input').forEach(i => i.value = '');
    template.querySelector('.total-text').textContent = '0 kg';

    // Update name attribute
    template.querySelector('.input-ikan').setAttribute('name', `ikan_id[${index}]`);
    template.querySelector('.input-kirim').setAttribute('name', `jumlah_kirim[${index}]`);
    template.querySelector('.input-terima').setAttribute('name', `jumlah_terima[${index}]`);
    template.querySelector('.input-harga').setAttribute('name', `harga_beli[${index}]`);

    container.appendChild(template);
  });


  // Event Delegation untuk update total & hapus row
  container.addEventListener('input', function (e) {
    if (e.target.classList.contains('input-terima')) {
      const row = e.target.closest('.row-item');
      const total = row.querySelector('.total-text');
      total.textContent = `${e.target.value} kg`;
    }
  });

  container.addEventListener('click', function (e) {
    if (e.target.classList.contains('hapus-btn')) {
      if (container.children.length > 1) {
        e.target.closest('.row-item').remove();
      }
    }
  });

});
</script>

@endsection
