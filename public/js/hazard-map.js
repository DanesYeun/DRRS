function initializeHazardMap(hazardData, shelterData, mapContainerId) {
    // Initialize the map
    var map = L.map(mapContainerId).setView([10.728, 123.826], 16); // Set coordinates and zoom level
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    hazardData.forEach(function(hazard) {
        try {
            var coordinatesString = hazard.coordinates;

            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString); // Decode JSON string into an array

            // Check if coordinates are valid
            if (Array.isArray(coordinates) && coordinates.length > 0 && Array.isArray(coordinates[0])) {
                // create zones
                var hazardPolygon = L.polygon(coordinates, {
                    color: 'red',
                    fillColor: 'red',
                    fillOpacity: 0.5
                }).addTo(map);

                hazardPolygon.bindPopup(hazard.hazardName).openPopup();
            } else {
                console.error('Invalid coordinates for hazard: ', hazard.hazardName);
            }

        } catch (e) {
            console.error('Error parsing coordinates for hazard: ', hazard.hazardName, e);
        }
    });

    // Iterate through each shelter and add pins to the map
    shelterData.forEach(function(shelter) {
        try {
            var coordinatesString = shelter.shelterCoordinates;

            if (coordinatesString.startsWith('"') && coordinatesString.endsWith('"')) {
                coordinatesString = coordinatesString.slice(1, -1);
            }

            var coordinates = JSON.parse(coordinatesString); // Decode JSON string into an array

            if (Array.isArray(coordinates) && coordinates.length === 2) {
                // pin for each shelter
                var shelterMarker = L.marker([coordinates[0], coordinates[1]]).addTo(map);

                shelterMarker.bindPopup(shelter.shelterName).openPopup();
            } else {
                console.error('Invalid coordinates for shelter: ', shelter.shelterName);
            }

        } catch (e) {
            console.error('Error parsing coordinates for shelter: ', shelter.shelterName, e);
        }
    });
}
