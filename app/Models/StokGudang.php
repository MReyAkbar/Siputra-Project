<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGudang extends Model
{
    protected $table = 'stok_gudang';
    protected $fillable = ['ikan_id', 'gudang_id', 'jumlah_stok'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }
}
