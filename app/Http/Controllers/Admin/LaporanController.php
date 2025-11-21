<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function harian()
    {
        $today = Carbon::today();
        $data = $this ->getLaporan($today, 'day');
        return view('admin.laporan.harian', compact('data'));
    }

    public function mingguan()
    {
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $data = $this->getLaporan([$weekStart, $weekEnd], 'week');
        return view('admin.laporan.mingguan', compact('data'));
    }

    public function bulanan()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $data = $this->getLaporan([$monthStart, $monthEnd], 'month');
        return view('admin.laporan.bulanan', compact('data'));
    }

    private function getLaporan($dateRange, $mode)
    {
       // Pembelian
        $pembelian = DetailPembelian::with('ikan', 'transaksi')
            ->when($mode === 'day', function ($q) use ($dateRange) {
                $q->whereDate('created_at', $dateRange);
            })
            ->when($mode === 'week' || $mode === 'month', function ($q) use ($dateRange) {
                $q->whereBetween('created_at', $dateRange);
            })
            ->get()
            ->map(function ($p) {
                return [
                    'tanggal'   => $p->created_at,
                    'kode'      => $p->ikan->kode,
                    'nama'      => $p->ikan->nama,
                    'tipe'      => 'Pembelian',
                    'jumlah'    => $p->jumlah_terima,
                    'harga'     => $p->harga_beli
                ];
            });


        // Penjualan
        $penjualan = DetailPenjualan::with('ikan', 'transaksi')
            ->when($mode === 'day', function ($q) use ($dateRange) {
                $q->whereDate('created_at', $dateRange);
            })
            ->when($mode === 'week' || $mode === 'month', function ($q) use ($dateRange) {
                $q->whereBetween('created_at', $dateRange);
            })
            ->get()
            ->map(function ($p) {
                return [
                    'tanggal'   => $p->created_at,
                    'kode'      => $p->ikan->kode,
                    'nama'      => $p->ikan->nama,
                    'tipe'      => 'Penjualan',
                    'jumlah'    => $p->jumlah,
                    'harga'     => $p->harga_jual
                ];
            });

        // Gabungkan
        return $pembelian->merge($penjualan)->sortByDesc('tanggal');
    }
}
