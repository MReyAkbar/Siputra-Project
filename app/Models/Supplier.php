<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'nama_supplier',
        'no_hp',
        'alamat',
    ];

    // Relasi: Supplier dipakai pada banyak transaksi pembelian
    public function pembelian()
    {
        return $this->hasMany(TransaksiPembelian::class, 'supplier_id');
    }

    // Helper opsional (untuk tampilan dropdown lebih rapi)
    public function getDisplayNameAttribute()
    {
        return $this->nama_supplier . ($this->no_hp ? " - {$this->no_hp}" : "");
    }
}
