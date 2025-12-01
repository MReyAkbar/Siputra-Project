<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPenjualan;
use App\Models\StokGudang;
use App\Models\Ikan;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private function getChartDataByPeriod($periode = 'bulanan')
    {
        $ikan = Ikan::all();
        $chartLabels = $ikan->pluck('nama');
        $chartMasuk = [];
        $chartKeluar = [];

        $now = Carbon::now();
        $startDate = null;

        // Tentukan range tanggal berdasarkan periode
        if ($periode === 'mingguan') {
            $startDate = $now->copy()->startOfWeek();
        } elseif ($periode === 'tahunan') {
            $startDate = $now->copy()->startOfYear();
        } else { // bulanan (default)
            $startDate = $now->copy()->startOfMonth();
        }

        // Hitung masuk dan keluar per ikan untuk periode tertentu
        foreach ($ikan as $i) {
            $masuk = $i->detailPembelian()
                ->whereHas('transaksiPembelian', function ($q) use ($startDate) {
                    $q->where('tanggal', '>=', $startDate);
                })
                ->sum('jumlah_terima') ?: 0;
            $chartMasuk[] = $masuk;

            $keluar = $i->detailPenjualan()
                ->whereHas('transaksiPenjualan', function ($q) use ($startDate) {
                    $q->where('tanggal', '>=', $startDate);
                })
                ->sum('jumlah') ?: 0;
            $chartKeluar[] = $keluar;
        }

        return [
            'labels' => $chartLabels,
            'masuk' => $chartMasuk,
            'keluar' => $chartKeluar
        ];
    }

    public function index()
    {
        // Statistik utama
        // Total pembelian (kg) is stored per detail in 'detail_pembelian.jumlah_terima'
        $totalPembelian = DetailPembelian::sum('jumlah_terima') ?? 0;
        $totalPenjualan = DetailPenjualan::sum('jumlah') ?? 0;
        $kapasitasTersedia = StokGudang::sum('jumlah_stok') ?? 0;

        // Data chart default (bulanan)
        $chartData = $this->getChartDataByPeriod('bulanan');
        $chartLabels = $chartData['labels'];
        $chartMasuk = $chartData['masuk'];
        $chartKeluar = $chartData['keluar'];

        return view('admin.dashboard', compact(
            'totalPembelian',
            'totalPenjualan',
            'kapasitasTersedia',
            'chartLabels',
            'chartMasuk',
            'chartKeluar'
        ));
    }

    public function getChartData(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');
        $data = $this->getChartDataByPeriod($periode);
        return response()->json($data);
    }
}
