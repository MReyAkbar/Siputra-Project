<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    protected $fillable = ['user_id', 'is_checked_out'];

    public function items()
    {
        return $this->hasMany(ShoppingCartItem::class, 'cart_id');
    }
}
