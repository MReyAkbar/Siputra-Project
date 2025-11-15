<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    protected $table = 'catalog_items';
    protected $fillable = ['ikan_id', 'gambar', 'harga_jual', 'deskripsi', 'is_active'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }
}
