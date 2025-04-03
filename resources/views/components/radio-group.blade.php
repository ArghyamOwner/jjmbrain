@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'noMargin' => false,
	'optional' => false,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'defaultValue' => '',
	'options' => [
		[
			'label' => 'Administrator',
			'value' => 'administrator',
			'summary' => 'An administrator has all the access in the app.'
		],
		[
			'label' => 'Moderator',
			'value' => 'moderator',
			'summary' => 'An administrator has all the access in the app.'
		],
		[
			'label' => 'Editor',
			'value' => 'editor',
			'summary' => 'An administrator has all the access in the app.'
		]
	],
	'align' => 'top'
])

@php
	$alignClass = [
		'center' => 'items-center',
		'top' => 'items-start'
	][$align]
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}" x-data="{
		defaultValue: '{{ $defaultValue }}',
		options: @js($options),
		modelValue: @entangle($attributes->wire('model'))
	}" x-cloak wire:key="{{ md5(collect($options)) }}">
    
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
	@endif
	
    <div class="rounded-lg border shadow-sm border-gray-300 divide-y rounded-lg">
		 <template x-for="(option, optionIndex) in options" :key="optionIndex">
			<div :class="{
				'ring-1 bg-indigo-50 ring-indigo-300 relative': defaultValue == option.value,
				'rounded-t-lg': optionIndex == 0,
				'rounded-b-lg': optionIndex + 1 == options.length,
			}" class="py-3 px-4 flex {{ $alignClass }}" :aria-checked="defaultValue === option.value">
				<input
					:id="option.value"
					type="radio"
					name="{{ $attributes->wire('model')->value() }}"
					:value="option.value"
					x-modelable="modelValue"
					x-model="defaultValue"
					class="form-radio focus:outline-none border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500 {{ $align === 'top' ? 'mt-1' : 'mt-0' }}"
				>
				<label :for="option.value" class="ml-4 block cursor-pointer select-none w-full">
					<div class="text-sm text-gray-800 font-medium" x-text="option.label"></div>
					<div class="text-sm text-gray-500" x-show="option.summary?.length || option.description?.length" x-html="option.summary || option.description || ''"></div>
				</label>
			</div>
		 </template>
    </div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>