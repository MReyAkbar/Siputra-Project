<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriIkan extends Model
{
    use HasFactory;
    protected $table = 'kategori_ikan';
    protected $fillable = ['nama_kategori'];

    public function ikan()
    {
        return $this->hasMany(Ikan::class, 'kategori_id');
    }
}
