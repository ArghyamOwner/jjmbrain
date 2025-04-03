@props([
	'to' => '#',
	'active' => false
])

@php
// $navlinkActive = \Illuminate\Support\Str::startsWith(request()->url(), $to) ? 'bg-slate-700 text-slate-200' : 'text-slate-300';

$navlinkActive = (request()->url() === $to) || $active ? 'bg-slate-700 text-indigo-400 shadow' : 'text-slate-300';
@endphp

<a 
	href="{{ $to }}" 
	{{ $attributes->merge([
		'class' => 'text-sm overflow-hidden relative mb-1 rounded-md px-3 py-1.5 block hover:bg-slate-700 transition duration-200 ease-in-out '. $navlinkActive
	]) }}>
	{{ $slot }}

	@if(request()->url() === $to || $active)
		<span class="w-1 h-5 rounded-r-full absolute left-0 bg-indigo-500"></span>
	@endif
</a>
