{{-- filepath: resources/views/cart.blade.php --}}
@extends('layout.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

    @if ($cart->count() > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Jumlah</th>
                    <th class="p-2 border">Subtotal</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td class="p-2 border flex items-center gap-2">
                            @if (!empty($item->product->image))
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover">
                            @endif
                            {{ $item->product->name ?? '-' }}
                        </td>
                        <td class="p-2 border">Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}</td>
                        <td class="p-2 border">{{ $item->quantity }}</td>
                        <td class="p-2 border">Rp {{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}</td>
                        <td class="p-2 border flex gap-2">
                            <form action="{{ route('cart.remove', $item->product_id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                            <button 
                                onclick="showUpdateModal({{ $item->product_id }}, {{ $item->quantity }})"
                                class="text-yellow-600 hover:underline"
                                type="button"
                            >Update</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="3" class="p-2 border text-right">Total</td>
                    <td class="p-2 border">
                        Rp {{ number_format($cart->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity), 0, ',', '.') }}
                    </td>
                    <td class="p-2 border"></td>
                </tr>
            </tfoot>
        </table>

        {{-- Tombol Checkout --}}
        <div class="mt-6 flex justify-end">
            <a href="{{ route('checkout') }}" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600 font-semibold">
                Checkout
            </a>
        </div>

        {{-- Modal Update Keranjang --}}
        <div id="updateModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6 relative">
                <button onclick="closeUpdateModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-blue-700">Update Jumlah Produk</h2>
                <form id="updateCartForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="product_id" id="modalProductId">
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="quantity" id="modalQuantity" class="w-full border rounded px-3 py-2" min="1" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeUpdateModal()" class="px-4 py-2 bg-gray-300 rounded mr-2">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function showUpdateModal(productId, quantity) {
                document.getElementById('updateModal').classList.remove('hidden');
                document.getElementById('modalProductId').value = productId;
                document.getElementById('modalQuantity').value = quantity;
                document.getElementById('updateCartForm').action = '/cart/update/' + productId;
            }
            function closeUpdateModal() {
                document.getElementById('updateModal').classList.add('hidden');
            }
        </script>
    @else
        <p>Keranjang masih kosong.</p>
    @endif
@endsection