<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use App\Models\Ikan;

class KatalogController extends Controller
{
    public function index()
    {
        // Ambil katalog aktif + relasi ikan
        $items = CatalogItem::with('ikan.kategori')
                    ->where('is_active', 1)
                    ->latest()
                    ->get();

        return view('katalog', compact('items'));
    }

    public function show($id)
    {
        $item = CatalogItem::with('ikan')->findOrFail($id);

        // Produk terkait = ikan lain dalam kategori sama
        $related = CatalogItem::with('ikan')
                    ->where('id', '!=', $id)
                    ->where('is_active', 1)
                    ->take(4)
                    ->get();

        return view('detail-ikan', compact('item', 'related'));
    }
}
