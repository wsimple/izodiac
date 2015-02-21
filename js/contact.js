$("#map").addClass("contact-map");

$("#map").gMap({
    markers: [{
        address: "Los Angeles, CA",
        popup: true,
        scrollwheel: true,
        infowindowanchor: [8, 8]
    }],
    zoom: 7,
});

$('#btnContactSave').click(function(event) {
    $(this).attr({disabled: 'disabled'});
    $(this).html('Enviando ...');
    $('#frmContact').submit();
});

$('#frmContact').ajaxForm({
    dataType: 'JSON',
    success : function(data) { 
        $('#contact-reveal h2').html(data['title']);
        $('#contact-reveal h5').append(data['message']);
        $('#contact-reveal').foundation('reveal', 'open');
        $('#btnContactSave').removeAttr('disabled');
        $('#btnContactSave').html('Enviar');
        $('#frmContact').trigger("reset");
        if (data['out']=='ok'){
            setTimeout(function(){
                redirect(data['url']);
            }, 3000);
        }
    }
});

$('#frmContact').on('invalid', function(event) {
    $('#btnContactSave').removeAttr('disabled');
    $('#btnContactSave').html('Enviar');
});