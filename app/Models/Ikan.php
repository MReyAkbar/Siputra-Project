<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    protected $table = 'ikan';
    protected $fillable = ['kategori_id', 'nama', 'deskripsi', 'gambar', 'status'];

    public function kategori()
    {
        return $this->belongsTo(KategoriIkan::class, 'kategori_id');
    }

    public function varian()
    {
        return $this->hasMany(VarianIkan::class, 'ikan_id');
    }
}
