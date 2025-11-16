<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $fillable = ['nama_gudang', 'lokasi', 'kapasitas_kg', 'gambar', 'deskripsi', 'status_sewa', 'status_operasional'];

    public function stok()
    {
        return $this->hasMany(StokGudang::class, 'gudang_id');
    }
}
