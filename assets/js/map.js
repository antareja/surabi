//<![CDATA[
var filter = [ "rizki", "haidar" ];
var z = 1;
var customIcons = {
	rizki : {
		icon : 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
	},
	haidar : {
		icon : 'http://labs.google.com/ridefinder/images/mm_20_red.png'
	}
};

var map = new google.maps.Map(document.getElementById("map"), {
	center : new google.maps.LatLng(-6.915499, 107.594301),
	zoom : 13,
	mapTypeId : 'roadmap'
});
var infoWindow = new google.maps.InfoWindow;

// create a new websocket
var socket = io.connect('http://localhost:8000');
// on message received we print all the data inside the #container div
socket.on('notification', function(data) {
	$.each(data.users, function(index, user) {
		var name = user.name;
		var point = new google.maps.LatLng(parseFloat(user.lat),
				parseFloat(user.lng));
		var html = "<b>" + name + "</b> <br/>";
		var icon = customIcons[name] || {};
		var marker = new google.maps.Marker({
			map : map,
			position : point,
			icon : icon.icon
		});
		bindInfoWindow(marker, map, infoWindow, html);
	});
});

function bindInfoWindow(marker, map, infoWindow, html) {
	google.maps.event.addListener(marker, 'mouseover', function() {
		infoWindow.setContent(html);
		infoWindow.open(map, marker);
	});
}

function doNothing() {
}
// ]]>
