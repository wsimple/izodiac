<div class="row">
	<article>

	<div class="row">&nbsp;</div>

	<div class="row">

	<div class="large-4 columns">
			<h5><?=$language->line('support_title_info')?></h5>
			<div class="large-12 columns panel radius">
				<ul class="contact-info-list">
					<li><img src="<?=base_url()?>/img/building20x20.png" width="15" height="15" alt="">&nbsp;&nbsp;<?=formatString($companyInfo->name)?></li>
					<li><img src="<?=base_url()?>/img/phone20x20.png" width="15" height="15" alt="">&nbsp;&nbsp;&nbsp;<?=$companyInfo->tlf?></li>
					<li><img src="<?=base_url()?>/img/mail20x20.png" width="15" height="15" alt="">&nbsp;&nbsp;&nbsp;<a href="mailto:<?=$companyInfo->email?>"><?=$companyInfo->email?></a></li>
					<li><img src="<?=base_url()?>/img/address20x20.png" width="15" height="15" alt="">&nbsp;&nbsp;&nbsp;<?=$companyInfo->address.'&nbsp;'.formatString($companyInfo->city).'.&nbsp;'.formatString($companyInfo->state).',&nbsp;'.formatString($companyInfo->country)?></li>
				</ul>
			</div>
		</div>

		<div class="large-8 columns">
			<h5><?=$language->line('support_title_form')?></h5>
			<form data-abide name="frmContact" id="frmContact" action="<?=$config['domain']?>/contact/sent" method="POST">
				<div class="large-12 columns panel radius">
					<div class="row">
						<div class="large-6 columns">
							<label><?=$language->line('support_name')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactName" id="txtContactName" pattern="alpha_numeric" placeholder="<?=$language->line('support_name_holder')?>" required />
							</label>
							<small class="error radius"><?=$language->line('support_name_lblerror')?>.</small>
						</div>
						<div class="large-6 columns">
							<label><?=$language->line('support_last_name')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactLastName" id="txtContactLastName" pattern="alpha_numeric" placeholder="<?=$language->line('support_last_name_holder')?>" required />
							</label>
							<small class="error"><?=$language->line('support_last_name_lblerror')?>.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_subject')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactSubject" id="txtContactSubject" pattern="" placeholder="<?=$language->line('support_subject_holder')?>" required />
							</label>
							<small class="error"><?=$language->line('support_subject_lblerror')?>.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_email')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="email" name="txtContactEmail" id="txtContactEmail" pattern="email" placeholder="<?=$language->line('support_email_holder')?>" required />
							</label>
							<small class="error"><?=$language->line('support_email_lblerror')?>.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-7 columns">
							<label><?=$language->line('support_phone_number')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<input type="text" name="txtContactTlf" id="txtContactTlf" placeholder="<?=$language->line('support_phone_number_holder')?>" required />
							</label>
							<small class="error"><?=$language->line('support_phone_number_lblerror')?>.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<label><?=$language->line('support_message')?>&nbsp;<small>(<?=$language->line('general_required')?>)</small>
								<textarea name="txtContactMsg" id="txtContactMsg" placeholder="<?=$language->line('support_message_holder')?>" required></textarea>
							</label>
							<small class="error"><?=$language->line('support_message_lblerror')?>.</small>
						</div>
					</div>

					<div class="row">&nbsp;</div>

					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnContactSave" name="btnContactSave" class="button radius tiny">&nbsp;&nbsp;&nbsp;&nbsp;<?=$language->line('general_send')?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
						<div class="large-2 columns">
							&nbsp;
						</div>
						<div class="large-6 columns">
							<div id="contact-reveal" class="reveal-modal small" data-reveal>
								<h2></h2>
								<h5></h5>
								<a class="close-reveal-modal">&#215;</a>
							</div>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
		
	</article>
</div>

<!-- News -->
<div class="row">
	&nbsp;
</div>

<div class="row radius panel white_panel">
	<div clss="large-9 columns">
		<h4 class="color_green"><?=$language->line('general_more_news')?></h4>
		<h5>
			<small><?=$language->line('general_blog_small_summary')?></small>
		</h5>
		<hr>
		<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
		  <?php 
		    foreach ($blog_summary as $array){
		      $url_post = $config['domain'].'/content/body/'.$array['id'];
		      $title_post = substr(formatString($array['title']),0,100);
		  ?>
		      <li>
		      
				<div class="summary_pic">
		        	<img src="<?=(file_exists($array['image']) ? base_url().$array['image'] : base_url().'img/no-pic.gif')?>" alt="<?=formatString($array['title'])?>">
				</div>

		        <h6><?=anchor($url_post, $title_post, 'title="'.$language->line('general_go_to').': '.$title_post.'"')?></h6>

		        <div class="post-summary paragraph">
		          <?=substr($array['summary'],0,200)?>&nbsp;...
		          <br>
		          <?=anchor($url_post,$language->line('general_more_info'),'title="'.$language->line('general_go_to').': '.$title_post.'"')?>
		        </div>

		      </li>
		  <?php } ?>
		</ul>
	</div>
</div>

