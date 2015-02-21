$( "#cboListContentFilter" ).change(function() {

	$('#out_ajax').html('Loading ...');

	$.ajax({
		url: $(this).attr("domain")+'/content/ajax_grid/'+$(this).val(),
		type:  'POST',
		dataType: 'HTML',
		success:  function (data) {
			$('#out_ajax').html(data);
		}
	});

});