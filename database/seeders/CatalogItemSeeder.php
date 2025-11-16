<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatalogItem;

class CatalogItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'ikan_id' => 1,
                'harga_jual' => 35000,
                'deskripsi' => 'Segar premium kualitas ekspor.',
                'gambar' => 'katalog/ikan-tuna.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 2,
                'harga_jual' => 28000,
                'deskripsi' => 'Terbaik dari nelayan lokal.',
                'gambar' => 'katalog/ikan-tuna.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 3,
                'harga_jual' => 32000,
                'deskripsi' => 'Tekstur daging padat.',
                'gambar' => 'katalog/ikan-gurame.jpg',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 4,
                'harga_jual' => 30000,
                'deskripsi' => 'Segar hasil tangkapan pagi.',
                'gambar' => 'katalog/ikan-ogos.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 5,
                'harga_jual' => 24000,
                'deskripsi' => 'Cocok untuk berbagai olahan.',
                'gambar' => 'katalog/ikan-kembung.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 6,
                'harga_jual' => 22000,
                'deskripsi' => 'Segar berkualitas tinggi.',
                'gambar' => 'katalog/ikan-kakap-merah.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 7,
                'harga_jual' => 27000,
                'deskripsi' => 'Pilihan dengan ukuran besar.',
                'gambar' => 'katalog/ikan-barracuda.png',
                'is_active' => 1,
            ],
            [
                'ikan_id' => 8,
                'harga_jual' => 31000,
                'deskripsi' => 'Segar premium dari laut dalam.',
                'gambar' => 'katalog/ikan-layang.png',
                'is_active' => 1,
            ],
        ];

        foreach ($items as $item) {
            CatalogItem::create($item);
        }
    }
}
