</div>
<aside class="large-2 columns side-bar-list" id="middle">
	<?php if (isset($wp_user) && $wp_user['id']!=''){ ?>
		<h5>Manage</h5>
		<ul class="side-nav">
			<?php foreach ($wpanelMenu as $menu){ ?>	
		    <li>
		    	<a href="<?=$config['domain'].'/content/body/'.$menu['id']?>">
		    		<img src="<?=base_url()?>/img/arrow.png" alt="<?=$menu['title']?>" width="15" height="15">&nbsp;<?=formatString($menu['title'.$idiom])?>
		    	</a>
		    	<hr>
		    </li>
			<?php } ?>
			<li>
		    	<a href="<?=$config['domain'].'/wpanel/logout/'?>">
		    		<img src="<?=base_url()?>/img/arrow.png" alt="logout" width="15" height="15">&nbsp;<?=$language->line('header_logOut')?>
		    	</a>
		    </li>
		</ul>
	<?php } ?>

	<!-- Blog -->
	<h5><?=$language->line('general_browse_label')?></h5>
	<ul class="side-nav">
	  <?php foreach ($blogMenu as $array){ 
	  		$title_post = (trim($array['title'.$idiom])!='') ? substr(formatString($array['title'.$idiom]),0,100) : substr(formatString($array['title']),0,100);
	  	?>
	    <li>
			<a href="<?=$config['domain'].'/content/body/'.$array['id']?>">
			<img src="<?=base_url()?>/img/arrow.png" alt="<?=$title_post?>" width="15" height="15">&nbsp;<?=$title_post?>
	      	</a>
	    </li>
	  <?php } ?>
	</ul>

	<!-- Newsletter -->
	<h5><?=$language->line('sideBar_newsletters')?></h5>
	<small><?=$language->line('newsletters_titleForm')?>.</small>
	<form data-abide name="frmNewsletters" id="frmNewsletters" action="<?=$config['domain']?>/newsletters/sent" method="POST">
		<div class="row">&nbsp;</div>
		<div class="row">
			<div class="large-12 columns">
				<label>
					<input type="email" id="txtNewslettersName" name="txtNewslettersName" placeholder="<?=$language->line('newsletters_label01')?>" pattern="alpha" required />
				</label>
				<small class="error radius"><?=$language->line('newsletters_errorLabel01')?>.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<label>
					<input type="text" id="txtNewslettersEmail" name="txtNewslettersEmail" placeholder="<?=$language->line('newsletters_label02')?>" pattern="email" required />
				</label>
				<small class="error radius"><?=$language->line('newsletters_errorLabel02')?>.</small>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<a id="btnSaveNewsletters" name="btnSaveNewsletters" class="button radius tiny"><?=$language->line('newsletters_btnSuscri')?></a>
			</div>
			<div id="newsletters-reveal" class="reveal-modal small" data-reveal>
				<h2></h2>
				<h5></h5>
				<a class="close-reveal-modal">&#215;</a>
			</div>
		</div>
	</form>

	<!-- Facebook -->
	<h5><?=$language->line('sideBar_facebo')?></h5>
	<div class="facebook_box">
	

	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fmyizodiac&amp;width=180&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:258px;" allowTransparency="true"></iframe>


	</div>	
	<!-- twitter -->
	<h5><?=$language->line('sideBar_tweets')?></h5>
<a class="twitter-timeline" href="https://twitter.com/myizodiac" data-widget-id="567477945006948353">Tweets by @myizodiac</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</aside>
</div>

