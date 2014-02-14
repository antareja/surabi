  var posisi=$("#tmp_position").html();
  var poly, map;
  var markers = [];
  var path = new google.maps.MVCArray;

    var uluru = new google.maps.LatLng(-6.9147,107.599398);

    map = new google.maps.Map(document.getElementById("map_canvas_region"), {
      zoom: 14,
      center: uluru,
    });
//-------------------------------tampilkan marker jika edit----------------------------
    if(posisi!="")
    {
  	  posisi=posisi.split(";");
  	  for(var x=0;x<posisi.length;x++)
  	  {
  		  posisi[x]=posisi[x].replace("(","");
  		  posisi[x]=posisi[x].replace(")","");
  		  addPoint2(posisi[x]);
  	  }
    }
//--------------------------------------------------------------------------------------    
    poly = new google.maps.Polygon({
      strokeWeight: 3,
      fillColor: '#5555FF'
    });
    poly.setMap(map);
    poly.setPaths(new google.maps.MVCArray([path]));

    google.maps.event.addListener(map, 'rightclick', addPoint);

  function addPoint(event) {
    path.insertAt(path.length, event.latLng);

    var marker = new google.maps.Marker({
      position: event.latLng,
      map: map,
      id: path.length,
      draggable: true
    });
    markers.push(marker);
    marker.setTitle("#" + path.length);
	$("#div_input").html($("#div_input").html()+"<input type='hidden' id='txt_posisi_"+path.length+"' name='txt_posisi[]' value='"+event.latLng+"'>");

    google.maps.event.addListener(marker, 'click', function() {
      marker.setMap(null);
      for (var i = 0, I = markers.length; i < I && markers[i] != marker; ++i);
      markers.splice(i, 1);
      path.removeAt(i);
	  $("#txt_posisi_"+marker.id).remove();
      }
    );

    google.maps.event.addListener(marker, 'dragend', function() {
      for (var i = 0, I = markers.length; i < I && markers[i] != marker; ++i);
      path.setAt(i, marker.getPosition());
	  $("#txt_posisi_"+marker.id).val(marker.getPosition());
      }
    );
  }
  
  function addPoint2(latlng) {
	  	latlng=latlng.split(",");
	  	latlng=new google.maps.LatLng(latlng[0],latlng[1]);
	  	path.insertAt(path.length, latlng);

	    var marker = new google.maps.Marker({
	      position: latlng,
	      map: map,
	      id: path.length,
	      draggable: true
	    });
	    markers.push(marker);
	    marker.setTitle("#" + path.length);
		$("#div_input").html($("#div_input").html()+"<input type='text' id='txt_posisi_"+path.length+"' name='txt_posisi[]' value='"+latlng+"'>");

	    google.maps.event.addListener(marker, 'click', function() {
	      marker.setMap(null);
	      for (var i = 0, I = markers.length; i < I && markers[i] != marker; ++i);
	      markers.splice(i, 1);
	      path.removeAt(i);
		  $("#txt_posisi_"+marker.id).remove();
	      }
	    );

	    google.maps.event.addListener(marker, 'dragend', function() {
	      for (var i = 0, I = markers.length; i < I && markers[i] != marker; ++i);
	      path.setAt(i, marker.getPosition());
		  $("#txt_posisi_"+marker.id).val(marker.getPosition());
	      }
	    );
	  }