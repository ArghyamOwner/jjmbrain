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
	'invert' => false,
	'placeholder' => 'Write...',
	'rows' => 1,
	'maxlength' => null
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	@isset($hint)
		<x-text-hint class="mb-1">{{ $hint }}</x-text-hint>
	@endisset

	<div 
		x-data="{ 
			counter: 0,
			limit: parseInt('{{ $maxlength }}'),
			get remaining() {
				this.counter = this.$refs.input.value.length;
				if (this.counter > this.limit) {
					this.counter = this.limit;
				}
			},
			get counterStats() {
				return `${this.counter}/${this.limit}`;
			},


			focused: false,
			resizeTextarea (event) {
				event.target.style.height = 'auto'
				event.target.style.height = (event.target.scrollHeight) + 'px';
				this.remaining;
			},
			init() {
				this.$nextTick(() => {
					this.$refs.input.setAttribute('style', 'height:' + (this.$refs.input.scrollHeight) + 'px;overflow-y:hidden;');
					this.remaining;
				})
			}
		}"
		x-cloak
		:class="{ 'outline-none ring-2 ring-indigo-500 border-b-transparent': focused === true }" 

		{{ $attributes->class([
				'form-textarea transition duration-150 ease-in-out px-3 py-1.5 block w-full text-gray-700 font-sans rounded-md text-left focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 shadow-sm border sm:text-sm placeholder-gray-400 disabled:bg-gray-200' => true,
				'bg-gray-100 border-transparent border-b-gray-400' => $invert,
				'bg-white border-gray-300' => !$invert,
				'border-red-300' => $errors->has($name) && $withErrorMessage,
				'bg-gray-200' => $readonly
		]) }}
	>
		<textarea 
			rows="{{ $rows }}"
			wire:ignore
			x-ref="input"
			x-on:focus="focused = true" 
			x-on:blur="focused = false" 

			x-on:input="resizeTextarea"
			 
			id="{{ $id ?? $name }}" 
			name="{{ $name }}"
			autocomplete="off" 
			placeholder="{{ $placeholder }}"
			maxlength="{{ $maxlength }}"
			class="resize-none border-0 focus:ring-0 p-0 bg-transparent w-full text-sm focus:outline-none overflow-hidden placeholder-gray-400"
		 
			{{ $attributes->whereStartsWith('wire:model') }}
		>{{ old($name, $value ?? '') }}</textarea>
		<div class="text-slate-400 text-sm text-right" x-text="counterStats"></div>
	</div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>