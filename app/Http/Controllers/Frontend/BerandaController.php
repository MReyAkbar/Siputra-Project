<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gudang;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        $items = CatalogItem::with('ikan')
                    ->where('is_active', 1)
                    ->latest()
                    ->take(4)
                    ->get();

        $gudangs = Gudang::where('status_operasional','aktif')
                    ->latest()
                    ->get();
        return view('beranda', compact('items', 'gudangs'));
    }
    
    public function show($id)
    {
        $item = CatalogItem::with('item')->findOrFail($id);
        return view('detail-ikan', compact('item', 'related'));

        $gudang = Gudang::findOrFail($id);
        return view('detail-gudang', compact('gudang'));
    }
}
