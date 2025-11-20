<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use App\Models\Ikan;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalog = CatalogItem::with('ikan')->orderBy('id','desc')->get();
        return view('admin.manajemen.katalog.index', compact('catalog'));
    }

    public function create()
    {
        $ikan = Ikan::orderBy('nama')->get();
        return view('admin.manajemen.katalog.create', compact('ikan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ikan_id' => 'required|exists:ikan,id',
            'harga_jual' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('katalog', 'public');
        }

        CatalogItem::create([
            'ikan_id' => $request->ikan_id,
            'harga_jual' => $request->harga_jual,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active ?? 1,
            'gambar' => $gambar,
        ]);

        log_activity(
            'katalog_create',
            'Menambahkan item katalog baru untuk ikan ID: ' . $request->ikan_id,
            [
                'harga_jual' => $request->harga_jual,
                'is_active' => $request->is_active ?? 1,
            ]
        );

        return redirect()->route('admin.katalog.index')->with('success', 'Catalog item created successfully.');
    }

    public function edit($id)
    {
        $ikan = Ikan::orderBy('nama')->get();
        $catalogItem = CatalogItem::findOrFail($id);
        return view('admin.manajemen.katalog.edit', compact('catalogItem', 'ikan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ikan_id' => 'required|exists:ikan,id',
            'harga_jual' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'is_active' => 'boolean'
        ]);

        $item = CatalogItem::findOrFail($id);

        // upload gambar baru
        if ($request->hasFile('gambar')) {
            $item->gambar = $request->file('gambar')->store('katalog', 'public');
        }

        $item->update([
            'ikan_id' => $request->ikan_id,
            'harga_jual' => $request->harga_jual,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->is_active ?? 1,
        ]);

        log_activity(
            'katalog_update',
            'Memperbarui item katalog ID: ' . $item->id,
            [
                'harga_jual' => $request->harga_jual,
                'is_active' => $request->is_active ?? 1,
            ]
        );

        return redirect()->route('admin.katalog.index')->with('success', 'Catalog item updated successfully.');
    }

    public function destroy ($id)
    {
        CatalogItem::destroy($id);

        log_activity(
            'katalog_delete',
            'Menghapus item katalog ID: ' . $id,
            []
        );
        return redirect()->route('admin.katalog.index')->with('success', 'Catalog item deleted successfully.');
    }
}
