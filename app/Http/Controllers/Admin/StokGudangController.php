<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokGudang;
use Illuminate\Http\Request;

class StokGudangController extends Controller
{
    public function index()
    {
        $stok = StokGudang::with('gudang','ikan')->orderBy('gudang_id')->orderBy('ikan_id')->get();
        return view('admin.manajemen.stok.index', compact('stok'));
    }
}
