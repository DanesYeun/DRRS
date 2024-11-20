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
                alert("Error: " + error.message);
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