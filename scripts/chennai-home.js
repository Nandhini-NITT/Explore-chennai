var lat,lng;

function getLocation() {
    if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
  lat=position.coords.latitude;
  lng=position.coords.longitude;
  	L.mapbox.accessToken = 'pk.eyJ1IjoibmFuZGhpbmlkZXZpIiwiYSI6ImNpcWJ1bGQ1dTAwd21mbG0xZmg4bmZ2M3YifQ.RbOoXPJutCitMrH-tp6H7Q';
	var map = L.mapbox.map('map', 'mapbox.streets')
    .setView([lat, lng], 15);
	var marker = L.marker([lat, lng]).addTo(map);
	marker.bindPopup("<b>Your location</b><br>Click to find places near you").openPopup();
	function onMapClick(e) {
    window.location="viewPlace.html";
}
	marker.on('click', onMapClick);
    });
	}
	else {
        console.log("Geolocation is not supported by this browser.");
    }
}
