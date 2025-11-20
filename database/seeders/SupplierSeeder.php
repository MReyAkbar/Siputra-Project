<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = [
            ['nama_supplier' => 'PT. Laut Segar Juwana', 'no_hp' => '021-12345678', 'alamat' => 'Jl. Bahari No. 10, Juwana'],
            ['nama_supplier' => 'CV. Ikan Segar', 'no_hp' => '031-87654321', 'alamat' => 'Jl. Nelayan No. 5, Surabaya'], 
        ];
        foreach ($supplier as $s) {
            Supplier::create($s);
        }
    }
}
