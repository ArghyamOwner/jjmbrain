<div {{ $attributes }}>
	<div
		@class([
			'flex flex-col md:flex-row md:flex-1 md:items-center space-y-2 md:space-y-0'
		])
	>
		<div class="flex-1">
			@isset($beforeTitle)
				<div {{ $beforeTitle->attributes->merge(['class' => 'block']) }}>{{ $beforeTitle }}</div>
			@endisset

			@isset($title)
				<h2 {{ $title->attributes->class(['font-semibold text-xl'])->merge() }}>
					{{ $title }}
				</h2>
			@endisset

			@isset($afterTitle)
				<div {{ $afterTitle->attributes->merge(['class' => 'block']) }}>{{ $afterTitle }}</div>
			@endisset
		</div>

		@isset($action)
			<div {{ $action->attributes->merge() }}>
				{{ $action}}
			</div>
		@endisset
	</div>
</div>
