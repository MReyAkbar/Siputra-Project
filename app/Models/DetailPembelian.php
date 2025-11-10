<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    protected $fillable = ['transaksi_pembelian_id', 'varian_id', 'jumlah_kirim', 'jumlah_terima', 'harga_beli'];

    public function varian()
    {
        return $this->belongsTo(VarianIkan::class, 'varian_id');
    }
}
