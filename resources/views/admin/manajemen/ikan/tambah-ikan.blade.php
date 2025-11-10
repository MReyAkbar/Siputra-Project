@extends('layouts.admin')

@section('title', 'Tambah Ikan Baru')

@section('content')
<div class="min-h-screen bg-gray-50">
  <div class="bg-white shadow-sm border-b border-gray-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl font-bold text-gray-900">Tambah Ikan</h1>
          <p class="mt-1 text-sm text-gray-600">Tambahkan data dan informasi ikan</p>
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
        <div class="p-8 bg-[#134686]" x-data="formIkan()">
          <form @submit.prevent="simpan()">
            <div class="space-y-6">
              <div>
                <label class="block text-white text-sm font-semibold mb-3">Gambar Ikan</label>
                <div 
                  @dragover.prevent="dragOver = true" 
                  @dragleave.prevent="dragOver = false" 
                  @drop.prevent="handleDrop($event)"
                  :class="dragOver ? 'ring-4 ring-green-400' : ''"
                  class="relative border-4 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all"
                  :style="dragOver ? 'background: rgba(34, 197, 94, 0.1)' : ''">
                  
                  <input type="file" accept="image/*" @change="handleFile($event)" class="absolute inset-0 opacity-0 cursor-pointer">
                  
                  <div class="space-y-4">
                    <div class="mx-auto w-32 h-32">
                      <template x-if="gambarPreview && gambarPreview !== '' && !gambarPreview.includes('default')">
                        <img :src="gambarPreview" class="w-full h-full object-cover rounded-xl shadow-2xl border-4 border-white">
                      </template>

                      <template x-if="!gambarPreview || gambarPreview === '' || gambarPreview.includes('default')">
                        <div class="flex items-center justify-center w-full h-full">
                          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.2639 15.9376L12.5958 14.2835C11.7909 13.4852 11.3884 13.0861 10.9266 12.9402C10.5204 12.8119 10.0838 12.8166 9.68048 12.9537C9.22188 13.1096 8.82814 13.5173 8.04068 14.3327L4.04409 18.2802M14.2639 15.9376L14.6053 15.5991C15.4112 14.7999 15.8141 14.4003 16.2765 14.2544C16.6831 14.1262 17.12 14.1312 17.5236 14.2688C17.9824 14.4252 18.3761 14.834 19.1634 15.6515L20 16.4936M14.2639 15.9376L18.275 19.9566M18.275 19.9566C17.9176 20.0001 17.4543 20.0001 16.8 20.0001H7.2C6.07989 20.0001 5.51984 20.0001 5.09202 19.7821C4.71569 19.5904 4.40973 19.2844 4.21799 18.9081C4.12796 18.7314 4.07512 18.5322 4.04409 18.2802M18.275 19.9566C18.5293 19.9257 18.7301 19.8728 18.908 19.7821C19.2843 19.5904 19.5903 19.2844 19.782 18.9081C20 18.4803 20 17.9202 20 16.8001V16.4936M12.5 4L7.2 4.00011C6.07989 4.00011 5.51984 4.00011 5.09202 4.21809C4.71569 4.40984 4.40973 4.7158 4.21799 5.09213C4 5.51995 4 6.08 4 7.20011V16.8001C4 17.4576 4 17.9222 4.04409 18.2802M20 11.5V16.4936M14 10.0002L16.0249 9.59516C16.2015 9.55984 16.2898 9.54219 16.3721 9.5099C16.4452 9.48124 16.5146 9.44407 16.579 9.39917C16.6515 9.34859 16.7152 9.28492 16.8425 9.1576L21 5.00015C21.5522 4.44787 21.5522 3.55244 21 3.00015C20.4477 2.44787 19.5522 2.44787 19 3.00015L14.8425 7.1576C14.7152 7.28492 14.6515 7.34859 14.6009 7.42112C14.556 7.4855 14.5189 7.55494 14.4902 7.62801C14.4579 7.71033 14.4403 7.79862 14.4049 7.97518L14 10.0002Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </div>
                      </template>
                    </div>
                    <div>
                      <p class="text-white font-medium">Drag & drop gambar di sini</p>
                      <p class="text-gray-300 text-sm">atau klik untuk pilih file</p>
                      <p class="text-xs text-gray-400 mt-2">Max 2MB • Otomatis dikompres</p>
                    </div>
                  </div>
                </div>

                <div x-show="error" class="mt-3 p-4 bg-red-600 bg-opacity-20 border border-red-500 rounded-lg">
                  <p class="text-red-200 text-sm" x-text="error"></p>
                </div>
              </div>

              <div>
                <label class="block text-white text-sm font-semibold mb-2">ID Ikan</label>
                <input x-model="form.id_ikan" type="text" required placeholder="IKN009" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                <input x-model="form.jenis" type="text" required placeholder="Ikan Salmon" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Harga Jual (Rp)</label>
                <input x-model.number="form.harga" type="number" required placeholder="75000" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Total Jumlah (Kg)</label>
                <input x-model.number="form.total" type="number" required placeholder="800" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
              </div>
              <div>
                <label class="block text-white text-sm font-semibold mb-2">Deskripsi</label>
                <textarea x-model="form.deskripsi" rows="4" placeholder="Ikan salmon segar impor dari Norwegia..." class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"></textarea>
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
                <span x-text="loading ? 'Menyimpan...' : 'Tambah Ikan'"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function formIkan() {
  return {
    dragOver: false,
    loading: false,
    error: '',
    gambarPreview: "{{ asset('images/default-ikan.png') }}",
    form: { 
      id_ikan: '', jenis: '', harga: 0, total: 0, deskripsi: '', 
      gambar: "{{ asset('images/default-ikan.png') }}" 
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

    async simpan() {
      if (!this.form.id_ikan || !this.form.jenis) {
        alert('ID Ikan dan Jenis Ikan wajib diisi!');
        return;
      }

      this.loading = true;
      await new Promise(r => setTimeout(r, 800));

      let data = JSON.parse(localStorage.getItem('siputra_ikans') || '[]');
      const newId = data.length ? Math.max(...data.map(i => i.id)) + 1 : 1;
      data.push({ ...this.form, id: newId });
      localStorage.setItem('siputra_ikans', JSON.stringify(data));

      alert('Ikan berhasil ditambahkan!');
      window.location.href = '/admin/manajemen/ikan/data-ikan';
    }
  }
}
</script>
@endsection