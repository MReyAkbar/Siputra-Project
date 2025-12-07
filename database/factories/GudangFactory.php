<?php

namespace Database\Factories;

use App\Models\Gudang;
use Illuminate\Database\Eloquent\Factories\Factory;

class GudangFactory extends Factory
{
    protected $model = Gudang::class;

    public function definition()
    {
        return [
            'nama_gudang' => 'Gudang ' . $this->faker->city,
            'lokasi' => $this->faker->address,
            'kapasitas_kg' => $this->faker->numberBetween(5000, 200000),
            'gambar' => 'gudang/default.jpg',
            'deskripsi' => $this->faker->sentence,
            'status_sewa' => $this->faker->randomElement(['tersedia', 'tidak_tersedia']),
            'status_operasional' => 'aktif',
        ];
    }
}