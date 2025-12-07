<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiPembelian extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pembelian';
    protected $fillable = ['tanggal', 'gudang_id', 'supplier_id', 'admin_id'];
    protected $casts = [
        'tanggal' => 'datetime',
    ];

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
