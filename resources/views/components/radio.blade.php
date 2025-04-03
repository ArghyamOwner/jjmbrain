@props([
	'theme' => 'indigo',
	'id' => null,
	'name' => null,
	'label' => null,
	'checked' => false,
	'align' => 'center',
	'radioClasses' => ''
])

@php
	$themeColors = [
		'indigo' => 'text-indigo-600 focus:ring-indigo-500',
		'green' => 'text-green-600 focus:ring-green-500',
		'blue' => 'text-blue-600 focus:ring-blue-500',
	][$theme];

	$alignClass = [
		'center' => 'items-center',
		'top' => 'items-start'
	][$align];
@endphp

<div class="flex {{ $alignClass }} {{ $radioClasses }}">
	<input 
		id="{{ $id }}"
		type="radio" 
		name="{{ $name }}"
		
		{{
			$attributes->merge([
				'class' => 'form-radio focus:outline-none border-gray-300 h-4 w-4 ' . $themeColors,

			])
		}}

		@if ($checked)
			checked
		@endif
	>
	<label for="{{ $id }}" class="ml-2.5 block cursor-pointer w-full">
		@if($label)
			<div class="text-sm font-medium text-gray-700">{{ $label }}</div>
		@else
			{{ $slot }}
		@endif
	</label>
</div>