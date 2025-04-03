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
	'options' => [],
	'selectedItems' => []
])

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
	@endif

	<div wire:ignore wire:key="{{ md5(collect($options)) }}">
		<select
		  x-data="{
			tomSelectInstance: null,
			options: {{ collect($options) }},
			items: {{ collect($selectedItems) }},
	
			renderTemplate(data, escape) {
				return `<div class='flex items-center'>
					<span class='mr-3 w-8 h-8 rounded-full bg-gray-100'><img src='https://avatars.dicebear.com/api/initials/${escape(data.title)}.svg' class='w-8 h-8 rounded-full'/></span>
					<div><span class='block font-medium text-gray-700'>${escape(data.title)}</span>
					<span class='block text-gray-500'>${escape(data.subtitle)}</span></div>
				</div>`;
			},
			itemTemplate(data, escape) {
				return `<div>
					<span class='block font-medium text-gray-700'>${escape(data.title)}</span>
				</div>`;
			}
		}" x-init="tomSelectInstance = new TomSelect($refs.input, {
			@if ($attributes->has('multiple'))
			plugins: {
				remove_button:{
					title:'Remove this item',
				}
			},
			@endif

			valueField: 'id',
			labelField: 'title',
			searchField: 'title',
			options: options,
			items: items,
			@if (! empty($items) && ! $attributes->has('multiple'))
				placeholder: undefined,
			@endif
			render: {
				option: renderTemplate,
				item: itemTemplate
			}
		});" x-ref="input" x-cloak {{ $attributes }}></select>
	</div>
	
	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif

	@isset($hint)
		<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
	@endisset
</div>

@once
	@push('styles')
	<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
	<style>
		.ts-control {
			padding: 10px;
			border-radius: 0.5rem;
			--tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
			--tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
			box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
		}
		.ts-wrapper.focus .ts-control {
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
		.ts-control.dropdown-active,
		.ts-dropdown {
			border-radius: 0.5rem;
			overflow: hidden;
			box-shadow: 0 -1px 1px 0 rgb(0 0 0 / 0.07), 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
		}
		.ts-wrapper.single .ts-control:after {
			content:  url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 9l4-4 4 4m0 6l-4 4-4-4' /%3E%3C/svg%3E");
			display: block;
			position: absolute;
			top: 9px;
			right: 8px;
			width: 20px;
			height: 20px;
			border: none;
		}

		.ts-wrapper.multi .ts-control > div {
			border-radius: 4px;
		}

		.ts-wrapper.plugin-remove_button .item{
			display:		inline-flex;
			align-items:	center;
			padding-right:	0 !important;
		}

		.ts-wrapper.plugin-remove_button .item .remove {
			color:				inherit;
			text-decoration:	none;
			vertical-align:		middle;
			display:			inline-block;
			padding:			0 2px;
			border-left:		1px solid #ddd;
			border-radius:		0 2px 2px 0;
			box-sizing:			border-box;
			margin-left:		2px;
		}

		.ts-wrapper.plugin-remove_button .item .remove:hover {
			background: rgba(0,0,0,0.05);
		}

		.ts-wrapper.plugin-remove_button .item.active .remove {
			border-left-color: #ddd;
		}

		.ts-wrapper.plugin-remove_button.disabled .item .remove:hover {
			background: none;
		}
		.ts-wrapper.plugin-remove_button .remove-single {
			position: absolute;
			right: 0;
			top: 0;
			font-size: 23px;
		}
	</style>
	@endpush

	@push('scripts-footer')
		<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/plugins/clear_button.min.js"></script>
	@endpush
@endonce

