<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;

class OrderController extends Controller
{
    // Menampilkan halaman checkout (GET)
    public function showCheckout()
    {
    // Ambil dari database (sesuai CartController Anda)
    $cartItems = Cart::with('product')
                  ->where('user_id', auth()->id())
                  ->get();
    
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Keranjang kosong.');
    }

    $total = $cartItems->sum(function($item) {
        return $item->product->price * $item->quantity;
    });

    return view('checkout', [
        'cartItems' => $cartItems,
        'total' => $total
    ]);

    }

    // Memproses checkout (POST)
    public function processCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
        ]);

        $cartItems = Cart::with('product')
                      ->where('user_id', auth()->id())
                      ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong.');
        }

        // Buat order utama
        $order = Order::create([
            'user_id' => auth()->id(),
            'nama_penerima' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'catatan' => $request->catatan,
            'total' => $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            }),
            'status' => 'pending',
            'metode_pembayaran' => $request->payment_method,
        ]);

        // Tambahkan item order
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Kurangi stok produk
            Product::where('id', $item->product_id)
                 ->decrement('stock', $item->quantity);
        }

        // Hapus cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('order.success', $order->id)
                       ->with('success', 'Pesanan berhasil dibuat.');
    }
    public function orderSuccess(Order $order)
{
    if ($order->user_id !== auth()->id()) {
        abort(403);
    }

    return view('order_success', compact('order'));
}
}