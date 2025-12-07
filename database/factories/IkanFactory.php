<?php

namespace Database\Factories;

use App\Models\Ikan;
use Illuminate\Database\Eloquent\Factories\Factory;

class IkanFactory extends Factory
{
    protected $model = Ikan::class;
    
    private static $counter = 100; // Start from 100 to avoid conflicts with seeded data

    public function definition()
    {
        self::$counter++;
        
        return [
            'kategori_id' => $this->faker->numberBetween(1, 9),
            'kode' => 'IKN' . str_pad(self::$counter, 3, '0', STR_PAD_LEFT),
            'nama' => $this->faker->randomElement([
                'Ikan Tuna', 
                'Ikan Salmon', 
                'Ikan Tongkol', 
                'Ikan Kakap',
                'Ikan Kembung',
                'Ikan Baronang',
                'Ikan Cakalang'
            ]) . ' ' . $this->faker->word,
            'harga_beli' => $this->faker->numberBetween(10000, 50000),
            'deskripsi' => $this->faker->sentence,
        ];
    }
}