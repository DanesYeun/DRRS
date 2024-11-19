function initializeHazardMap(hazardData, shelterData, mapContainerId) {
    var map = L.map(mapContainerId).setView([10.728, 123.826], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    map.addControl(new L.Control.FullScreen());

    var hazardLayers = [];
    var shelterLayers = [];
    
    // store original names
    var originalPopups = new Map();

    function clearAllPopups() {
        hazardLayers.forEach(layer => layer.closePopup());
        shelterLayers.forEach(layer => layer.closePopup());
    }

    function createPopupAndOpen(layer, content) {
        var popup = L.popup({
            autoClose: false,
            closeOnClick: false
        })
        .setContent(content);
        
        layer.bindPopup(popup);
        setTimeout(() => layer.openPopup(), 100);
    }

    function calculateDistance(point1, point2) {
        return L.latLng(point1[0], point1[1]).distanceTo(L.latLng(point2[0], point2[1]));
    }

    function findNearbyShelters(hazardCoordinates, shelterData) {
        const MAX_DISTANCE = 500;
        let nearbyShelters = [];

        shelterData.forEach(function(shelter) {
            try {
                var shelterCoordinatesString = shelter.shelterCoordinates;
                if (shelterCoordinatesString.startsWith('"') && shelterCoordinatesString.endsWith('"')) {
                    shelterCoordinatesString = shelterCoordinatesString.slice(1, -1);
                }
                var shelterCoordinates = JSON.parse(shelterCoordinatesString);

                if (Array.isArray(shelterCoordinates) && shelterCoordinates.length === 2) {
                    let minDistance = Infinity;
                    hazardCoordinates.forEach(point => {
                        const distance = calculateDistance(point, shelterCoordinates);
                        minDistance = Math.min(minDistance, distance);
                    });

                    if (minDistance <= MAX_DISTANCE) {
                        nearbyShelters.push({
                            shelter: shelter,
                            distance: (minDistance / 1000).toFixed(2)
                        });
                    }
                }
            } catch (e) {
                console.error('Error processing shelter:', shelter.shelterName, e);
            }
        });

        return nearbyShelters.sort((a, b) => parseFloat(a.distance) - parseFloat(b.distance));
    }

    function restoreOriginalPopups() {
        originalPopups.forEach((popup, layer) => {
            layer.bindPopup(popup);
            layer.openPopup();
        });
    }

    let markersToOpen = [];

    hazardData.forEach(function (hazard) {
        try {
            var coordinatesString = hazard.coordinates;
            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString);

            if (Array.isArray(coordinates) && coordinates.length > 0 && Array.isArray(coordinates[0])) {
                var hazardPolygon = L.polygon(coordinates, {
                    color: 'red',
                    fillColor: 'red',
                    fillOpacity: 0.5
                }).addTo(map);

                var originalPopup = L.popup({
                    autoClose: false,
                    closeOnClick: false
                })
                .setContent(`Hazard: ${hazard.hazardName}`);
                
                hazardPolygon.bindPopup(originalPopup);
                originalPopups.set(hazardPolygon, originalPopup);
                markersToOpen.push(hazardPolygon);

                hazardPolygon.on('click', function() {
                    hazardLayers.forEach(layer => map.removeLayer(layer));
                    shelterLayers.forEach(layer => map.removeLayer(layer));

                    hazardPolygon.addTo(map);
                    createPopupAndOpen(hazardPolygon, `Hazard: ${hazard.hazardName}`);

                    const nearbyShelters = findNearbyShelters(coordinates, shelterData);
                    
                    if (nearbyShelters.length > 0) {
                        nearbyShelters.forEach(nearbyInfo => {
                            try {
                                var shelterCoords = JSON.parse(
                                    nearbyInfo.shelter.shelterCoordinates.replace(/^"|"$/g, '')
                                );
                                var shelterMarker = L.marker(shelterCoords).addTo(map);
                                createPopupAndOpen(shelterMarker, 
                                    `
                                    <div class="text-center">
                                        <h6>Nearby Shelter: ${nearbyInfo.shelter.shelterName}</h6>
                                        ${nearbyInfo.shelter.shelterImagePath ? 
                                            `<img src="/storage/${nearbyInfo.shelter.shelterImagePath}" 
                                                 alt="${nearbyInfo.shelter.shelterName}" 
                                                 class="img-fluid" 
                                                 style="max-width: 200px; max-height: 200px; object-fit: cover;">` 
                                            : ''}
                                        <p>Distance: ${nearbyInfo.distance} km</p>
                                    </div>
                                    `
                                );
                                shelterLayers.push(shelterMarker);
                            } catch (e) {
                                console.error('Error creating shelter marker:', e);
                            }
                        });
                    }
                });

                hazardLayers.push(hazardPolygon);
            }
        } catch (e) {
            console.error('Error parsing coordinates for hazard:', hazard.hazardName, e);
        }
    });

    shelterData.forEach(function (shelter) {
        try {
            var coordinatesString = shelter.shelterCoordinates;
            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString);

            if (Array.isArray(coordinates) && coordinates.length === 2) {
                var shelterMarker = L.marker([coordinates[0], coordinates[1]]).addTo(map);
                var originalPopup = L.popup({
                    autoClose: false,
                    closeOnClick: false
                })
                .setContent(`
                    <div class="text-center">
                        <h6>${shelter.shelterName}</h6>
                        ${shelter.shelterImagePath ? 
                            `<img src="/storage/${shelter.shelterImagePath}" 
                                 alt="${shelter.shelterName}" 
                                 class="img-fluid" 
                                 style="max-width: 160px; max-height: 160px; object-fit: cover;">` 
                            : ''}
                    </div>
                `);
                
                shelterMarker.bindPopup(originalPopup);
                originalPopups.set(shelterMarker, originalPopup);
                markersToOpen.push(shelterMarker);
                shelterLayers.push(shelterMarker);
            }
        } catch (e) {
            console.error('Error parsing coordinates for shelter:', shelter.shelterName, e);
        }
    });

    setTimeout(() => {
        markersToOpen.forEach(marker => marker.openPopup());
    }, 500);

    function showAll() {
        clearAllPopups();
        hazardLayers.forEach(layer => layer.addTo(map));
        shelterLayers.forEach(layer => layer.addTo(map));
        restoreOriginalPopups();
    }

    function showHazards() {
        clearAllPopups();
        hazardLayers.forEach(layer => layer.addTo(map));
        shelterLayers.forEach(layer => map.removeLayer(layer));
        restoreOriginalPopups();
    }

    function showShelters() {
        clearAllPopups();
        shelterLayers.forEach(layer => layer.addTo(map));
        hazardLayers.forEach(layer => map.removeLayer(layer));
        restoreOriginalPopups();
    }

    var FilterControl = L.Control.extend({
        onAdd: function (map) {
            var div = L.DomUtil.create('div', 'btn-group btn-group-sm');
            div.innerHTML = `
                <button id="show-all" class="btn btn-secondary">Show All</button>
                <button id="show-hazards" class="btn btn-secondary">Hazards</button>
                <button id="show-shelters" class="btn btn-secondary">Shelters</button>
            `;
            L.DomEvent.on(div, 'click', function (e) {
                L.DomEvent.stopPropagation(e);
            });
            return div;
        },
        onRemove: function (map) { }
    });

    var filterControl = new FilterControl();
    filterControl.addTo(map);

    document.getElementById('show-all').addEventListener('click', showAll);
    document.getElementById('show-hazards').addEventListener('click', showHazards);
    document.getElementById('show-shelters').addEventListener('click', showShelters);
}