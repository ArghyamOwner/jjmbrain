 <div
	{{
		$attributes->merge([
			'class' => 'shadow bg-white rounded-lg overflow-hidden relative flex items-center max-w-full'
		])
	}}
 >
	
	<div class="absolute top-0 left-0 w-64 -skew-y-12 -mt-10">
		<div class="w-full h-16 bg-gray-200"></div>
		<div class="w-1/2 h-16 bg-gray-100"></div>
	</div>

	<div class="absolute top-0 -right-1 w-1/3 md:w-1/4 -skew-y-12 -mt-8">
		<div class="h-16 bg-indigo-300"></div>
		<div class="flex">
			<div class="w-2/3 h-16 bg-gray-100"></div>
			<div class="w-1/3 h-16 bg-indigo-500"></div>
		</div>
		<div class="h-16 w-1/2 bg-gray-200 ml-auto"></div>
	</div>
           
	<div class="relative z-10 px-4 md:px-0 md:max-w-xl md:mx-auto py-6 flex-1">
		<h2 class="font-semibold text-gray-800 text-center text-5xl">{{ $title ?? 'Title Goes Here' }}</h2>
		<div class="my-4"></div>
		<p class="text-gray-600 text-center font-mono">{{ $author ?? 'Author Name' }}</p>
	</div>

	<div class="absolute bottom-0 left-0 w-1/3 md:w-1/4 -skew-y-12 -mb-8">
		<div class="h-16 w-2/3 bg-gray-200"></div>
		<div class="flex">
			<div class="w-1/2 h-16 bg-indigo-200"></div>
			<div class="w-1/2 h-16 bg-indigo-500"></div>
		</div>
		<div class="flex">
			<div class="w-1/3 h-16 bg-white"></div>
			<div class="w-2/3 h-16 bg-gray-100"></div>
		</div>
	</div>

	<div class="absolute bottom-0 -right-1 w-1/3 md:w-1/4 -skew-y-12 -mb-2">
		<div class="h-16 w-1/2 bg-gray-100 ml-auto"></div>
		<div class="h-16 w-3/4 bg-indigo-400 ml-auto"></div>
	</div>

</div>