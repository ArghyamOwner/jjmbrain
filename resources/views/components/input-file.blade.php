@props([
	'id' => 'file'. Str::random(10),
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'accept' => 'images',
	'mode' => 'normal',
	'maxSize' => 2097152 // 2 MB in bytes
])

@php
	$acceptFile = [
		'images' => 'image/jpg,image/jpeg,image/png',
		'pdf' => 'application/pdf',
		'document' => '.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'excel' => 'application/excel,application/vnd.ms-excel,application/x-excel,application/x-msexcel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'csv' => 'text/csv',
	][$accept];
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	@isset($hint)
		<x-text-hint class="mb-1">{{ $hint }}</x-text-hint>
	@endisset

	<div
		x-data="{
			isUploading: false, 
			progress: 0,
			circumference: 20 * 2 * Math.PI,

			hasError: false,
			errorText: '',
			errorTimeout: null,
			file: {},
			maxSize: '{{ $maxSize }}',
			handleFiles(event) { 
				if (event.target.files[0].size > parseInt(this.maxSize)) { 
					event.stopImmediatePropagation();
					this.errorText = `File uploads cannot be larger than ${this.humanFileSize(parseInt(this.maxSize))}.`;
					clearTimeout(this.errorTimeout); 
					this.hasError = true;
					this.errorTimeout = setTimeout(() => { this.hasError = false; this.errorText = '' }, 4500);
					return;
				}
				
				// Preview Image
				this.readAndPreview(event.target.files[0]);
				
				this.file.name = event.target.files[0].name;
				this.file.size = this.humanFileSize(event.target.files[0].size)
				this.file.type = this.getFileExtension(event.target.files[0].name)

				// Upload to server
				@this.upload(
					'{{ $attributes->wire('model')->value }}',  
					event.target.files[0], 
					() => {}, 
					() => {},
					(event) => {
						this.progress = event.detail.progress;
					}
				)			 
			},
			humanFileSize(size) {
				const i = size == 0 ? 0 : Math.floor( Math.log(size) / Math.log(1024) );
				return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
			},
			readAndPreview(fileobject) {
				if ( /\.(jpe?g|png|gif)$/i.test(fileobject.name) ) {
					this.file.url = URL.createObjectURL(fileobject);
				}
			},
			getFileExtension(filename) {
				return filename.substr(filename.lastIndexOf('\\') + 1).split('.')[1] || 'file';
			},
		}"
		x-cloak>
		<input 
			x-on:change.prevent="handleFiles($event)"
			type="file" 
			name="{{ $name ?? 'file' }}" 
			id="{{ $id }}" 
			class="w-px h-px opacity-0 absolute overflow-hidden inputfile" 
			accept="{{ $acceptFile }}"
		/>
		<label for="{{ $id }}"
			@class([
				'relative whitespace-nowrap cursor-pointer items-center overflow-hidden border bg-gray-50 p-0 hover:border-gray-300 focus:border-gray-300 rounded-lg',
				'flex flex-col w-full' => $mode === 'stack',
				'flex flex-col md:inline-flex md:flex-row' => $mode === 'normal',
			])>

			<div
				x-transition:enter="transition ease-out duration-300"
				x-transition:enter-start="opacity-0 transform scale-95"
				x-transition:enter-end="opacity-100 transform scale-100"
				x-transition:leave="transition ease-in duration-200"
				x-transition:leave-start="opacity-100 transform scale-100"
				x-transition:leave-end="opacity-0 transform scale-95"
				x-show="hasError"
				style="display: none;"
				class="origin-top z-10 text-sm font-medium text-center bg-red-50 text-red-600 rounded-lg px-2 py-1 w-full mx-auto absolute top-0 left-0 right-0 mt-1.5"
				x-text="errorText"
				x-cloak
			></div>

			<div class="flex w-full md:w-auto flex-1 items-center">
				<div class="flex-shrink-0 ml-1 rounded-md relative overflow-hidden">
		
					{{-- Radial Progress with percentage --}}
					<div wire:loading.flex wire:target="{{ $attributes->wire('model')->value }}" wire:loading.class="w-full">
						<svg class="w-8 h-8" viewBox="0 0 60 60">
							<circle
								class="text-gray-300"
								stroke-width="4"
								stroke="currentColor"
								fill="transparent"
								r="20"
								cx="30"
								cy="30"
							/>
							<circle
								transform="rotate(-90 30 30)"
								class="text-blue-600"
								stroke-width="4"
								:stroke-dasharray="circumference"
								:stroke-dashoffset="circumference - progress / 100 * circumference"
								stroke-linecap="round"
								stroke="currentColor"
								fill="transparent"
								r="20"
								cx="30"
								cy="30"
							/>
						</svg>
					</div>
	
					<div wire:loading.remove wire:target="{{ $attributes->wire('model')->value }}">
						<div x-show="Object.keys(file).length" class="w-8 h-8 bg-gray-200 border relative">
							<img
								x-show="['jpg', 'png', 'jpeg'].includes(file.type)" 
								:src="file.url" alt="preview" class="rounded absolute inset-0 h-full w-full object-cover">
							
							<svg x-show="['pdf'].includes(file.type)" xmlns="http://www.w3.org/2000/svg" class="pdf w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><path d="M48,200H64a16,16,0,0,0,0-32H48v48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="216 168 188 168 188 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="212" y1="196" x2="188" y2="196" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M128,216a24,24,0,0,0,0-48H114v48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
							
							<svg x-show="['doc', 'docx'].includes(file.type)"  xmlns="http://www.w3.org/2000/svg" class="doc w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M58,216a24,24,0,0,0,0-48H44v48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><ellipse cx="130" cy="192" rx="22" ry="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></ellipse><path d="M212,210.5a21,21,0,0,1-14,5.5c-12.2,0-22-10.7-22-24s9.8-24,22-24a21,21,0,0,1,14,5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
							
							<svg x-show="['xls', 'xlsx'].includes(file.type)" xmlns="http://www.w3.org/2000/svg" class="xls w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="120 168 120 216 148 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="52" y1="168" x2="88" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="88" y1="168" x2="52" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M176,212a25.2,25.2,0,0,0,15,5c9,0,17-3,17-13,0-16-32-9-32-24,0-8,6-13,15-13a25.2,25.2,0,0,1,15,5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
							
							<svg x-show="['csv'].includes(file.type)" xmlns="http://www.w3.org/2000/svg" class="csv w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="172 168 192 216 212 168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><path d="M80,210.5A21,21,0,0,1,66,216c-12.2,0-22-10.7-22-24s9.8-24,22-24a21,21,0,0,1,14,5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M112,212a25.2,25.2,0,0,0,15,5c9,0,17-3,17-13,0-16-32-9-32-24,0-8,6-13,15-13a25.2,25.2,0,0,1,15,5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
						</div>
						 
						<div x-show="Object.keys(file).length === 0">
							<svg class="h-8 w-8 text-slate-300 p-0 ml-0.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H15C20.43 1.25 22.75 3.57 22.75 9V15C22.75 20.43 20.43 22.75 15 22.75ZM9 2.75C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V9C21.25 4.39 19.61 2.75 15 2.75H9Z" fill="currentColor"/>
								<path d="M9 10.75C7.48 10.75 6.25 9.52 6.25 8C6.25 6.48 7.48 5.25 9 5.25C10.52 5.25 11.75 6.48 11.75 8C11.75 9.52 10.52 10.75 9 10.75ZM9 6.75C8.31 6.75 7.75 7.31 7.75 8C7.75 8.69 8.31 9.25 9 9.25C9.69 9.25 10.25 8.69 10.25 8C10.25 7.31 9.69 6.75 9 6.75Z" fill="currentColor"/>
								<path d="M2.67075 19.7001C2.43075 19.7001 2.19075 19.5801 2.05075 19.3701C1.82075 19.0301 1.91075 18.5601 2.26075 18.3301L7.19075 15.0201C8.27075 14.2901 9.76075 14.3801 10.7407 15.2101L11.0707 15.5001C11.5707 15.9301 12.4207 15.9301 12.9107 15.5001L17.0707 11.9301C18.1307 11.0201 19.8007 11.0201 20.8707 11.9301L22.5007 13.3301C22.8107 13.6001 22.8507 14.0701 22.5807 14.3901C22.3107 14.7001 21.8407 14.7401 21.5207 14.4701L19.8907 13.0701C19.3907 12.6401 18.5407 12.6401 18.0407 13.0701L13.8807 16.6401C12.8207 17.5501 11.1507 17.5501 10.0807 16.6401L9.75075 16.3501C9.29075 15.9601 8.53075 15.9201 8.02075 16.2701L3.09075 19.5801C2.96075 19.6601 2.81075 19.7001 2.67075 19.7001Z" fill="currentColor"/>
							</svg>
						</div>
					</div>
				</div> 
				<div
					@class([
						'px-4 py-1 inline-block whitespace-nowrap overflow-hidden truncate',
						'md:w-48' => $mode === 'normal',
					])
				>
					<div x-text="file.name" class="text-xs whitespace-nowrap overflow-hidden truncate font-medium"></div>
					<div x-text="file.size" class="text-xs text-gray-500"></div>
				</div>
			</div>
			<div class="flex-1 border-l w-full text-center px-4 py-2 bg-gray-100 font-semibold text-gray-600 hover:text-gray-700">Choose a file&hellip;</div>
		</label>	
	</div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-0.5" />
	@endif
</div>