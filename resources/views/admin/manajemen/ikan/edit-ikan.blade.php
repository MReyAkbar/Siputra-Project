@extends('layouts.admin')

@section('title', 'Edit Ikan')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Edit Ikan</h1>
          <p class="mt-1 text-sm text-gray-600">Edit data dan informasi Ikan</p>
        </div>
        <a href="{{ url('/admin/manajemen/ikan/data-ikan') }}" class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition-colors">
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
        <div class="p-8 bg-[#134686]" x-data="formEdit({{ $id }})">
          <form @submit.prevent="update()">
            <div class="space-y-6">
              <div>
                <label class="block text-white text-sm font-semibold mb-3">Gambar Ikan</label>
                <div 
                  @dragover.prevent="dragOver = true" 
                  @dragleave.prevent="dragOver = false" 
                  @drop.prevent="handleDrop($event)"
                  :class="dragOver ? 'ring-4 ring-yellow-400' : ''"
                  class="relative border-4 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all"
                  :style="dragOver ? 'background: rgba(251, 191, 36, 0.1)' : ''">
                  
                  <input type="file" accept="image/*" @change="handleFile($event)" class="absolute inset-0 opacity-0 cursor-pointer">
                  
                  <div class="space-y-4">
                    <div class="mx-auto w-32 h-32">
                      <img :src="gambarPreview" class="w-full h-full object-cover rounded-xl shadow-2xl border-4 border-white">
                    </div>
                    <div>
                      <p class="text-white font-medium">Drag & drop untuk ganti gambar</p>
                      <p class="text-gray-300 text-sm">atau klik untuk pilih file</p>
                      <p class="text-xs text-gray-400 mt-2">Kosongkan = tidak ganti gambar</p>
                    </div>
                  </div>
                </div>
                <div x-show="error" class="mt-3 p-4 bg-red-600 bg-opacity-20 border border-red-500 rounded-lg">
                    <p class="text-red-200 text-sm" x-text="error"></p>
                </div>
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">ID Ikan</label>
                <input x-model="form.id_ikan" type="text" required class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                <input x-model="form.jenis" type="text" required class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Harga Jual (Rp)</label>
                <input x-model.number="form.harga" type="number" required class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Total Jumlah (Kg)</label>
                <input x-model.number="form.total" type="number" required class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Deskripsi</label>
                <textarea x-model="form.deskripsi" rows="4" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"></textarea>
              </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
              <a href="{{ url('admin/manajemen/ikan/data-ikan') }}" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                Batal
              </a>
              <button type="submit" :disabled="loading" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition flex items-center gap-3 disabled:opacity-70">
                <span x-show="loading" class="animate-spin">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                  </svg>
                </span>
                Update Ikan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function formEdit(id) {
  return {
    dragOver: false,
    loading: false,
    error: '',
    gambarPreview: '',
    form: {},

    init() {
      let data = JSON.parse(localStorage.getItem('siputra_ikans') || '[]');
      let ikan = data.find(i => i.id == id);
      this.form = { ...ikan };
      this.gambarPreview = ikan.gambar;
    },

    async processImage(file) {
      this.error = '';
      if (!file.type.match('image.*')) {
        this.error = 'File harus berupa gambar!';
        return null;
      }
      if (file.size > 2 * 1024 * 1024) {
        this.error = 'Ukuran gambar maksimal 2MB!';
        return null;
      }

      return new Promise((resolve) => {
        const img = new Image();
        img.onload = () => {
          const canvas = document.createElement('canvas');
          const ctx = canvas.getContext('2d');
          let width = img.width;
          let height = img.height;
          if (width > 800) {
              height = (800 / width) * height;
              width = 800;
          }
          canvas.width = width;
          canvas.height = height;
          ctx.drawImage(img, 0, 0, width, height);
          canvas.toBlob((blob) => {
              const reader = new FileReader();
              reader.onload = () => resolve(reader.result);
              reader.readAsDataURL(blob);
          }, 'image/webp', 0.8);
        };
        img.src = URL.createObjectURL(file);
      });
    },

    async handleFile(e) {
      const file = e.target.files[0];
      if (file) {
        this.loading = true;
        const compressed = await this.processImage(file);
        if (compressed) {
          this.gambarPreview = compressed;
          this.form.gambar = compressed;
        }
        this.loading = false;
      }
    },

    handleDrop(e) {
      this.dragOver = false;
      const file = e.dataTransfer.files[0];
      if (file) this.handleFile({ target: { files: [file] } });
    },

    async update() {
      this.loading = true;
      await new Promise(r => setTimeout(r, 800));

      let data = JSON.parse(localStorage.getItem('siputra_ikans') || '[]');
      let index = data.findIndex(i => i.id == id);
      data[index] = { ...this.form, id: data[index].id };
      localStorage.setItem('siputra_ikans', JSON.stringify(data));

      alert('Ikan berhasil diperbarui!');
      window.location.href = '/admin/manajemen/ikan/data-ikan';
    }
  }
}
</script>
@endsection