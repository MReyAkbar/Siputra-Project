<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    protected $table = 'transaksi_pembelian';
    protected $fillable = ['tanggal', 'gudang_id', 'supplier_id', 'admin_id'];

    public function detail()
    {
        return $this->hasMany(DetailPembelian::class, 'transaksi_pembelian_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

        public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    

}
