<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPembelian;
use App\Models\DetailPembelian;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\Ikan;
use App\Models\StokGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = TransaksiPembelian::with(['detail.ikan','supplier'])->orderBy('tanggal','desc')->get();
        return view('admin.transaksi.pembelian.index', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi.pembelian.create',[
            'gudang' => Gudang::all(),
            'supplier' => Supplier::all(),
            'ikan' => Ikan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate([
            'gudang_id' => 'required|exists:gudang,id',
            'supplier_id' => 'required|exists:suppliers,id',

            'ikan_id.*' => 'required|exists:ikan,id',
            'jumlah_kirim.*' => 'required|numeric|min:0',
            'jumlah_terima.*' => 'required|numeric|min:0',
            'harga_beli.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($r) {
            $transaksi = TransaksiPembelian::create([
                'tanggal' => now(),
                'gudang_id' => $r->gudang_id,
                'supplier_id' => $r->supplier_id,
                'admin_id' => auth()->id(),
            ]);

            foreach ($r->ikan_id as $i => $ikanId) {
                $detail = DetailPembelian::create([
                    'transaksi_pembelian_id' => $transaksi->id,
                    'ikan_id' => $ikanId,
                    'jumlah_kirim' => $r->jumlah_kirim[$i],
                    'jumlah_terima' => $r->jumlah_terima[$i],
                    'harga_beli' => $r->harga_beli[$i],
                ]);

                // Update stok gudang
                $stok = StokGudang::firstOrCreate(
                    ['ikan_id' => $ikanId, 'gudang_id' => $r->gudang_id],
                    ['stok_kg' => 0]
                );
                $stok->jumlah_stok += $detail->jumlah_terima;
                $stok->save();
            }
        });
        return redirect()->route('admin.pembelian.index')->with('success', 'Transaksi pembelian berhasil disimpan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
