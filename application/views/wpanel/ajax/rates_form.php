<a class="close-reveal-modal">&#215;</a>
<h5 class="title_dialogs"><span style="color: #000"><?=formatString($service->title_english!=''?$service->title_english:$service->title)?></span>&nbsp;>&nbsp;Rate</h5>
<form data-abide name="frmRates" id="frmRates" action="<?=$config['domain']?>/rates/sent" method="POST">
	
	<div class="row panel radius">
		<div class="large-6 columns">
			<label>
				($) Rate:&nbsp;<small>(Required)</small>
				<input type="text" name="txtRate" id="txtRate" placeholder="Amount" value="<?=isset($rate->amount)?$rate->amount:''?>" required />
			</label>
			<small class="error radius">Rate is required</small>
		</div>
		<div class="large-12 columns">
			<label>What it includes&nbsp;<small>(Required)</small>
				<textarea name="txtInclude" id="txtInclude" placeholder="what this rate includes" required><?=isset($rate->included)?$rate->included:''?></textarea>
			</label>
			<small class="error">Description is required</small>
		</div>
	</div>

	<div class="row">
		<div id="out_message" data-alert class="alert-box success radius" style="display: none;" tabindex="0" aria-live="assertive" role="dialogalert"></div>
	</div>

	<div class="row">
		<input type="hidden" id="serv" name="serv" value="<?=$service->id?>">
		<button type="button" id="btnSaveRate" class="button tiny right radius">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save Rate&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
	</div>
</form>

<script src="<?=base_url()?>js/vendor/jquery.min.js"></script>

<script src="<?=base_url()?>js/foundation.min.js"></script>

<script src="<?=base_url()?>js/jquery.form.min.js"></script>

<script src="<?=base_url()?>js/numeral.js"></script>

<script src="<?=base_url()?>js/functions.js"></script>

<script>
	$(document).foundation();
	
	$('#txtRate').val(number_format($('#txtRate').val(),1));

	$("#txtRate").blur(function() {
	  $(this).val(number_format($(this).val(),1));
	});
	
	$('#btnSaveRate').click(function(event) {
		$(this).attr({disabled: 'disabled'});
		$(this).html('Sending ...');
		$('#frmRates').submit();
	});

	$('#frmRates').ajaxForm({
	    dataType: 'JSON',
	    success : function(data) { 
	        if (data['out']=='ok'){
	        	$('#out_message').html(data['message']);
	        	$("#out_message").fadeIn();
				$('#btnSaveRate').html('Wait ...');
	            setTimeout(function(){
	                $('#confirm-reveal').foundation('reveal', 'close');
	                redirect(data['url']);
	            }, 2000);
	        }
	    }
	});
</script>