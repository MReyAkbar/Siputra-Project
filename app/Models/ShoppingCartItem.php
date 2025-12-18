<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $table = 'shopping_cart_items';
    protected $fillable = ['cart_id', 'catalog_item_id', 'ikan_id', 'jumlah'];

    protected $casts = [
        'jumlah' => 'integer',
    ];

    // Relationship to catalog item (primary)
    public function catalogItem()
    {
        return $this->belongsTo(CatalogItem::class, 'catalog_item_id');
    }

    // Keep ikan relationship for backward compatibility
    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    // Helper method to get the product (catalog item or ikan)
    public function getProduct()
    {
        return $this->catalogItem ?? $this->ikan;
    }

    // Get product name
    public function getProductName()
    {
        if ($this->catalogItem) {
            return $this->catalogItem->ikan->nama;
        }
        return $this->ikan->nama ?? 'Produk Tidak Diketahui';
    }

    // Get product price
    public function getProductPrice()
    {
        if ($this->catalogItem) {
            return $this->catalogItem->harga_jual;
        }
        return $this->ikan->harga_beli ?? 0;
    }

    // Get product image
    public function getProductImage()
    {
        if ($this->catalogItem && $this->catalogItem->gambar) {
            return $this->catalogItem->gambar;
        }
        return $this->ikan->foto ?? null;
    }

    // Get subtotal
    public function getSubtotal()
    {
        return $this->jumlah * $this->getProductPrice();
    }
}