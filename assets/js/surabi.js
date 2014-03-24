
jQuery(function($) {
	$('#id-input-file-1 , #id-input-file-2').ace_file_input({
		no_file : 'No File ...',
		btn_choose : 'Choose',
		btn_change : 'Change',
		droppable : false,
		onchange : null,
		thumbnail : false
	// | true | large
	// whitelist:'gif|png|jpg|jpeg'
	// blacklist:'exe|php'
	// onchange:''
	//
	});

	var oTable1 = $('#sample-table-2').dataTable({
		"aoColumns" : [ {
			"bSortable" : false
		}, null, null, null, null, null, {
			"bSortable" : false
		} ]
	});

	$('table th input:checkbox').on(
			'click',
			function() {
				var that = this;
				$(this).closest('table').find(
						'tr > td:first-child input:checkbox').each(function() {
					this.checked = that.checked;
					$(this).closest('tr').toggleClass('selected');
				});

			});

	$('[data-rel="tooltip"]').tooltip({
		placement : tooltip_placement
	});
	function tooltip_placement(context, source) {
		var $source = $(source);
		var $parent = $source.closest('table')
		var off1 = $parent.offset();
		var w1 = $parent.width();

		var off2 = $source.offset();
		var w2 = $source.width();

		if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
			return 'right';
		return 'left';
	}

	$('#date-picker').datepicker({
		autoclose : true,
		dateFormat : 'yy-mm-dd',
		minDate : getFormattedDate(new Date())
	}).next().on(ace.click_event, function() {
		$(this).prev().focus();
	});
	$('#date-picker2').datepicker({
		autoclose : true,
		dateFormat : 'yy-mm-dd',
		minDate : getFormattedDate(new Date())
	}).next().on(ace.click_event, function() {
		$(this).prev().focus();
	});
	// $('.cek').removeAttr('checked');
	// $('.cek').prop('checked', true);

	// $('.cek').
	

});



$('.form-user').validate({
	rules : {
		password : {
			minlength : 5
		},
		re_password : {
			equalTo : "#password"
		}
	}
});
// For User Form
$('.btn-user').click(function() {
	$("#form-user").submit();
	// console.log($('.form-user').valid());
});

$('.btn-view').click(function() {
	$("#form-report").submit();
});
$('.btn-pdf').click(function() {
	$("input[name=pdf]").val('pdf');
	$("#form-report").submit();
});
// For Region Alert Form 
$('.btn-region').click(function() {
	var position = [];
	var poly;
	$('input[name^="txt_posisi"]').each(function() {
		poly = $(this).val();
		polygon = poly.replace(",",";");
		position.push(polygon);
		//console.log($(this).val());
	    //alert($(this).val());
	});
	$('#tmp_position').val(position);
	console.log($('#tmp_position').val());
	$("#form-region").submit();
});


function getFormattedDate(date) {
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear().toString().slice(2);
	return year + '-' + month + '-' + day;
}
// $('.cek').click(function () {
// $('.cek').attr('checked','checked');
// //var currentId = $(this).attr('id');
// add_filter(this.id);
// });

// $(document).ready(my_function);
// if want to set default check list
// $(document).ready(function() {
// $('.cek').attr('checked','checked');
// $('.cek').each(function(){
// add_filter(this.id);
// });
// $('.test').each(function(){
// alert(this.id);
// });
// });
function add_marker(isi) {
	isi2 = isi.replace("marker_", "");
	var icon2 = new OpenLayers.Icon(customIcons["icon_mobil_" + isi2].icon);
	var point2 = tampung_posisi[isi].posisi;
	nama_marker[isi].nama = new OpenLayers.Marker(point2, icon2);
	if(popup_marker["popup_marker_"+isi2].popup=="")
	{
		markerClick = function (evt) {
            if (this.popup == null) {
                this.popup = this.createPopup(this.closeBox);
                map.addPopup(this.popup);
                this.popup.show();
            } else {
                this.popup.toggle();
            }
            currentPopup = this.popup;
            OpenLayers.Event.stop(evt);
        };
		var popupClass = AutoSizeAnchored;
		popupContentHTML=generate_popup(last_position["posisi_"+isi2].nama,last_position["posisi_"+isi2].location,last_position["posisi_"+isi2].latitude,last_position["posisi_"+isi2].longitude,last_position["posisi_"+isi2].tanggal,last_position["posisi_"+isi2].jam,last_position["posisi_"+isi2].speed);
		popup_marker["popup_marker_"+isi2].popup = new OpenLayers.Feature(marker_layer, new OpenLayers.LonLat(last_position["posisi_"+isi2].longitude, last_position["posisi_"+isi2].latitude));
		popup_marker["popup_marker_"+isi2].popup.closeBox = true;
        popup_marker["popup_marker_"+isi2].popup.popupClass = popupClass;
        popup_marker["popup_marker_"+isi2].popup.data.popupContentHTML = popupContentHTML;
	}
	nama_marker[isi].nama.events.register("mouseover",
			popup_marker["popup_marker_" + isi2].popup, markerClick);
	cek_marker.push(isi);
	marker_layer.addMarker(nama_marker[isi].nama);
}

function add_filter(isi) {
	var ada = jQuery.inArray(isi, filter);
	if (ada < 0)
		filter.push(isi);
	add_marker(isi);
}

function remove_filter(isi) {
	filter = jQuery.grep(filter, function(value) {
		return value != isi;
	});
	cek_marker = jQuery.grep(cek_marker, function(value) {
		return value != isi;
	});
	marker_layer.removeMarker(nama_marker[isi].nama);
}


$(document).ready(function() {
$('#company_id').change(function() {
	var company = $(this).val();
	$.post('../get_admin', 
		{company_id : company})
			.done(function(data) {
				$('#admin_id').html(data);
	});
});
});

$('#assign').click(function() {
	var boxes = $('input[name=assign]:checked');
	var veh_id = [];
	var user = $('#user_id option:selected').val();
	var fullname = $( "#user_id option:selected" ).text();
	$(boxes).each(function(){
		//alert($(this.id);
		vehicle_id = this.id;
		veh_id.push(vehicle_id);
		$("#vehicle_" + this.id).html(fullname);
		$.post('vehicle_assign', {vehicle : veh_id, user_id : user})
		.done(function(data)  {
			$('#result').html(data);
		});
		console.log(veh_id);
	    //do stuff here with this
	});
	//alert(veh_id);
	//alert(user_id);
});
