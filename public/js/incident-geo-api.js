// Fallback Geolocation using IP API
function fallbackGeolocation() {
    fetch('http://ip-api.com/json/')
        .then(response => response.json())
        .then(data => {
            
            document.getElementById('latitude').value = data.lat;
            document.getElementById('longitude').value = data.lon;
          
        })
        .catch(err => {
            alert("Fallback geolocation failed.");
            console.error(err);
        });
}

// Function to get user's geolocation using browser geolocation API
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
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("Permission denied. Please enable location access.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Position unavailable. Using fallback location.");
                        fallbackGeolocation();
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

document.getElementById('locate-button').addEventListener('click', function(event) {
    event.preventDefault(); 
    //getUserCoordinates();
    fallbackGeolocation();    
});