@props([
	'href' => '#',
	'active' => false
])

<x-button-icon tag="a" :href="$href" class="relative">
	<div @class([
		'w-2.5 h-2.5 rounded-full absolute top-1 right-1 border-2',
		'bg-red-500 border-white' => $active,
		'border-transparent' => !$active
	])></div>
	<x-icon-notification class="w-5 h-5" />
</x-button-icon>   