@props(['theme' => 'red', 'width' => 'w-24'])

@php
	$themeClasses = match($theme) {
		'red' => 'bg-red-400 text-red-100',
		'green' => 'bg-green-400 text-green-100',
		'gray' => 'bg-gray-400 text-gray-100',
	};	
	$themeWrapperClasses = match($theme) {
		'red' => 'bg-red-500',
		'green' => 'bg-green-500',
		'gray' => 'bg-gray-500',
	};
@endphp

<div class="{{ $width }} aspect-square absolute -top-2 -left-2 overflow-hidden rounded-sm">
	<div class="absolute top-0 right-0 h-2 w-2 {{ $themeWrapperClasses }}"></div>
	<div class="absolute bottom-0 left-0 h-2 w-2 {{ $themeWrapperClasses }}"></div>
	<span
		class="py-1.5 font-semibold uppercase text-xs tracking-wider w-full block w-square-diagonal text-center absolute bottom-0 left-0 -rotate-45 origin-bottom-left shadow-sm {{ $themeClasses }}"
	>
		{{ $slot }}
	</span>
</div>