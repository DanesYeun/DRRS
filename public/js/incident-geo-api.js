window.addEventListener('DOMContentLoaded', function() {
    getUserCoordinates(); 
});

function fallbackGeolocation() {
    fetch('http://ip-api.com/json/')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById('latitude').value = data.lat;
            document.getElementById('longitude').value = data.lon;
          
        })
        .catch(err => {
            alert("Fallback geolocation failed.");
            console.error(err);
        });
}

function getUserCoordinates() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {

                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                console.log(position.coords);
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

            },
            function(error) {
                fallbackGeolocation();
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
