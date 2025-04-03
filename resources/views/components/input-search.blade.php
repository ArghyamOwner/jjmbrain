@props([
	'label' => null,
	'name' => null,
	'noMargin' => false,
	'invert' => false,
	'readonly' => false
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $name }}">{{ $label }}</x-label>
    @endif
	
	<div class="relative">
		<svg class="absolute select-none mt-1.5 ml-2 w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="116" cy="116" r="84" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></circle><line x1="175.39356" y1="175.40039" x2="223.99414" y2="224.00098" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>

		<input type="search" 
			{{ $attributes->class([
				'pl-10 form-input transition duration-150 ease-in-out pr-3 py-2 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 shadow-sm border border-gray-300 text-sm placeholder-gray-400 disabled:bg-gray-200' => true,
				'bg-gray-100 border-transparent border-b-gray-400 ' => $invert,
				'bg-white border-gray-300' => !$invert,
				'border-red-300' => $errors->has($name),
				'bg-gray-200' => $readonly
			])->merge() }}
		/>
	</div>
</div>
