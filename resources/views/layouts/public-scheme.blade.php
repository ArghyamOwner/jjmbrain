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
    <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
    @stack('scripts')
</head>

<body>
    <div class="px-4 py-4" style="background-color: #0f4497;">
        <div class="flex justify-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-16">
            </div>
            <div class="text-left">
                <div class="text-2xl font-bold text-white">Jal Jeevan Mission</div>
                <div class="text-xl font-medium text-white">PHED Assam</div>
            </div>
        </div>
    </div> 
    <div class="px-4 py-8" style="background-color: #056fd2;">
        <div>
            <img src="{{ url('img/emblem.png') }}" alt="emblem" loading="lazy" class="object-fit h-32 mx-auto block">
            <div class="uppercase text-md tracking-wider text-center font-medium text-white">GOVERNMENT OF ASSAM</div>
        </div>
    </div>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    @stack('scripts-footer')
    @stack('scripts-bottom')
</body>

</html>
