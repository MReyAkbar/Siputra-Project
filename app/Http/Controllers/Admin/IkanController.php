<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ikan;
use App\Models\KategoriIkan;

class IkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ikan = Ikan::with('kategori')->latest()->paginate(10);

        return view('admin.manajemen.ikan.data-ikan', compact('ikan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriIkan::all();
        return view('admin.manajemen.ikan.tambah-ikan', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_ikan,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,non-aktif',
        ]);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('ikan', 'public');
            $data['gambar'] = $path;
        }

        Ikan::create($data);

        return redirect()->route('admin.ikan.index')->with('success', 'Ikan berhasil ditambahkan.');
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
        $ikan = Ikan::findOrFail($id);
        $kategori = KategoriIkan::all();
        return view('admin.manajemen.ikan.edit-ikan', compact('ikan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ikan = Ikan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_ikan,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            if ($ikan->gambar && Storage::disk('public')->exists($ikan->gambar)) {
                Storage::disk('public')->delete($ikan->gambar);
            }
            $path = $request->file('gambar')->store('ikan', 'public');
            $data['gambar'] = $path;
        }

        $ikan->update($data);
        return redirect()->route('admin.ikan.index')->with('success', 'Ikan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ikan = Ikan::findOrFail($id);
        
        if ($ikan->gambar && Storage::disk('public')->exists($ikan->gambar)) {
            Storage::disk('public')->delete($ikan->gambar);
        }
        $ikan->delete();

        return redirect()->route('admin.ikan.index')->with('success', 'Ikan berhasil dihapus.');
    }
}
