{{-- filepath: resources/views/welcome.blade.php --}}
@extends('layout.main')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">Jumlah Produk</h2>
            <p class="text-2xl">{{ $productCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">Jumlah Kategori</h2>
            <p class="text-2xl">{{ $categoryCount }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow flex flex-col items-center justify-center">
            <h2 class="text-xl font-semibold text-blue-700 mb-2">Total Klik Produk</h2>
            <div class="text-4xl font-extrabold text-blue-600 tracking-widest">
                {{ $totalClicks }}
            </div>
            <span class="text-gray-500 text-sm mt-1">Total semua produk diklik</span>
        </div>
    </div>

    <div class="bg-white p-6 rounded shadow mt-8">
        <h2 class="text-xl font-bold mb-4 text-blue-700">Statistik Klik Produk per Kategori</h2>
        @foreach($clicksPerCategory as $category)
            <div class="mb-4">
                <div class="font-semibold text-lg text-gray-800">{{ $category->name }}</div>
                @if($category->products->count())
                    <ul class="ml-4 mt-2">
                        @foreach($category->products as $product)
                            <li class="flex justify-between border-b py-1">
                                <span>{{ $product->name }}</span>
                                <span class="text-blue-600 font-bold">
                                    {{ $product->click_count ?? 0 }} klik
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-gray-500 ml-4">Tidak ada produk.</div>
                @endif
            </div>
        @endforeach
    </div>
@endsection