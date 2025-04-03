@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'placeholder' => 'DD-MM-YYYY',
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'appendAfter' => '<svg class="w-6 h-6 stroke-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 8.75C4.75 7.64543 5.64543 6.75 6.75 6.75H17.25C18.3546 6.75 19.25 7.64543 19.25 8.75V17.25C19.25 18.3546 18.3546 19.25 17.25 19.25H6.75C5.64543 19.25 4.75 18.3546 4.75 17.25V8.75Z"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4.75V8.25"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4.75V8.25"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.75 10.75H16.25"></path></svg>',
	'appendBefore' => null,
	'readonly' => false,
	'type' => 'text',
	'width' => 'w-56',
	'options' => [
		"date" => true,
		"delimiter" => '-',
		"datePattern" => ['d', 'm', 'Y']
	]
])

{{--
	INR Symbol = &#8377; or &#x20B9;	
--}}

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