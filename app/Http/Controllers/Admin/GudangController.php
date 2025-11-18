<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Storage;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gudangs = Gudang::orderBy('nama_gudang')->get();
        return view('admin.manajemen.gudang.index', compact('gudangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manajemen.gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas_kg' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
            'status_sewa' => 'required|in:tersedia,tidak_tersedia',
            'status_operasional' => 'required|in:aktif,nonaktif',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gudang', 'public');
        }

        Gudang::create([
            'nama_gudang' => $request->nama_gudang,
            'lokasi' => $request->lokasi,
            'kapasitas_kg' => $request->kapasitas_kg,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'status_sewa' => $request->status_sewa,
            'status_operasional' => $request->status_operasional,
        ]);

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('admin.manajemen.gudang.edit', compact('gudang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gudang = Gudang::findOrFail($id);

        $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kapasitas_kg' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
            'status_sewa' => 'required|in:tersedia,tidak_tersedia',
            'status_operasional' => 'required|in:aktif,nonaktif',
        ]);

        $gambar = $gudang->gambar;
        if ($request->hasFile('gambar')) {
            if($gudang->gambar && Storage::disk('public')->exists($gudang->gambar)) {
                Storage::disk('public')->delete($gudang->gambar);
            }
            $gambar = $request->file('gambar')->store('gudang', 'public');
        }

        $gudang->update([
            'nama_gudang' => $request->nama_gudang,
            'lokasi' => $request->lokasi,
            'kapasitas_kg' => $request->kapasitas_kg,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'status_sewa' => $request->status_sewa,
            'status_operasional' => $request->status_operasional,
        ]);

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gudang = Gudang::findOrFail($id);

        // Hapus gambar jika ada
        if ($gudang->gambar && Storage::disk('public')->exists($gudang->gambar)) {
            Storage::disk('public')->delete($gudang->gambar);
        }

        $gudang->delete();

        return redirect()->route('admin.gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }
}
