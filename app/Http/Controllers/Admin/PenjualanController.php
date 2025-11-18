<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Http\Controllers\Controller;
use App\Models\TransaksiPenjualan;
use App\Models\DetailPenjualan;
use App\Models\Gudang;
use App\Models\Customer;
use App\Models\Ikan;
use App\Models\StokGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = TransaksiPenjualan::with(['detail.ikan','customer'])->orderBy('tanggal','desc')->get();
        return view('admin.transaksi.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi.penjualan.create',[
            'gudang' => Gudang::all(),
            'customer' => Customer::all(),
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
            'customer_id' => 'required|exists:customers,id',

            'ikan_id.*' => 'required|exists:ikan,id',
            'jumlah.*' => 'required|numeric|min:0',
            'harga_jual.*' => 'required|numeric|min:0',
        ]);

        DB::transaction(function() use ($r) {
            $transaksi = TransaksiPenjualan::create([
                'tanggal' => now(),
                'customer_id' => $r->customer_id,
                'gudang_id' => $r->gudang_id,
                'admin_id' => auth()->id(),
            ]);

            foreach ($r->ikan_id as $i => $ikanId) {
                $jumlah = $r->jumlah[$i];
                $harga = $r->harga_jual[$i];
                $subtotal = $jumlah * $harga;

                $detail = DetailPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'ikan_id' => $ikanId,
                    'jumlah' => $jumlah,
                    'harga_jual' => $harga,
                    'subtotal' => $subtotal,
                ]);

                // Update stok gudang
                $stok = StokGudang::where('ikan_id', $ikanId)
                    ->where('gudang_id', $r->gudang_id)
                    ->first();

                if (!$stok) {
                    abort(400, "Stok ikan ini tidak tersedia di gudang!");
                }

                if ($stok->jumlah_stok < $jumlah) {
                    abort(400, "Stok ikan tidak mencukupi untuk penjualan!");
                }

                $stok->jumlah_stok -= $jumlah;
                $stok->save();
            }
        });
        return redirect()->route('admin.penjualan.index')->with('success', 'Transaksi penjualan berhasil disimpan.');
    }
    
    /**
     * Generate invoice for the specified resource.
     */
    public function invoice($id)
    {
        $penjualan = TransaksiPenjualan::with(['detail.ikan','customer','gudang','admin'])->findOrFail($id);

        $pdf = PDF::loadView('admin.transaksi.penjualan.invoice', compact('penjualan'))->setPaper('a4', 'portrait');
        return $pdf->stream('invoice-penjualan-'.$penjualan->id.'.pdf');
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
