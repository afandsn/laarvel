{{-- filepath: resources/views/category_create.blade.php --}}
@extends('layout.main')

@section('content')
    <div class="max-w-md mx-auto mt-8 bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-blue-700">Tambah Kategori</h1>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium mb-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection