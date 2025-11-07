<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianIkan extends Model
{
    protected $table = 'varian_ikan';
    protected $fillable = ['ikan_id', 'nama_varian', 'harga_jual'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }

    public function stokGudang()
    {
        return $this->hasMany(StokGudang::class, 'varian_id');
    }

    // Hitung stok total otomatis (semua gudang)
    public function getStokTotalAttribute()
    {
        return $this->stokGudang->sum('jumlah_stok');
    }

    // Format tampilan katalog → "Layang (15–20)"
    public function getDisplayNameAttribute()
    {
        return $this->ikan->nama . ' (' . $this->nama_varian . ')';
    }

    // Format tampilan harga → "Rp XX.XXX / kg"
    public function getDisplayHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.') . ' / kg';
    }
}
