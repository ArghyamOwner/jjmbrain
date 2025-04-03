@php
    $coordinates = [
        'lat' => floatval($siteSettings['latitude']) ?? 26.1427,
        'lng' => floatval($siteSettings['longitude']) ?? 91.6597
    ]
@endphp

<div class="border-t border-b">
    <x-google-map 
        id="location-map"
        zoom="17" 
        :coordinates="$coordinates"
        :info-content="$tenantName ?? config('app.name')"
    />
</div>