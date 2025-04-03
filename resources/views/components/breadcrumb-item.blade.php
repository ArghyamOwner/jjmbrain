@props([
	'href' => '',
	'separator' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"><g fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>' //'&#47;'
])
 
@if ($href)
	<a class="font-medium hover:underline text-indigo-700" href="{{ $href }}">
		{{ $slot }}
	</a>
 
	<span class="text-slate-400">{!! $separator !!}</span> 
@else 
	<span class="font-medium text-slate-700">
		{{ $slot }}
	</span>
@endif
