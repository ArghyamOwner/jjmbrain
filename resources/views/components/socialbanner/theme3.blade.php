 <div
	{{
		$attributes->merge([
			'class' => 'shadow bg-white rounded-lg overflow-hidden relative flex items-center pattern-grid text-gray-100 max-w-full'
		])
	}}
 >
	<div class="h-64 bg-gradient-to-b from-gray-50 absolute top-0 left-0 right-0"></div>

 	<div class="relative z-10 px-4 md:px-0 md:max-w-xl md:mx-auto py-6">
		<h2 class="font-bold text-gray-800 text-center text-5xl">{{ $title ?? 'Title Goes Here' }}</h2>
		<p class="text-indigo-600 text-center font-mono mt-5">{{ $author ?? 'Author Name' }}</p>
	</div>

	<div class="h-48 bg-gradient-to-t from-gray-50 absolute bottom-0 left-0 right-0"></div>
</div>


 <style>
.pattern-grid {
    background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(to right, currentColor 1px, transparent 1px);
    background-size: 40px 40px;
}
 </style>