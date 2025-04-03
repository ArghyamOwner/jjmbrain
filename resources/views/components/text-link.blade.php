@props(['withBackIcon' => false, 'color' => 'indigo'])

@php
$themes = [
	'blue' => 'text-sky-600 hover:text-sky-700',
	'blue-light' => 'text-sky-300 hover:text-sky-500',
	'indigo' => 'text-indigo-600 hover:text-indigo-700',
	'red' => 'text-red-600 hover:text-red-700',
	'green' => 'text-green-600 hover:text-green-700',
	'gray' => 'text-gray-700 hover:text-sky-600',
	'white' => 'text-white',
][$color ?? 'indigo'];
@endphp

<a
	{{ $attributes->merge([
		"class" => "inline-flex items-center hover:underline " . $themes
	]) }}
>	
	@if($withBackIcon)
		<svg class="mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g fill="none"><path d="M20 12H4m0 0l6 6m-6-6l6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
	@endif
	{{ $slot }}
</a>
