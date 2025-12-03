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
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private function getDateRange($periode = 'bulanan')
    {
        $now = Carbon::now();
        $startDate = null;
        $previousStartDate = null;
        $previousEndDate = null;

        if ($periode === 'harian') {
            $startDate = $now->copy()->startOfDay();
            $previousStartDate = $now->copy()->subDay()->startOfDay();
            $previousEndDate = $now->copy()->subDay()->endOfDay();
        } elseif ($periode === 'mingguan') {
            $startDate = $now->copy()->startOfWeek();
            $previousStartDate = $now->copy()->subWeek()->startOfWeek();
            $previousEndDate = $now->copy()->subWeek()->endOfWeek();
        } else { // bulanan (default)
            $startDate = $now->copy()->startOfMonth();
            $previousStartDate = $now->copy()->subMonth()->startOfMonth();
            $previousEndDate = $now->copy()->subMonth()->endOfMonth();
        }

        return [
            'current_start' => $startDate,
            'current_end' => $now,
            'previous_start' => $previousStartDate,
            'previous_end' => $previousEndDate
        ];
    }

    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? $current : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }

    private function getTransactionStats($periode = 'bulanan')
    {
        $dates = $this->getDateRange($periode);

        // Current Period - Pembelian
        $currentPembelianKg = DetailPembelian::whereHas('transaksiPembelian', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['current_start'], $dates['current_end']]);
        })->sum('jumlah_terima') ?? 0;

        // Previous Period - Pembelian
        $previousPembelianKg = DetailPembelian::whereHas('transaksiPembelian', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['previous_start'], $dates['previous_end']]);
        })->sum('jumlah_terima') ?? 0;

        // Current Period - Penjualan
        $currentPenjualanKg = DetailPenjualan::whereHas('transaksiPenjualan', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['current_start'], $dates['current_end']]);
        })->sum('jumlah') ?? 0;

        // Previous Period - Penjualan
        $previousPenjualanKg = DetailPenjualan::whereHas('transaksiPenjualan', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['previous_start'], $dates['previous_end']]);
        })->sum('jumlah') ?? 0;

        return [
            'pembelian' => [
                'current' => $currentPembelianKg,
                'previous' => $previousPembelianKg,
                'change' => $this->calculatePercentageChange($currentPembelianKg, $previousPembelianKg)
            ],
            'penjualan' => [
                'current' => $currentPenjualanKg,
                'previous' => $previousPenjualanKg,
                'change' => $this->calculatePercentageChange($currentPenjualanKg, $previousPenjualanKg)
            ]
        ];
    }

    private function getFinancialStats($periode = 'bulanan')
    {
        $dates = $this->getDateRange($periode);

        // Current Period - Pengeluaran (Pembelian)
        $currentPengeluaran = DetailPembelian::whereHas('transaksiPembelian', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['current_start'], $dates['current_end']]);
        })->sum(DB::raw('harga_beli')) ?? 0;

        // Previous Period - Pengeluaran
        $previousPengeluaran = DetailPembelian::whereHas('transaksiPembelian', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['previous_start'], $dates['previous_end']]);
        })->sum(DB::raw('harga_beli')) ?? 0;

        // Current Period - Penerimaan (Penjualan)
        $currentPenerimaan = DetailPenjualan::whereHas('transaksiPenjualan', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['current_start'], $dates['current_end']]);
        })->sum('subtotal') ?? 0;

        // Previous Period - Penerimaan
        $previousPenerimaan = DetailPenjualan::whereHas('transaksiPenjualan', function ($q) use ($dates) {
            $q->whereBetween('tanggal', [$dates['previous_start'], $dates['previous_end']]);
        })->sum('subtotal') ?? 0;

        return [
            'penerimaan' => [
                'current' => $currentPenerimaan,
                'previous' => $previousPenerimaan,
                'change' => $this->calculatePercentageChange($currentPenerimaan, $previousPenerimaan)
            ],
            'pengeluaran' => [
                'current' => $currentPengeluaran,
                'previous' => $previousPengeluaran,
                'change' => $this->calculatePercentageChange($currentPengeluaran, $previousPengeluaran)
            ]
        ];
    }

    private function getChartData($periode = 'bulanan')
    {
        $dates = $this->getDateRange($periode);

        // Aggregate purchases by date
        $pembelian = DetailPembelian::select(
            DB::raw('DATE(transaksi_pembelian.tanggal) as tanggal'),
            DB::raw('SUM(detail_pembelian.jumlah_terima) as total')
        )
        ->join('transaksi_pembelian', 'detail_pembelian.transaksi_pembelian_id', '=', 'transaksi_pembelian.id')
        ->whereBetween('transaksi_pembelian.tanggal', [$dates['current_start'], $dates['current_end']])
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get()
        ->keyBy('tanggal');

        // Aggregate sales by date
        $penjualan = DetailPenjualan::select(
            DB::raw('DATE(transaksi_penjualan.tanggal) as tanggal'),
            DB::raw('SUM(detail_penjualan.jumlah) as total')
        )
        ->join('transaksi_penjualan', 'detail_penjualan.transaksi_penjualan_id', '=', 'transaksi_penjualan.id')
        ->whereBetween('transaksi_penjualan.tanggal', [$dates['current_start'], $dates['current_end']])
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get()
        ->keyBy('tanggal');

        // Generate date labels based on period
        $labels = [];
        $pembelianData = [];
        $penjualanData = [];

        $current = $dates['current_start']->copy();
        while ($current <= $dates['current_end']) {
            $dateStr = $current->format('Y-m-d');
            
            if ($periode === 'harian') {
                $labels[] = $current->format('H:00');
            } elseif ($periode === 'mingguan') {
                $labels[] = $current->format('D');
            } else {
                $labels[] = $current->format('d M');
            }

            $pembelianData[] = $pembelian->get($dateStr)->total ?? 0;
            $penjualanData[] = $penjualan->get($dateStr)->total ?? 0;

            if ($periode === 'harian') {
                $current->addHours(2);
            } else {
                $current->addDay();
            }
        }

        return [
            'labels' => $labels,
            'pembelian' => $pembelianData,
            'penjualan' => $penjualanData
        ];
    }

    private function getLowStockAlerts()
    {
        // Get items with stock less than 50kg (adjust threshold as needed)
        return StokGudang::with(['ikan', 'gudang'])
            ->where('jumlah_stok', '<', 50)
            ->where('jumlah_stok', '>', 0)
            ->orderBy('jumlah_stok', 'asc')
            ->limit(5)
            ->get()
            ->map(function ($stok) {
                $threshold = 100; // Define your stock threshold
                $percentage = ($stok->jumlah_stok / $threshold) * 100;
                
                return [
                    'nama_ikan' => $stok->ikan->nama,
                    'gudang' => $stok->gudang->nama,
                    'jumlah' => $stok->jumlah_stok,
                    'threshold' => $threshold,
                    'percentage' => min($percentage, 100) // Cap at 100%
                ];
            });
    }

    private function getTopPerformers($periode = 'bulanan')
    {
        $dates = $this->getDateRange($periode);

        return DetailPenjualan::select(
            'ikan.nama',
            DB::raw('SUM(detail_penjualan.jumlah) as total_terjual'),
            DB::raw('SUM(detail_penjualan.subtotal) as total_revenue')
        )
        ->join('ikan', 'detail_penjualan.ikan_id', '=', 'ikan.id')
        ->join('transaksi_penjualan', 'detail_penjualan.transaksi_penjualan_id', '=', 'transaksi_penjualan.id')
        ->whereBetween('transaksi_penjualan.tanggal', [$dates['current_start'], $dates['current_end']])
        ->groupBy('ikan.id', 'ikan.nama')
        ->orderBy('total_terjual', 'desc')
        ->limit(5)
        ->get();
    }

    private function getBottomPerformers($periode = 'bulanan')
    {
        $dates = $this->getDateRange($periode);

        $allIkan = Ikan::all();
        $soldIkan = DetailPenjualan::select(
            'ikan_id',
            DB::raw('SUM(detail_penjualan.jumlah) as total_terjual')
        )
        ->join('transaksi_penjualan', 'detail_penjualan.transaksi_penjualan_id', '=', 'transaksi_penjualan.id')
        ->whereBetween('transaksi_penjualan.tanggal', [$dates['current_start'], $dates['current_end']])
        ->groupBy('ikan_id')
        ->get()
        ->keyBy('ikan_id');

        return $allIkan->map(function ($ikan) use ($soldIkan) {
            return [
                'nama' => $ikan->nama,
                'total_terjual' => $soldIkan->get($ikan->id)->total_terjual ?? 0
            ];
        })
        ->sortBy('total_terjual')
        ->take(5)
        ->values();
    }

    public function index()
    {
        $periode = 'bulanan'; // default

        // Get all statistics
        $transactionStats = $this->getTransactionStats($periode);
        $financialStats = $this->getFinancialStats($periode);
        $chartData = $this->getChartData($periode);
        
        $totalPembelian = $transactionStats['pembelian']['current'];
        $pembelianChange = $transactionStats['pembelian']['change'];
        
        $totalPenjualan = $transactionStats['penjualan']['current'];
        $penjualanChange = $transactionStats['penjualan']['change'];
        
        $kapasitasTersedia = StokGudang::sum('jumlah_stok') ?? 0;
        
        $penerimaan = $financialStats['penerimaan']['current'];
        $penerimaanChange = $financialStats['penerimaan']['change'];
        
        $pengeluaran = $financialStats['pengeluaran']['current'];
        $pengeluaranChange = $financialStats['pengeluaran']['change'];

        $lowStockAlerts = $this->getLowStockAlerts();
        $topPerformers = $this->getTopPerformers($periode);
        $bottomPerformers = $this->getBottomPerformers($periode);

        return view('admin.dashboard', compact(
            'totalPembelian',
            'pembelianChange',
            'totalPenjualan',
            'penjualanChange',
            'kapasitasTersedia',
            'penerimaan',
            'penerimaanChange',
            'pengeluaran',
            'pengeluaranChange',
            'chartData',
            'lowStockAlerts',
            'topPerformers',
            'bottomPerformers'
        ));
    }

    public function getDashboardData(Request $request)
    {
        $periode = $request->query('periode', 'bulanan');

        $transactionStats = $this->getTransactionStats($periode);
        $financialStats = $this->getFinancialStats($periode);
        $chartData = $this->getChartData($periode);
        $topPerformers = $this->getTopPerformers($periode);
        $bottomPerformers = $this->getBottomPerformers($periode);

        return response()->json([
            'transaction_stats' => $transactionStats,
            'financial_stats' => $financialStats,
            'chart_data' => $chartData,
            'top_performers' => $topPerformers,
            'bottom_performers' => $bottomPerformers
        ]);
    }
}