@isset($siteSettings['metrics'])
<div
	{{ $attributes->merge([
		"class" => "grid grid-cols-1 md:grid-cols-4 shadow-lg border divide-y divide-slate-100 md:divide-y-0 md:divide-x md:divide-slate-100"
	]) }}>
	<div class="p-8">
		<div class="w-12 h-12 mb-4 shadow-sm border rounded-lg flex items-center justify-center mx-auto">
			<svg class="text-sky-600 w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="140" r="40" opacity="0.2"></circle><circle cx="60" cy="84" r="32" opacity="0.2"></circle><circle cx="196" cy="84" r="32" opacity="0.2"></circle><circle cx="128" cy="140" r="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></circle><path d="M196,116a59.8,59.8,0,0,1,48,24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M12,140a59.8,59.8,0,0,1,48-24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M70.4,216a64.1,64.1,0,0,1,115.2,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M60,116A32,32,0,1,1,91.4,78" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M164.6,78A32,32,0,1,1,196,116" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
		</div>
		<h3 class="text-4xl md:text-6xl text-center font-bold text-slate-800">{{ $siteSettings['metrics']['population'] ?? 0 }}</h3>
		<p class="text-slate-600 mt-3 text-center">populations</p>
	</div>
	<div class="p-8">
		<div class="w-12 h-12 mb-4 shadow-sm border rounded-lg flex items-center justify-center mx-auto">
			<svg class="text-sky-600 w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M93.2,122.8A70.3,70.3,0,0,1,88,96a72,72,0,1,1,72,72,70.3,70.3,0,0,1-26.8-5.2h0L120,176H96v24H72v24H32V184l61.2-61.2Z" opacity="0.2"></path><path d="M93.2,122.8A70.3,70.3,0,0,1,88,96a72,72,0,1,1,72,72,70.3,70.3,0,0,1-26.8-5.2h0L120,176H96v24H72v24H32V184l61.2-61.2Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><circle cx="180" cy="76" r="12"></circle></svg>
		</div>
		<h3 class="text-4xl md:text-6xl text-center font-bold text-slate-800">{{ $siteSettings['metrics']['holdings'] ?? 0 }}</h3>
		<p class="text-slate-600 mt-1 text-center">holdings</p>
	</div>
	<div class="p-8">
		<div class="w-12 h-12 mb-4 shadow-sm border rounded-lg flex items-center justify-center mx-auto">
			<svg class="text-sky-600 w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M144,216V40a8,8,0,0,0-8-8H40a8,8,0,0,0-8,8V216" opacity="0.2"></path><line x1="16" y1="216" x2="240" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><path d="M144,216V40a8,8,0,0,0-8-8H40a8,8,0,0,0-8,8V216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M224,216V104a8,8,0,0,0-8-8H144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><line x1="64" y1="72" x2="96" y2="72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="80" y1="136" x2="112" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="64" y1="176" x2="96" y2="176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="176" y1="176" x2="192" y2="176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="176" y1="136" x2="192" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
		</div>
		<h3 class="text-4xl md:text-6xl text-center font-bold text-slate-800">{{ $siteSettings['metrics']['households'] ?? 0 }}</h3>
		<p class="text-slate-600 mt-1 text-center">households</p>
	</div>
	<div class="p-8">
		<div class="w-12 h-12 mb-4 shadow-sm border rounded-lg flex items-center justify-center mx-auto">
			<svg class="text-sky-600 w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polygon points="160 216 96 184 96 40 160 72 160 216" opacity="0.2"></polygon><polyline points="96 184 32 200 32 56 96 40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><polygon points="160 216 96 184 96 40 160 72 160 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polygon><polyline points="160 72 224 56 224 200 160 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline></svg>
		</div>
		<h3 class="text-4xl md:text-6xl text-center font-bold text-slate-800">{{ $siteSettings['metrics']['area'] ?? 0 }}</h3>
		<p class="text-slate-600 mt-1 text-center">sq. km area</p>
	</div>
</div>
@endisset