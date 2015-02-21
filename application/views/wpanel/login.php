<div class="row">&nbsp;</div>

<div class="row panel radius" id="login">
	<div clss="large-9 columns">
		<article>
			<h4><?=$language->line('login_user_title')?></h4>
			<h5>
				<small>You should provide your login information to continue</small>
			</h5>
			<hr>
			<div class="row">
				<form data-abide name="frmWpLogin" id="frmWpLogin" action="<?=$config['domain']?>/wpanel/login" method="POST">
					<div class="row">
						<div class="large-12 columns">
							<div class="large-4 columns">
								<label><?=$language->line('login_signup_frm_email')?>:&nbsp;<small>(<?=$language->line('general_required')?>)</small>
									<input type="text" name="txtLogin" id="txtLogin" pattern="email" value="" required />
								</label>
								<small class="error radius"><?=$language->line('login_signup_frm_email_error')?>.</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<div class="large-4 columns">
								<label><?=$language->line('login_pass_label')?>:&nbsp;<small>(<?=$language->line('general_required')?>)</small>
									<input type="text" name="txtPass" id="txtPass" value="" required />
								</label>
								<small class="error radius"><?=$language->line('login_pass_error')?>.</small>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="large-6 columns">
							<div class="large-6 columns">
								<button type="button" id="btnWpLogin" name="btnWpLogin" class="button radius tiny"><?=$language->line('login_button_label')?></button>
							</div>
						</div>
						<div class="large-6 columns">
							<div id="contact-reveal" class="reveal-modal small" data-reveal>
								<h2></h2>
								<h5></h5>
								<a class="close-reveal-modal">&#215;</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</article>
	</div>
</div>