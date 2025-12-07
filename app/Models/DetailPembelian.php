<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'detail_pembelian';
    protected $fillable = ['transaksi_pembelian_id', 'ikan_id', 'jumlah_kirim', 'jumlah_terima', 'harga_beli'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }


    public function transaksi()
    {
        return $this->belongsTo(TransaksiPembelian::class, 'transaksi_pembelian_id');
    }
    public function transaksiPembelian()
    {
        return $this->belongsTo(TransaksiPembelian::class, 'transaksi_pembelian_id');
    }
}
