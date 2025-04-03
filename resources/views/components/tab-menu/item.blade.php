@props([
	'isActive' => false,
	'tag' => 'button'
])

<{{ $tag }} {{ $tag === 'button' ? 'type=button' : '' }}
	@class([
		'p-2 border-b-2 hover:text-indigo-600 inline-flex items-center',
		'border-indigo-600 text-indigo-600 font-semibold' => $isActive,
		'border-transparent' => ! $isActive
	])
	{{ $attributes }}
>{{ $slot }}</{{ $tag }}>