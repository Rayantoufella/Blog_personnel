<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') — Blog Personnel</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23A855F7'/><stop offset='1' stop-color='%23EC4899'/></linearGradient></defs><rect width='32' height='32' rx='8' fill='url(%23g)'/><text x='16' y='22' text-anchor='middle' font-family='sans-serif' font-weight='700' font-size='18' fill='white'>B</text></svg>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    <!-- CSS Global -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <!-- CSS spécifique à la page -->
    @yield('css')

    <style>
        @yield('inline_css')
    </style>
</head>
<body>
    @yield('content')

    <!-- JS Global -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- JS spécifique à la page -->
    @yield('js')
</body>
</html>
