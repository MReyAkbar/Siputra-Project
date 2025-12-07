<?php

namespace App\Models;

use App\Models\StokGudang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;
    protected $table = 'gudang';
    protected $fillable = ['nama_gudang', 'lokasi', 'kapasitas_kg', 'gambar', 'deskripsi', 'status_sewa', 'status_operasional'];

    public function stok()
    {
        return $this->hasMany(StokGudang::class, 'gudang_id');
    }
}
