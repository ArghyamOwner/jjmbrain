<div 
	{{ $attributes->class([
		'ticker__list inline-block box-content whitespace-nowrap'
	])->merge() }}
	style="padding-right: 100%"
>
	{{ $slot }}
</div>