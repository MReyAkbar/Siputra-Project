<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StokGudang;
use App\Models\Ikan;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function cekStok($ikan_id, Request $r)
    {
        $gudang_id = $r->gudang_id;

        if (!$gudang_id) {
            return response()->json([
                'error' => 'Parameter gudang_id wajib'
            ], 400);
        }

        // Ambil stok berdasarkan gudang + ikan
        $stok = StokGudang::where('ikan_id', $ikan_id)
            ->where('gudang_id', $gudang_id)
            ->first();

        // Ambil data ikan untuk harga
        $ikan = Ikan::find($ikan_id);

        return response()->json([
            'ikan_id'   => $ikan_id,
            'gudang_id' => $gudang_id,
            'stok'      => $stok ? $stok->jumlah_stok : 0,
            'harga_beli' => $ikan ? $ikan->harga_beli : 0
        ]);
    }
}