{{-- filepath: resources/views/category.blade.php --}}
@extends('layout.main')

@section('content')
    <div class="max-w-2xl mx-auto mt-8 bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-blue-700">Daftar Kategori</h1>
        @if($categories->count())
            <ul class="divide-y divide-gray-200">
                @foreach($categories as $category)
                    <li class="py-3 flex items-center justify-between">
                        <span class="text-lg text-gray-800 font-medium">{{ $category->name }}</span>
                        <div class="flex gap-2">
                            <a href="{{ url('/category/'.$category->id) }}" class="text-blue-500 hover:underline text-sm">Lihat Produk</a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini beserta semua produknya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="flex gap-4 mt-6">
                <a href="{{ route('category.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold">
                    + Tambah Kategori
                </a>
                <a href="{{ route('product.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">
                    + Tambah Produk
                </a>
            </div>
        @else
            <div class="text-gray-500">Belum ada kategori.</div>
            <div class="flex gap-4 mt-6">
                <a href="{{ route('category.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 font-semibold">
                    + Tambah Kategori
                </a>
                <a href="{{ route('product.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">
                    + Tambah Produk
                </a>
            </div>
        @endif
    </div>
@endsection