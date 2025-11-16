@extends('layouts.admin')

@section('title', 'Edit Ikan')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Ikan</h1>
                    <p class="mt-1 text-sm text-gray-600">Edit data dan informasi master ikan</p>
                </div>

                <a href="{{ route('admin.ikan.index') }}"
                class="inline-flex items-center gap-2 text-[#134686] hover:text-[#0d3566] font-medium transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="flex items-center justify-center p-6">
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-8 bg-[#134686]">

                    <form action="{{ route('admin.ikan.update', $ikan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            {{-- Kategori --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Kategori Ikan</label>
                                <select name="kategori_id"
                                    class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                    <option value="">-- Pilih Kategori --</option>

                                    @foreach($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $ikan->kategori_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kode Ikan --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Kode Ikan</label>
                                <input type="text" name="kode"
                                    value="{{ old('kode', $ikan->kode) }}"
                                    class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('kode')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nama Ikan --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Nama Ikan</label>
                                <input type="text" name="nama"
                                    value="{{ old('nama', $ikan->nama) }}"
                                    class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('nama')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Harga Beli --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Harga Beli (Rp)</label>
                                <input type="number" name="harga_beli"
                                    value="{{ old('harga_beli', $ikan->harga_beli) }}"
                                    class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('harga_beli')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Status</label>
                                <select name="status"
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                    <option value="aktif" {{ $ikan->status === 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="nonaktif" {{ $ikan->status === 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Deskripsi (opsional)</label>
                                <textarea name="deskripsi" rows="4"
                                    class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">{{ old('deskripsi', $ikan->deskripsi) }}</textarea>

                                @error('deskripsi')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-8 flex justify-end gap-4">

                            <a href="{{ route('admin.ikan.index') }}"
                               class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                                Update Ikan
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
