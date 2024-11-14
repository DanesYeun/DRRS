function initializeHazardMap(hazardData, shelterData, mapContainerId) {
    // Initialize the map
    var map = L.map(mapContainerId).setView([10.728, 123.826], 16); // Set coordinates and zoom level

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    map.addControl(new L.Control.FullScreen()); // Adds full screen view to the buttons on the top left

    // for storing hazard, shelter, and nearest shelter datas. 
    var hazardLayers = [];
    var shelterLayers = [];
    var nearestShelters = {}; // To hold nearest shelter info for each hazard

    // Add hazard polygons to the map (red/danger zones)
    hazardData.forEach(function (hazard) {
        try {
            var coordinatesString = hazard.coordinates;

            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString); // Decode JSON string into an array

            // Check if coordinates are valid
            if (Array.isArray(coordinates) && coordinates.length > 0 && Array.isArray(coordinates[0])) {
                // Create zones
                var hazardPolygon = L.polygon(coordinates, {
                    color: 'red',
                    fillColor: 'red',
                    fillOpacity: 0.5
                }).addTo(map);

                // Bind a popup to the polygon with the hazard name
                hazardPolygon.bindPopup(hazard.hazardName);

                // Add filtering, showing the nearest shelter
                hazardPolygon.on('click', function () {
                    showNearestShelter(hazard.hazardName); // Automatically show nearest shelter when clicking a hazard
                });

                // Initialize nearest shelter
                let nearestShelter = null;
                let minDistance = Infinity;

                shelterData.forEach(function (shelter) {
                    try {
                        var shelterCoordinatesString = shelter.shelterCoordinates;

                        if (shelterCoordinatesString.startsWith('"') && shelterCoordinatesString.endsWith('"')) {
                            shelterCoordinatesString = shelterCoordinatesString.slice(1, -1);
                        }

                        var shelterCoordinates = JSON.parse(shelterCoordinatesString); // Decode JSON string into an array

                        // Check if the shelter coordinates are valid
                        if (Array.isArray(shelterCoordinates) && shelterCoordinates.length === 2) {
                            var shelterLatLng = L.latLng(shelterCoordinates[0], shelterCoordinates[1]);

                            // calculate distance to the shelter point
                            coordinates.forEach(function (point) {
                                var hazardLatLng = L.latLng(point[0], point[1]);
                                
                                // Calculate distance to the shelter
                                var distance = hazardLatLng.distanceTo(shelterLatLng);

                                if (distance < minDistance) {
                                    minDistance = distance;
                                    nearestShelter = shelter; // Store the nearest shelter
                                }
                            });
                        } else {
                            console.error('Invalid coordinates for shelter: ', shelter.shelterName);
                        }
                    } catch (e) {
                        console.error('Error parsing coordinates for shelter: ', shelter.shelterName, e);
                    }
                });

                // Store nearest shelter information for this hazard
                if (nearestShelter) {
                    nearestShelters[hazard.hazardName] = {
                        shelter: nearestShelter,
                        distance: (minDistance / 1000).toFixed(2) // Convert to km
                    };
                } else {
                    console.warn(`No nearest shelter found for hazard: ${hazard.hazardName}`);
                }

                // Update the popup to include nearest shelter information
                hazardPolygon.bindPopup(`Hazard: ${hazard.hazardName}<br>${nearestShelter ? `Nearest Shelter: ${nearestShelter.shelterName}, Distance: ${nearestShelters[hazard.hazardName].distance} km` : 'No shelter available'}`);
                hazardLayers.push(hazardPolygon); // Store polygon

            } else {
                console.error('Invalid coordinates for hazard: ', hazard.hazardName);
            }

        } catch (e) {
            console.error('Error parsing coordinates for hazard: ', hazard.hazardName, e);
        }
    });

    // Iterate through each shelter and add pins to the map
    shelterData.forEach(function (shelter) {
        try {
            var coordinatesString = shelter.shelterCoordinates;

            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString); // Decode JSON string into an array

            if (Array.isArray(coordinates) && coordinates.length === 2) {
                // Pin per shelter
                var shelterMarker = L.marker([coordinates[0], coordinates[1]]).addTo(map);
                shelterMarker.bindPopup(shelter.shelterName).openPopup();
                shelterLayers.push(shelterMarker);
            } else {
                console.error('Invalid coordinates for shelter: ', shelter.shelterName);
            }

        } catch (e) {
            console.error('Error parsing coordinates for shelter: ', shelter.shelterName, e);
        }
    });

    // Function to show the nearest shelter for a selected hazard
    function showNearestShelter(hazardName) {
        // Clear current displayed nearest layers
        hazardLayers.forEach(layer => {
            const popup = layer.getPopup();
            if (popup && popup.getContent().includes(hazardName)) {
                layer.addTo(map);
            } else {
                // Remove other hazards
                map.removeLayer(layer);
            }
        });

        // Find and add nearest shelter
        if (nearestShelters[hazardName]) {
            const nearestShelterInfo = nearestShelters[hazardName];
            const nearestShelter = nearestShelterInfo.shelter;
            const distance = nearestShelterInfo.distance;

            var shelterCoordinatesString = nearestShelter.shelterCoordinates;
            if (shelterCoordinatesString.startsWith('"') && shelterCoordinatesString.endsWith('"')) {
                shelterCoordinatesString = shelterCoordinatesString.slice(1, -1);
            }
            var shelterCoordinates = JSON.parse(shelterCoordinatesString); // Decode JSON string into an array

            if (Array.isArray(shelterCoordinates) && shelterCoordinates.length === 2) {
                // Create a marker for the nearest shelter and bind the popup
                var nearestShelterMarker = L.marker([shelterCoordinates[0], shelterCoordinates[1]]).addTo(map);
                nearestShelterMarker.bindPopup(`Nearest shelter to ${hazardName}: ${nearestShelter.shelterName}, Distance: ${distance} km`).openPopup();
            }
        } else {
            console.warn(`No nearest shelter found for hazard: ${hazardName}`);
        }
    }

    // button for show all
    function showAll() {
        hazardLayers.forEach(layer => layer.addTo(map));
        shelterLayers.forEach(layer => layer.addTo(map));
    }

    // button for hazard filter
    function showHazards() {
        hazardLayers.forEach(layer => layer.addTo(map));
        shelterLayers.forEach(layer => map.removeLayer(layer));
    }

    // button for shelter filter
    function showShelters() {
        shelterLayers.forEach(layer => layer.addTo(map));
        hazardLayers.forEach(layer => map.removeLayer(layer));
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
        onRemove: function (map) {
        }
    });

    // Add the filter to map
    var filterControl = new FilterControl();
    filterControl.addTo(map);

    // event listeners for filter buttons
    document.getElementById('show-all').addEventListener('click', showAll);
    document.getElementById('show-hazards').addEventListener('click', showHazards);
    document.getElementById('show-shelters').addEventListener('click', showShelters);
}
