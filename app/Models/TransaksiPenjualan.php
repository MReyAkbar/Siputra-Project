<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    protected $table = 'transaksi_penjualan';
    protected $fillable = ['tanggal', 'customer_id', 'no_hp', 'gudang_id', 'admin_id'];

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'transaksi_penjualan_id');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'gudang_id');
    }

        public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
