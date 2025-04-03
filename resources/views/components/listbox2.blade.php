@props([
	'options' => [],
	'label' => null,
	'name' => null,
	'hint' => null,
	'placeholder' => 'Select an option',
	'limit' => 100,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'readonly' => false,
	'remote' => false,
])

{{--
	$options = [
		[
			'label' => 'English',
			'value' => 'en',
			'avatar' => 'https://avatars.dicebear.com/api/initials/english.svg'
		],
		[
			'label' => 'Assamese',
			'value' => 'as',
			'avatar' => 'https://avatars.dicebear.com/api/initials/assamese.svg'
		],
		[
			'label' => 'Bodo',
			'value' => 'bd',
			'avatar' => 'https://avatars.dicebear.com/api/initials/bodo.svg'
		]
	];

	Example:
	<x-listbox
		label="Select customer"
		name="customer"
		wire:model="customer"
		remote
	>
		<x-slot name="custom">
			<template x-if="Object.keys(options).length > 0">
				<span class="flex space-x-3">
					<span class="shrink-0">
						<img 
							:src="`https://avatars.dicebear.com/api/initials/${options[key]?.label}.svg`" 
							:alt="options[key]?.label" 
							loading="lazy"
							class="w-8 h-8 rounded-full object-cover"
						>
					</span>
					<span class="flex-1" x-bind:class="{ 'text-indigo-600': value.includes(key) }">
						<span class="block" x-text="options[key]?.label"></span>
						<span class="block text-xs" x-text="options[key]?.customerNumber"></span>
					</span>
				</span>
			</template>
		</x-slot>
	</x-listbox>
--}}

@php
	$errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';
	$readonlyClass = $readonly ? 'bg-gray-100 cursor-not-allowed' : 'bg-white cursor-default';
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
	@if ($label)
		<x-label 
			class="mb-1" 
			for="{{ $name }}" 
			:optional="$optional">
			{{ $label }}
		</x-label>
    @endif


	@isset($hint)
		<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
	@endisset

	<div
		x-on:refresh-listbox-options-data.window="$nextTick(() => {
			refreshOptionData($event.detail); 
			init();
		})"
		x-data="select" 
		x-init="init()" 
		x-on:click.outside="closeListbox()" 
		x-on:keydown.escape="closeListbox()" 
		class="relative" 
		x-cloak
	>
		<button 
			x-ref="button" 
			x-on:click.prevent="toggleListboxVisibility()" 
			:aria-expanded="open"
			aria-haspopup="listbox"
			type="button" 
			class="relative z-0 w-full pl-3 py-2 pr-10 text-left transition duration-150 ease-in-out border border-gray-300 rounded-lg focus:outline-none shadow-sm sm:text-sm {{ $errorClass }} {{ $readonlyClass }}"
			x-bind:class="{
				'border-indigo-500 ring-1 ring-indigo-500': open,
				'bg-gray-200 cursor-default': disabled,
			}">
 
			@isset($attributes['multiple'])
				<span 
					x-show="! open && value.length === 0" 
					x-text="value in options ? options[value].label : placeholder"
					:class="{ 'text-gray-500': ! (value in options) }" 
					class="block truncate"></span>

				<div class="flex flex-wrap space-x-1 -ml-1.5" x-cloak x-show="value.length > 0">
					<template x-for="(key, index) in value" :key="index">
						<div
							class="text-indigo-800 rounded-full truncate bg-indigo-100 px-2 py-0.5 my-0.5 flex flex-row items-center">
							<div class="pl-1.5 pr-2 truncate" x-text="options[key].label"></div>
							<div 
								x-show="!disabled" 
								x-bind:class="{'cursor-pointer': !disabled}" 
								x-on:click.prevent.stop="deselectOption(index)"
								class="w-4"
							>
								<svg xmlns="http://www.w3.org/2000/svg"
									class="h-5 w-5 fill-current text-indigo-400 hover:text-indigo-600" viewBox="0 0 20 20"
									fill="currentColor">
									<path fill-rule="evenodd"
										d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</div>
					</template>
				</div>
			@else
				<span 
					x-show="! open" 
					x-text="value in options ? options[value].label : placeholder"
					:class="{ 'text-gray-500': ! (value in options) }" 
					class="block truncate"></span>
			@endisset

			<input 
				x-ref="search" 
				x-show="open"
				x-model="search"

				@if ($remote)
					x-on:input.debounce.600ms="search.length > 3 && $wire.search(search)" 
				@endif

				x-on:keydown.enter.stop.prevent="selectOption()"
				x-on:keydown.arrow-up.prevent="focusPreviousOption()"
				x-on:keydown.arrow-down.prevent="focusNextOption()"
				class="appearance-none w-full h-5 focus:outline-none focus:border-transparent" />

			<span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
				<svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
					<path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round"></path>
				</svg>
			</span>
		</button>

		<div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0" x-cloak
			class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-sm border border-gray-200">
			<ul x-ref="listbox" x-on:keydown.enter.stop.prevent="selectOption()"
				x-on:keydown.arrow-up.prevent="focusPreviousOption()"
				x-on:keydown.arrow-down.prevent="focusNextOption()" role="listbox"
				:aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" tabindex="-1"
				class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">

				<template x-for="(key, index) in Object.keys(options)" :key="index">
					<li :id="name + 'Option' + focusedOptionIndex" 
						x-on:click="selectOption()"
						x-on:mouseenter="focusedOptionIndex = index" 
						x-on:mouseleave="focusedOptionIndex = null"
						role="option" 
						:aria-selected="focusedOptionIndex === index" 
						x-bind:class="{ 
							'text-indigo-700 bg-indigo-100': index === focusedOptionIndex, 
							'text-gray-900': index !== focusedOptionIndex 
						}" 
						class="relative py-2 pl-3 cursor-default select-none pr-9">

						{{-- Single --}}
						<template x-if="multiple === false">
							<span>
								@isset($custom)
									{{ $custom }}
								@else 
									<span x-text="options[key]?.label" class="block font-normal truncate"
									x-bind:class="{ 'text-indigo-600': index === focusedOptionIndex || key == value }"></span>
								@endisset

								<span x-bind:class="{ 
									'block': value == key, 
									'hidden': value != key,
									'text-indigo-500': index === focusedOptionIndex, 
									'text-indigo-500': index !== focusedOptionIndex 
								}" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-500">
									<svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd"
											d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
											clip-rule="evenodd" />
									</svg>
								</span>
							</span>
						</template>

						{{-- Multiple --}}
						<template x-if="multiple === true">
							<span>
								@isset($custom)
									{{ $custom }}
								@else 
									<span x-text="options[key]?.label" class="block font-normal truncate"
									x-bind:class="{ 'text-indigo-600': value.includes(key) }"></span>
								@endisset

								<span x-bind:class="{
									'block': value.includes(key), 
									'hidden': !(value.includes(key)),
									'text-indigo-500': index === focusedOptionIndex, 
									'text-indigo-500': index !== focusedOptionIndex 
								}" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-500">
									<svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
										<path fill-rule="evenodd"
											d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
											clip-rule="evenodd" />
									</svg>
								</span>
							</span>
						</template>

					</li>
				</template>

				<div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
					class="px-3 py-2 text-gray-600 cursor-default select-none"></div>
			</ul>
		</div>
	</div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif
</div>	

@push('scripts')
<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('select', () => ({
			data: @json($options),
			emptyOptionsMessage: 'No match found.', 
			name: '{{ $name }}', 
			placeholder: '{{ $placeholder ?? 'Select an item' }}',
			
			@if ($attributes->has('wire:model'))  
				value: @entangle($attributes->wire('model')),
			@else
				value: '',
			@endif

			multiple: {{ isset($attributes['multiple']) ? 'true':'false' }},
			disabled: {{ isset($attributes['disabled']) ? 'true':'false' }},
		 
			open: false,
			options: {},
			search: '',
			focusedOptionIndex: null,
			limit: 100,

			refreshOptionData(newData) {
				this.data = newData;
				// console.log(this.data)
			},

			closeListbox() {
				this.open = false

				this.focusedOptionIndex = null

				this.search = ''
			},

			focusNextOption() {
				if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1

				if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

				this.focusedOptionIndex++

				this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
					block: "center",
				})
			},

			focusPreviousOption() {
				if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

				if (this.focusedOptionIndex <= 0) return

				this.focusedOptionIndex--

				this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
					block: "center",
				})
			},

			init() {
				this.options = this.data
 
				if (this.value == null) {
					if (this.multiple) {
						this.value = []
					} else {
						this.value = ''		
					}
				}

				this.resetOptions()

				this.$watch('search', ((value) => {
					if (!this.open || !value) {
						this.resetOptions()
						return
					}
 
					this.options = Object.keys(this.data)
						.filter((key) => this.data[key].label.toLowerCase().includes(value.toLowerCase()))
						.slice(0, this.limit)
						.reduce((options, key) => {
							options[this.data[key].value] = this.data[key]
							return options
						}, {})
				}))
			},

			resetOptions() {
				this.options = Object.keys(this.data)
					.slice(0, this.limit)
					.reduce((options, key) => {
						options[this.data[key].value] = this.data[key]
						return options
					}, {})
			},

			selectOption() {
				if (!this.open) return this.toggleListboxVisibility()

				if (!this.disabled) { 
					const currentSelectedValue = Object.keys(this.options)[this.focusedOptionIndex]

					if (this.multiple) {
						// If it's not already in there
						if (!this.value.includes(currentSelectedValue)) {
							// If value exists in the options array
							if (Object.keys(this.options).includes(currentSelectedValue)) {
								this.value.push(currentSelectedValue.toString())
								this.search = ''
							} else {
								return;
							}
						} else {
							// Find the current value in selected array 
							// Get the index of it and delete
							let currentSelectedValueIndex = this.value.indexOf(currentSelectedValue);
							this.value.splice(currentSelectedValueIndex, 1)
						}
					} else {
						// If value exists in the options array
						if (Object.keys(this.options).includes(currentSelectedValue) === true) {
							this.value = currentSelectedValue

							this.closeListbox()
						} else {
							return;
						}
					}
				}
			},

			deselectOption(index) {
				if(this.multiple) {
					this.value.splice(index, 1)
				}
				else {
					this.value = ''
				}
			},

			toggleListboxVisibility() {
				if(!this.disabled) {
					if (this.open) return this.closeListbox()

					this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

					if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

					this.open = true

					this.$nextTick(() => {
						this.$refs.search.focus()

						this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
							block: "nearest"
						})
					})
				}
			}
		}))
	})
</script>
@endpush