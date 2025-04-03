@props([
	'noPadding' => false,
	'overflowHidden' => false,
	'formAction' => false,
	'shadow' => 'default',
	'cardClasses' => ''
])

@php
	$shadowClass = [
		'none' => 'shadow-none',
		'small' => 'shadow-sm',
		'default' => 'shadow-sm ring-1 ring-slate-200',
		'medium' => 'shadow-md',
		'large' => 'shadow-lg',
	][$shadow];

	$cardPadding = $noPadding ? 'p-0' : 'p-5';
	$overflowHiddenClass = $overflowHidden ? 'relative overflow-hidden' : '';
@endphp

<div class="bg-white rounded-lg {{ $overflowHiddenClass }} {{ $shadowClass }} {{ $cardClasses }}">
	@if($formAction)
		<form wire:submit.prevent="{{ $formAction }}">
	@endif

	<div class="flex flex-col h-full">
		@isset($header)
			<div>
				<div {{ $header->attributes->class(['px-5 py-2.5 flex-1 flex flex-col md:flex-row md:justify-between md:items-start']) }}>
					<div class="pr-4 flex-1">
						{{ $header }}

						@isset($subheading)
							<div {{ $subheading->attributes->class(['block text-sm text-gray-500']) }}>
								{{ $subheading }}
							</div>
						@endisset
					</div>

					@isset($action)
						<div {{ $action->attributes->class(['flex mt-2 md:mt-0']) }}>{{ $action }}</div>
					@endisset
				</div>
			</div>
		@endisset

		<div {{ 
			$attributes->merge([
				'class' => isset($title) ? 'pt-0 ' . $cardPadding : $cardPadding
			]) 
		}}>
			{{ $slot }}
		</div>

		@isset($footer)
			<div {{ $footer->attributes->class(['mt-auto px-5 py-4 bg-gray-50 rounded-b-lg border-t border-gray-100']) }}>
				{{ $footer }}
			</div>
		@endisset
	</div>
	
	@if($formAction)
		</form>
	@endif
</div>
