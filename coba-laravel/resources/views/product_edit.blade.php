@extends('layout.main')

@section('content')
<div class="max-w-xl mx-auto mt-8 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Produk</h1>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                   class="w-full border rounded px-3 py-2" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                   class="w-full border rounded px-3 py-2" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required
                      rows="4">{{ old('description', $product->description) }}</textarea>
        </div>
        
        <div class="mb-4">
            <label class="block font-medium mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                   class="w-full border rounded px-3 py-2" required min="0">
        </div>
        
        <div class="mb-4">
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="flex justify-between">
            <a href="{{ route('products.show', $product->id) }}" 
               class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Kembali
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection