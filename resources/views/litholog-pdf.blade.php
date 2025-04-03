<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Litholog</title>
	{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
	<style>
		{!! file_get_contents(public_path('css/litholog.css')) !!}
	</style>
</head>
<body class="font-sans text-slate-800">
	@php
		function calculateCasingWidth($caseDiagram) {
			$maxValue = getMaxValueFromArrayOfJSON($caseDiagram, 'to');
			return $maxValue / count($caseDiagram);
		}

		function calculateWaterLogWidth($waterLevel) {
			$maxValue = getMaxValueFromArrayOfJSON($waterLevel, 'to');
			return $maxValue / count($waterLevel);
		}

		function calculateWidth($lithologies) {
			$maxValue = getMaxValueFromArrayOfJSON($lithologies, 'to');
			return $maxValue / count($lithologies);
		}

		function getMaxValueFromArrayOfJSON($jsonArray, $property) {
			$maxValue = PHP_INT_MIN;

			foreach ($jsonArray as $obj) {
				if (is_array($obj) && array_key_exists($property, $obj) && is_numeric($obj[$property])) {
					if ($obj[$property] > $maxValue) {
						$maxValue = $obj[$property];
					}
				}
			}

			return $maxValue;
		} 
	@endphp

	<div>
		<div class="grid grid-cols-2 mb-4">
			<div class="flex items-center">
				<div class="shrink-0 mr-3">
					<img src="{{ url('img/logo-grievance.png') }}" class="h-16" />
				</div>
				<div>
					<h2 class="font-bold">Jal Jeevan Mission, Assam</h2>
					<p class="text-sm">{{ $schemeName }}, {{ $division }}</p>
					<p class="text-sm">{{ $district }}</p>
				</div>
			</div>
			<div class="text-right">
				<div class="flex w-full justify-end mb-1">
					{!! $qrcodeLarge ?? '' !!}
				</div>
				<p class="text-xs">Scan the QR to verify the lithology in JJM brain</p>
			</div>
		</div>

		<div class="mb-4 text-center">
			<h2 class="font-bold">Lithology Report</h2>
			<p class="text-xs">This report is computer generated using JJM brain no sign required</p>
			<p class="text-xs">This lithology is verified by <span class="font-bold">{{ $verifiedBy }}</span></p>
		</div>
		
		<table class="w-full mb-6">
			<tbody>
				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Date of Report</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->created_at?->format('d-m-Y') }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Hole Diameter</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->hole_diameter ?? '' }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Type of Drilling</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->drilling_type ?? '' }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Casing Diameter</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->casing_size ?? '' }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Well Number</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->well_id ?? '' }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Compressor Pressure</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->compressor_pressure ? $litholog->compressor_pressure.' (Kg/cm2)' : "N/A" }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Drilling Start Date</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog?->starting_date?->toFormattedDateString() }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Drawdown</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->drawdown ? $litholog->drawdown.' (Meters)' : "N/A" }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Drilling End Date</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog?->completion_date?->toFormattedDateString() }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Pump Duration (in Hrs.)</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->duration_pump ? $litholog->duration_pump.' (Hrs.)'
						: "N/A" }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Driller Name and Phone</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->driller_name }} ({{ $litholog->driller_phone }})</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Static Water</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->static_water ? $litholog->static_water.' (meters)' : "N/A" }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Vehicle Number</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->drill_vehicle_number }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Status</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->status ?? "N/A" }}</td>
				</tr>

				<tr>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Latitude</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->latitude }}</td>
					<td class="font-bold text-xs border px-2 py-0.5 w-1/4 truncate">Longitude</td>
					<td class="text-xs border px-2 py-0.5 w-1/4 truncate">{{ $litholog->longitude ?? "N/A" }}</td>
				</tr>
			</tbody>
		</table>
		 
		<h2 class="text-center mb-2 font-bold">Lithology Diagram</h2>
		<div class="relative" style="min-height: 650px">
			<div class="absolute -top-10 left-0 w-full h-full flex items-center justify-center">
				<div class="mx-auto max-w-lg flex-1 p-4 transform rotate-90">
		
					<!-- Water Level -->
					<div class="relative">
						<div class="flex items-center w-full mb-4">
							@foreach($waterLevel as $waterlogitemKey => $waterlogitem)
								<div
									@class([
										'h-32 border-l border-t border-b border-gray-900 flex items-center justify-center relative' => true,
										'border-r' => $waterlogitemKey + 1 == count($waterLevel)
									]) 
									style="width: {{ ($waterlogitem['to'] - $waterlogitem['from']) * calculateWaterLogWidth($waterLevel) }}%; background-image: url({{ url('img/litholog/'.$waterlogitem['code']) }})">
								</div>
							@endforeach
						</div>
	
						<div class="flex items-center w-full mb-10">
							@foreach($waterLevel as $waterlogitemKey => $waterlogitem)
								<div class="flex items-center relative border-t border-gray-900"
									style="width: {{ ($waterlogitem['to'] - $waterlogitem['from']) * calculateWaterLogWidth($waterLevel) }}%">
									<span class="w-px h-1 border-l absolute left-0 top-0 border-gray-900"></span>
	
									@if (($waterlogitemKey + 1) == count($waterLevel))
										<span class="w-px h-1 border-l absolute right-0 top-0 border-gray-900"></span>
									@endif
	
									<span class="text-xs absolute -left-1.5 top-2 transform -rotate-90 block">{{ $waterlogitem['from'] }}</span>
	
									@if (($waterlogitemKey + 1) == count($waterLevel))
										<span class="text-xs absolute -right-2 top-2 transform -rotate-90 block">{{ $waterlogitem['to'] }}</span>
									@endif
								</div>
							@endforeach
						</div>
						
						<div class="absolute -rotate-90 -ml-16 -mt-32 text-sm">Water Level</div>
					</div>
					<!-- /Water Level -->
					
					<!-- Casing Diagram -->
					<div class="relative">
						<div class="flex items-center w-full mb-4 py-4 relative"
							style="background-image: url({{ url('img/litholog/10000.svg') }})">
							<div class="absolute w-16 h-full" style="z-index:1; background-image: url({{ url('img/litholog/30500.svg') }})"></div>
							@foreach($caseDiagram as $casingitemKey => $casingitem)
								<div
									@class([
										'border-l border-t border-b border-gray-900 flex items-center justify-center relative z-10',
										'border-r' => ($casingitemKey + 1) == count($caseDiagram),
										'h-10' => collect(['Casing Pipe Small', 'Well Cap Small', 'Fracture Small', 'Open Hole'])->contains($casingitem['code_name']),
										'h-16' => !collect(['Casing Pipe Small', 'Well Cap Small', 'Fracture Small', 'Open Hole'])->contains($casingitem['code_name'])
									])
									style="width: {{ ($casingitem['to'] - $casingitem['from']) * calculateCasingWidth($caseDiagram) }}%; background-image: url({{ url('img/litholog/'.$casingitem['code']) }})">
									
								</div>
							@endforeach
						</div>
			
						<div class="flex items-center w-full mb-10">
							@foreach($caseDiagram as $casingitemKey => $casingitem)
								<div class="flex items-center relative border-t border-gray-900"
									style="width: {{ ($casingitem['to'] - $casingitem['from']) * calculateCasingWidth($caseDiagram) }}%">
									<span class="w-px h-1 border-l absolute left-0 top-0 border-gray-900"></span>

									@if (($casingitemKey + 1) == count($caseDiagram))
										<span class="w-px h-1 border-l absolute right-0 top-0 border-gray-900"></span>
									@endif
										
									<span class="text-xs absolute -left-1.5 top-2 transform -rotate-90">{{ $casingitem['from'] }}</span>

									@if (($casingitemKey + 1) == count($caseDiagram))
									<span class="text-xs absolute -right-2 top-2 transform -rotate-90">{{ $casingitem['to'] }}</span>
									@endif
								</div>
							@endforeach
						</div>
						
						<div class="absolute -rotate-90 -ml-20 -mt-28 text-sm">Casing Diagram</div>
					</div>
					<!-- /Casing Diagram -->
	
					<!-- Lithologies -->
					<div class="relative">
						<div class="flex items-center w-full mb-4">
							@foreach($lithologies as $lithoitemKey => $lithoitem)
								<div @class([
										'h-24 border-l border-t border-b border-gray-900 flex items-center justify-center' => true,
										'border-r' => ($lithoitemKey + 1) == count($lithologies)
									])
									style="width: {{ ($lithoitem['to'] - $lithoitem['from']) * calculateWidth($lithologies) }}%; background-image: url({{ url('img/litholog/'.$lithoitem['code']) }})">
								</div>
							@endforeach
						</div>
				 
						<div class="flex items-center w-full">
							@foreach($lithologies as $lithoitemKey => $lithoitem)
								<div class="flex items-center relative border-t border-gray-900"
									style="width: {{($lithoitem['to'] - $lithoitem['from']) * calculateWidth($lithologies) }}%">
									<span class="w-px h-2 border-l absolute left-0 top-0 border-gray-900"></span>
	
									@if (($lithoitemKey + 1) == count($lithologies))
										<span class="w-px h-2 border-l absolute right-0 top-0 border-gray-900"></span>
									@endif
	
									<span class="text-xs absolute -left-1.5 top-3 transform -rotate-90">{{ $lithoitem['from'] }}</span>
	
									@if (($lithoitemKey + 1) == count($lithologies))
										<span class="text-xs absolute -right-2 top-3 transform -rotate-90">{{ $lithoitem['to'] }}</span>
									@endif
								</div>
							@endforeach
						</div>
						 
						<div class="absolute -rotate-90 -ml-14 -mt-20 text-sm">Lithology</div>
					</div>
					<!-- /Lithologies --> 
				</div>
			</div>
		</div>

		<h2 class="mb-2 font-bold">Litholog (all the dimensions are in meter)</h2>
		<table class="w-full mb-6">
			<thead>
				<tr>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Start</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">End</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Layer</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@forelse($lithologies as $lithoitem)
					<tr>
						<td class="text-xs border px-2 py-0.5">{{ $lithoitem['from'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $lithoitem['to'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $lithoitem['code_name'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $lithoitem['remarks'] }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-xs border px-2 py-0.5">
							No records added yet.
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<h2 class="mb-2 font-bold">Casing Diagram</h2>
		<table class="w-full mb-6">
			<thead>
				<tr>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Start</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">End</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Layer</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@forelse($caseDiagram as $casingitem)
					<tr>
						<td class="text-xs border px-2 py-0.5">{{ $casingitem['from'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $casingitem['to'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $casingitem['code_name'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $casingitem['remarks'] }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-xs border px-2 py-0.5">
							No records added yet.
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		<h2 class="mb-2 font-bold">Water Level</h2>
		<table class="w-full mb-6">
			<thead>
				<tr>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Start</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">End</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Layer</th>
					<th class="font-bold text-left text-xs border px-2 py-0.5">Remarks</th>
				</tr>
			</thead>
			<tbody>
				@forelse($waterLevel as $waterLevelItem)
					<tr>
						<td class="text-xs border px-2 py-0.5">{{ $waterLevelItem['from'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $waterLevelItem['to'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $waterLevelItem['code_name'] }}</td>
						<td class="text-xs border px-2 py-0.5">{{ $waterLevelItem['remarks'] }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-xs border px-2 py-0.5">
							No records added yet.
						</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>	
</body>
</html> 