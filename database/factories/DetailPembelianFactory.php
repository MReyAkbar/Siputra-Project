<?php

namespace Database\Factories;

use App\Models\DetailPembelian;
use App\Models\TransaksiPembelian;
use App\Models\Ikan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPembelianFactory extends Factory
{
    protected $model = DetailPembelian::class;

    public function definition()
    {
        $jumlahKirim = $this->faker->numberBetween(100, 1000);
        // jumlah_terima usually slightly less than jumlah_kirim (accounting for shrinkage/loss)
        $jumlahTerima = $jumlahKirim - $this->faker->numberBetween(0, 20);
        
        return [
            'transaksi_pembelian_id' => TransaksiPembelian::factory(),
            'ikan_id' => Ikan::factory(),
            'jumlah_kirim' => $jumlahKirim,
            'jumlah_terima' => $jumlahTerima,
            'harga_beli' => $this->faker->numberBetween(50000, 5000000),
        ];
    }
}