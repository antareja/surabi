/**
 * 
 */
var socket = io.connect('http://192.168.12.250:8000');
var geocoder = new google.maps.Geocoder();
// on message received we print all the data inside the #container div
socket.on('notification', function (data) {
	var data_map=data.data;
	var speed=data_map["velocity"];
	var tanggal=data_map["tanggal"];
	var jam=data_map["jam"];
	var lat = data_map["lat"];
	var lng = data_map["lng"];
	var mobile=data_map["mobile"];
	var velocity=data_map["velocity"];
	var point = new google.maps.LatLng(lat, lng);
	var color=$("#tr_"+mobile).css("color");
	//$("#tr_"+mobile).css({backgroundColor: 'yellow'});
	$("#speed_"+mobile).html(velocity);
	$("#position_"+mobile).html(tanggal+" "+jam);
	geocoder.geocode({'latLng': point}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					if (results[0]) 
					{
						$("#location_"+mobile).html(results[0]["address_components"][0].short_name);
					} 
					else 
					{
						
					}
				} 
				else 
				{
					
				}
});
	$("#tr_"+mobile).toggle( "pulsate" );
	$("#tr_"+mobile).toggle( "pulsate" );
});	