<?php

namespace App\Services;

use App\Models\StokGudang;
use App\Models\Gudang;
use Exception;

class StockService
{
    /**
     * Menambah stok (untuk transaksi pembelian)
     */
    public function increaseStock($gudangId, $ikanId, $jumlah)
    {
        $this->checkCapacity($gudangId, $jumlah);

        $stok = StokGudang::firstOrCreate(
            ['ikan_id' => $ikanId, 'gudang_id' => $gudangId],
            ['jumlah_stok' => 0]
        );

        $stok->jumlah_stok += $jumlah;
        $stok->save();

        return $stok;
    }

    /**
     * Mengurangi stok (untuk transaksi penjualan)
     */
    public function decreaseStock($gudangId, $ikanId, $jumlah)
    {
        $stok = StokGudang::where('ikan_id', $ikanId)
            ->where('gudang_id', $gudangId)
            ->first();

        if (!$stok) {
            throw new Exception("Stok untuk ikan ini belum tersedia di gudang.");
        }

        if ($stok->jumlah_stok < $jumlah) {
            throw new Exception("Stok tidak mencukupi untuk penjualan.");
        }

        $stok->jumlah_stok -= $jumlah;
        $stok->save();

        return $stok;
    }

    /**
     * Mengecek apakah stok mencukupi
     */
    public function checkStock($gudangId, $ikanId, $jumlah)
    {
        $stok = StokGudang::where('ikan_id', $ikanId)
            ->where('gudang_id', $gudangId)
            ->first();

        if (!$stok || $stok->jumlah_stok < $jumlah) {
            return false;
        }

        return true;
    }

    /**
     * Mengecek kapasitas gudang sebelum penambahan stok
     */
    public function checkCapacity($gudangId, $jumlahBaru)
    {
        $gudang = Gudang::findOrFail($gudangId);

        $totalStok = StokGudang::where('gudang_id', $gudangId)->sum('jumlah_stok');

        $sisaKapasitas = $gudang->kapasitas_kg - $totalStok;

        if ($jumlahBaru > $sisaKapasitas) {
            throw new Exception("Kapasitas gudang tidak mencukupi. Sisa kapasitas hanya {$sisaKapasitas} kg.");
        }

        return true;
    }
}
