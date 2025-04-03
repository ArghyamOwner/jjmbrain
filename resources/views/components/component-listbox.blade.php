@props([
	'options' => [],
	'label' => null,
	'name' => null,
	'hint' => null,
	'placeholder' => 'Select an option',
	'loadingText' => 'Searching...',
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
			'description' => 'https://avatars.dicebear.com/api/initials/english.svg'
		],
		[
			'label' => 'Assamese',
			'value' => 'as',
			'description' => 'https://avatars.dicebear.com/api/initials/assamese.svg'
		],
		[
			'label' => 'Bodo',
			'value' => 'bd',
			'description' => 'https://avatars.dicebear.com/api/initials/bodo.svg'
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
							:src="`https://avatars.dicebear.com/api/initials/${option.label}.svg`" 
							:alt="option.label" 
							loading="lazy"
							class="w-8 h-8 rounded-full object-cover"
						>
					</span>
					<span class="flex-1" x-bind:class="{ 'text-indigo-600': value.includes(option.value) }">
						<span class="block" x-text="option.label"></span>
						<span class="block text-xs" x-text="option?.customerNumber"></span>
					</span>
				</span>
			</template>
		</x-slot>
	</x-listbox>
--}}

@php
	$errorClass = $errors->has($name) ? 'border-red-300' : 'border-slate-300';
	$readonlyClass = $readonly ? 'bg-slate-100 cursor-not-allowed' : 'bg-white cursor-default';
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
		x-on:refresh-listbox-options-data.window="refreshOptionData($event.detail)"
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
			class="relative z-0 w-full pl-3 py-2 pr-10 text-left transition duration-150 ease-in-out border border-slate-300 rounded-lg focus:outline-none shadow-sm sm:text-sm {{ $errorClass }} {{ $readonlyClass }}"
			x-bind:class="{
				'border-indigo-500 ring-1 ring-indigo-500': open,
				'bg-slate-200 cursor-default': disabled,
			}">
 
			@isset($attributes['multiple'])
				<span 
					x-show="! open && value.length === 0"
					x-text="value.length ? options.filter((option) => value.includes(option.value)).map((option) => option.label) : placeholder"
					:class="{ 'text-slate-500': ! value.length }" 
					class="block truncate"></span>

				<div class="flex flex-wrap space-x-1 -ml-1.5" x-cloak x-show="value.length > 0">
					<template x-for="(key, index) in value" :key="index">
						<div
							class="text-indigo-800 rounded-full truncate bg-indigo-100 px-2 py-0.5 my-0.5 flex flex-row items-center">
							<div class="pl-1.5 pr-2 truncate" x-text="options.find((option) => option.value == key)?.label || placeholder"></div>
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
			@endisset

			<input 
				x-ref="search" 
				x-show="open"
				x-model="search"

				@if ($remote)
					x-on:input.debounce.600ms="(search.length > 3) && (state = 'searching') && $wire.search(search)" 
				@endif

				x-on:keydown.enter.stop.prevent="selectOption()"
				x-on:keydown.arrow-up.prevent="focusPreviousOption()"
				x-on:keydown.arrow-down.prevent="focusNextOption()"
				class="appearance-none w-full h-5 focus:outline-none focus:border-transparent" />

			<span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
				<svg class="w-5 h-5 text-slate-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
					<path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
						stroke-linejoin="round"></path>
				</svg>
			</span>
		</button>

		<div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
			x-transition:leave-end="opacity-0" x-cloak
			class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-sm border border-slate-200">
			<ul 
				x-ref="listbox" 
				x-on:keydown.enter.stop.prevent="selectOption()"
				x-on:keydown.arrow-up.prevent="focusPreviousOption()"
				x-on:keydown.arrow-down.prevent="focusNextOption()" 
				role="listbox"
				:aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null" 
				tabindex="-1"
				class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">

				<template x-for="(option, optionIndex) in options" :key="optionIndex">
					<li :id="name + 'Option' + focusedOptionIndex" 
						x-on:click="selectOption()"
						x-on:mouseenter="focusedOptionIndex = optionIndex"
						role="option" 
						:aria-selected="focusedOptionIndex === optionIndex" 
						x-bind:class="{ 
							'text-slate-800': optionIndex !== focusedOptionIndex 
						}" 
						class="relative py-px px-2 cursor-default select-none">

						{{-- Multiple --}}
						<template x-if="multiple === true">
							<div>
								@isset($custom)
									{{ $custom }}
								@else 
									<span x-text="option.label" class="block font-normal truncate"></span>
								@endisset
							</div>
						</template>
					</li>
				</template>

				<div class="text-center px-3 py-2 text-slate-600 cursor-default select-none">
					<span x-show="! Object.keys(options).length && ! isRemote" x-text="emptyOptionsMessage"></span>
 
					<span x-show="isRemote">
						<span x-show="! Object.keys(options).length && (state.length == 0)" x-text="'Search...'"></span>
						<span x-show="search.length > 3 && (state === 'searching')" x-text="loadingText"></span>
						<span x-show="(Object.keys(options).length == 0) && (state === 'finished')" x-text="'No match found. Search again.'"></span>
					</span>
				</div>
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
			loadingText: '{{ $loadingText }}',
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
			state: '',
			focusedOptionIndex: 0,
			limit: 100,
			isRemote: Boolean('{{ $remote }}'),

			refreshOptionData(newData) {
				this.$nextTick(() => {
					this.state = 'finished';
					this.data = newData;
					this.init();
				})
			},

			closeListbox() {
				this.open = false;
				this.focusedOptionIndex = 0;
				this.search = '';
				this.state = '';
			},

			focusNextOption() {
				if (this.focusedOptionIndex < this.$refs.listbox.children.length - 2) {
					this.focusedOptionIndex++;
				} else {
					this.focusedOptionIndex = 0;
				}

				if (this.focusedOptionIndex === this.$refs.listbox.children.length - 2) {
					this.focusedOptionIndex = 0;
				}

				this.scrollIntoView();
			},

			focusPreviousOption() {
				if (this.focusedOptionIndex < 1) {
					this.focusedOptionIndex = this.$refs.listbox.children.length - 3;
				} else {
					this.focusedOptionIndex--;
				}

				if (this.focusedOptionIndex > this.$refs.listbox.children.length - 2) {
					this.focusedOptionIndex = this.$refs.listbox.children.length - 2;
				}

				this.scrollIntoView();
			},

			scrollIntoView() {
				this.$refs.listbox.children[this.focusedOptionIndex + 1].scrollIntoView({
					block: 'nearest',
					behavior: 'smooth'
				});
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
 
					this.options = this.data
						.filter((item) => item.label.toLowerCase().includes(value.toLowerCase()))
						.slice(0, this.limit);
				}))
			},

			resetOptions() {
				this.options = this.data.slice(0, this.limit)
			},

			selectOption() {
				if (!this.open) return this.toggleListboxVisibility()

				if (!this.disabled) { 
					const currentSelectedValue = this.options[this.focusedOptionIndex]
					
					this.value.push(currentSelectedValue.value)
					this.search = ''
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
						this.$refs.search.focus();
						this.scrollIntoView();
					})
				}
			}
		}))
	})
</script>
@endpush