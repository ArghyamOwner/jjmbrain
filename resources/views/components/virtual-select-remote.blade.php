@props([
	'id' => 'virtual-select' . Str::random(10),
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'noMargin' => false,
	'optional' => false,
	'options' => [],
	'customLabel' => false,
	'search-method' => null,
])

@php
	$errorClass = $errors->has($name) ? 'border-red-300' : 'border-gray-300';

	$virtualSelectOptions = array_merge([
		'ele' => '#'.$id,
		'search' => true,
		'options' => [],
		'disableSelectAll' => true,
		'placeholder' => 'Select an option',
		'showSelectedOptionsFirst' => false,
		// 'showValueAsTags' => true,
		// 'hasOptionDescription' => true
	], $options);
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif
	
	<div wire:ignore wire:key="{{ md5(collect($options)) }}">
		<div
			x-data="{
				select: @entangle($attributes->wire('model')),
				initVirtualSelect() {
					@if ($customLabel)
						VirtualSelect.init(Object.assign({{ collect($virtualSelectOptions) }}, {
							labelRenderer: customLabelRenderer,
							onServerSearch:  function (searchValue, virtualSelect) {
								if (searchValue.length > 3) {
									// console.log(searchValue);
									$wire.call('{{ $searchMethod }}', searchValue)
								}
								@this.on('result-found-{{ Str::kebab($searchMethod) }}', (result) => {
									{{-- console.log(result);  --}}
									virtualSelect.setServerOptions(result);
								})
							}
						}))
					@else
						VirtualSelect.init(Object.assign({{ collect($virtualSelectOptions) }}, {
							onServerSearch: function (searchValue, virtualSelect) {
								if (searchValue.length > 3) {
									// console.log(searchValue);
									$wire.call('{{ $searchMethod }}', searchValue)
								}
								@this.on('result-found-{{ Str::kebab($searchMethod) }}', (result) => virtualSelect.setServerOptions(result[0]))
							}
						}))
					@endif
				}
			}"
			id="{{ $id }}"
			x-ref="virtualSelect"
			x-init="$nextTick(() => initVirtualSelect())"
			x-cloak
			x-on:change="select = event.target.value"
		></div>
	</div>

	{{-- x-on:change="window.location.href = event.target.value" --}}
 
	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif

	@isset($hint)
		<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
	@endisset
</div>

@once
	@push('styles')
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.40/dist/virtual-select.min.css">
		<style>
			.vscomp-ele {
				max-width: 100%;
			}
			.vscomp-toggle-button {
				min-height: 38px;
				border: 1px solid rgb(209 213 219);
				box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
			}
			.vscomp-toggle-button,
			.vscomp-dropbox-container {
				border-radius: 0.5rem;
				overflow: hidden;
			}
			.vscomp-search-wrapper .vscomp-search-input:focus {
				box-shadow: 0 0 0 0px #fff !important;
			}
			.vscomp-wrapper {
				font-family: inherit;
			}
			.vscomp-wrapper.focused .vscomp-toggle-button, 
			.vscomp-wrapper:focus .vscomp-toggle-button {
				outline: 2px solid transparent;
				outline-offset: 2px;
				--tw-ring-inset: var(--tw-empty,/*!*/ /*!*/);
				--tw-ring-offset-width: 0px;
				--tw-ring-offset-color: #fff;
				--tw-ring-opacity: 1;
				--tw-ring-color: rgba(99, 102, 241, var(--tw-ring-opacity));
				--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
				--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
				--tw-border-opacity: 1;
				box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
				border-color: rgba(99, 102, 241, var(--tw-border-opacity));
			}
			.vscomp-wrapper .checkbox-icon::after {
				/* border: 2px solid rgb(156 163 175);
				border-radius: 4px; */
			}
			.vscomp-option.focused,
			.vscomp-wrapper.show-value-as-tags .vscomp-value-tag {
				background-color: rgb(0 0 0 / 0.05);
			}
			.vscomp-option.selected {
				background-color: rgb(0 0 0 / 0.03);
			}
			.vscomp-arrow::after {
				content: "";
				-webkit-transform: none;
				transform: none;
				border: none;
				width: 20px;
				height: 20px;
				margin-top: 0px;
				margin-right: 7px;
			}
			.pop-comp-wrapper {
				box-shadow: 0 -1px 1px 0 rgb(0 0 0 / 0.07), 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
			}
			.vscomp-options-container {
				padding-top: 1px;
				padding-bottom: 5px;
			}
			.vscomp-options-container::-webkit-scrollbar {'hasOptionDescription' => true
				height: 18px;
			}
			.vscomp-options-container::-webkit-scrollbar-corner {
				background: 0 0;
			}
			.vscomp-options-container::-webkit-scrollbar-thumb {
				background-color: rgb(0 0 0 / 0.15);
			}
			.vscomp-options-container::-webkit-scrollbar-track {
				background-color: rgb(0 0 0 / 0.07);
			}
			.vscomp-wrapper.multiple .vscomp-option.selected .checkbox-icon::after {
				border-color: #6366f1;
				border-left-color: transparent;
				border-top-color: transparent;
				-webkit-transform: rotate(45deg) translate(1px, -4px);
				transform: rotate(45deg) translate(1px, -4px);
			}
			.vscomp-option-description {
				margin-top: -12px;
			}
		</style>
	@endpush
	@push('scripts-footer')
		<script src="https://cdn.jsdelivr.net/npm/virtual-select-plugin@1.0.40/dist/virtual-select.min.js"></script>
		<script>
			function customLabelRenderer(data) {
				const prefix = `<img src='https://avatars.dicebear.com/api/initials/${data.label}.svg?&width=64&height=64' loading='lazy' class='flex-shrink-0 h-6 w-6 rounded-full mr-2'>`;
				return `<div class="flex items-center">${prefix}<div class="text-gray-700">${data.label}</div></div>`;
			}
		</script>
	@endpush	
@endonce