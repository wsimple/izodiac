<?php
	$_content = array(
		'title' => ($idiom=='_english') ? $content->title_english : $content->title,
		'summary' => ($idiom=='_english') ? $content->summary_english : $content->summary,
		'body' => ($idiom=='_english') ? $content->body_english :$content->body
	);
?>
<div class="row">
	<article>
		<div class="row">
			&nbsp;
		</div>

		<div class="row">
			<div class="large-12 columns" class="justify">
				<p>
					<img class="content_pic" src="<?=(file_exists($content->image)?base_url().$content->image:base_url().'img/no-pic.gif')?>" alt="<?=$_content['title']?>">
					<?php echo $_content['summary']; ?>
				</p>

				<p>
					<?php echo $_content['body']; ?>
				</p>
			</div>	
		</div>

		<?php if ($is_post){ //if the content is a blog post ?>
		<div class="row">
			<div class="large-12 columns">
			<h3><small class="section-title"><?=$language->line('general_related_post')?></small></h3>
			<ul class="suggest-list">
				<?php 
					foreach ($more_posts as $array){
						$url_post = $config['domain'].'/content/body/'.str_replace(' ','-',formatString(convert_accented_characters($array['title'.$idiom]),3));
      					$title_post = formatString($array['title'.$idiom]); 
				?>
						<li>
							<img src="<?=base_url()?>img/arrow.png" alt="<?=$array['title']?>" width="24" height="24">&nbsp;
							<?=anchor($url_post,$title_post,'title="'.$language->line('general_go_to').': '.$title_post.'"')?>
						</li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>

		<div class="row">
			&nbsp;
		</div>
		
		<div class="row">
			<div class="large-12 columns">
				<h4 class="color_green"><?=$language->line('general_comments')?></h4>
				<hr>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<div class="large-12 columns"><?=comments('izodiac')?></div>
			</div>
		</div>
	</article>
</div>


<!-- News -->
<div class="row">
	&nbsp;
</div>

<div class="row radius white_panel">
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

