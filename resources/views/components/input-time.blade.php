@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'placeholder' => 'HH:MM',
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'appendAfter' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" width="24" height="24" viewBox="0 0 24 24"><title>clock</title><g fill="none"><path d="M12 6v6l4 2m6-2c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>',
	'appendBefore' => null,
	'readonly' => false,
	'type' => 'text',
	'width' => 'w-56',
	'options' => [
		"time" => true,
    	"timePattern" => ['h', 'm']
	]
])

@php
	$errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';
	$readonlyClass = $readonly ? 'bg-gray-100' : 'bg-white';
	$appendBeforeClasses = $appendBefore ? 'pl-8' : '';
	$appendAfterClasses = $appendAfter ? 'pr-8' : '';
@endphp

<div class="{{ $noMargin ? 'mb-0' :  'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

    <div class="relative {{ $width }}">

		@isset($appendBefore)
			<span class="select-none text-gray-400 absolute top-0 left-0 text-sm leading-5 font-medium pl-2 inline-flex h-full items-center">{!! $appendBefore !!}</span>
		@endisset

        <input
			x-data="{
				options: {{ json_encode($options) }}
			}"
			x-init="new Cleave($el, options)" 
			x-cloak

			id="{{ $id ?? $name }}" 
			type="{{ $type }}"
			name="{{ $name }}"
			placeholder="{{ $placeholder }}"

			{{ $attributes->merge([
				'class' => 'form-input transition duration-150 ease-in-out px-3 py-2 block w-full text-gray-700 font-sans rounded-lg text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 shadow-sm border sm:text-sm placeholder-gray-400 ' . $errorClass . ' ' . $readonlyClass . ' ' . $appendBeforeClasses . ' ' . $appendAfterClasses 
			]) }}

			@if ($attributes->has('wire:model'))
				{{ $attributes->whereStartsWith('wire:model') }}
			@endif
		/>	

		@isset($appendAfter)
			<span class="select-none text-gray-400 absolute top-0 right-0 text-sm leading-5 font-medium pr-2 inline-flex h-full items-center">{!! $appendAfter !!}</span>
		@endisset

	</div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif

	@isset($hint)
		<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
	@endisset

</div>

@once
	@push('scripts')
		<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
	@endpush
@endonce