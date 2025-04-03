@props([
	'withShadow' => true,
	'rounded' => true
])

<div class="overflow-x-auto
	{{ $withShadow ? 'shadow-sm border-slate-50': 'border-slate-100' }}
	{{ $rounded ? 'rounded-lg': '' }}
">
    <table class="min-w-full bg-white
		{{ $rounded ? 'rounded-lg': '' }}
	">
		{{ $slot }}
	</table>
</div>