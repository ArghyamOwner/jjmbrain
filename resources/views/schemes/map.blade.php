<x-google-map 
	:coordinates="[
		'lat' => floatval($latitude) ?? 26.1158, 
		'lng' => floatval($longitude) ?? 91.7086
	]"
	zoom="12"
	info-content="{{ $scheme->name }}"
/>