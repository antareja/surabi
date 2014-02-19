function searchLocations(lat, lng) {
  var geocoder = new google.maps.Geocoder();
  var point = new google.maps.LatLng(lat, lng);
	geocoder.geocode({'latLng': point}, function(results, status) 
	{
		if (status == google.maps.GeocoderStatus.OK) 
		{
			if (results[0]) 
			{
				// alert();
				$( "#location" ).append(results[0]["address_components"][0].short_name);
			} 
			else 
			{
				alert("Unknown");
				
			}
		} 
  });
}