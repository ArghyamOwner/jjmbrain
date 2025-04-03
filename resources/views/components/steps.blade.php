@props([
	'step' => 1,
	'title' => null,
	'description' => null,
	'status' => ''	
])

<div {{ $attributes->class(['flex flex-1 items-center relative px-4 py-4']) }}>
	<div class="flex-shrink-0 mr-4">
		@if ($status === 'done')
			<div class="w-8 h-8 border-2 border-indigo-600 bg-indigo-600 text-white rounded-full flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
			</svg></div>
		@elseif($status === 'active')
			<div class="w-8 h-8 border-2 border-indigo-600 bg-white text-indigo-600 rounded-full flex items-center justify-center">{{ $step }}</div>
		@else
			<div class="w-8 h-8 border-2 border-gray-200 bg-white text-gray-500 rounded-full flex items-center justify-center">{{ $step }}</div>
		@endif
	</div>
	<div class="flex-1">
		<h3 class="text-gray-500 text-xs font-semibold uppercase tracking-wider truncate">{{ $title }}</h3>

		@if ($description)
			<p class="text-sm text-gray-500 mt-1 hidden md:block">{{ $description }}</p>
		@endif
	</div>

	@if($status === 'active')
		<div class="w-1 h-full md:h-0.5 md:w-full bg-indigo-600 absolute left-0 right-0 bottom-0"></div>
	@endif
</div>