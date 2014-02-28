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
	
	$('#date-picker').datepicker({autoclose:true , dateFormat: 'yy-mm-dd',  minDate: getFormattedDate(new Date())}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	$('#date-picker2').datepicker({autoclose:true,  dateFormat: 'yy-mm-dd', minDate: getFormattedDate(new Date())}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
});
function getFormattedDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear().toString().slice(2);
    return year + '-' + month + '-' + day;
}