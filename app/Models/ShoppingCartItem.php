<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $table = 'shopping_cart_items';
    protected $fillable = ['cart_id', 'varian_id', 'jumlah'];

    public function varian()
    {
        return $this->belongsTo(VarianIkan::class, 'varian_id');
    }
}
