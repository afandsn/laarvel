{{-- filepath: resources/views/product_create.blade.php --}}
@extends('layout.main')

@section('content')
<div class="max-w-lg mx-auto mt-8 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Tambah Produk</h1>
    <form action="{{ route('product.store') }}" method="POST" id="productForm">
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
            <label class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Kategori</label>
            <select name="category_id" id="categorySelect" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
                <option value="other">Lainnya...</option>
            </select>
            <input type="text" name="new_category" id="newCategoryInput" class="w-full border rounded px-3 py-2 mt-2 hidden" placeholder="Masukkan kategori baru">
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Stok</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required min="0">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">Simpan</button>
    </form>
</div>
<script>
    document.getElementById('categorySelect').addEventListener('change', function() {
        var input = document.getElementById('newCategoryInput');
        if (this.value === 'other') {
            input.classList.remove('hidden');
            input.required = true;
        } else {
            input.classList.add('hidden');
            input.required = false;
        }
    });
</script>
@endsection