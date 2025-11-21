<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $fillable = ['transaksi_penjualan_id', 'ikan_id', 'jumlah', 'harga_jual', 'subtotal'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_penjualan_id');
    }
    public function transaksiPenjualan()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_penjualan_id');
    }
}
