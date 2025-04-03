@props([
	'withBorder' => true
])

<div
	@class([
		'flex space-x-2 h-12 border-gray-300 overflow-x-auto whitespace-nowrap',
		'border-b' => $withBorder
	])
>
	{{ $slot }}
</div>