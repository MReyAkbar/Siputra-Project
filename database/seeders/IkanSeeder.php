<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ikan;

class IkanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ikanList = [
            ['kategori_id' => 1, 'kode' => 'IKN001', 'nama' => 'Tuna Sirip Kuning', 'harga_beli' => 25000,  'deskripsi' => 'Ikan tuna kualitas ekspor.'],
            ['kategori_id' => 1, 'kode' => 'IKN002', 'nama' => 'Tuna Mata Besar',   'harga_beli' => 28000,  'deskripsi' => 'Tuna premium.'],
            ['kategori_id' => 9, 'kode' => 'IKN003', 'nama' => 'Gurame',            'harga_beli' => 15000,  'deskripsi' => 'Ikan cakalang segar.'],
            ['kategori_id' => 8, 'kode' => 'IKN004', 'nama' => 'Ogos',              'harga_beli' => 12000,  'deskripsi' => 'Ikan Ogos pilihan.'],
            ['kategori_id' => 4, 'kode' => 'IKN005', 'nama' => 'Kembung',           'harga_beli' => 14000,  'deskripsi' => 'Ikan kembung segar.'],
            ['kategori_id' => 5, 'kode' => 'IKN006', 'nama' => 'Kakap Merah',       'harga_beli' => 33000,  'deskripsi' => 'Ikan kakap merah premium.'],
            ['kategori_id' => 6, 'kode' => 'IKN007', 'nama' => 'Barracuda',         'harga_beli' => 18000,  'deskripsi' => 'Barracuda hasil tangkapan nelayan.'],
            ['kategori_id' => 7, 'kode' => 'IKN008', 'nama' => 'Layang',            'harga_beli' => 10000,  'deskripsi' => 'Ikan layang segar.'],
        ];

        foreach ($ikanList as $ikan) {
            Ikan::create($ikan);
        }
    }
}
