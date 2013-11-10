function initialize() {
    var myLatlng = new google.maps.LatLng(37.3666, -8.78535);
    var mapOptions = {
        zoom: 17,
        center: new google.maps.LatLng(37.3666, -8.78535),
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Luso Leaves'
    });
}

google.maps.event.addDomListener(window, 'load', initialize);