<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    protected $table = 'ikan';
    protected $fillable = ['kategori_id', 'nama', 'kode', 'harga_beli', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo(KategoriIkan::class, 'kategori_id');
    }

    public function catalogItems()
    {
        return $this->hasMany(CatalogItem::class, 'ikan_id');
    }

    public function stokGudang()
    {
        return $this->hasMany(StokGudang::class, 'ikan_id');
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'ikan_id');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'ikan_id');
    }
}
