<div {{ $attributes }}>
	<h4 class="font-bold text-slate-800">Share this post:</h4>
	<div class="flex flex-wrap space-x-2">
		<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-block group">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-current text-slate-400 hover:text-slate-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M4 4l11.733 16h4.267l-11.733 -16z"></path>
				<path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"></path>
			 </svg>
		</a>
		
		<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="inline-block group">
			<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-current text-slate-400 hover:text-slate-500" viewBox="0 0 24 24"><path d="M12.001 2.002c-5.522 0-9.999 4.477-9.999 9.999 0 4.99 3.656 9.126 8.437 9.879v-6.988h-2.54v-2.891h2.54V9.798c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.24 0-1.628.772-1.628 1.563v1.875h2.771l-.443 2.891h-2.328v6.988C18.344 21.129 22 16.992 22 12.001c0-5.522-4.477-9.999-9.999-9.999z"></path></svg>
		</a>
	</div>
</div>