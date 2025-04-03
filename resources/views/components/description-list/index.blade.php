@props([
    'size' => 'default',
	'grid' => 'default'
])

<div>
	@isset($heading)
		<div class="mb-2">
			<x-heading size="lg">{{ $heading }}</x-heading>

			@isset($subheading)
				<p class="mt-1 max-w-2xl text-sm text-slate-500">
					{{ $subheading ?? '' }}
				</p>
			@endisset
		</div>
	@endisset

    <div {{ $attributes }}>
        <dl>
			{{ $slot }}
        </dl>
    </div>
</div>
