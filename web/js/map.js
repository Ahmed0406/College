function initMap() {
    var myLatLng = {lat: 35.5954674, lng: 8.6595939};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: true,
        zoom: 10
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: 'Lycée Al-Ahed Al-Jadid'
    });
}