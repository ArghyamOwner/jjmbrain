@props([
	'id' => 'file'. Str::random(10),
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'file' => null,
	'accept' => 'images',
	'multiple' => false,
	'height' => '',
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

	<div
		x-data="{
			maxSize: '{{ $maxSize }}',
			isMultiple: Boolean('{{ $multiple }}') || false, 
			dragging: false,
			progress: 0,
			media: [],
			circumference: 20 * 2 * Math.PI,

			onDroppedFiles(event) {
				this.dragging = false;
				let files = [...event.dataTransfer.items].filter(item => item.kind === 'file').map(item => item.getAsFile())
				this.handleFiles(files);
			},
			
			readAndPreview(media) {
				if ( /\.(jpe?g|png|gif)$/i.test(media.file.name) ) {
					media.url = URL.createObjectURL(media.file);
				}
			},

			getFileExtension(filename) {
				return filename.substr(filename.lastIndexOf('\\') + 1).split('.')[1] || 'file';
			},

			handleFiles(files) {
				if (this.isMultiple === true) {
					Array.from(files).forEach(file => {
						this.media.unshift({
							file: file,
							url: '',
							progress: 0,
							uploaded: false,
							failed: false,
							name: '',
							type: this.getFileExtension(file.name),
							size: this.humanFileSize(file.size),
							errorMessage: ''
						})
					})

					this.media.forEach(media => {
						this.readAndPreview(media);
 
						URL.revokeObjectURL(media.url); // free memory
				 
						if (! media.uploaded) {
							if (media.file.size > parseInt(this.maxSize)) {
								media.failed = true;
								media.errorMessage = 'File size is large.';
							} else {
								@this.upload(
									'{{ $attributes->wire('model')->value }}', 
									media.file, 
									(uploadedFilename) => {
										media.uploaded = true
										media.name = uploadedFilename
									}, 
									(error) => {
										media.failed = true
									}, 
									(event) => {
										media.progress = event.detail.progress || 0
									}
								);
							}
						}
					})
				} else {
					this.media = [];
					this.media.push({
						file: files[0],
						url: '',
						progress: 0,
						uploaded: false,
						failed: false,
						name: '',
						type: this.getFileExtension(files[0].name),
						size: this.humanFileSize(files[0].size),
						errorMessage: ''
					});

					if (this.media.length > 0) {
						this.readAndPreview(this.media[0]);

						if (this.media[0].file.size > parseInt(this.maxSize)) {
							this.media[0].failed = true;
							this.media[0].errorMessage = 'File size is large.';
						} else {
							@this.upload(
								'{{ $attributes->wire('model')->value }}', 
								this.media[0].file, 
								(uploadedFilename) => {
									this.media[0].uploaded = true
									this.media[0].name = uploadedFilename
								}, 
								(error) => {
									this.media[0].failed = true
								}, 
								(event) => {
									this.media[0].progress = event.detail.progress || 0
								}
							);
						}
					}
				}
			},

			removeFile(file) {
				@this.removeUpload(
					'{{ $attributes->wire('model')->value }}', 
					file.name, 
					() => {
						this.media = this.media.filter((item) => item.name !== file.name);
					}
				)

				this.media = this.media.filter((item) => item.name !== file.name);
			},

			humanFileSize(size) {
				const i = size == 0 ? 0 : Math.floor( Math.log(size) / Math.log(1024) );
				return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
			}
		}"
		x-cloak>
		
		{{-- Dropzone --}}
		<div 
			x-on:drop.prevent="onDroppedFiles"
			x-on:dragover.prevent="dragging = true"
			x-on:dragleave.prevent="dragging = false"
			:class="{'border-gray-300 bg-gray-100': dragging}"
			class="border-2 border-dashed rounded-lg flex flex-wrap items-center justify-center flex-1 px-4 py-2.5 transition-all ease-in-out duration-300 {{ $height }}">
			<div class="flex-shrink-0 flex items-center">
				@if($multiple)
					<svg class="-mr-5 -mt-2 transform -rotate-6 h-8 w-8 text-gray-300 group-hover:text-indigo-300 transition duration-500 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><g><circle cx="99.99951" cy="92" r="12"></circle><path d="M208.00049,31.99963h-160a16.01833,16.01833,0,0,0-16,16V175.97369l-.001.0307.001,31.99524a16.01833,16.01833,0,0,0,16,16h160a16.01833,16.01833,0,0,0,16-16v-160A16.01834,16.01834,0,0,0,208.00049,31.99963Zm-28.68653,80a16.019,16.019,0,0,0-22.62792,0l-44.68555,44.68653L91.314,135.99963a16.02161,16.02161,0,0,0-22.62792,0L48.00049,156.68457V47.99963h160l.00586,92.6922Z"></path></g></svg>
					<svg class="transition duration-500 ease-in-out relative h-8 w-8 transform rotate-3 text-gray-400 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M168.001,100.00017v.00341a12.00175,12.00175,0,1,1,0-.00341ZM232,56V200a16.01835,16.01835,0,0,1-16,16H40a16.01835,16.01835,0,0,1-16-16V56A16.01835,16.01835,0,0,1,40,40H216A16.01835,16.01835,0,0,1,232,56Zm-15.9917,108.6936L216,56H40v92.68575L76.68652,112.0002a16.01892,16.01892,0,0,1,22.62793,0L144.001,156.68685l20.68554-20.68658a16.01891,16.01891,0,0,1,22.62793,0Z"></path></svg>
				@else
					<svg class="h-8 w-8 text-gray-300 group-hover:text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M168.001,100.00017v.00341a12.00175,12.00175,0,1,1,0-.00341ZM232,56V200a16.01835,16.01835,0,0,1-16,16H40a16.01835,16.01835,0,0,1-16-16V56A16.01835,16.01835,0,0,1,40,40H216A16.01835,16.01835,0,0,1,232,56Zm-15.9917,108.6936L216,56H40v92.68575L76.68652,112.0002a16.01892,16.01892,0,0,1,22.62793,0L144.001,156.68685l20.68554-20.68658a16.01891,16.01891,0,0,1,22.62793,0Z"></path></svg>
				@endif
			</div>

			@if($slot->isEmpty())
				<span class="ml-2 text-gray-600">Drop files to upload or</span>
			@else
				{{ $slot }}
			@endif

			<label class="text-sm text-indigo-600 underline cursor-pointer ml-2 font-medium">
				<span>Browse files</span> 

				<input 
					type="file"
					class="absolute inset-0 opacity-0 text-transparent sr-only"
					x-on:change.prevent="handleFiles(event.target.files)"
					x-ref="input"
					accept="{{ $acceptFile }}"

					@if ($multiple)
						multiple
					@endif
				/>
			</label>
		</div>

		{{-- Validation errors & hint --}}
		@if($withErrorMessage)
			<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-1" />
		@endif

		@isset($hint)
			<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
		@endisset
		
		{{-- Preview --}}
		<div class="border rounded-lg mt-4" x-show="media.length">
			<template x-for="(mediaFile, mediaIndex) in media">
				<div class="flex space-x-3 w-full md:w-auto flex-1 items-center py-2 px-2"
					:class="{'border-t': mediaIndex !== 0 }">
					<div class="flex-shrink-0 ml-1 rounded relative overflow-hidden">
						<div x-show="['jpg', 'png', 'jpeg'].includes(mediaFile.type)" class="w-16 h-16 bg-gray-100 border relative rounded overflow-hidden" style="padding-bottom: 75%">
							<img :src="mediaFile.url" alt="file" class="absolute h-full w-full object-cover">
						</div>

						<div x-show="! ['jpg', 'png', 'jpeg'].includes(mediaFile.type)" class="w-16 h-16 bg-gray-100 border relative rounded overflow-hidden flex items-center justify-center">
							<svg x-show="['pdf'].includes(mediaFile.type)" xmlns="http://www.w3.org/2000/svg" class="pdf w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><path d="M48,200H64a16,16,0,0,0,0-32H48v48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="216 168 188 168 188 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="212" y1="196" x2="188" y2="196" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M128,216a24,24,0,0,0,0-48H114v48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
						
							<svg x-show="['doc', 'docx'].includes(mediaFile.type)" xmlns="http://www.w3.org/2000/svg" class="doc w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M58,216a24,24,0,0,0,0-48H44v48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><ellipse cx="130" cy="192" rx="22" ry="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></ellipse><path d="M212,210.5a21,21,0,0,1-14,5.5c-12.2,0-22-10.7-22-24s9.8-24,22-24a21,21,0,0,1,14,5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
						
							<svg x-show="['xls', 'xlsx'].includes(mediaFile.type)" xmlns="http://www.w3.org/2000/svg" class="xls w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="120 168 120 216 148 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="52" y1="168" x2="88" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="88" y1="168" x2="52" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M176,212a25.2,25.2,0,0,0,15,5c9,0,17-3,17-13,0-16-32-9-32-24,0-8,6-13,15-13a25.2,25.2,0,0,1,15,5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
							
							<svg x-show="['csv'].includes(mediaFile.type)" xmlns="http://www.w3.org/2000/svg" class="csv w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="172 168 192 216 212 168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><path d="M80,210.5A21,21,0,0,1,66,216c-12.2,0-22-10.7-22-24s9.8-24,22-24a21,21,0,0,1,14,5.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M112,212a25.2,25.2,0,0,0,15,5c9,0,17-3,17-13,0-16-32-9-32-24,0-8,6-13,15-13a25.2,25.2,0,0,1,15,5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M48,128V40a8,8,0,0,1,8-8h96l56,56v40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>	 

							<svg x-show="['file'].includes(mediaFile.type)" xmlns="http://www.w3.org/2000/svg" class="txt w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="96" y1="136" x2="160" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="96" y1="168" x2="160" y2="168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
						</div>
					</div> 
					<div class="flex-1 px-2 py-1 inline-block whitespace-nowrap overflow-hidden truncate">
						<div x-text="mediaFile.file.name" class="mb-1 text-sm whitespace-nowrap overflow-hidden truncate font-medium"></div>
						<div x-text="mediaFile.size" class="text-xs text-gray-500"></div>
						<div class="flex">
							<div x-text="mediaFile.type" class="text-xs text-gray-500"></div>
							<div class="ml-1 flex items-center" x-show="mediaFile.errorMessage.length">
								<div class="mr-1 text-gray-300 text-xs">&bull;</div>
								<div class="text-xs text-red-500" x-text="mediaFile.errorMessage"></div>
							</div>
						</div>
					</div>
					
					<div class="flex-shrink-0 flex space-x-2 items-center">
						{{-- Progress --}}
						<svg x-show="! mediaFile.uploaded && ! mediaFile.failed" class="w-8 h-8" viewBox="0 0 60 60">
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
								:stroke-dashoffset="circumference - mediaFile.progress / 100 * circumference"
								stroke-linecap="round"
								stroke="currentColor"
								fill="transparent"
								r="20"
								cx="30"
								cy="30"
							/>
						</svg>

						{{-- Success --}}
						<svg x-show="mediaFile.uploaded && !mediaFile.failed" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>

						{{-- Failed --}}
						<svg x-show="mediaFile.failed" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>

						{{-- Remove --}}
						<svg x-on:click="removeFile(mediaFile)" x-show="mediaFile.uploaded || mediaFile.failed" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
					</div>
				</div>
			</template>
		</div>
	</div>
</div>