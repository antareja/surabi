<script src="<?php echo base_url() ?>assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(function($) {
	  var geocoder = new google.maps.Geocoder();
	  var point = new google.maps.LatLng(<?php echo $lat?>, <?php echo $lng?>);
		geocoder.geocode({'latLng': point}, function(results, status) 
		{
			if (status == google.maps.GeocoderStatus.OK) 
			{
				if (results[0]) 
				{
					$( "div" ).html(results[0]["address_components"][0].short_name);
					$.post('<?php echo site_url()?>packet/get_loc',{

						}).done(function(data) {
					});
				} 
				else 
				{
					$( ".location" ).append("Unknown");
				}
			} 
	  });
	});
</script>
<div></div>