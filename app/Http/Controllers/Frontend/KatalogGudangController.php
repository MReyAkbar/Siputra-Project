<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gudang;

class KatalogGudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::where('status_operasional','aktif')->get();
        return view('gudang', compact('gudangs'));
    }

    public function show($id)
    {
        $gudang = Gudang::findOrFail($id);
        return view('detail-gudang', compact('gudang'));
    }
}
