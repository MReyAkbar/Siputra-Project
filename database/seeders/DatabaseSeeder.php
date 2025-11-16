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
        $this->call([KategoriIkanSeeder::class, IkanSeeder::class, CatalogItemSeeder::class]);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Atmint',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => \Hash::make('admin1234'),
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'role' => 'manager',
            'password' => \Hash::make('manager1234'),
        ]);
    }
}
