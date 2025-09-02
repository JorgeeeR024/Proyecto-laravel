<!DOCTYPE html>
<html>
<head>
    <title>Mapa con Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <style>
        #map {
            height: 100vh; /* Mapa a pantalla completa */
        }
    </style>
</head>
<body>

<div id="map"></div>

<!-- JS de Leaflet -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Coordenadas iniciales (Bogotá, Colombia)
    var map = L.map('map').setView([4.7110, -74.0721], 13);

    // Capa base (mapa)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Detectar ubicación del usuario
    map.locate({setView: true, maxZoom: 16});

    // Evento cuando encuentra ubicación
    map.on('locationfound', function(e) {
        L.marker(e.latlng).addTo(map)
            .bindPopup("¡Estás aquí! 📍")
            .openPopup();
    });

    // Evento si no se encuentra ubicación
    map.on('locationerror', function() {
        alert("No pude encontrarte 😢");
    });
</script>

</body>
</html>
