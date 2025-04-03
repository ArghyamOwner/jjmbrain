<div>
	@php
		$tocs = Str::toc($items)
	@endphp
	@if (count($tocs) > 0)
		<h4 class="uppercase tracking-wide text-xs font-medium mb-2 text-gray-500">On This Page</h4>
	    @foreach ($tocs as $toc)
	    	<div>
				<a class="text-sm text-indigo-600 hover:underline" href="#{{ $toc }}"># {{ $toc }}</a>
	    	</div>
	    @endforeach
    @endif
</div>
