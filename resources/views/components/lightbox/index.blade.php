@props([
	'options' => []
])

@php
	$galleryOptions = array_merge([
		'async' => true
	], $options);
@endphp

<div>
    <div x-data x-init="$nextTick(() => { baguetteBox.run('.gallery') })" {{ $attributes->merge(['class' => 'gallery']) }}>
        {{ $slot }}
    </div>
</div>

@once
    @push('styles')
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.css">
    @endpush
    @push('scripts-footer')
    	<script src="https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.js"></script>
    @endpush
@endonce
