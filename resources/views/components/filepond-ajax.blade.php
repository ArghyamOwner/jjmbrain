@props([
	'id' => null,
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'acceptFiles' => 'image/png,image/jpeg,image/jpg,image/gif',
	'maxFileSize' => '2MB', // 500KB
	'maxFiles' => 1,
	'endpoint' => null,
	'multiple' => false,
	'withPreview' => false,
	'withPreviewInGrid' => false,
	'previewHeight' => 170,
	'withBackground' => 'yes',
	'oldFiles' => [],
	'images' => [],
	'labelIdle' => "Drag & Drop your file or <span class='filepond--label-action text-indigo-600 !decoration-indigo-400'>Browse</span>"
])

@php
	$filepondBackgroundColor = [
		'yes' => '#f7fafc',
		'no' => '#ffffff'
	][$withBackground];
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">
	@if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	<div
		@destroy-filepond.window="pond.removeFile()"
		class="relative w-full"
		x-data="{
			hasError: false,
			errorText: '',
			errorTimeout: null,
			pond: null,
			maxFileSize: '{{ $maxFileSize }}',
			maxFiles: {{ $maxFiles }},
			allowedFiles: '{{ $acceptFiles }}',
			images: {{ collect($images) }},
			imagePreviewHeight: {{ $previewHeight }},
			oldFiles: {{ json_encode($oldFiles) }},
		}"
		
		x-init="
			$nextTick(() => { 
				if (oldFiles.length > 0) {
					const oldPreviewFiles = [];
					oldFiles.map(oldFile => {
						oldPreviewFiles.push({
							source: oldFile,
							options: { type: 'local' }
						})
					});

					pond.files = oldPreviewFiles
				}
			})
			
			FilePond.registerPlugin(FilePondPluginFileValidateType);
			FilePond.registerPlugin(FilePondPluginFileValidateSize);
			
			@if ($withPreview)
				FilePond.registerPlugin(FilePondPluginFilePoster);
				FilePond.registerPlugin(FilePondPluginImagePreview);
			@endif
			 	 
			pond = FilePond.create($refs.input)

			pond.setOptions({
				imagePreviewHeight: parseInt(imagePreviewHeight),
				filePosterMaxHeight: parseInt(imagePreviewHeight),
				instantUpload: true,
				maxFiles: maxFiles,
				maxFileSize: maxFileSize,
				acceptedFileTypes: allowedFiles.split(','),
				allowMultiple: {{ $multiple ? 'true' : 'false' }},
				labelIdle: `{{ $labelIdle }}`,
				labelFileProcessingComplete: 'Upload complete',

				server: {
					process: '{{ $endpoint }}',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},

					load: (source, load, error, progress, abort, headers) => {
						const request = new Request(source);
						fetch(request).then((res) => res.blob()).then(blob => load(blob));
					}
				}
			});

			pond.on('warning', (error, file, status) => {
				if (file.length > parseInt(maxFiles)) {
					errorText = `The maximum number of files is ${maxFiles}`;
					
					clearTimeout(errorTimeout); 
					hasError = true;
					errorTimeout = setTimeout(() => { hasError = false }, 3500);
				}
			});

			pond.on('processfile', (error, file) => {
				images.push(file.serverId);
			});
			
			pond.on('removefile', (nullValue, file) => {
				let foundImage = images.findIndex(
					image => image === file.filename
				);

				if (foundImage != -1) {
					images.splice(foundImage, 1);
				}
			});
		"
		x-cloak>

		<div
			x-transition:enter="transition ease-out duration-300"
			x-transition:enter-start="opacity-0 transform scale-95"
			x-transition:enter-end="opacity-100 transform scale-100"
			x-transition:leave="transition ease-in duration-200"
			x-transition:leave-start="opacity-100 transform scale-100"
			x-transition:leave-end="opacity-0 transform scale-95"
			x-show="hasError"
			style="display: none;"
			class="z-10 text-sm text-center bg-red-100 text-red-600 rounded-full px-2 py-1 w-64 mx-auto absolute top-0 left-0 right-0 mt-5"
			x-text="errorText"
			x-cloak
		></div>
	 
		<input 
			type="hidden" 
			:value="images.join(',')" 
			name="{{ $name }}"
		/>
	 
		<input
			x-ref="input"
			type="file" 
			class="filepond"
			name="file"
			data-allow-reorder="false"
			accept="{{ $acceptFiles }}" 
			data-max-files="{{ $maxFiles }}"

			@if ($multiple)
				multiple
			@endif

			@if ($multiple)
				multiple
			@endif
		/>

		@if($withErrorMessage)
			<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
		@endif

		@isset($hint)
			<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
		@endisset
	</div>
</div>


@once
@push('styles')
	<link rel="stylesheet" href="https://unpkg.com/filepond@^4/dist/filepond.css">

	@if ($withPreview)
		<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
	@endif

	<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />
	
	<style>
		.filepond--root {
			font-family: inherit;
		}
		.filepond--panel-root {
			background-color: rgb(249 250 251);
			border: 1px solid rgb(229 231 235);
		}
	</style>

	@if ($withPreviewInGrid)
		<style>
			@media (min-width: 30em) {
				.filepond--item {
					width: calc(50% - 0.5em);
				}
			}

			@media (min-width: 50em) {
				.filepond--item {
					width: calc(33.33% - 0.5em);
				}
			}
		</style>
	@endif
	
@endpush

@push('scripts')
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

	@if ($withPreview)
		<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
	@endif
	
	<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endpush
@endonce
