@props([
	'width' => '55'
])

<div class="flex items-center space-x-2">
	<div {{ $attributes->merge(['class' => 'font-semibold leading-none text-slate-800']) }}>
		@isset ($siteSettings['logo_url'])
			<img src="{{ $siteSettings['logo_url'] }}" alt="logo" loading="lazy" class="h-12 object-fit">
		@else
			{{ $tenantName ?? config('app.name') }}
		@endisset
	</div>
</div>
