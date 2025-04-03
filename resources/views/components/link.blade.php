@props([
	'variant' => '' // danger/warning/success
])

@php
	$variantClass = match($variant) {
		'danger' => 'text-red-600',
		'success' => 'text-green-600',
		'warning' => 'text-yellow-600',
		'info' => 'text-indigo-600',
		'cyan' => 'text-cyan-600',
		'black' => 'text-gray-700',
		default => 'text-indigo-600'
	};
@endphp

<a {{ $attributes->class([
		'font-medium inline-flex hover:underline',
		$variantClass
])->merge() }}>
	{{ $slot }}
</a>