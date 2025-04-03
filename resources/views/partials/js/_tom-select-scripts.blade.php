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
	</style>
	@endpush

	@push('scripts-footer')
		<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
	@endpush
@endonce