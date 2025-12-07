<?php

namespace Database\Factories;

use App\Models\TransaksiPembelian;
use App\Models\Gudang;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiPembelianFactory extends Factory
{
    protected $model = TransaksiPembelian::class;
  
    public function definition()
    {
        return [
            'tanggal' => now(),
            'gudang_id' => Gudang::factory(),
            'supplier_id' => Supplier::factory(),
            'admin_id' => User::factory()->create(['role' => 'admin'])->id,
        ];
    }
}