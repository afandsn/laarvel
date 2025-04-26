@extends('layout.main')

@section('content')
<div class="max-w-lg mx-auto mt-8 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Tambah Produk</h1>
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">Simpan</button>
    </form>
</div>
@endsection