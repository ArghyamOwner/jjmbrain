@props([
	'withShadow' => true,
	'rounded' => true,
	'tableBordered' => false,
	'tableCondensed' => false,
	'tableBorderedFull' => false,
	'tableStickyFirstColumn' => false,
	'tableStickyLastColumn' => false
])

<div
    @class([
        'relative overflow-hidden',
        'bg-white shadow' => $withShadow,
		'rounded-lg' => $rounded
    ])
>
	<div 
		@class([
			'overflow-x-auto overflow-y-auto relative w-full',
			'shadow-sm' => $withShadow,
			'rounded-lg' => $rounded,
			// 'border-t' => ! $withShadow,
			'border' => $tableBordered,
			// 'border-t-0' => $tableBorderedFull
		])>
		<table
			@class([
                'min-w-full table-datatable',
                'bg-white' => $withShadow,
				'border-separate border-spacing-0' => $tableBorderedFull,
				'border-collapse' => ! $tableBorderedFull
            ])
		>
			{{ $slot }}
		</table>
	</div>
</div>
