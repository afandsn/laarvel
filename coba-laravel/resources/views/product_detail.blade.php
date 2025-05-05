{{-- filepath: resources/views/product_detail.blade.php --}}
@extends('layout.main')

@section('content')
<div class="max-w-xl mx-auto mt-8 bg-white p-8 rounded shadow">
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full mb-4 rounded">
    <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
    <p class="text-gray-600 mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    <p class="mb-4">{{ $product->description }}</p>
    <div class="text-sm text-gray-500 mb-4">Dilihat: {{ $product->click_count }} kali</div>
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="flex items-center gap-2">
            <input type="number" name="quantity" value="1" min="1" class="border-gray-300 rounded px-2 py-1 w-20 text-center focus:outline-none focus:ring focus:ring-blue-200">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-1.5 rounded-md transition">
                Tambah ke Keranjang
            </button>
        </div>
    </form>
    <div class="flex gap-2 mt-6">
        <a href="{{ route('product.index') }}" class="inline-block px-4 py-2 bg-gray-200 hover:bg-blue-600 hover:text-white rounded font-semibold transition">
            &larr; Kembali ke Daftar Produk
        </a>
        <button onclick="document.getElementById('editModal').classList.remove('hidden')" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 font-semibold transition">
            Edit Produk
        </button>
    </div>
</div>

{{-- Modal Edit Produk --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <button onclick="document.getElementById('editModal').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-2xl">&times;</button>
        <h2 class="text-xl font-bold mb-4 text-blue-700">Edit Produk</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Harga</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ $product->description }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Stok</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2" required min="0">
            </div>
            <div class="mb-4">
                <label class="block font-medium mb-1">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2" required>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" @if($product->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded mr-2">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection