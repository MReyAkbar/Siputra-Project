<?php

namespace Database\Factories;

use App\Models\TransaksiPenjualan;
use App\Models\Gudang;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiPenjualanFactory extends Factory
{
    protected $model = TransaksiPenjualan::class;

    public function definition()
    {
        return [
            'tanggal' => now(),
            'customer_id' => Customer::factory(),
            'gudang_id' => Gudang::factory(),
            'admin_id' => User::factory()->create(['role' => 'admin'])->id,
        ];
    }
}