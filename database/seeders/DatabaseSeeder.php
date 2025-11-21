<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriIkanSeeder::class,
            IkanSeeder::class, 
            CatalogItemSeeder::class, 
            GudangSeeder::class, 
            SupplierSeeder::class, 
            CustomerSeeder::class,
            PembelianSeeder::class,
        ]);

        // User::factory(10)->create();

        
    }
}
