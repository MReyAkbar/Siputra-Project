<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gudang;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_gudang' => 'Gudang 1',
                'lokasi' => 'Pergudangan Safe n lock Sidoarjo, Jawa Timur',
                'kapasitas_kg' => 200000,
                'gambar' => 'gudang/gudang-1.png',
                'deskripsi' => 'Gudang Cold Storage utama dengan kapasitas besar untuk penyimpanan produk beku.',
                'status_sewa' => 'tidak_tersedia',
                'status_operasional' => 'aktif',
            ],
            [
                'nama_gudang' => 'Gudang 2',
                'lokasi' => 'Pergudangan Safe n lock Sidoarjo, Jawa Timur',
                'kapasitas_kg' => 200000,
                'gambar' => 'gudang/gudang-2.png',
                'deskripsi' => 'Gudang berpendingin berkapasitas besar, cocok untuk simpan ikan beku dan produk laut lainnya.',
                'status_sewa' => 'tersedia',
                'status_operasional' => 'aktif',
            ],
        ];

        Gudang::insert($data);
    }
}
