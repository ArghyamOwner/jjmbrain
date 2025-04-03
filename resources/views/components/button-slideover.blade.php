@props([
	'type' => 'link',
	'buttonColor' => 'white',
	'linkColor' => 'indigo',
	'emitTo' => '',
	'eventName' => '',
	'parameterOne' => '',		 
])

@if ($type === 'link')
	<x-text-link 
		href="#"
		:color="$linkColor"
		x-on:click.prevent="livewire.emitTo(
			'{{ $emitTo }}',
			'{{ $eventName }}',
			'{{ $parameterOne }}'
		)"
	>{{ $slot }}</x-text-link>
@else
	<x-button 
		type="button"
		:color="$buttonColor"
		x-on:click.prevent="livewire.emitTo(
			'{{ $emitTo }}',
			'{{ $eventName }}',
			'{{ $parameterOne }}'
		)"
	>{{ $slot }}</x-button>
@endif