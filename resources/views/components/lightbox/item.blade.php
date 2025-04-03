@props([
	'previewImageUrl' => '',
	'imageUrl' => '',
	'imageCaption' => '',
	'alternativeText' => '',
	'imageClasses' => 'object-contain'
]) 
 
 <a href="{{ $imageUrl }}" data-caption="{{ $imageCaption }}" {{ $attributes->class('block') }}>
	@if($slot->isEmpty())
		<img 
			src="{{ $previewImageUrl }}" 
			alt="{{ $alternativeText }}" 
			loading="lazy" 
			class="{{ $imageClasses }}"
			onerror="this.src = `{{ url('img/image-placeholder.png') }}`"
		/>
	@else
		{{ $slot }}
	@endif
 </a>