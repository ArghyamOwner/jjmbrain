@props([
	'id' => md5($name ?? Str::random(8)),
	'label' => null,
	'name' => null,
	'hint' => null,
	'withErrorMessage' => true,
	'errorMessageFor' => null,
	'optional' => false,
	'noMargin' => false,
	'placeholderImageForUploadProgress' => 'https://via.placeholder.com/1000X400?text=loading...',
	'initialValue' => null,
	'placeholder' => 'Write something great!',
	'height' => '200px',
	'toolbarType' => 'normal' // minimal | normal | custom
])

@php
	$toolbarButtons = [
		'normal' => [
			[
				['header' =>  2 ], 
				'bold', 'italic', 'underline', 'strike'
			],
			['link', 'blockquote', 'code-block', 'image'],
			[[ 'list' => 'ordered' ], [ 'list' => 'bullet' ]],
			['blockquote-info', 'blockquote-alert'],
			['clean']
		],
		'minimal' => [
			['bold', 'italic', 'underline'],
			['link'],
			[[ 'list' => 'ordered' ], [ 'list' => 'bullet' ]]
		]
	][$toolbarType];
@endphp

<div class="{{ $noMargin ? 'mb-0' : 'mb-5' }}">	
    @if($label)
		<x-label class="mb-1" for="{{ $name }}" :optional="$optional">{{ $label }}</x-label>
    @endif

	<div
		wire:ignore
		x-data="{
			quill: null,
			placeholderImage: '{{ $placeholderImageForUploadProgress }}',
			quillContent: @entangle($attributes->wire('model')),
			selectLocalImage(quillInstance) {
				const input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.click();

				// Listen upload local image and save to server
				input.onchange = () => {
					const file = input.files[0];

					// file type is only image.
					if (/^image\//.test(file.type)) {
						// push image url to rich editor.
						const range = quillInstance.getSelection(true);

						// Insert temporary loading placeholder image
						quillInstance.insertEmbed(range.index, 'image', this.placeholderImage);

						// puts the cursor at the end of image
						quillInstance.setSelection(range.index + 1);

						this.saveToServer(file, quillInstance, range);
					} else {
						console.warn('You could only upload images.');
					}
				};
			},
			saveToServer(file, quillInstance, range) {
				@this.upload(
					'files',
					file,
					(uploadedFileName) => {
						const eventName = `myapp:image-upload-completed:${btoa(uploadedFileName)}`;

						const listener = function (event) {
							// Remove placeholder image
							quillInstance.deleteText(range.index, 1);
						
							// Insert uploaded image
							quillInstance.insertEmbed(range.index, 'image', event.detail.url);

							// puts the cursor at the end of image
							quillInstance.setSelection(range.index + 1);

							window.removeEventListener(eventName, listener);
						}

						window.addEventListener(eventName, listener);

						@this.call('completeUpload', uploadedFileName, eventName);					
					},
					(error) => {
						console.log(error);
					},
					(event) => {
						// console.log(event.detail.progress)
					}
				)
			}
		}" 
		x-init="
			quill = new Quill('#editor-{{ $id }}', {
				scrollingContainer: '.ql-container',
				modules: {
					toolbar: {
						container: {{ collect($toolbarButtons) }},
						handlers: {
						}
					},
					magicUrl: true
				},
				theme: 'snow',
				placeholder: '{{ $placeholder }}'
			});

			quill.on('text-change', function () {
				let html = quill.root.innerHTML;
				if (html === '<p><br></p>') html = ''
				quillContent = html;
			});
			quill.clipboard.addMatcher(Node.ELEMENT_NODE, function (node, delta) {
				let plaintext = node.innerText;
				let Delta = Quill.import('delta');
				return new Delta().insert(plaintext);
			});
			// quill editor add image handler
			quill.getModule('toolbar').addHandler('image', () => {
				selectLocalImage(quill);
			});
			// console.log(quill.getContents());
			quillContent = (quill.root.innerHTML === '<p><br></p>')
					? '' 
					: quill.root.innerHTML;
		"
		x-on:quill-clear-content.window="quill.root.innerHTML = ''"
		x-cloak
	>
		<div {{ $attributes->whereDoesntStartWith('wire:model') }}>
			<div class="quill-wrapper">
				<div id="editor-{{ $id }}" x-model="quillContent" class="prose prose-sm prose-custom max-w-none overflow-y-auto text-sm" style="height: {{ $height }}">
					{!! $initialValue !!}
				</div>
			</div>
		</div>
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
		<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.7/quill.snow.css">
		<style>
			.quill-wrapper .ql-toolbar.ql-snow {
				background-color: #fff;
				border-top-left-radius: 0.375rem;
			  	border-top-right-radius: 0.375rem;
			  	z-index: 10;
			}
			.quill-wrapper .ql-toolbar.ql-snow,
			.quill-wrapper .ql-container {
				font-family: inherit;
				font-size: inherit;
			}
			.quill-wrapper .ql-container {
				border-bottom-left-radius: 0.375rem;
			  	border-bottom-right-radius: 0.375rem;
			  	/*padding: 0 16px;*/
			  	color: #2d3748;
			  	min-height: 5em;
			}
			
			.quill-wrapper .ql-toolbar.ql-snow,
			.quill-wrapper .ql-container.ql-snow {
				border-color: #d2d6dc;
			}
			.quill-wrapper .ql-editor.ql-blank::before {
				font-style: normal;
			}
			.quill-wrapper .prose p:first-of-type {
				margin-top: 0 !important;
			}
			.quill-wrapper .prose p:last-of-type {
				margin-bottom: 0 !important;
			}
			.ql-clipboard {
				position: fixed;
			}
			.ql-container {
				font-size: inherit;
			}
			.ql-editor ol > li,
			.ql-editor ul > li {
				list-style-type: none;
			}
			.ql-editor ul > li::before {
				content: '';
			}
			.ql-editor ol li:not(.ql-direction-rtl),
			.ql-editor ul li:not(.ql-direction-rtl) {
				padding-left: 1em;
			}
			.quill-wrapper .ql-snow .ql-tooltip[data-mode=video] {
				left: 10px !important;
			}
		</style>	
	@endpush

	@push('scripts')
		<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/quill-magic-url@2.0.2/dist/index.min.js"></script>
		<script>
			document.addEventListener('livewire:load', function () {
				const icons = Quill.import('ui/icons');
				icons['blockquote-info'] = `<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>`;
				icons['blockquote-alert'] = `<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>`;

				const Block = Quill.import('blots/block');

				class BlockquoteInfoBlot extends Block {
					static blotName = 'blockquote-info';
					static tagName = 'blockquote';
					static className = 'info';
				}

				class BlockquoteAlertBlot extends Block {
					static blotName = 'blockquote-alert';
					static tagName = 'blockquote';
					static className = 'alert';
				}

				Quill.register(BlockquoteInfoBlot);
				Quill.register(BlockquoteAlertBlot);
			});
		</script>
	@endpush
@endonce