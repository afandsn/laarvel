@extends('layout.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

    @if (count($cart) > 0)
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Produk</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Jumlah</th>
                    <th class="p-2 border">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $item)
                    <tr>
                        <td class="p-2 border flex items-center gap-2">
                            @if (!empty($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover">
                            @endif
                            {{ $item['name'] }}
                        </td>
                        <td class="p-2 border">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="p-2 border">{{ $item['quantity'] }}</td>
                        <td class="p-2 border">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                    <td class="p-2 border">
                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                    
                @endforeach
            </tbody>

            <tfoot>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="3" class="p-2 border text-right">Total</td>
                    <td class="p-2 border">
                        Rp {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
            
        </table>
    @else
        <p>Keranjang masih kosong.</p>
    @endif
@endsection
