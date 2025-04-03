@props([
	'id' => md5(Str::random(6)),
	'label' => null,
	'hint' => null,
	'name' => null,
	'errorMessageFor' => null,
	'optional' => false,
	'withErrorMessage' => true,
	'noMargin' => false,
	'readonly' => false,
	'invert' => false
])

@php
	$errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';
@endphp

<div class="{{ $noMargin ? 'mb-0' :  'mb-5' }}">
	@if(isset($label))
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	@isset($hint)
		<x-text-hint class="mb-1">{{ $hint }}</x-text-hint>
	@endisset

	<select
		id="{{ $id ?? $name }}"
		name="{{ $name }}"
	 
		{{ $attributes->class([
			'form-input transition duration-150 ease-in-out px-3 py-2 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 shadow-sm border-b text-sm placeholder-gray-400 disabled:bg-gray-200' => true,
			'bg-gray-100 border-transparent border-b-gray-400 ' => $invert,
			'bg-white border-gray-300' => !$invert,
			'border-red-300' => $errors->has($name) && $withErrorMessage,
			'bg-gray-200' => $readonly
		])->merge() }}
	>
		{{ $slot }}
	</select>

	@if ($withErrorMessage)
		<x-input-error class="mt-2" for="{{ $errorMessageFor ?? $name }}" />
	@endif
</div>
