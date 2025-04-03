@props([
	'color' => 'black',
	'tag' => 'button',
	'withSpinner' => false,
	'withIcon' => false,
	'icon' => '' 
])

@php
	$themeClasses = [
		'indigo' => 'bg-indigo-700 border-transparent hover:bg-indigo-800 text-white focus:ring-indigo-500',
		'purple' => 'bg-purple-700 border-transparent hover:bg-purple-800 text-white focus:ring-purple-500',
		'cyan' => 'bg-cyan-700 border-transparent hover:bg-cyan-800 text-white focus:ring-cyan-500',
		'blue' => 'bg-sky-700 border-transparent hover:bg-sky-800 text-white focus:ring-sky-500',
		'black' => 'bg-slate-700 border-transparent hover:bg-slate-800 text-white focus:ring-slate-500',
		'white' => 'border-slate-300 bg-white text-slate-500 hover:bg-slate-50 focus:ring-slate-400',
		'red' => 'bg-red-600 border-transparent hover:bg-red-500 text-white focus:ring-red-500',
		'transparent' => 'border-transparent bg-white hover:bg-white focus:ring-cyan-500'
	][$color];
@endphp

<{{ $tag }}
	{{ $attributes->merge([
		'class' => $themeClasses . ' transition duration-300 ease-in-out inline-flex items-center justify-center py-2 px-4 border shadow-sm text-sm font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed' 
	]) }}

	wire:loading.attr="disabled"

	@if ($withSpinner)
    	wire:loading.class="base-spinner cursor-not-allowed opacity-75" 
	@endif
>	
	@if($withIcon)
		@svg($icon, 'w-5 h-5 mr-1 -ml-1 shrink-0')
	@endif

	{{ $slot }}
</{{ $tag }}>
