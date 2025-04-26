<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    // Tambahkan produk ke keranjang (database)
    public function addToCart(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk menambah ke keranjang.');
        }

        $product = Product::findOrFail($id);
        $quantity = $request->input('quantity', 1);

        // Cek apakah produk sudah ada di cart user
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Tampilkan keranjang belanja (database)
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat keranjang.');
        }

        $cart = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart', compact('cart'));
    }

    // Hapus produk dari keranjang (database)
    public function remove(Request $request, $id)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->route('cart')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = \App\Models\Cart::where('user_id', auth()->id())
        ->where('product_id', $id)
        ->first();

    if ($cartItem) {
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
    }

    return redirect()->route('cart')->with('success', 'Jumlah produk berhasil diupdate.');
}

}