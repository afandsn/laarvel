{{-- filepath: resources/views/product.blade.php --}}
@extends('layout.main')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Daftar Produk</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <div class="bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-900 mb-1">
                            <a href="{{ route('product.show', $product->id) }}" class="hover:underline">
                                {{ $product->name }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-sm mb-4">
                            Stok: {{ $product->stock }}
                            @if($product->stock <= 0)
                                <span class="text-red-500 ml-2">(Stok Habis)</span>
                            @elseif($product->stock < 5)
                                <span class="text-yellow-500 ml-2">(Stok Terbatas)</span>
                            @endif
                        </p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-2">
                            @csrf
                            <div class="flex items-center gap-2">
                                <label for="quantity-{{ $product->id }}" class="sr-only">Jumlah</label>
                                <input id="quantity-{{ $product->id }}" 
                                       type="number" 
                                       name="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}"
                                       class="border-gray-300 rounded px-2 py-1 w-20 text-center focus:outline-none focus:ring focus:ring-blue-200"
                                       @if($product->stock <= 0) disabled @endif>
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-1.5 rounded-md transition"
                                        @if($product->stock <= 0) disabled @endif>
                                    @if($product->stock <= 0)
                                        Stok Habis
                                    @else
                                        Tambah ke Keranjang
                                    @endif
                                </button>
                            </div>
                            @if(session('error') && session('product_id') == $product->id)
                                <p class="text-red-500 text-sm">{{ session('error') }}</p>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection