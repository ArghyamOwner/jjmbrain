@props(['variant' => 'info', 'withdot' => true])

@php
$badgeClass = [
	'info' => 'bg-blue-100 text-blue-600',
	'success' => 'bg-green-100 text-green-600',
	'warning' => 'bg-yellow-100 text-yellow-600',
	'danger' => 'bg-red-100 text-red-600',
	'gray' => 'bg-gray-100 text-gray-500'
];	

$badgeDotClass = [
	'info' => 'bg-blue-500',
	'success' => 'bg-green-500',
	'warning' => 'bg-yellow-500',
	'danger' => 'bg-red-500',
	'gray' => 'bg-gray-500'
];	
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 rounded-full capitalize text-xs leading-5 font-semibold '. $badgeClass[$variant]]) }}>
	@if($withdot)<span class="w-1.5 h-1.5 rounded-full mr-1 {{ $badgeDotClass[$variant] }}"></span>@endif{{ $slot }}
</span>