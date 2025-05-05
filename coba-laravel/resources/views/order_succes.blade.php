@extends('layout.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <div class="text-green-500 mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mt-4">Pembayaran Berhasil!</h2>
        <p class="text-gray-600 mt-2">Terima kasih telah berbelanja. Pesanan Anda sedang diproses.</p>
        
        <div class="mt-6 bg-gray-50 p-4 rounded-lg text-left max-w-md mx-auto">
            <h3 class="font-medium text-gray-800 mb-2">Detail Pesanan</h3>
            <p class="text-sm"><span class="font-medium">No. Order:</span> #{{ $order->id }}</p>
            <p class="text-sm"><span class="font-medium">Total Pembayaran:</span> Rp {{ number_format($order->total + $order->ongkir, 0, ',', '.') }}</p>
            <p class="text-sm"><span class="font-medium">Metode Pembayaran:</span> {{ ucfirst($order->metode_pembayaran) }}</p>
            <p class="text-sm"><span class="font-medium">Status:</span> <span class="capitalize">{{ $order->status }}</span></p>
        </div>

        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ route('product.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700">
                Lanjutkan Belanja
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-gray-800 hover:bg-gray-300">
                Ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection