<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function harian(Request $r)
    {
        $tanggal = $r->tanggal ? carbon::parse($r->tanggal) : Carbon::today();

        $data = $this->getLaporan($tanggal, 'day');
        return view('admin.laporan.harian', ['data' => $data, 'tanggal' => $tanggal->format('Y-m-d')]);
    }

    public function mingguan(Request $r)
    {
        // Default: 7 hari terakhir
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();

        // Jika user pilih minggu tertentu
        if ($r->filled('week')) {
            [$year, $weekNumber] = explode('-W', $r->week);

            $start = Carbon::now()->setISODate($year, $weekNumber)->startOfWeek();
            $end = Carbon::now()->setISODate($year, $weekNumber)->endOfWeek();
        }

        // Pembelian
        $pembelian = DetailPembelian::with('ikan')
            ->whereHas('transaksiPembelian', function ($q) use ($start, $end) {
                $q->whereBetween('tanggal', [$start, $end]);
            })
            ->get()
            ->groupBy('ikan_id')
            ->map(function ($rows) {
                return [
                    'kode' => $rows->first()->ikan->kode,
                    'nama' => $rows->first()->ikan->nama,
                    'total_beli' => $rows->sum('jumlah_terima'),
                    'nilai_beli' => $rows->sum(fn($r) => $r->jumlah_terima * $r->harga_beli),
                ];
            });

        // Penjualan
        $penjualan = DetailPenjualan::with('ikan')
            ->whereHas('transaksiPenjualan', function ($q) use ($start, $end) {
                $q->whereBetween('tanggal', [$start, $end]);
            })
            ->get()
            ->groupBy('ikan_id')
            ->map(function ($rows) {
                return [
                    'total_jual' => $rows->sum('jumlah'),
                    'nilai_jual' => $rows->sum(fn($r) => $r->jumlah * $r->harga_jual),
                ];
            });

        // Gabungkan kedua data
        $data = collect();

        foreach ($pembelian as $ikan_id => $row) {
            $jual = $penjualan[$ikan_id] ?? ['total_jual' => 0, 'nilai_jual' => 0];

            $data->push([
                'kode' => $row['kode'],
                'nama' => $row['nama'],
                'total_beli' => $row['total_beli'],
                'total_jual' => $jual['total_jual'],
                'selisih' => $row['total_beli'] - $jual['total_jual'],
                'nilai_beli' => $row['nilai_beli'],
                'nilai_jual' => $jual['nilai_jual'],
            ]);
        }

        return view('admin.laporan.mingguan', compact('data', 'start', 'end'));
    }


    public function bulanan(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        $data = $this->getLaporanBulananSummary($start, $end);
        return view('admin.laporan.bulanan', compact('data', 'month', 'year'));
    }

    private function getLaporanBulananSummary($start, $end)
    {
        // Pembelian
        $pembelian = DetailPembelian::with('ikan')
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy('ikan.nama')
            ->map(function ($group) {
                return [
                    'ikan' => $group->first()->ikan->nama,
                    'total_pembelian' => $group->sum('jumlah_terima'),
                    'nilai_pembelian' => $group->sum(function ($d) {
                        return $d->jumlah_terima * $d->harga_beli;
                    }),
                    'total_penjualan' => 0,
                    'nilai_penjualan' => 0,
                ];
            });

        // Penjualan
        $penjualan = DetailPenjualan::with('ikan')
            ->whereBetween('created_at', [$start, $end])
            ->get()
            ->groupBy('ikan.nama')
            ->map(function ($group) {
                return [
                    'ikan' => $group->first()->ikan->nama,
                    'total_penjualan' => $group->sum('jumlah'),
                    'nilai_penjualan' => $group->sum(function ($d) {
                        return $d->subtotal;
                    }),
                    'total_pembelian' => 0,
                    'nilai_pembelian' => 0,
                ];
            });

        // Gabungkan pembelian & penjualan per ikan
        $merged = collect();

        foreach ($pembelian as $nama => $p) {
            $merged[$nama] = $p;
        }

        foreach ($penjualan as $nama => $j) {
            if (isset($merged[$nama])) {
                $merged[$nama]['total_penjualan'] = $j['total_penjualan'];
                $merged[$nama]['nilai_penjualan'] = $j['nilai_penjualan'];
            } else {
                $merged[$nama] = $j;
            }
        }

        return $merged->values();
    }

    private function getLaporan($dateRange, $mode)
    {
        // === PEMBELIAN ===
        $pembelian = DetailPembelian::with('ikan', 'transaksiPembelian')
            ->when($mode === 'day', function ($q) use ($dateRange) {
                $q->whereHas('transaksiPembelian', function ($t) use ($dateRange) {
                    $t->whereDate('tanggal', $dateRange);
                });
            })
            ->when($mode === 'week' || $mode === 'month', function ($q) use ($dateRange) {
                $q->whereHas('transaksiPembelian', function ($t) use ($dateRange) {
                    $t->whereBetween('tanggal', $dateRange);
                });
            })
            ->get()
            ->map(function ($p) {
                return [
                    'tanggal' => $p->transaksiPembelian->tanggal,
                    'kode' => $p->ikan->kode,
                    'nama' => $p->ikan->nama,
                    'tipe' => 'Pembelian',
                    'jumlah' => $p->jumlah_terima,
                    'harga' => $p->harga_beli
                ];
            });

        // === PENJUALAN ===
        $penjualan = DetailPenjualan::with('ikan', 'transaksiPenjualan')
            ->when($mode === 'day', function ($q) use ($dateRange) {
                $q->whereHas('transaksiPenjualan', function ($t) use ($dateRange) {
                    $t->whereDate('tanggal', $dateRange);
                });
            })
            ->when($mode === 'week' || $mode === 'month', function ($q) use ($dateRange) {
                $q->whereHas('transaksiPenjualan', function ($t) use ($dateRange) {
                    $t->whereBetween('tanggal', $dateRange);
                });
            })
            ->get()
            ->map(function ($p) {
                return [
                    'tanggal' => $p->transaksiPenjualan->tanggal,
                    'kode' => $p->ikan->kode,
                    'nama' => $p->ikan->nama,
                    'tipe' => 'Penjualan',
                    'jumlah' => $p->jumlah,
                    'harga' => $p->harga_jual
                ];
            });

        return $pembelian->merge($penjualan)->sortByDesc('tanggal');
    }
}
