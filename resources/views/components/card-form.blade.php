@props([
	'formAction' => false,
	'noPadding' => false,
	'withShadow' => true,
])
 
<div {{ $attributes->class([
	"bg-white rounded-lg",
	"shadow" => $withShadow
])->merge() }}>
	@if($formAction)
		<form wire:submit.prevent="{{ $formAction }}">
	@endif
			
	<div @class([
		"flex flex-wrap -mx-4",
		"p-5" => ! $noPadding
	])>
		<div class="w-full md:w-2/5 px-4"> 
			<h2 class="font-bold text-lg text-gray-800 {{ ! isset($description) ? 'mb-2' : 'mb-1' }}">
				{{ $title }}
			</h2>

			@isset($description)
				<div class="mb-4 text-sm text-gray-500">
					{{ $description }}
				</div>
			@endisset
		</div>
		<div class="w-full md:w-3/5 px-4">
			{{ $slot }}
		</div>	 
	</div>

	@isset($footer)
		<div class="px-5 py-4 bg-gray-50 rounded-b-lg text-right flex justify-end items-center border-t border-gray-100">
			{{ $footer }}
		</div>
	@endisset

	@if($formAction)
		</form>
	@endif
</div>
 