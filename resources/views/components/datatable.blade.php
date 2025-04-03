@props([
    'pagination' => true,
    'paginationType' => 'simple',
    'columns' => null,
    'data' => null,
    'tableCondensed' => false,
    'tableBordered' => false,
    'tableStriped' => false,
    'tableFlat' => false
])

<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})"
    @class([
        'relative overflow-hidden',
        'bg-white shadow rounded-lg' => ! $tableFlat
    ])
>
    <div
        @class([
            'overflow-x-auto overflow-y-auto relative',
            'bg-white rounded-lg' => ! $tableFlat
        ])
    >  
		@if($data->isNotEmpty())        
			<table
				@class([
					'border-collapse table-auto w-full whitespace-no-wrap table-striped relative table-datatable',
					'bg-white' => ! $tableFlat
				])
			>
				<thead>
					<tr class="text-left">
						@foreach($columns as $column)
							<th
								@class([
									'bg-slate-50 sticky top-0 border-b border-slate-200 px-6 py-3 text-slate-500 font-bold tracking-wider uppercase text-xs truncate',
									$column['headingClasses'],
									'border first-of-type:border-l-0' => $tableBordered
								])
							>
								{{ $column['label'] }}
							</th>
						@endforeach
					</tr>
				</thead>
				<tbody wire:loading.class="opacity-25 base-spinner">
					@if($data->isEmpty())
						<tr>
							<td colspan="{{ $colspan ?? count($columns) }}" class="text-slate-500 text-center px-6 py-3 border-t border-slate-100 whitespace-nowrap">
								No data found.
							</td>
						</tr>
					@else
						@foreach($data as $index => $row)
							<tr
								@class([
									'even:bg-slate-50' => $tableStriped
								])
							>
								@foreach($columns as $value)
									@php 
										$valueItem = explode('.', $value['key']);
									@endphp

									<td
										@class([
											'px-6 whitespace-nowrap',
											$value['width'],
											'pr-16' => $loop->last,
											'py-3' => ! $tableCondensed,
											'py-1.5 text-sm' => $tableCondensed,
											'border border-slate-200 first-of-type:border-l-0' => $tableBordered,
											'border-t border-slate-100' => ! $tableBordered
										])
									>
										@if($value['type'] === 'data')
											<span
												@class([
													$value['rowClasses'],
													'text-slate-700 block items-center truncate'
												])
											>
												@if(isset($value['theme']) && $value['theme'] === 'avatar')
													@include($value['view'] ?? 'datatable::avatar', [
														'avatar' => data_get($row, $value['avatarUrl'] ?? $value['key']),
														'title' => isset($value['format']) && is_callable($value['format']) 
															? $value['format']($row)
															: data_get($row, $value['key'])
													])
												@elseif(isset($value['theme']) && $value['theme'] === 'badge')
													<span
														@class([
															'inline-flex font-bold uppercase text-xs leading-5 tracking-wider px-2 rounded-full',
															$value['colors'][data_get($row, $value['key'])]
														])
													>
														{{ data_get($row, $value['key']) }}
													</span>
												@elseif(isset($value['theme']) && $value['theme'] === 'actions')
													@if(isset($value['format']) && is_callable($value['format']))
														@include('datatable::actions', $value['format']($row))
													@endif
												@else
													@if(isset($value['format']) && is_callable($value['format']))
														{!! isset($value['linebreak']) ? nl2br($value['format']($row)) : $value['format']($row) !!}
													@else
														{{ data_get($row, $value['key']) }}
													@endif
												@endif
											</span>
										@endif
									</td>
								@endforeach
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		@else
			<x-card-empty class="shadow-none" />
		@endif
    </div>
    <div class="absolute top-0 bottom-0 right-0 w-12 bg-gradient-to-l from-slate-100"></div>
</div>

@if($pagination)
    <div class="mt-5">
        @if ($paginationType === 'simple')
            {{ $data->links('partials.livewireSimplePagination') }}   
        @else
            {{ $data->onEachSide(2)->links() }}   
        @endif
    </div>
@endif