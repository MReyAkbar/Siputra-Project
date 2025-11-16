@extends('layouts.admin')

@section('title', 'Tambah Item Katalog')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Item Katalog</h1>
                    <p class="mt-1 text-sm text-gray-600">Tambahkan produk yang akan tampil di katalog</p>
                </div>

                <a href="{{ route('admin.katalog.index') }}" 
                   class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor">
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
                <div class="p-8 bg-[#134686]" 
                     x-data="formKatalog('{{ asset('images/default-ikan.png') }}')">

                    <form method="POST" action="{{ route('admin.katalog.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">

                            {{-- Upload Gambar --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-3">Gambar Produk</label>

                                <div @dragover.prevent="dragOver = true"
                                     @dragleave.prevent="dragOver = false"
                                     @drop.prevent="handleDrop($event)"
                                     :class="dragOver ? 'ring-4 ring-green-400' : ''"
                                     class="relative border-4 border-dashed rounded-2xl p-8 text-center cursor-pointer transition"
                                     :style="dragOver ? 'background: rgba(34,197,94,0.1)' : ''">

                                    <input type="file" accept="image/*" name="gambar"
                                           @change="handleFile($event)"
                                           class="absolute inset-0 opacity-0 cursor-pointer">

                                    <div class="space-y-4">
                                        <div class="w-32 h-32 mx-auto">
                                            <img :src="gambarPreview"
                                                 class="w-full h-full object-cover rounded-xl shadow-2xl border-4 border-white">
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Drag & drop gambar di sini</p>
                                            <p class="text-gray-300 text-sm">atau klik untuk pilih file</p>
                                            <p class="text-xs text-gray-400 mt-2">Max 2MB • Otomatis dikompres</p>
                                        </div>
                                    </div>
                                </div>

                                <p x-show="error" class="mt-3 text-sm text-red-300" x-text="error"></p>
                            </div>

                            {{-- Pilih Ikan --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Pilih Ikan (Master)</label>
                                <select name="ikan_id" required
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                                    <option value="">-- Pilih Ikan --</option>
                                    @foreach ($ikan as $i)
                                        <option value="{{ $i->id }}">
                                            {{ $i->nama }} ({{ $i->kategori->nama_kategori }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Harga --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Harga Jual (Rp)</label>
                                <input type="number" name="harga_jual" required
                                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="3"
                                          class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
                                          placeholder="Deskripsi katalog..."></textarea>
                            </div>

                            {{-- Status --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Status</label>
                                <select name="status" class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="mt-8 flex justify-end gap-4">
                            <a href="{{ route('admin.katalog.index') }}"
                               class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                                Batal
                            </a>

                            <button type="submit"
                                    class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition flex items-center gap-3">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function formKatalog(defaultImage) {
    return {
        dragOver: false,
        error: '',
        gambarPreview: defaultImage,

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
            if (!file) return;

            const compressed = await this.processImage(file);
            if (compressed) this.gambarPreview = compressed;
        },

        handleDrop(e) {
            this.dragOver = false;
            const file = e.dataTransfer.files[0];
            if (file) this.handleFile({ target: { files: [file] } });
        }
    }
}
</script>

@endsection
