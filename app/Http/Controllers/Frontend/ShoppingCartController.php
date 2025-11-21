<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\Ikan;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $cart = ShoppingCart::firstOrCreate(
            ['user_id' => Auth::id(), 'is_checked_out' => false]
        );

        $items = $cart->items()->with('ikan')->get();

        return view('keranjang', compact('items'));
    }

    public function add($ikan_id)
    {
        $cart = ShoppingCart::firstOrCreate(
            ['user_id' => Auth::id(), 'is_checked_out' => false]
        );

        $item = ShoppingCartItem::firstOrCreate(
            ['cart_id' => $cart->id, 'ikan_id' => $ikan_id],
            ['jumlah' => 1]
        );

        if (!$item->wasRecentlyCreated) {
            $item->jumlah += 1;
            $item->save();
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update($item_id)
    {
        $item = ShoppingCartItem::findOrFail($item_id);

        $item->jumlah = request()->jumlah;
        $item->save();

        return back()->with('success', 'Jumlah berhasil diperbarui!');
    }

    public function delete($item_id)
    {
        ShoppingCartItem::findOrFail($item_id)->delete();

        return back()->with('success', 'Item dihapus dari keranjang!');
    }
}
