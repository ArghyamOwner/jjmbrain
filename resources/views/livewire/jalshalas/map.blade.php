<div>
    <div class="md:w-full mb-4">
        <x-card no-padding>
            <div wire:ignore id="map" class="rounded-lg" style="min-height: 88vh;"></div>
        </x-card>
    </div>
</div>

@once
    @push('styles')
        <!-- Load Leaflet from CDN -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin="" />
        <!-- Leaflet Mapbox CSS file for Fullscreen option on map-->
        <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' />
    @endpush

    @push('scripts-footer')
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
        <!-- Leaflet Mapbox js file for Fullscreen option on map-->
        <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
        <script>
            let jalshalaSchoolLocations = @json($jalshalaSchoolLocations);
            
            let jalshalaSchemeLocations = @json($jalshalaSchemeLocations);

            let allLayers = new L.FeatureGroup();

            let map = L.map('map', {
                zoom: 12,
                zoomControl: false,
            }).setView([26.0017, 92.8477]);

            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);

            map.addControl(new L.Control.Fullscreen({
                position: 'bottomright',
            }));

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let jalshalaSchoolLocationMapLayer = L.geoJson(jalshalaSchoolLocations, {
                pointToLayer: function(feature, latlng) {
                    return L.circleMarker(latlng, {
                        color: "#006400",
                        fillOpacity: 0.8,
                        opacity: 1,
                        radius: 8,
                        fillColor: "#006400",
                        weight: 1
                    })
                },
                onEachFeature: function(feature, layer) {
                    layer.bindPopup(bindPopupData(feature));
                }
            });

            allLayers.addLayer(jalshalaSchoolLocationMapLayer);

            // jalshalaSchoolLocationMapLayer.addTo(map);


            let jalshalaSchemeLocationMapLayer = L.geoJson(jalshalaSchemeLocations, {
                pointToLayer: function(feature, latlng) {
                    return L.circleMarker(latlng, {
                        color: "#ff0000",
                        fillOpacity: 0.8,
                        opacity: 1,
                        radius: 8,
                        fillColor: "#ff0000",
                        weight: 1
                    })
                },
                onEachFeature: function(feature, layer) {
                    layer.bindPopup(bindPopupData2(feature));
                }
            });

            allLayers.addLayer(jalshalaSchemeLocationMapLayer);

            // jalshalaSchemeLocationMapLayer.addTo(map);

            allLayers.addTo(map);

            function bindPopupData(feature) {
                return `School Name: <strong>${feature.properties.school_name}</strong>
                    <br>School Code: <strong>${feature.properties.school_code}</strong>
                `;
            }

            function bindPopupData2(feature) {
                return `Scheme Name: <strong>${feature.properties.name}</strong>
                    <br>IMIS ID: <strong>${feature.properties.imis_id}</strong>
                    <br>SMT ID: <strong>${feature.properties.smt_id}</strong>
                `;
            }

            map.fitBounds([allLayers.getBounds()]);
        </script>
    @endpush

@endonce
