@props([
	'id' => str()->random(6),
	'label' => null,
	'name' => null,
	'hint' => null,
	'type' => 'text',
	'appendBefore' => null,
	'appendAfter' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'readonly' => false,
	'disabled' => false,
	'extraAttributes' => [],
	'invert' => false
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $id ?? $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	@isset($hint)
		<x-text-hint class="mb-1">{{ $hint }}</x-text-hint>
	@endisset
 
    <div class="relative">
		@isset($appendBefore)
			<span class="select-none text-gray-400 absolute top-0 left-0 text-sm leading-5 font-medium pl-3 inline-flex h-full items-center">{{ $appendBefore }}</span>
		@endisset

        <input
			id="{{ $id ?? $name }}" 
			type="{{ $type }}"
			name="{{ $name }}"

			{{ $readonly ? 'readonly=readonly' : '' }}
			{{ $disabled ? 'disabled=disabled' : '' }}
 
			{{ $attributes->class([
				'form-input transition duration-150 ease-in-out px-3 py-2 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 border-b text-sm placeholder-gray-400 disabled:bg-gray-200' => true,
				'bg-gray-100 border-transparent border-b-gray-400' => $invert,
				'bg-white border-gray-300 shadow-sm' => !$invert,
				'border-red-300' => $errors->has($name) && $withErrorMessage,
				'bg-slate-200' => $readonly
			])->merge() }}
		/>	

		@isset($appendAfter)
			<span class="select-none text-gray-400 absolute top-0 right-0 text-sm leading-5 font-medium pr-3 inline-flex h-full items-center">{{ $appendAfter }}</span>
		@endisset
    </div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>
