@php
	// $navlinkActive = \Illuminate\Support\Str::startsWith(request()->url(), $href) ? 'text-indigo-600' : 'text-slate-700';
	$navlinkActive = url()->current() === $href ? 'text-indigo-700' : 'text-slate-700';
@endphp

<a 
	href="{{ $href }}" 
	{{ $attributes->merge([
		'class' => 'ml-6 py-1 font-medium hover:text-indigo-600 transition-all duration-150 ease-in-out '. $navlinkActive
	]) }}>
	{{ $slot }}
</a>