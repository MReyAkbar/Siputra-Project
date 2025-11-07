<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriIkan extends Model
{
    protected $table = 'kategori_ikan';
    protected $fillable = ['nama_kategori'];

    public function ikan()
    {
        return $this->hasMany(Ikan::class, 'kategori_id');
    }
}
