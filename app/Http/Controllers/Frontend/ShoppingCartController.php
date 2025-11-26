<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\CatalogItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    /**
     * Display cart page
     */
    public function index()
    {
        $cart = ShoppingCart::firstOrCreate(
            ['user_id' => Auth::id(), 'is_checked_out' => false]
        );

        $items = $cart->items()->with(['catalogItem.ikan.kategori', 'ikan'])->get();

        return view('keranjang', compact('items'));
    }

    /**
     * Add item to cart via AJAX
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'catalog_item_id' => 'required|exists:catalog_items,id',
                'jumlah' => 'nullable|integer|min:1'
            ]);

            $catalogItem = CatalogItem::with('ikan')->findOrFail($request->catalog_item_id);
            
            if (!$catalogItem->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk ini tidak tersedia saat ini.'
                ], 400);
            }

            $requestedQty = $request->input('jumlah', 1);
            $availableStock = $catalogItem->ikan->stokGudang()->sum('jumlah_stok');
            
            if ($availableStock < $requestedQty) {
                return response()->json([
                    'success' => false,
                    'message' => "Stok tidak mencukupi. Stok tersedia: {$availableStock} kg"
                ], 400);
            }

            $cart = ShoppingCart::firstOrCreate(
                ['user_id' => Auth::id(), 'is_checked_out' => false]
            );

            DB::beginTransaction();

            $cartItem = ShoppingCartItem::where('cart_id', $cart->id)
                ->where('catalog_item_id', $request->catalog_item_id)
                ->first();

            if ($cartItem) {
                $newQty = $cartItem->jumlah + $requestedQty;
                
                if ($availableStock < $newQty) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => "Tidak dapat menambah. Total akan melebihi stok. Stok tersedia: {$availableStock} kg, Dalam keranjang: {$cartItem->jumlah} kg"
                    ], 400);
                }
                
                $cartItem->jumlah = $newQty;
                $cartItem->save();
                
                $message = "Jumlah {$catalogItem->ikan->nama} berhasil diperbarui di keranjang!";
            } else {
                ShoppingCartItem::create([
                    'cart_id' => $cart->id,
                    'catalog_item_id' => $request->catalog_item_id,
                    'jumlah' => $requestedQty
                ]);
                
                $message = "{$catalogItem->ikan->nama} berhasil ditambahkan ke keranjang!";
            }

            DB::commit();

            $cartCount = ShoppingCartItem::where('cart_id', $cart->id)
                ->sum('jumlah');

            return response()->json([
                'success' => true,
                'message' => $message,
                'cartCount' => $cartCount,
                'productName' => $catalogItem->ikan->nama
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan ke keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $item_id)
    {
        try {
            $request->validate([
                'jumlah' => 'required|integer|min:1'
            ]);

            $item = ShoppingCartItem::with('catalogItem.ikan')->findOrFail($item_id);

            if ($item->cart->user_id !== Auth::id()) {
                return back()->with('error', 'Aksi tidak diizinkan.');
            }

            $catalogItem = $item->catalogItem;
            if ($catalogItem) {
                $availableStock = $catalogItem->ikan->stokGudang()->sum('jumlah_stok');
                
                if ($availableStock < $request->jumlah) {
                    return back()->with('error', "Stok tidak mencukupi. Stok tersedia: {$availableStock} kg");
                }
            }

            $item->jumlah = $request->jumlah;
            $item->save();

            return back()->with('success', 'Jumlah berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui jumlah: ' . $e->getMessage());
        }
    }

    /**
     * Remove item from cart
     */
    public function delete($item_id)
    {
        try {
            $item = ShoppingCartItem::findOrFail($item_id);

            if ($item->cart->user_id !== Auth::id()) {
                return back()->with('error', 'Aksi tidak diizinkan.');
            }

            $item->delete();

            return back()->with('success', 'Item berhasil dihapus dari keranjang!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus item: ' . $e->getMessage());
        }
    }

    /**
     * Get cart count (for badge)
     */
    public function getCount()
    {
        try {
            $cart = ShoppingCart::where('user_id', Auth::id())
                ->where('is_checked_out', false)
                ->first();

            if (!$cart) {
                return response()->json(['count' => 0]);
            }

            $count = ShoppingCartItem::where('cart_id', $cart->id)
                ->sum('jumlah');

            return response()->json(['count' => $count]);

        } catch (\Exception $e) {
            return response()->json(['count' => 0], 500);
        }
    }
}