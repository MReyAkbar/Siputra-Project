<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    protected $table = 'catalog_items';
    
    protected $fillable = [
        'ikan_id',
        'harga_jual',
        'gambar',
        'deskripsi',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationship to Ikan
    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }

    // Relationship to shopping cart items
    public function cartItems()
    {
        return $this->hasMany(ShoppingCartItem::class, 'catalog_item_id');
    }

    // Scope for active items only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Get available stock from related ikan
    public function getAvailableStock()
    {
        if (!$this->ikan) {
            return 0;
        }
        
        return $this->ikan->stokGudang()->sum('jumlah_stok') ?? 0;
    }

    // Check if item is in stock
    public function isInStock()
    {
        return $this->getAvailableStock() > 0;
    }
}