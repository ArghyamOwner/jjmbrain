<div class="flex items-center space-x-2">
	@isset($siteSettings['logo_url'])
		<img 
			src="{{ $siteSettings['logo_url'] }}" 
			alt="logo" 
			width="200" 
			class="object-fit shrink-0" 
			loading="lazy" 
		/>
	@else
		<img 
			src="{{ url('img/logoipsum.svg') }}" 
			alt="logo" 
			width="200" 
			class="object-fit shrink-0" 
			loading="lazy" 
		/>
	@endisset
</div>