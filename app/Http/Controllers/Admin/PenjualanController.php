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
use App\Services\StockService;
use Exception;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = TransaksiPenjualan::with(['detail.ikan', 'customer'])->orderBy('tanggal', 'desc')->get();
        return view('admin.transaksi.penjualan.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi.penjualan.create', [
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

        $stock = new StockService();

        DB::beginTransaction();

        try {
            // Validate stock before processing
            foreach ($r->ikan_id as $i => $ikanId) {
                $jumlah = $r->jumlah[$i];
                
                $stok = StokGudang::where('ikan_id', $ikanId)
                    ->where('gudang_id', $r->gudang_id)
                    ->first();
                
                $stokTersedia = $stok ? $stok->jumlah_stok : 0;
                
                if ($jumlah > $stokTersedia) {
                    $ikan = Ikan::find($ikanId);
                    throw new Exception("Stok {$ikan->nama} tidak mencukupi. Tersedia: {$stokTersedia} kg, diminta: {$jumlah} kg");
                }
            }

            $transaksi = TransaksiPenjualan::create([
                'tanggal' => now(),
                'customer_id' => $r->customer_id,
                'gudang_id' => $r->gudang_id,
                'admin_id' => auth()->id(),
            ]);

            foreach ($r->ikan_id as $i => $ikanId) {
                $jumlah = $r->jumlah[$i];
                $harga = $r->harga_jual[$i];

                $detail = DetailPenjualan::create([
                    'transaksi_penjualan_id' => $transaksi->id,
                    'ikan_id' => $ikanId,
                    'jumlah' => $jumlah,
                    'harga_jual' => $harga,
                    'subtotal' => $jumlah * $harga,
                ]);

                // Kurangi stok via service
                $stock->decreaseStock(
                    $r->gudang_id,
                    $ikanId,
                    $jumlah
                );
            }

            DB::commit();

            // Log activity only if function exists
            if (function_exists('log_activity')) {
                log_activity(
                    'penjualan_create',
                    'Mencatat transaksi penjualan baru di gudang ID: ' . $r->gudang_id,
                    [
                        'customer_id' => $r->customer_id,
                        'ikan_id' => $r->ikan_id,
                        'jumlah' => $r->jumlah,
                    ]
                );
            }

            return redirect()->route('admin.penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil disimpan.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Generate invoice for the specified resource.
     */
    public function invoice($id)
    {
        $penjualan = TransaksiPenjualan::with(['detail', 'customer', 'gudang'])->findOrFail($id);

        $pdf = PDF::loadView('admin.transaksi.penjualan.invoice', compact('penjualan'))->setPaper('a4', 'portrait');
        return $pdf->stream('invoice-penjualan-' . $penjualan->id . '.pdf');
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