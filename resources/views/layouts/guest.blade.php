<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Calderon Vega</title>
        
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('uploads/family.ico') }}" type="image/x-icon">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <!-- PWA -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register("{{ asset('serviceworker.js') }}");
                });
            }
        </script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @include('sweetalert::alert')
            {{ $slot }}
        </div>
    </body>
</html>