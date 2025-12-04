<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiPembelian;
use App\Models\DetailPembelian;
use App\Models\StokGudang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PembelianSeeder extends Seeder
{
    public function run()
    {
        DB::transaction(function () {

            $pembelian = TransaksiPembelian::create([
                'tanggal'     => Carbon::today(),
                'gudang_id'   => 1,
                'supplier_id' => 1,
                'admin_id'    => 1,
            ]);

            $detailList = [
                ['ikan_id' => 1, 'jumlah_kirim' => 500, 'jumlah_terima' => 480, 'harga_beli' => 3000000],
                ['ikan_id' => 2, 'jumlah_kirim' => 700, 'jumlah_terima' => 690, 'harga_beli' => 4500000],
                ['ikan_id' => 4, 'jumlah_kirim' => 400, 'jumlah_terima' => 380, 'harga_beli' => 5000000],
            ];

            foreach ($detailList as $d) {
                $detail = DetailPembelian::create([
                    'transaksi_pembelian_id' => $pembelian->id,
                    'ikan_id' => $d['ikan_id'],
                    'jumlah_kirim' => $d['jumlah_kirim'],
                    'jumlah_terima' => $d['jumlah_terima'],
                    'harga_beli' => $d['harga_beli'],
                ]);

                // Tambah stok otomatis (sesuai jumlah terima)
                $stok = StokGudang::firstOrCreate(
                    ['ikan_id' => $d['ikan_id'], 'gudang_id' => $pembelian->gudang_id],
                    ['jumlah_stok' => 0]
                );

                $stok->jumlah_stok += $detail->jumlah_terima;
                $stok->save();
            }

        });

        DB::transaction(function () {

            $pembelian = TransaksiPembelian::create([
                'tanggal'     => Carbon::today(),
                'gudang_id'   => 1,
                'supplier_id' => 2,
                'admin_id'    => 1,
            ]);

            $detailList = [
                ['ikan_id' => 3, 'jumlah_kirim' => 500, 'jumlah_terima' => 480, 'harga_beli' => 3000000],
                ['ikan_id' => 6, 'jumlah_kirim' => 600, 'jumlah_terima' => 580, 'harga_beli' => 5000000],
                ['ikan_id' => 8, 'jumlah_kirim' => 800, 'jumlah_terima' => 780, 'harga_beli' => 5000000],
            ];

            foreach ($detailList as $d) {
                $detail = DetailPembelian::create([
                    'transaksi_pembelian_id' => $pembelian->id,
                    'ikan_id' => $d['ikan_id'],
                    'jumlah_kirim' => $d['jumlah_kirim'],
                    'jumlah_terima' => $d['jumlah_terima'],
                    'harga_beli' => $d['harga_beli'],
                ]);

                // Tambah stok otomatis (sesuai jumlah terima)
                $stok = StokGudang::firstOrCreate(
                    ['ikan_id' => $d['ikan_id'], 'gudang_id' => $pembelian->gudang_id],
                    ['jumlah_stok' => 0]
                );

                $stok->jumlah_stok += $detail->jumlah_terima;
                $stok->save();
            }

        });
    }
}
