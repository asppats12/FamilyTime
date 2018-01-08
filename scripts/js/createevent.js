var map;
var service;
var infowindow;
var input;
var searchBtn;
var markers;
var marker;


var eventName;
var eventDetails;
var eventStartDate;
var eventEndDate;
var eventStartTime;
var eventEndTime;

var placeId;
var placeName;
var placeLat;
var placeLng;
var formattedAddress;

var xhttp;

function initialize(){
    var options = {
        zoom: 12,
        center: {lat: 43.7315 , lng: -79.7624 }
    };

    input = document.getElementById("pac-input");
    searchBtn = document.getElementById("pac-button");
    markers = [];
    map = new google.maps.Map(document.getElementById("map"), options);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    searchBox = new google.maps.places.SearchBox(input,options);

    infowindow = new google.maps.InfoWindow();
    service = new google.maps.places.PlacesService(map);

    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(createMarker(place));


            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

function createMarker(place) {
    marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent("<strong>" + place.name + "</strong><p>"+place.formatted_address+"</p>");
        infowindow.open(map, this);
        place_name = place.name;
        formatted_address = place.formatted_address;

        place_lat = place.geometry.location.lat();
        place_lng = place.geometry.location.lng();
        place_id = place.place_id;
        formatted_address = place.formatted_address;
    });
    return marker;
}

function validateEventData() {
    event.preventDefault();
    eventName = document.getElementById("eventname").value;
    eventStartDate = document.getElementById("startdate").value;
    eventEndDate = document.getElementById("enddate").value;
    eventStartTime = document.getElementById("starttime").value;
    eventEndTime = document.getElementById("endtime").value;
    eventDetails = document.getElementById("eventdetails").value;

    saveEvent();
}

function saveEvent(){
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText){
                alert("Event added.");
                window.location.href="dashboard.php";
            }
            else{
                alert("Event not added.");
            }
        }
    };
    xhttp.open("POST", "../api/addEventDetails.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var dataString = "eventName="+eventName+"&startDate="+eventStartDate+"&endDate="+eventEndDate+"&startTime="+eventStartTime+
        "&endTime="+eventEndTime+"&eventDetails="+eventDetails+"&placeId="+place_id+"&placeName="+place_name+"&lat="+place_lat+"&lng="+place_lng+"&address="+formatted_address;
    xhttp.send(dataString);
}


