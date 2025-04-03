@props([
	'title' => null,
	'subtitle' => null,
	'last' => true
])

<div>
	<div {{ $attributes->merge(["class" => "flex items-start"]) }}>
		<div class="flex-shrink-0 mr-4 rounded-full bg-white flex items-center p-1 relative z-10">
			@isset($customIcon)
				{{ $customIcon }}
			@else
				<div class="h-10 w-10 bg-indigo-50 rounded-full flex items-center justify-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
						</svg>
				</div>
			@endisset
		</div>

		<div class="flex-1 relative">
			@if ($title)
				<div class="text-medium text-gray-800">{{ $title }}</div>
			@endif

			@if ($subtitle)
				<div class="text-sm text-gray-500">{{ $subtitle }}</div>
			@endif

			<div class="mt-2 {{ $last === false ? 'mb-6' : 'mb-0' }}">
				{{ $slot }}
			</div>

			@if ($last === false)
				<div class="-ml-10 absolute left-0 top-0 w-0.5 h-full bg-slate-100 rounded-full"></div>
			@endif
		</div>
	</div>
</div>
