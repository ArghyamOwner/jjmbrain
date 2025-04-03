<div>
	<div {{ $attributes->merge(['class' => 'flex']) }}>
		@isset($mediaObject)
			<div class="shrink-0 mr-4">
				{{ $mediaObject }}
			</div>
		@endisset
		<div class="flex-1 min-w-0">
			{{ $mediaBody }}
		</div>
	</div>
</div>