@props([
	'tag' => 'h2',
	'size' => '2xl',
	'color' => 'text-gray-800'
])

@php
$headingSize = [
	'6xl' => 'text-5xl md:text-6xl',
	'5xl' => 'text-4xl md:text-5xl',
	'4xl' => 'text-3xl md:text-4xl',
	'3xl' => 'text-3xl',
	'2xl' => 'text-2xl',
	'xl' => 'text-xl',
	'lg' => 'text-lg',
	'md' => 'text-md'
][$size];
@endphp

<{{ $tag }} {{ $attributes->class([
		'font-semibold font-serif',
		$headingSize,
		$color
	]) }}>{{ $slot }}</{{ $tag }}>
