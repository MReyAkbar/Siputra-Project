<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriIkanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_ikan')->insert([
            ['nama_kategori' => 'Tuna', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Tongkol', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Layang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kembung', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Cakalang', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kurisi', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kakap Merah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Ogos', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Barracuda', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
