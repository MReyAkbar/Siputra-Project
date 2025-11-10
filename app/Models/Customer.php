<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'nama_customer',
        'no_hp',
        'alamat',
    ];

    // Relasi: Customer terkait banyak transaksi penjualan
    public function penjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'customer_id');
    }

    // Helper opsional untuk dropdown / invoice
    public function getDisplayNameAttribute()
    {
        return $this->nama_customer . ($this->no_hp ? " - {$this->no_hp}" : "");
    }
}
