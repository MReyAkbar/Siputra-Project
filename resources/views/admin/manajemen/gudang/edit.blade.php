@extends('layouts.admin')

@section('title', 'Edit Gudang')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Gudang</h1>
                    <p class="mt-1 text-sm text-gray-600">Perbarui data dan informasi gudang</p>
                </div>

                <a href="{{ route('admin.gudang.index') }}"
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

                    <form action="{{ route('admin.gudang.update', $gudang->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            {{-- Gambar --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Gambar Gudang</label>

                                <div class="w-full flex flex-col items-center">
                                    <img 
                                        src="{{ $gudang->gambar ? asset('storage/'.$gudang->gambar) : asset('images/no-image.png') }}"
                                        class="w-40 h-40 object-cover rounded-xl border-4 border-white shadow-xl mb-4">

                                    <input type="file" name="gambar"
                                           class="block w-full text-white text-sm 
                                                  file:bg-white file:text-gray-900 
                                                  file:px-4 file:py-2 file:rounded-lg 
                                                  file:border-0 file:cursor-pointer">
                                </div>

                                @error('gambar')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nama Gudang --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Nama Gudang</label>
                                <input type="text" 
                                       name="nama_gudang" 
                                       value="{{ old('nama_gudang', $gudang->nama_gudang) }}"
                                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('nama_gudang')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Lokasi --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Lokasi</label>
                                <input type="text" 
                                       name="lokasi"
                                       value="{{ old('lokasi', $gudang->lokasi) }}"
                                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('lokasi')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kapasitas --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Kapasitas (Kg)</label>
                                <input type="number" 
                                       name="kapasitas_kg"
                                       value="{{ old('kapasitas_kg', $gudang->kapasitas_kg) }}"
                                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('kapasitas_kg')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status Sewa --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Status Sewa</label>
                                <select name="status_sewa"
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                                    <option value="tersedia" 
                                        {{ $gudang->status_sewa == 'tersedia' ? 'selected' : '' }}>
                                        Tersedia
                                    </option>

                                    <option value="tidak_tersedia" 
                                        {{ $gudang->status_sewa == 'tidak_tersedia' ? 'selected' : '' }}>
                                        Tidak Tersedia
                                    </option>
                                </select>

                                @error('status_sewa')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status Operasional --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Status Operasional</label>
                                <select name="status_operasional"
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">
                                    <option value="aktif" 
                                        {{ $gudang->status_operasional === 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="nonaktif" 
                                        {{ $gudang->status_operasional === 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>
                                </select>

                                @error('status_operasional')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                          class="w-full px-4 py-3 rounded-lg bg-white text-gray-900"
                                          placeholder="Informasi gudang...">{{ old('deskripsi', $gudang->deskripsi) }}</textarea>

                                @error('deskripsi')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-8 flex justify-end gap-4">

                            <a href="{{ route('admin.gudang.index') }}"
                               class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                                Update Gudang
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
