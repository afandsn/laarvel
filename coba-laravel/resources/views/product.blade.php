@extends('layout.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
    <div class="grid grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="border rounded p-4 shadow">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-2">
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" class="border p-1 w-16 mb-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Tambah ke Keranjang</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
