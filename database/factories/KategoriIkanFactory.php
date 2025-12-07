<?php

namespace Database\Factories;

use App\Models\KategoriIkan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriIkanFactory extends Factory
{
    protected $model = KategoriIkan::class;

    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->randomElement([
                'Tuna',
                'Cakalang',
                'Tongkol',
                'Kembung',
                'Kakap',
                'Baronang',
                'Layang',
                'Ogos',
                'Gurame',
                'Bandeng',
                'Salmon'
            ]) . ' ' . $this->faker->randomElement(['Grade A', 'Grade B', 'Premium', 'Fresh']),
        ];
    }
}