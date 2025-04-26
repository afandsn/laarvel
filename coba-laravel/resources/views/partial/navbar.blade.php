{{-- filepath: resources/views/partial/navbar.blade.php --}}
<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            {{-- Kiri: Logo dan menu utama --}}
            <div class="flex items-center space-x-6">
                <a href="/" class="text-2xl font-bold text-blue-600 tracking-wide">MyShop</a>
                <a href="/" class="hidden md:inline py-2 px-3 text-gray-700 hover:text-blue-600 font-semibold transition">Home</a>
                <a href="/dashboard" class="hidden md:inline py-2 px-3 text-gray-700 hover:text-blue-600 font-semibold transition">Dashboard</a>
            </div>
            {{-- Kanan: Nama akun dan menu --}}
            <div class="flex items-center space-x-4">
                @auth
                    <span class="hidden md:inline py-2 px-4 font-mono font-bold text-blue-600 text-lg tracking-wider bg-blue-50 rounded shadow-sm">
                        {{ Auth::user()->name }}
                    </span>
                @endauth

                {{-- Dropdown menu --}}
                <div class="relative">
                    <button id="dropdownButton" class="py-2 px-3 text-gray-700 hover:text-blue-600 font-semibold transition flex items-center focus:outline-none">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        Menu
                    </button>
                    <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden z-50">
                        <a href="/product" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Products</a>
                        <a href="/category" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Categories</a>
                        <a href="/cart" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Cart</a>
                        @auth
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">Logout</button>
                            </form>
                        @endauth
                        @guest
                            <a href="/login" class="block px-4 py-2 text-gray-700 hover:bg-blue-50">Login</a>
                            <a href="/register" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 font-semibold">Register</a>
                        @endguest
                    </div>
                </div>

                {{-- Hamburger for mobile --}}
                <div class="md:hidden flex items-center">
                    <button id="nav-toggle" class="text-gray-700 focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="nav-menu" class="md:hidden hidden flex-col space-y-1 mt-2">
            <a href="/" class="block py-2 px-3 text-gray-700 hover:text-blue-600 font-semibold">Home</a>
            <a href="/dashboard" class="block py-2 px-3 text-gray-700 hover:text-blue-600 font-semibold">Dashboard</a>
            <a href="/product" class="block py-2 px-3 text-gray-700 hover:text-blue-600">Products</a>
            <a href="/category" class="block py-2 px-3 text-gray-700 hover:text-blue-600">Categories</a>
            <a href="/cart" class="block py-2 px-3 text-gray-700 hover:text-blue-600">Cart</a>
            @auth
                <a href="{{ route('profile.edit') }}" class="block py-2 px-3 text-gray-700 hover:text-blue-600">Edit Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 px-3 text-red-600 hover:text-white hover:bg-red-600 font-semibold rounded">Logout</button>
                </form>
                <span class="block py-2 px-3 font-mono font-bold text-blue-600 text-lg tracking-wider bg-blue-50 rounded shadow-sm">
                    {{ Auth::user()->name }}
                </span>
            @endauth
            @guest
                <a href="/login" class="block py-2 px-3 text-gray-700 hover:text-blue-600">Login</a>
                <a href="/register" class="block py-2 px-3 text-blue-600 hover:bg-blue-50 font-semibold">Register</a>
            @endguest
        </div>
    </div>

    {{-- Script untuk dropdown dan mobile toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile nav toggle
            const navToggle = document.getElementById('nav-toggle');
            const navMenu = document.getElementById('nav-menu');
            navToggle && navToggle.addEventListener('click', function () {
                navMenu.classList.toggle('hidden');
            });

            // Dropdown menu toggle
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            dropdownButton.addEventListener('click', function (e) {
                e.stopPropagation(); // Jangan biarkan klik nembus ke body
                dropdownMenu.classList.toggle('hidden');
            });

            // Klik di luar untuk nutup menu
            document.addEventListener('click', function (e) {
                if (!dropdownMenu.contains(e.target) && !dropdownButton.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
</nav>
