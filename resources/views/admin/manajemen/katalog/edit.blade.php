@extends('layouts.admin')

@section('title', 'Edit Katalog Ikan')

@section('content')
<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Katalog Ikan</h1>
                    <p class="mt-1 text-sm text-gray-600">Perbarui data katalog ikan</p>
                </div>

                <a href="{{ route('admin.katalog.index') }}"
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

                    <form action="{{ route('admin.katalog.update', $catalogItem->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            {{-- Gambar --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Gambar Katalog</label>

                                <div class="w-full flex flex-col items-center">
                                    <img 
                                        src="{{ $catalogItem->gambar ? asset('storage/'.$catalogItem->gambar) : asset('images/default-ikan.png') }}"
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

                            {{-- Pilih Ikan --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Jenis Ikan</label>
                                <select name="ikan_id"
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                    @foreach($ikan as $i)
                                        <option value="{{ $i->id }}" 
                                            {{ $catalogItem->ikan_id == $i->id ? 'selected' : '' }}>
                                            {{ $i->nama }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('ikan_id')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Harga Jual --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Harga Jual (Rp)</label>
                                <input type="number" 
                                       name="harga_jual"
                                       value="{{ old('harga_jual', $catalogItem->harga_jual) }}"
                                       class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                @error('harga_jual')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Status</label>
                                <select name="is_active"
                                        class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">

                                    <option value="1" {{ $catalogItem->is_active ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ !$catalogItem->is_active ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <label class="block text-white text-sm font-semibold mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                          class="w-full px-4 py-3 rounded-lg bg-white text-gray-900">{{ old('deskripsi', $catalogItem->deskripsi) }}</textarea>

                                @error('deskripsi')
                                <p class="text-red-200 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- BUTTON --}}
                        <div class="mt-8 flex justify-end gap-4">

                            <a href="{{ route('admin.katalog.index') }}"
                               class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition">
                                Update Katalog
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
