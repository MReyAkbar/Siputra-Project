<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['nama_customer' => 'Ferdi', 'no_hp' => '0812100001', 'alamat' => 'Bandung'],
            ['nama_customer' => 'Dwicky', 'no_hp' => '0812100002', 'alamat' => 'Malang'],
            ['nama_customer' => 'Ardi', 'no_hp' => '0812100003', 'alamat' => 'Semarang'],
        ];

        foreach ($customers as $c) {
            Customer::create($c);
        }
    }
}
