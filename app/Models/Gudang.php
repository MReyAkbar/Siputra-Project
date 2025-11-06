<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $fillable = ['nama_gudang', 'alamat', 'status_operasional', 'status_sewa'];

    public function stok()
    {
        return $this->hasMany(StokGudang::class, 'gudang_id');
    }
}
