<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    protected $table = 'shopping_cart_items';
    protected $fillable = ['cart_id', 'ikan_id', 'jumlah'];

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'ikan_id');
    }
}
