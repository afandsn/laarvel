@extends('layout.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Checkout Pesanan</h1>
    
    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Detail Pesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Pesanan</h2>
                    
                    <div class="mb-4">
                        <p class="text-gray-600 mb-1">Kode Order: <span class="font-medium text-gray-800">#{{ strtoupper(uniqid()) }}</span></p>
                        <p class="text-gray-600">Tanggal: <span class="font-medium text-gray-800">{{ now()->format('d F Y H:i') }}</span></p>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Produk Dipesan</h3>
                        @foreach($cartItems as $item)
                            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                                    <div class="ml-4">
                                        <p class="text-gray-800 font-medium">{{ $item->product->name }}</p>
                                        <p class="text-gray-500 text-sm">Qty: {{ $item->quantity }}</p>
                                        <p class="text-gray-500 text-sm">Stok: {{ $item->product->stock }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-800 font-medium">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-800 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="text-gray-800 font-medium">Rp 15.000</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold mt-4 pt-4 border-t border-gray-200">
                            <span>Total Pembayaran</span>
                            <span>Rp {{ number_format($total + 15000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Form Alamat Pengiriman -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Alamat Pengiriman</h2>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                                <input type="text" id="nama" name="nama" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="tel" id="telepon" name="telepon" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                            <div>
                                <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <select id="provinsi" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                </select>
                            </div>
                            <div>
                                <label for="kota" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                                <select id="kota" name="kota" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Pilih Kota</option>
                                </select>
                            </div>
                            <div>
                                <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan untuk Penjual (Opsional)</label>
                            <textarea id="catatan" name="catatan" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Sembunyikan tombol submit di form utama -->
                        <button type="submit" class="hidden">Submit</button>
                    </form>
                </div>
            </div>
            
            <!-- Metode Pembayaran & Ringkasan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input id="bank-transfer" name="payment_method" type="radio" value="transfer" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" checked>
                            <label for="bank-transfer" class="ml-3 block text-sm font-medium text-gray-700">
                                Transfer Bank
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="e-wallet" name="payment_method" type="radio" value="e-wallet" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <label for="e-wallet" class="ml-3 block text-sm font-medium text-gray-700">
                                E-Wallet (OVO, Gopay, Dana)
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="cod" name="payment_method" type="radio" value="cod" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                            <label for="cod" class="ml-3 block text-sm font-medium text-gray-700">
                                COD (Bayar di Tempat)
                            </label>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Estimasi Pengiriman</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Reguler</span>
                                <span class="text-gray-800 font-medium">2-3 hari kerja</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Express</span>
                                <span class="text-gray-800 font-medium">1 hari kerja</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" onclick="submitCheckoutForm()" class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md transition duration-300">
                        Bayar Sekarang
                    </button>
                    
                    <div class="mt-4 text-sm text-gray-500">
                        <p>Dengan mengklik "Bayar Sekarang", Anda menyetujui Syarat & Ketentuan yang berlaku.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-700 mt-4">Keranjang belanja Anda kosong</h2>
            <p class="text-gray-500 mt-2">Belum ada produk yang di checkout.</p>
            <a href="{{ route('product.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-300">
                Lanjutkan Belanja
            </a>
        </div>
    @endif
</div>

<script>
    function submitCheckoutForm() {
        // Validasi stok
        let outOfStockItems = [];
        @foreach($cartItems as $item)
            if ({{ $item->quantity }} > {{ $item->product->stock }}) {
                outOfStockItems.push({
                    name: '{{ $item->product->name }}',
                    requested: {{ $item->quantity }},
                    available: {{ $item->product->stock }}
                });
            }
        @endforeach

        if (outOfStockItems.length > 0) {
            let message = 'Produk berikut stok tidak mencukupi:\n';
            outOfStockItems.forEach(item => {
                message += `- ${item.name} (Butuh: ${item.requested}, Tersedia: ${item.available})\n`;
            });
            alert(message);
            return false;
        }

        // Submit form
        document.querySelector('form').submit();
    }
</script>
@endsection