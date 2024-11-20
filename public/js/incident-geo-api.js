// Function to get the user's coordinates
function getUserCoordinates() {
    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(
            function(position) {

                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

            },
            function(error) {
                // Error: handle geolocation failure
                // alert("Error: " + error.message);
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Permission denied. Please enable location access.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Position unavailable. Unable to retrieve your location.");
                        break;
                    case error.TIMEOUT:
                        alert("Request timed out. Try again.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                }
            },
            {
                enableHighAccuracy: true,  // Use GPS for higher accuracy
                maximumAge: 0            
            }
        );
    } else {
     
        alert("Geolocation is not supported by this browser.");
    }
}

// Event listener for the "Get My Coordinates" button
document.getElementById('locate-button').addEventListener('click', function(event) {
    event.preventDefault(); 
    getUserCoordinates();    
});