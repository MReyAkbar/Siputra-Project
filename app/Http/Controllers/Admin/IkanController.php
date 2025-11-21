<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikan;
use App\Models\KategoriIkan;
use Illuminate\Http\Request;

class IkanController extends Controller
{
    /**
     * Tampilkan semua ikan (produk final)
     */
    public function index()
    {
        $ikans = Ikan::with('kategori')->orderBy('nama')->get();

        return view('admin.manajemen.ikan.index', compact('ikans'));
    }


    /**
     * Form tambah ikan baru
     */
    public function create()
    {
        $kategori = KategoriIkan::all();

        return view('admin.manajemen.ikan.create', compact('kategori'));
    }


    /**
     * Simpan ikan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_ikan,id',
            'nama'        => 'required|string|max:255',
            'kode'        => 'nullable|string|max:50|unique:ikan,kode',
            'deskripsi'   => 'nullable|string',
            'harga_beli'  => 'nullable|numeric',
        ]);

        // Generate kode jika tidak diisi (opsional)
        $kode = $request->kode;
        if (!$kode) {
            $kode = strtoupper(substr($request->nama, 0, 3)) . '-' . rand(100, 999);
        }

        Ikan::create([
            'kategori_id' => $request->kategori_id,
            'nama'        => $request->nama,
            'kode'        => $kode,
            'harga_beli'  => $request->harga_beli,
            'deskripsi'   => $request->deskripsi,
        ]);

        log_activity(
            'ikan_create',
            'Menambahkan data ikan baru: ' . $request->nama,
            [
                'nama' => $request->nama,
                'kode' => $kode,
            ]
        );

        return redirect()->route('admin.ikan.index')->with('success', 'Data ikan berhasil ditambahkan.');
    }


    /**
     * Form edit ikan
     */
    public function edit($id)
    {
        $ikan = Ikan::findOrFail($id);
        $kategori = KategoriIkan::all();

        return view('admin.manajemen.ikan.edit', compact('ikan', 'kategori'));
    }


    /**
     * Update ikan
     */
    public function update(Request $request, $id)
    {
        $ikan = Ikan::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategori_ikan,id',
            'nama'        => 'required|string|max:255',
            'kode'        => 'required|string|max:50|unique:ikan,kode,' . $ikan->id,
            'deskripsi'   => 'nullable|string',
            'harga_beli'  => 'nullable|numeric',
        ]);

        $ikan->update([
            'kategori_id' => $request->kategori_id,
            'nama'        => $request->nama,
            'kode'        => $request->kode,
            'harga_beli'  => $request->harga_beli,
            'deskripsi'   => $request->deskripsi,
        ]);

        log_activity(
            'ikan_update',
            'Memperbarui data ikan ID: ' . $ikan->id,
            [
                'nama' => $request->nama,
                'kode' => $request->kode,
            ]
        );

        return redirect()->route('admin.ikan.index')->with('success', 'Data ikan berhasil diperbarui.');
    }


    /**
     * Hapus ikan
     */
    public function destroy($id)
    {
        $ikan = Ikan::findOrFail($id);
        $ikan->delete();

        log_activity(
            'ikan_delete',
            'Menghapus data ikan ID: ' . $ikan->id,
            [
                'nama' => $ikan->nama,
                'kode' => $ikan->kode,
            ]
        );

        return redirect()->route('admin.ikan.index')->with('success', 'Data ikan berhasil dihapus.');
    }
}
