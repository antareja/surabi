    //<![CDATA[
	var filter = ['00'];
	var cek_marker = [];
	var marker_array = [];
	var z=1;
	var markers={};
	var marker="";
	var boundaryPolygon;
	var geocoder = new google.maps.Geocoder();
    var customIcons = {
      icon_mobil00000000000000000000000320: {
        icon: 'http://surabi.dev/assets/uploads/icon_3.png'
      },
      icon_mobil00000000000000000000000521: {
    	icon: 'http://surabi.dev/assets/uploads/icon_5.png'
      },
      icon_mobil00000000000000000000000321: {
      	icon: 'http://surabi.dev/assets/uploads/icon_6.png'
      }
    };
    
    var nama_mobil = {
    	nama_mobil00000000000000000000000320: {
    	   nama: 'Houling'
    	},
    	nama_mobil00000000000000000000000521: {
    	   nama: 'Dump Truck'
    	},
    	nama_mobil00000000000000000000000321: {
    	   nama: 'Car'
    	}
    };
    google.maps.Polygon.prototype.Contains = function (point) {
        // ray casting alogrithm http://rosettacode.org/wiki/Ray-casting_algorithm
        var crossings = 0,
        path = this.getPath();

        // for each edge
        for (var i = 0; i < path.getLength(); i++) {
            var a = path.getAt(i),
            j = i + 1;
            if (j >= path.getLength()) {
                j = 0;
            }
            var b = path.getAt(j);
            if (rayCrossesSegment(point, a, b)) {
                crossings++;
            }
        }

        // odd number of crossings?
        return (crossings % 2 == 1);

        function rayCrossesSegment(point, a, b) {
            var px = point.lng(),
            py = point.lat(),
            ax = a.lng(),
            ay = a.lat(),
            bx = b.lng(),
            by = b.lat();
            if (ay > by) {
                ax = b.lng();
                ay = b.lat();
                bx = a.lng();
                by = a.lat();
            }
            if (py == ay || py == by) py += 0.00000001;
            if ((py > by || py < ay) || (px > Math.max(ax, bx))) return false;
            if (px < Math.min(ax, bx)) return true;

            var red = (ax != bx) ? ((by - ay) / (bx - ax)) : Infinity;
            var blue = (ax != px) ? ((py - ay) / (px - ax)) : Infinity;
            return (blue >= red);
        }
    };

    var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-6.915499,107.594301),
        zoom: 13,
        scaleControl:true,
        mapTypeId: 'roadmap'
      });
    
    
    var boundarydata = [
        new google.maps.LatLng(-6.936800354144058, 107.60258674621582),
		new google.maps.LatLng(-6.9389091089626485, 107.60250091552734),
		new google.maps.LatLng(-6.937971885764778, 107.60687828063965),
		new google.maps.LatLng(-6.936672550518212, 107.60687828063965)
	                  ];


	                        boundaryPolygon = new google.maps.Polygon({
	                            path: boundarydata,
	                            strokeColor: "#0000FF",
	                            strokeOpacity: 0.8,
	                            strokeWeight: 2,
	                            fillColor: 'Red',
	                            fillOpacity: 0.4

	                        });

      boundaryPolygon.setMap(map);
      var infoWindow = new google.maps.InfoWindow;
	
	// create a new websocket
        var socket = io.connect('http://192.168.12.250:8000');
        // on message received we print all the data inside the #container div
        socket.on('notification', function (data) {
			var data_map=data.data;
			
			var name = data_map["system"];
			var lat = data_map["lat"];
			var lng = data_map["lng"];
			
			var marker_id='marker_' + data_map["mobile"];
			var ada=jQuery.inArray( name, filter );
			if(ada>=0)
			{
			var point = new google.maps.LatLng(lat, lng);
			geocoder.geocode({'latLng': point}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					if (results[0]) 
					{
						html2="<b> Location : Near "+results[0]["address_components"][0].short_name+"</b><br>";
					} 
					else 
					{
						html2="<b> Location : Unknow</b> <br/>";
					}
				} 
				else 
				{
					html2="<b> Location : Unknow</b> <br/>";
				}
			var html = "<div id='infowindow' style='height:100px;width:300px'><b> Name : "+nama_mobil["nama_mobil"+data_map["mobile"]].nama+"</b> <br/>";
			if(data_map["packet_number"]=="100")
			{
				html2+="<b> Position : " + point + "</b> <br/><b> Time : " + data_map["tanggal"] + " " + data_map["jam"] + "</b> <br/><b> Speed : " + data_map["velocity"] + "km/h</b> <br/>";
			}
			if(data_map["packet_number"]=="104")
			{
				html2+="<b> Position : " + point + "</b> <br/><b> Time : " + data_map["tanggal"] + " " + data_map["jam"] + "</b> <br/><b> Speed : " + data_map["velocity"] + " &nbsp;km/h</b> <br/>";
			}
			html+=html2+"</div>";
			var icon = customIcons["icon_mobil"+data_map["mobile"]] || {};
			if(jQuery.inArray( marker_id, cek_marker )<0)
			{
				marker = new google.maps.Marker({
				map: map,
				position: point,
				id: marker_id,
				icon: icon.icon
				});
				cek_marker.push(marker_id);
				markers[marker_id] = marker;
				bindInfoWindow(marker, map, infoWindow, html,marker_id);
				marker_array[marker_id]=marker;
			}
			else
			{
				marker_array[marker_id].setMap(null);
				marker = new google.maps.Marker({
				map: map,
				position: point,
				id: marker_id,
				icon: icon.icon
				});
				cek_marker.push(marker_id);
				markers[marker_id] = marker;
				bindInfoWindow(marker, map, infoWindow, html,marker_id);
				marker_array[marker_id]=marker;
			}
			//------------------------------polygon---------------------------------------
			                       
			if (boundaryPolygon.Contains(point)) {
				alert("Sampai");
			} 
			
		  });
		  }
      });
	
	function bindInfoWindow(marker, map, infoWindow, html,marker_id) {
      google.maps.event.addListener(marker, 'mouseover', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }
	
    function doNothing() {}
	
	function add_filter(isi)
	{
		
		var ada=jQuery.inArray( isi, filter );
		if(ada<0)filter.push(isi);
	}
	
	function remove_filter(isi)
	{
		filter = jQuery.grep(filter, function(value) {
		return value != isi;
		});
		marker_array["marker_"+isi].setMap(null);
	}
	
	google.maps.event.addListener(map, 'mousemove', function(event) {
		var latlong=event.latLng.toString().split(",");
		document.getElementById('txt_lat').innerHTML=latlong[0].substring(1);
		document.getElementById('txt_long').innerHTML=latlong[1].substring(0,latlong[1].length-1);
	});
	
	

	
	
    //]]>

	$('.check').removeAttr('checked');
