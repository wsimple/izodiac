$('#btnWpLogin').click(function(event) {
    $(this).attr({disabled: 'disabled'});
    $(this).html('Sending ...');
    $('#frmWpLogin').submit();
});

$('#frmWpLogin').ajaxForm({
    dataType: 'JSON',
    success : function(data){
        if (data['title']=='ok' && data['message']=='ok'){
            redir(data['url']);
        }else{ 
            $('#contact-reveal h2').html(data['title']);
            $('#contact-reveal h5').append(data['message']);
            $('#contact-reveal').foundation('reveal', 'open');
            $('#btnWpLogin').removeAttr('disabled');
            $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;'+data['label_button']+'&nbsp;&nbsp;&nbsp;&nbsp;');
            $('#txtLogin').focus();
            $('#frmWpLogin').trigger("reset");
        }
    }
});

$('#frmWpLogin').on('invalid', function(event) {
    $('#btnWpLogin').removeAttr('disabled');
    $('#btnWpLogin').html('&nbsp;&nbsp;&nbsp;&nbsp;Enviar&nbsp;&nbsp;&nbsp;&nbsp;');
});

$('#close_message').click(function(event) {
    $('#contact-reveal-signup h2').html('');
    $('#contact-reveal-signup h5').html('');
});