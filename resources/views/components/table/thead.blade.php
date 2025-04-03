@aware([
    'tableCondensed' => false,
	'tableBorderedFull' => false,
	'tableStickyFirstColumn' => false,
	'tableStickyLastColumn' => false
])

<th {{ $attributes->class([
	'whitespace-nowrap border-b border-slate-200 bg-slate-50 text-left text-xs leading-4 font-semibold text-slate-400 uppercase tracking-wider',
	'py-2 px-6' => ! $tableCondensed,
	'py-2 px-4' => $tableCondensed,
	'border border-t-0 first-of-type:border-l-0 last-of-type:border-r-0' => $tableBorderedFull,
	'first:sticky first:left-0 first:z-20 first:text-left first:shadow-sm border-b-0 border-l-0' => $tableStickyFirstColumn,
	'last:sticky last:right-0 last:z-20 last:shadow-sm border-b-0' => $tableStickyLastColumn
])->merge() }}>
	{{ $slot }}
</th>
