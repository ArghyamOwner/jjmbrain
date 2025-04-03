@props([
	'toolbarTheme' => null,
	'options' => [],
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'imageUpload' => true,
	'imageUploadEndpoint' => route('tinymce.upload')
])

@php
	$tinymceToolbar = match($toolbarTheme) {
		'extraminimal' => [
			'plugins' => 'autolink lists link emoticons',
			'toolbar' => 'bold italic bullist numlist aligncenter hr link blockquote emoticons removeformat'
		],
		'minimal' => [
			'plugins' => 'autolink lists link codesample image emoticons',
			'toolbar' => 'bold italic bullist numlist aligncenter hr image link blockquote emoticons template removeformat'
		],
		'comment' => [
			'plugins' => 'autolink lists link fullscreen media',
			'toolbar' => 'bold italic bullist numlist aligncenter link fullscreen | media | undo redo'
		],
		default => [
			'plugins' => 'autolink lists link codesample image fullscreen table wordcount emoticons media',
			'toolbar' => 'blocks | bold italic underline strikethrough bullist numlist aligncenter hr image media link blockquote emoticons fullscreen | undo redo'
		]
	};

	$tinymceOptions = array_merge([
		'menubar' => false,
		'statusbar' => false,
		'toolbar_location' => 'top',
		'plugins' => $tinymceToolbar['plugins'],
		'toolbar' => $tinymceToolbar['toolbar'] ,
		'image_caption' => true,
		'block_formats' => 'Heading=h2; Sub-Heading=h3; Paragraph=p'
	], $options);
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $id ?? $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif
		
	@isset($hint)
		<x-text-hint class="mt-2">{{ $hint }}</x-text-hint>
	@endisset
 
	<div
		x-data="{ 
			value: @entangle($attributes->wire('model')),
			tinymceImageUploadHandler(blobInfo, progress) {
				return new Promise((resolve, reject) => {
					const xhr = new XMLHttpRequest();
					xhr.withCredentials = false;
					xhr.open('POST', '{{ $imageUploadEndpoint }}');

					xhr.upload.onprogress = (e) => {
						progress(e.loaded / e.total * 100);
					};

					xhr.onload = () => {
						if (xhr.status === 403) {
							reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
							return;
						}

						if (xhr.status < 200 || xhr.status >= 300) {
							reject('HTTP Error: ' + xhr.status);
							return;
						}

						const json = JSON.parse(xhr.responseText);

						if (!json || typeof json.location != 'string') {
							reject('Invalid JSON: ' + xhr.responseText);
							return;
						}

						resolve(json.location);
					};

					xhr.onerror = () => {
						reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
					};

					const formData = new FormData();
					formData.append('file', blobInfo.blob(), blobInfo.filename());

					xhr.send(formData);
				})
            }
		}"
		x-init="
			tinymce.init(Object.assign(
				{
					target: $refs.tinymce,
					content_style: `body { font-family: PlusJakartaSans,HKGrotesk,Helvetica,Arial,sans-serif;}`,
					font_css: '/css/font.css',

					setup: function(editor) {
						editor.on('blur', function(e) {
							value = editor.getContent()
						})
						editor.on('init', function (e) {
							if (value != null) {
								editor.setContent(value)
							}
						})
						$watch('value', function (newValue) {
							if (newValue !== editor.getContent()) {
								editor.resetContent(newValue || '');
								editor.selection.select(editor.getBody(), true);
								editor.selection.collapse(false);
							}
						});
					},

					@if($imageUpload)
						automatic_uploads: true,
						images_upload_handler: tinymceImageUploadHandler,
						images_reuse_filename: true,
					@endif
				}, 
				@js($tinymceOptions)
			))
		"
		wire:ignore
		x-cloak
	>
		<div>
			<textarea
				x-ref="tinymce"
				{{ $attributes->whereDoesntStartWith('wire:model') }}
			></textarea>
		</div>
	</div>

	@if($withErrorMessage)
		<x-input-error for="{{ $errorMessageFor ?? $name }}" class="mt-2" />
	@endif

</div>

@pushOnce('scripts-footer')
    <script src="{{ url('js/tinymce/tinymce.min.js') }}"></script>
@endpushOnce
 
<style>
.tox-tinymce {
	border-radius: 0.5rem;
	border: 1px solid rgb(209 213 219);
	box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
}
.tox:not(.tox-tinymce-inline) .tox-editor-header {
	box-shadow: 0 1px 1px 0 rgb(0 0 0 / 0.15);
}
</style>
 