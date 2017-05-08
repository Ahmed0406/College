var map
function attachSecretMessage(marker, message)
{
    var infowindow = new google.maps.InfoWindow({content: message});
    google.maps.event.addListener(marker, 'click', function() {infowindow.open(map,marker);});
}
window.gmapsLoadMap = function()
{
    var center = new google.maps.LatLng('35.593745', '8.6470983');
    var settings = {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoom: 8,
        center: center
    };
    map = new google.maps.Map(document.getElementById('map'), settings);
    var marker = new google.maps.Marker ({
        position: new google.maps.LatLng('35.593745', '8.6470983'),
        title: '',
        map: map
    });
    marker.setTitle(''.toString());
    attachSecretMessage(marker, ''+' - '+'');
}