@aware([
    'tableCondensed' => false,
	'tableBorderedFull' => false,
	'tableStickyFirstColumn' => false,
	'tableStickyLastColumn' => false
])

<td {{ $attributes->class([
	'whitespace-nowrap',
	'py-1.5 px-6' => ! $tableCondensed,
	'py-1.5 px-4 text-sm' => $tableCondensed,
	'border border-b-0 border-slate-200 first-of-type:border-l-0 last-of-type:border-r-0' => $tableBorderedFull,
    'border-t border-slate-100' => ! $tableBorderedFull,
	'first:sticky first:left-0 first:z-20 first:bg-white first:text-left first:shadow-sm border-l-0' => $tableStickyFirstColumn,
	'last:sticky last:right-0 last:z-20 last:bg-white last:shadow-sm' => $tableStickyLastColumn
])->merge() }}>
	{{ $slot }}
</td>
