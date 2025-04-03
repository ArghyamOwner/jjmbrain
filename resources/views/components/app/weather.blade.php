<div>
	<x-card>
		<x-heading>{{ $currentData['name'] }}</x-heading>
		<div class="flex flex-col md:flex-row">
			<div class="current-day md:w-64 text-center">
				@php
					$icon = $currentData['weather'][0]['icon'];
					$description = $currentData['weather'][0]['description'];
					$temp = $currentData['main']['temp'];
					$date = date("D, M d");
				@endphp
				<img class="mx-auto w-24 h-24" src="http://openweathermap.org/img/wn/{{ $icon }}@2x.png">
				<p class="temp text-xl font-bold">{{ $temp }}&deg;C</p>
				<p class="date">{{ $date }}</p>
				<p class="text-slate-500 mb-5">{{ $description }}</p>
			</div>

			<div class="forecast flex-1">
				<x-heading size="md" class="mb-1">7-day forecast</x-heading>
				@foreach($forecast as $day)
					@php
						$icon = $day['weather'][0]['icon'];
						$description = $day['weather'][0]['description'];
						$temp = $day['temp']['max'] . '/' . $day['temp']['min'];
						$date = date("D, M d", $day['dt']);
					@endphp

					<div class="forecast-day flex items-center space-x-3 text-sm">
						<p class="date w-24">{{ $date }}</p>
						
						<div class="flex space-x-2 items-center">
							<img class="shrink-0 w-10 h-10" src="http://openweathermap.org/img/wn/{{ $icon }}@2x.png">
							<p class="temp">{{ $temp }}&deg;C</p>
						</div>

						<p class="date text-slate-500">{{ $description }}</p>
					</div>
				@endforeach
			</div>
		</div>
	</x-card>
</div>