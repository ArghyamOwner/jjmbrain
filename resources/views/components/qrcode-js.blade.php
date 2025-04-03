@props(['text' => 'Hello QrCode!', 'width' => 128])

<div
	x-data
	x-init="new QRCode($refs.qrContainer, {
		text: '{{ $text }}',
		width: '{{ $width }}',
		height: '{{ $height ?? $width }}',
		colorDark: '#000000',
		colorLight: '#ffffff',
		correctLevel: QRCode.CorrectLevel.H
	})"
	x-ref="qrContainer"
	x-cloak></div>
 
@pushOnce('scripts-footer')
	<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
@endPushOnce