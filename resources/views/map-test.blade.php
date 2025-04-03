<!DOCTYPE html>
<html>
<head>
    <title>Display GeoTIFF in Leaflet.js</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
	{{-- <script src="https://unpkg.com/georaster"></script>
    <script src="https://unpkg.com/proj4"></script>
    <!-- <script src="https://unpkg.com/georaster-layer-for-leaflet"></script> -->
	<script src="https://unpkg.com/georaster-layer-for-leaflet/dist/georaster-layer-for-leaflet.min.js"></script> --}}
    <!-- <script src="https://unpkg.com/geotiff/dist/geotiff.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet-geotiff/leaflet-geotiff.js"></script> -->
</head>
<body>
    <div id="map" style="width: 100%; height: 95vh;"></div>
    <script>
		// initalize leaflet map
		// var map = L.map('map').setView([26.6985, 92.4851], 17);
		// var map = L.map('map').setView([26.5017, 90.9701], 17);
		var map = L.map('map').setView([27.2911, 95.6695], 17);
		

		// add OpenStreetMap basemap
		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		// var wmsLayer = L.tileLayer.wms('//localhost:8080/geoserver/tiff_test/wms', {
		var wmsLayer = L.tileLayer.wms('http://gis.sumato.tech/geoserver/tif_test/wms', {
			// layers: 'tiff_test:Dhekiajuli_clip', // Replace with your workspace and layer name
			layers: 'tif_test:Margherita_clip', 
			format: 'image/jpeg',
			// transparent: true,
			attribution: "SumatoGIS",
			maxNativeZoom: 19,
        	maxZoom: 25
			// crs: L.CRS.EPSG4326
		}).addTo(map);

		// GetCapabilities request to retrieve bounding box
		// var getCapabilitiesUrl = '//localhost:8080/geoserver/tiff_test/wms?SERVICE=WMS&VERSION=1.3.0&REQUEST=GetCapabilities';
		// fetch(getCapabilitiesUrl)
		// 	.then(function(response) {
		// 		return response.text();
		// 	})
		// 	.then(function(data) {
		// 		var parser = new DOMParser();
		// 		var xml = parser.parseFromString(data, 'text/xml');
		// 		var layerElement = xml.querySelector('Layer[queryable="1"]'); // Adjust the query selector based on your layer
		// 		var bboxElement = layerElement.querySelector('BoundingBox');
		// 		var minx = parseFloat(bboxElement.getAttribute('minx'));
		// 		var miny = parseFloat(bboxElement.getAttribute('miny'));
		// 		var maxx = parseFloat(bboxElement.getAttribute('maxx'));
		// 		var maxy = parseFloat(bboxElement.getAttribute('maxy'));
				
		// 		var centerLat = (miny + maxy) / 2;
		// 		var centerLng = (minx + maxx) / 2;
				
		// 		map.setView([centerLat, centerLng]);
		// 	});



 
		// var url_to_geotiff_file = "https://oin-hotosm.s3.amazonaws.com/59c66c5223c8440011d7b1e4/0/7ad397c0-bba2-4f98-a08a-931ec3a6e943.tif";

		// https://oin-hotosm.s3.amazonaws.com/56f9b5a963ebf4bc00074e70/0/56f9c2d42b67227a79b4faec.tif

		// https://sumatoimg.nyc3.digitaloceanspaces.com/test/Dhekiajuli_clip/Dhekiajuli_clip.tif
		// https://sumatoimg.nyc3.digitaloceanspaces.com/test/Dhekiajuli_clip/Dhekiajuli_clip.tif
		// parseGeoraster('https://sumatoimg.nyc3.digitaloceanspaces.com/test/Dhekiajuli_clip/Dhekiajuli_clip.tif').then(georaster => {
		// 	console.log("georaster:", georaster);

		// 	/*
		// 		GeoRasterLayer is an extension of GridLayer,
		// 		which means can use GridLayer options like opacity.

		// 		Just make sure to include the georaster option!

		// 		Optionally set the pixelValuesToColorFn function option to customize
		// 		how values for a pixel are translated to a color.

		// 		http://leafletjs.com/reference-1.2.0.html#gridlayer
		// 	*/
		// 	var layer = new GeoRasterLayer({
		// 		georaster: georaster,
		// 		opacity: 1.0,
		// 		// pixelValuesToColorFn: values => values[0] === 42 ? '#ffffff' : '#000000',
		// 		// resolution: 64 // optional parameter for adjusting display resolution
		// 		resolution: 264
		// 	});
			
		// 	layer.addTo(map);

		// 	map.fitBounds(layer.getBounds());

		// });
	 

	</script>
</body>
</html>
