<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    protected $table = 'stok_gudang';
    protected $fillable = ['varian_id', 'gudang_id', 'jumlah_stok'];

    public function varian()
    {
        return $this->belongsTo(VarianIkan::class, 'varian_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }
}
