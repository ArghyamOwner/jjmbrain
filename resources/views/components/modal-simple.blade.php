

@props(['formAction' => false, 'maxWidth', 'name'])

@php
switch ($maxWidth ?? '2xl') {
    case 'sm':
        $maxWidth = 'sm:max-w-sm';
        break;
    case 'md':
        $maxWidth = 'sm:max-w-md';
        break;
    case 'lg':
        $maxWidth = 'sm:max-w-lg';
        break;
    case 'xl':
        $maxWidth = 'sm:max-w-xl';
        break;
    case '3xl':
        $maxWidth = 'sm:max-w-3xl';
        break;
    case '5xl':
        $maxWidth = 'sm:max-w-5xl';
        break;
    case '2xl':
    default:
        $maxWidth = 'sm:max-w-2xl';
        break;
}
@endphp

<div
	id="{{ $name }}"
	x-data="{ show: false, name: '{{ $name }}' }" 
	x-on:hide-modal.window="show = false" 
	x-on:show-modal.window="show = ($event.detail === name)"  
	x-on:keydown.escape.window="show = false" 
	x-cloak
	class="inline">

	@isset($trigger)
		<div class="cursor-pointer inline" role="button" x-on:click.prevent="show = true">
			{{ $trigger }}
		</div>
	@endisset

	<div x-show="show" style="display: none" class="fixed inset-0 overflow-y-auto px-4 py-6 z-50 sm:px-0">
		
		<div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">
			<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
		</div>

    	<div x-show="show" class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
 
			@if($formAction)
				<form wire:submit.prevent="{{ $formAction }}">
			@endif

            @isset($title)
	            <div class="text-lg font-bold text-gray-800 px-6 py-3 shadow-sm border-b">
	            	{{ $title }}
	            </div>
            @endisset

			<div class="px-6 py-6">
				{{ $slot }}
			</div>

			@isset($footer)
	            <div class="px-6 py-4 bg-gray-100 flex justify-end space-x-3 rounded-b-lg">
	            	<x-button type="button" color="white" x-on:click="show = false; livewire.emit('resetErrors')">Cancel</x-button>
	            	{{ $footer }}
	            </div>
            @endisset

			@if($formAction)
				</form>
			@endif
			
			<div
				class="m-3 absolute right-0 top-0 w-6 h-6 rounded-full bg-white text-gray-400 hover:text-gray-600 inline-flex items-center justify-center cursor-pointer"
				x-on:click="show = false; livewire.emit('resetErrors')"
			>
				<svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path
						d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z"
					/>
				</svg>
			</div>

		</div>
	</div>
</div>