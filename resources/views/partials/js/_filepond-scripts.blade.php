@pushOnce('styles')
	<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet">
	<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" /> 
	<link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">
	<style>
		/* .filepond--panel-root {
			background-color: white;
			border: 2px dashed #e2e8f0;
		} */
		.filepond--root {
			font-family: inherit;
		}
		.filepond--panel-root {
			background-color: rgb(249 250 251);
			border: 1px solid rgb(229 231 235);
		}
	</style>
@endpushOnce

@pushOnce('scripts')
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
	<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
	<script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>
	<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endpushOnce
 