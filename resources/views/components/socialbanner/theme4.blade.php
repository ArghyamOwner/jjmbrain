 <div
	{{
		$attributes->merge([
			'class' => 'shadow bg-white relative flex items-center max-w-full border-[1em] border-orange-600 bg-gray-900'
		])
	}}
 >
	        
	<div class="relative z-10 px-20 py-6 flex-1">
		<h2 class="font-semibold text-slate-200 text-6xl" contenteditable="true" spellcheck="false">{{ $title ?? 'Title Goes Here' }}</h2>
		<p class="text-slate-500 font-mono text-xl mt-8">{{ $author ?? 'Author Name' }}</p>
	</div>

	<div class="w-64 absolute right-0 top-0 bottom-0">
		<div class="grid grid-cols-6">
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10"></div>
			<div class="h-10"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
			<div class="h-10"></div>
			<div class="h-10 bg-orange-600"></div>
		</div>
	</div>

</div>