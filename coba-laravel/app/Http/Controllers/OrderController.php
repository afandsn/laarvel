<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;

class OrderController extends Controller
{
    public function checkout()
    {
        // Ambil semua item cart milik user yang sedang login
        $cart = Cart::where('user_id', auth()->id())->get();

        // Jika keranjang kosong, redirect kembali ke cart
        if ($cart->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong.');
        }

        // Simpan setiap item cart sebagai order baru
        foreach ($cart as $item) {
            Order::create([
                'user_id' => auth()->id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total' => $item->quantity * $item->product->price,
            ]);
        }

        // Hapus semua item cart setelah checkout
        Cart::where('user_id', auth()->id())->delete();

        // Redirect ke halaman checkout dengan pesan sukses
        return redirect()->route('checkout')->with('success', 'Pesanan berhasil dibuat.');
    }
}