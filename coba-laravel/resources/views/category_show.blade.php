{{-- filepath: resources/views/category_show.blade.php --}}
@extends('layout.main')

@section('content')
    <div class="max-w-2xl mx-auto mt-8 bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-blue-700">Produk pada Kategori: {{ $category->name }}</h1>
        @if($products->count())
            <ul class="divide-y divide-gray-200">
                @foreach($products as $product)
                    <li class="py-3 flex items-center justify-between">
                        <span class="text-lg text-gray-800 font-medium">{{ $product->name }}</span>
                        <span class="text-gray-500">Rp {{ number_format($product->price,0,',','.') }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-gray-500">Belum ada produk pada kategori ini.</div>
        @endif
    </div>
@endsection