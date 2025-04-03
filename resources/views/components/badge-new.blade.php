@props(['variant' => 'info', 'withdot' => true])

@php
    $badgeClass = [
        'info' => 'bg-blue-100 text-blue-600',
        'success' => 'bg-green-100 text-green-600',
        'warning' => 'bg-yellow-100 text-yellow-600',
        'danger' => 'bg-red-100 text-red-600',
        'gray' => 'bg-gray-100 text-gray-500',
        'meter' => 'bg-gray-100 text-gray-500',
    ];

    $borderClass = [
        'info' => 'border-blue-600',
        'success' => 'border-green-600',
        'warning' => 'border-yellow-600',
        'danger' => 'border-red-600',
        'gray' => 'border-gray-600',
        'meter' => 'border-gray-600',
    ];

    $bgClass = [
        'info' => 'bg-blue-100',
        'success' => 'bg-green-100',
        'warning' => 'bg-yellow-100',
        'danger' => 'bg-red-100',
        'gray' => 'bg-gray-100',
        'meter' => 'bg-gray-100',
    ];

    $iconClass = [
        'info' => 'text-blue-600',
        'success' => 'text-green-600',
        'warning' => 'text-yellow-600',
        'danger' => 'text-red-600',
        'gray' => 'text-gray-500',
        'meter' => 'text-gray-500',
    ];

    $icons = [
        'success' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-6 h-6 ' .
            $iconClass['success'] .
            '">
        	<path fill-rule="evenodd"
            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
            clip-rule="evenodd"></path>
    		</svg>',
        'info' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-6 h-6 ' .
            $iconClass['info'] .
            '"><path d="M12 2a10 10 0 1 1-10 10A10 10 0 0 1 12 2zm0 18a8 8 0 1 0-8-8 8 8 0 0 0 8 8zm-.75-6.75h-1.5V7.5h1.5v5.25zm0 3.75h-1.5v-1.5h1.5v1.5z" /></svg>',
        'warning' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-6 h-6 ' .
            $iconClass['warning'] .
            '"><path fill-rule="evenodd" d="M11.93 4.5l6.71 11.64a.75.75 0 0 1-.66 1.13h-13.4a.75.75 0 0 1-.66-1.13L12.07 4.5a.75.75 0 0 1 1.26 0zM12 6.91l-5.66 9.78h11.32L12 6.91z" clip-rule="evenodd" /></svg>',
        'danger' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-6 h-6 ' .
            $iconClass['danger'] .
            '"><path fill-rule="evenodd" d="M12 2a10 10 0 1 1-10 10A10 10 0 0 1 12 2zm0 18a8 8 0 1 0-8-8 8 8 0 0 0 8 8zm-.75-6.75h-1.5V7.5h1.5v5.25zm0 3.75h-1.5v-1.5h1.5v1.5z" /></svg>',
        'gray' =>
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-6 h-6 ' .
            $iconClass['gray'] .
            '"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"></path></svg>',
        'meter' => '<svg fill="#000000" width="24px" height="24px" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>meter</title><path d="M26,16a9.9283,9.9283,0,0,0-1.1392-4.6182l-1.4961,1.4961A7.9483,7.9483,0,0,1,24,16Z"/><path d="M23.4141,10,22,8.5859l-4.7147,4.7147A2.9659,2.9659,0,0,0,16,13a3,3,0,1,0,3,3,2.9659,2.9659,0,0,0-.3006-1.2853ZM16,17a1,1,0,1,1,1-1A1.0013,1.0013,0,0,1,16,17Z"/><path d="M16,8a7.9515,7.9515,0,0,1,3.1223.6353l1.4961-1.4961A9.9864,9.9864,0,0,0,6,16H8A8.0092,8.0092,0,0,1,16,8Z"/><path d="M16,30A14,14,0,1,1,30,16,14.0158,14.0158,0,0,1,16,30ZM16,4A12,12,0,1,0,28,16,12.0137,12.0137,0,0,0,16,4Z"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>',
];
    $icon = $icons[$variant] ?? $icons['info'];
@endphp

<span
    {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-1 rounded-lg border-2 ' . $borderClass[$variant].' '.$bgClass[$variant]])}} >
    {!! $icon !!}
    <div class="text-slate-800 font-medium pl-2 text-sm">
        {{ $slot }}
    </div>
</span>
