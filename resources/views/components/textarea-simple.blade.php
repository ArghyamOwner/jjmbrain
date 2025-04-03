@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'readonly' => false,
	'invert' => false
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	@isset($hint)
		<x-text-hint class="mb-1">{{ $hint }}</x-text-hint>
	@endisset
 
	<textarea 
		id="{{ $id ?? $name }}" 
		name="{{ $name }}"
		autocomplete="off" 
		rows="2"
	 
		{{ $attributes->whereStartsWith('wire:model') }}

		{{ $attributes->class([
				'form-input transition duration-150 ease-in-out px-3 py-2 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 shadow-sm border-b sm:text-sm placeholder-gray-400 disabled:bg-gray-200' => true,
				'bg-gray-100 border-transparent border-b-gray-400 ' => $invert,
				'bg-white border-gray-300' => !$invert,
				'border-red-300' => $errors->has($name) && $withErrorMessage,
				'bg-gray-200' => $readonly
			])->merge() 
		}}
	>{{ old($name, $value ?? '') }}</textarea>
	 
	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>