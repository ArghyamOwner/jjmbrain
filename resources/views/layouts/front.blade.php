<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? $title . ' - '. config('app.name') : config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $metaDescription ?? $siteSettings['meta_description'] ?? '' }}" />
    <meta name="og:title" content="{{ $metaTitle ?? '' }}" />
    <meta name="og:type" content="article" />
    <meta name="og:url" content="{{ url()->current() }}" />
    <meta name="og:site_name" content="{{ $tenantName ?? config('app.name') }}" />
    <meta name="og:description" content="{{ $metaDescription ?? '' }}" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:wght@400;600;700&display=swap"
        rel="stylesheet">

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
        
        <div class="py-1.5 bg-great-blue-700">
            <div class="md:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="text-sm text-great-blue-100">
                        <div class="flex space-x-2 items-center">
                            <svg class="shrink-0 h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            <span>Office Hours: {{ $siteSettings['working_hours'] ?? '' }}</span>
                        </div>
                    </div>
                    <div class="text-sm md:text-right text-great-blue-100 flex space-x-4 items-center md:justify-end">
                        <div class="flex space-x-2 items-center">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.0497 6C15.0264 6.19057 15.924 6.66826 16.6277 7.37194C17.3314 8.07561 17.8091 8.97326 17.9997 9.95M14.0497 2C16.0789 2.22544 17.9713 3.13417 19.4159 4.57701C20.8606 6.01984 21.7717 7.91101 21.9997 9.94M10.2266 13.8631C9.02506 12.6615 8.07627 11.3028 7.38028 9.85323C7.32041 9.72854 7.29048 9.66619 7.26748 9.5873C7.18576 9.30695 7.24446 8.96269 7.41447 8.72526C7.46231 8.65845 7.51947 8.60129 7.63378 8.48698C7.98338 8.13737 8.15819 7.96257 8.27247 7.78679C8.70347 7.1239 8.70347 6.26932 8.27247 5.60643C8.15819 5.43065 7.98338 5.25585 7.63378 4.90624L7.43891 4.71137C6.90747 4.17993 6.64174 3.91421 6.35636 3.76987C5.7888 3.4828 5.11854 3.4828 4.55098 3.76987C4.2656 3.91421 3.99987 4.17993 3.46843 4.71137L3.3108 4.86901C2.78117 5.39863 2.51636 5.66344 2.31411 6.02348C2.08969 6.42298 1.92833 7.04347 1.9297 7.5017C1.93092 7.91464 2.01103 8.19687 2.17124 8.76131C3.03221 11.7947 4.65668 14.6571 7.04466 17.045C9.43264 19.433 12.295 21.0575 15.3284 21.9185C15.8928 22.0787 16.1751 22.1588 16.588 22.16C17.0462 22.1614 17.6667 22 18.0662 21.7756C18.4263 21.5733 18.6911 21.3085 19.2207 20.7789L19.3783 20.6213C19.9098 20.0898 20.1755 19.8241 20.3198 19.5387C20.6069 18.9712 20.6069 18.3009 20.3198 17.7333C20.1755 17.448 19.9098 17.1822 19.3783 16.6508L19.1835 16.4559C18.8339 16.1063 18.6591 15.9315 18.4833 15.8172C17.8204 15.3862 16.9658 15.3862 16.3029 15.8172C16.1271 15.9315 15.9523 16.1063 15.6027 16.4559C15.4884 16.5702 15.4313 16.6274 15.3644 16.6752C15.127 16.8453 14.7828 16.904 14.5024 16.8222C14.4235 16.7992 14.3612 16.7693 14.2365 16.7094C12.7869 16.0134 11.4282 15.0646 10.2266 13.8631Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg> 
                            <div><a href="#" class="hover:underline">{{ $siteSettings['contact_phone'] ?? '' }}</a></div>
                        </div>
                        <div class="flex space-x-2 items-center">
                            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 7L10.1649 12.7154C10.8261 13.1783 11.1567 13.4097 11.5163 13.4993C11.8339 13.5785 12.1661 13.5785 12.4837 13.4993C12.8433 13.4097 13.1739 13.1783 13.8351 12.7154L22 7M6.8 20H17.2C18.8802 20 19.7202 20 20.362 19.673C20.9265 19.3854 21.3854 18.9265 21.673 18.362C22 17.7202 22 16.8802 22 15.2V8.8C22 7.11984 22 6.27976 21.673 5.63803C21.3854 5.07354 20.9265 4.6146 20.362 4.32698C19.7202 4 18.8802 4 17.2 4H6.8C5.11984 4 4.27976 4 3.63803 4.32698C3.07354 4.6146 2.6146 5.07354 2.32698 5.63803C2 6.27976 2 7.11984 2 8.8V15.2C2 16.8802 2 17.7202 2.32698 18.362C2.6146 18.9265 3.07354 19.3854 3.63803 19.673C4.27976 20 5.11984 20 6.8 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                
                            <div><a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="hover:underline">{{ $siteSettings['contact_email'] ?? '' }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.front.navbar-top')

        @isset($secondaryTopbar)
            {{ $secondaryTopbar }}
        @endisset

        <div class="flex-1 overflow-x-hidden">
            {{ $slot }}
        </div>

        @include('partials.front.footer2')
    </div>

    <x-toast />

    @stack('scripts-bottom')
</body>

</html>