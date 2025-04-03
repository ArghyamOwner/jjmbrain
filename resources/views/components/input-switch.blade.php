@props([
	'name' => null,
	'value' => false,
    'onValue' => true,
    'offValue' => false,
	'state' => null
]) 
 
 <div
	wire:ignore.self
	x-data="{
		onValue: {{ json_encode($onValue) }},
        offValue: {{ json_encode($offValue) }},

		@if ($attributes->has('wire:model') || $attributes->has('wire:model.defer'))  
			value: @entangle($attributes->wire('model')),
		@else
			value: {{ json_encode($value) }},
		@endif

		get isToggled() {
            return this.value === this.onValue;
        },

		toggle() {
			this.value = this.isToggled ? this.offValue : this.onValue;
		}
	}"
	x-cloak
	class="flex items-center"
 >
	<span
		{{ $attributes }}
		x-on:click="toggle()"
		x-on:keydown.space.prevent="toggle()" 
		:aria-checked="value"
		:class="{'bg-indigo-600': isToggled, 'bg-gray-200': !isToggled }"
		class="relative inline-block flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline"
		role="checkbox"
		tabindex="0"
	>
		<span
			aria-hidden="true"
			:class="{'translate-x-5': isToggled, 'translate-x-0': !isToggled }"
			class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"
		></span>
	</span>

	@isset($state)
		<span class="ml-4 text-gray-700">{{ $state }}</span>
	@endisset

	@if ($name)
        <input type="hidden" name="{{ $name }}" x-bind:value="JSON.stringify(value)" />
    @endif
</div>