<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/auth.css">
    @stack('styles')

    <livewireStyles />
    <livewire:scripts />
    <x-toast />
    <!-- Scripts -->
    @stack('alpinejs-scripts')
    <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
    @stack('scripts')
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @stack('scripts-footer')
    @stack('scripts-bottom')
</body>

</html>
