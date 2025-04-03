<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - '. config('app.name') : config('app.name', 'Laravel') }}</title>

    <meta property="description" content="{{ $metaDescription ?? '' }}" />
    <meta property="og:title" content="{{ $metaTitle ?? '' }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ $metaDescription ?? '' }}" />
    <meta property="og:image" content="{{ url('img/og_banner.png') }}"/>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <livewire:styles />
    <link rel="stylesheet" href="/css/front.css">
    @stack('styles')
    
    <!-- Scripts -->
    <livewire:scripts />
    <script defer src="https://unpkg.com/@alpinejs/intersect@3.9.0/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
    @stack('scripts')
</head>

<body>
    <div class="font-sans text-slate-900 antialiased flex flex-col w-full min-h-screen">
     
        @include('partials.front.navbar-top-help')

        @isset($secondaryTopbar)
            {{ $secondaryTopbar }}
        @endisset

        <div class="flex-1 overflow-x-hidden">
            {{ $slot }}
        </div>

        @include('partials.front.footer-help')
    </div>
 
    @stack('scripts-footer')
    @stack('scripts-bottom')
</body>

</html>