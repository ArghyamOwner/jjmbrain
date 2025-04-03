<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('meta')
        <title>{{ $title ?? '' }} - {{ config('app.name') }}</title>
        
        <link rel="preload" href="{{ asset('css/app.css') }}" as="style">
        
        <link rel="preconnect" href="{{ config('app.url') }}">
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
        <link rel="dns-prefetch" href="//cdn.cloudflare.net">
        <link rel="dns-prefetch" href="//unpkg.com">
        
        <link rel="prerender" href="{{ config('app.url') }}">

        <meta property="description" content="{{ $metaDescription ?? '' }}" />
        <meta property="og:title" content="{{ $metaTitle ?? '' }}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:site_name" content="{{ config('app.name') }}" />
        <meta property="og:description" content="{{ $metaDescription ?? '' }}" />
        <meta property="og:image" content="{{ url('img/og_banner.png') }}"/>

        <x-global-progress color="coral" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet"> --}}
        
        <link href="/css/app.css" rel="stylesheet">
        <livewire:styles />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy.css">
        @stack('styles')

        <livewire:scripts />
        @stack('alpinejs-scripts')
        <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
        @stack('scripts')
    </head>
    <body class="bg-slate-100 antialiased font-sans text-slate-700">
        
        <div class="flex">
            {{-- @includeWhen(auth()->user()->isAdministratorOrSuper(), 'layouts.sidebar')
            @includeWhen(auth()->user()->isSubAdministrator(), 'layouts.sidebar-sub-admin')--}}

            @if(auth()->user()->isCallCenter())
                @include('layouts.sidebar-call-center')
            @elseif (auth()->user()->isDPMU())    
                @include('layouts.sidebar-dpmu')
            @elseif (auth()->user()->isPanchayat())    
                @include('layouts.sidebar-panchayat')
            @elseif (auth()->user()->isExecutiveEngineer())    
                @include('layouts.sidebar-executive-engineer')
            @elseif (auth()->user()->isSectionOfficer())    
                @include('layouts.sidebar-section-officer')
            @elseif (auth()->user()->isTpaAdmin())    
                @include('layouts.sidebar-tpa')
            @elseif (auth()->user()->isJalMitra())    
                @include('layouts.sidebar-jal-mitra')
            @elseif (auth()->user()->isAsrlmBlock())    
                @include('layouts.sidebar-asrlm-block')
            @elseif (auth()->user()->isIsaCoordinator())    
                @include('layouts.sidebar-isa-coordinator')
            @elseif (auth()->user()->isLabTechnicalOfficer())    
                @include('layouts.sidebar-lab-technical-officer')
            @elseif (auth()->user()->isLabNodalOfficer())    
                @include('layouts.sidebar-lab-nodal-officer')
            @elseif (auth()->user()->isLabHo())    
                @include('layouts.sidebar-lab-ho')
            @elseif (auth()->user()->isGeologyHo())    
                @include('layouts.sidebar-geology-ho')
            @elseif (auth()->user()->isSdo())    
                @include('layouts.sidebar-sdo')
            @elseif (auth()->user()->isStateIsa())    
                @include('layouts.sidebar-state-isa')
            @elseif (auth()->user()->isDistrictJaldootCell())    
                @include('layouts.sidebar-district-jaldoot-cell')
            @elseif (auth()->user()->isStateJaldootCell())    
                @include('layouts.sidebar-state-jaldoot-cell')
            @elseif (auth()->user()->isIecSpecialist())    
                @include('layouts.sidebar-iec-specialist')
            @elseif (auth()->user()->isCeoZp())    
                @include('layouts.sidebar-ceo_zp')
            @elseif (auth()->user()->isBlockUser())    
                @include('layouts.sidebar-block-user')
            @elseif (auth()->user()->isPanchayatCommissioner())    
                @include('layouts.sidebar-panchayat-commissioner')
            @elseif (auth()->user()->isTechSupport())    
                @include('layouts.sidebar-techsupport')
            @elseif (auth()->user()->isGisExpert())    
                @include('layouts.sidebar-gis-expert')
            @elseif (auth()->user()->isDc())    
                @include('layouts.sidebar-dc')
            @elseif (auth()->user()->isWucAuditor())    
                @include('layouts.sidebar-wuc-auditor')
            @elseif (auth()->user()->isIotVendor())    
                @include('layouts.sidebar-iot-vendor')
            @elseif (auth()->user()->isLabAdmin())    
            @include('layouts.sidebar-lab-admin')
            @else
                @include('layouts.sidebar')
            @endif


            {{-- @include('layouts.sidebar')

            @includeWhen(auth()->user()->isCallCenter(), 'layouts.sidebar-call-center')

            @includeWhen(auth()->user()->isDPMU(), 'layouts.sidebar-dpmu')

            @includeWhen(auth()->user()->isPanchayat(), 'layouts.sidebar-panchayat')

            @includeWhen(auth()->user()->isExecutiveEngineer(), 'layouts.sidebar-executive-engineer')
         
            @includeWhen(auth()->user()->isSectionOfficer(), 'layouts.sidebar-section-officer')

            @includeWhen(auth()->user()->isTpaAdmin(), 'layouts.sidebar-tpa')

            @includeWhen(auth()->user()->isJalMitra(), 'layouts.sidebar-jal-mitra') --}}

         
            <div class="flex-1 overflow-x-hidden min-h-screen @auth lg:ml-64 @endauth">
                
                @if(str_contains(url()->current(), 'jjm.sumato'))
                    <x-alert :close="false" variant="warning">THIS IS TEST SITE, ANY ACTUAL DATA ENTRY WILL NOT BE REFLECTED IN JJM BRAIN.</x-alert>
                @endif
                
                {{-- Mobile Menu / Global Top Navbar --}}
                <div class="shadow-sm bg-white sticky top-0 w-full z-20 lg:hidden">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex flex-1 items-center">
                            <div class="flex items-center h-14 md:h-16 w-full">
                                {{-- Logo --}}
                                <div class="flex-1">
                                    <div class="flex lg:hidden">
                                        <div class="p-2 rounded-lg hover:bg-gray-200 cursor-pointer -ml-2 mr-2" x-on:click="$dispatch('opensidebar')" x-data x-cloak>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                                <line x1="4" y1="6" x2="20" y2="6" />
                                                <line x1="4" y1="12" x2="20" y2="12" />
                                                <line x1="4" y1="18" x2="20" y2="18" />
                                            </svg>
                                        </div>
                                        <x-application-logo class="text-xl" />
                                    </div>

                                    {{-- <div class="hidden md:flex">
                                        <x-heading size="lg">{{ $siteTitle ?? $title ?? '' }}</x-heading>
                                    </div> --}}
                                </div>
                            
                                {{-- <div class="flex space-x-2 items-center">
                                    <x-notification-button href="{{ route('notifications') }}" :active="true" />

                                    <x-dropdown>
                                        <x-slot:trigger>
                                            <div>
                                                <livewire:profile-button />
                                            </div>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="px-4 py-1 text-xs">
                                                <div class="font-medium text-sm leading-tight truncate">{{ auth()->user()->name ?? 'John Wick' }}</div>
                                                <div class="text-slate-500 text-xs truncate leading-tight">{{ Str::headline(auth()->user()->role ?? 'Test') }}</div>
                                            </div>

                                            <div class="border-t border-gray-100 my-1"></div>

                                            <x-dropdown-link class="flex items-center" href="{{ route('profile') }}"><x-icon-user class="mr-4 text-slate-400 w-5 h-5"/>Profile</x-dropdown-link>

                                            <x-dropdown-link class="flex items-center" href="{{ route('profile.settings') }}"><x-icon-setting class="mr-4 text-slate-400 w-5 h-5"/>Settings</x-dropdown-link>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-dropdown-link class="flex items-center" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <x-icon-logout class="mr-4 text-slate-400 w-5 h-5"/>Log out
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /Mobile Menu / Global Top Navbar --}}

                @isset($secondaryTopbar)
                    {{ $secondaryTopbar }}
                @endisset

                <div class="@auth pt-2 pb-10 @endauth">
                    <x-section-centered>
                        <x-banner />

                    </x-section-centered>

                    {{ $slot }}
                </div>

                <x-toast />
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@0.4.0/dist/cdn.min.js"></script>
        @if (app()->isProduction())
        <script async defer data-website-id="9133bf68-08fa-44f2-b355-2f99000b20ad" src="https://analytics.sumato.tech/umami.js"></script>
        @endif
        @stack('scripts-footer')
        @stack('charts')
    </body>
</html>

