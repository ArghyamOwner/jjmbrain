@props([
	'align' => 'center',
	'heading' => '',
	'subheading' => '',
	'padding' => 'py-10 md:py-20'
])

@php
	$alignClasses = match($align) {
		'left' => 'text-left',
		'center' => 'text-center',
		default => 'text-center'
	};
@endphp

<div class="{{ $padding }} bg-indigo-800 relative overflow-hidden">
	<x-section-centered class="relative z-10">
		<div class="{{ $align == 'center' ? 'mx-auto md:max-w-xl' : '' }}">
			@isset($heading)
				<h2 class="text-4xl font-medium font-serif text-indigo-50 {{ $alignClasses }}">{{ $heading }}</h2>
			@endisset

			@isset($subheading)
				<div class="{{ $alignClasses }} mt-3 text-lg prose prose-indigo text-indigo-100">{!! $subheading !!}</div>
			@endisset

			{{ $slot }}
		</div>
	</x-section-centered>

	<div class="absolute inset-0 w-full h-full grid grid-cols-12" x-data="{
        multiplesOfFour(number) {
          return [4, 10, 14, 29, 32, 47, 51, 80, 100].includes(number);
        }
      }" x-cloak>
		<template x-for="i in 600">als ar
			<div class="h-16 border border-indigo-500/10"
				:class="{ 'border-indigo-200/20' : multiplesOfFour(i), 'border-l-0 border-b-0' : !multiplesOfFour(i) }">
			</div>
		</template>
	</div>
</div>