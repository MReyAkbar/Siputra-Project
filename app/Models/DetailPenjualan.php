<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $fillable = ['transaksi_penjualan_id', 'varian_id', 'jumlah', 'harga_jual'];

    public function varian()
    {
        return $this->belongsTo(VarianIkan::class, 'varian_id');
    }
}
