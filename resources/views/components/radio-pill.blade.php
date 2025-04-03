@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'noMargin' => false,
	'optional' => false,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'defaultValue' => null,
	'options' => [],
	'theme' => 'rounded' // rounded or pill
])

@php
	$themeClasses = [
		'rounded' => 'rounded-lg',
		'pill' => 'rounded-full'
	][$theme];
@endphp
 
<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}" x-data="{
		defaultValue: '{{ $defaultValue }}',
		options: {{ collect($options) }},
		modelValue: @entangle($attributes->wire('model'))
	}" x-cloak>
    
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
	@endif
  
    <div {{ $attributes->class(['grid grid-cols-3 gap-3 sm:grid-cols-6']) }}>
		<template x-for="(option, optionIndex) in options" :key="option.value">
			<div>
				<label 
					:for="option.value" 
					class="border py-2 px-3 flex items-center justify-center text-sm font-medium cursor-pointer focus:outline-none checked:bg-indigo-50 checked:border-transparent checked:text-white checked:hover:bg-indigo-100 {{ $themeClasses }}" 
					:aria-checked="defaultValue === option.value" 
					:class="defaultValue === option.value ? 'bg-indigo-50 border-transparent text-indigo-600 hover:bg-indigo-50 ring-1 ring-inset ring-indigo-400' : 'bg-white border-gray-200 text-gray-900 hover:bg-gray-50'">
					<input
						class="sr-only" 
						:aria-labelledby="option.label || option.name"
						:id="option.value"
						type="radio"
						name="{{ $attributes->wire('model')->value() }}"
						:value="option.value"
						x-modelable="modelValue"
						x-model="defaultValue"
					/>
					<p :id="option.label" x-text="option.label"></p>
				</label>
			</div>
		</template>
    </div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>
