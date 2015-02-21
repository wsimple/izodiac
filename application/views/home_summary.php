<div class="row">
	<div class="large-12 columns" role="content">
		<?php 
			$i=1;
		    foreach ($blog_summary as $array){
		      $url_post = $config['domain'].'/content/body/'.$array['id'];
		      $title_post = substr(formatString($array['title'.$idiom]),0,100);
		?>
			<article>
				<h3><?=anchor($url_post, $title_post, 'title="'.$language->line('general_go_to').': '.$title_post.'"')?></h3>
				<h6><small>Written by <a href="http://tagbum.com/Izodiac"><?=$array['author']?></a><?=' '.$language->line('general_article_on').' '.formatDate($array['date'])?></h6></small>
				<div class="row">
					<div class="large-6 columns">
						<p><?=substr($array['summary'],0,520)?>.</p>
					</div>
					<div class="large-6 columns">
						<img src="<?=(file_exists($array['image']) ? base_url().$array['image'] : base_url().'img/no-pic.gif')?>" class="radius" alt="<?=$title_post?>">
					</div>
				</div>
				<p>
					<?=postLimit($array['body'], 200)?>
					&nbsp;...
					<small>[&nbsp;<?=anchor($url_post,$language->line('general_more_info'),'title="'.$language->line('general_go_to').': '.$title_post.'"')?>&nbsp;]</small>
				</p>
			</article>
		<?php
				if ($i++==3) 
					break;
				else
					echo '<hr>';
			} 
		?>
	</div>
</div>