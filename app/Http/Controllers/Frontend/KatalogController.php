<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $items = CatalogItem::with(['ikan.kategori', 'ikan.stokGudang'])
            ->get()
            ->map(function ($item) {
                $item->ikan->jumlah_stok = $item->ikan->stokGudang->sum('jumlah_stok');
                return $item;
            });

        return view('katalog', compact('items'));
    }

    public function show($id)
    {
        $item = CatalogItem::with(['ikan.kategori', 'ikan.stokGudang.gudang'])
            ->findOrFail($id);
        
        $item->ikan->jumlah_stok = $item->ikan->stokGudang->sum('jumlah_stok');
        
        return view('detail-ikan', compact('item'));
    }
}