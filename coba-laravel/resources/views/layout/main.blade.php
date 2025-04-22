<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
</head>
<body>
    @include('partial.navbar')
    <main>
        @yield('content')
    </main>
    @include('partial.footer')
</body>
</html>