<!DOCTYPE html>
<html>
<head>
    <title>Toko Laravel</title>
</head>
<body>
    @include('partial.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('partial.footer')
</body>
</html>
