<?php

namespace Database\Factories;

use App\Models\DetailPenjualan;
use App\Models\TransaksiPenjualan;
use App\Models\Ikan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPenjualanFactory extends Factory
{
    protected $model = DetailPenjualan::class;

    public function definition()
    {
        $jumlah = $this->faker->numberBetween(50, 500);
        $hargaJual = $this->faker->numberBetween(60000, 150000);
        
        return [
            'transaksi_penjualan_id' => TransaksiPenjualan::factory(),
            'ikan_id' => Ikan::factory(),
            'jumlah' => $jumlah,
            'harga_jual' => $hargaJual,
            'subtotal' => $jumlah * $hargaJual,
        ];
    }
}