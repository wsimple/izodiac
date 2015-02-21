<?php
	if (empty($wp_user) && $wp_user['id']==''){
		redirect($config['domain'].'/wpanel');
		die();
		exit();
	}
?>
<div class="row">
	&nbsp;
</div>

<div class="row">
	<article>
		<div class="row ">
			<div class="large-12 columns ">
				<h5><small>Here you will be able to manage your web page contents.</small></h5>
			</div>
		</div>
		
		<div class="row">
			<div class="large-12 columns">
				<label>
					<a href="<?=$config['not_click']?>" class="button split radius tiny success">&nbsp;&nbsp;&nbsp;&nbsp;Create a new content&nbsp;&nbsp;&nbsp;&nbsp; <span data-dropdown="drop"></span></a><br>
					<ul id="drop" class="f-dropdown" data-dropdown-content>
						<?php foreach ($list_type as $array){ ?>
					  		<li><a href="<?=$config['domain']?>/content/add/<?=$array['id']?>"><?=formatString($array['name'])?></a></li>
					  	<?php } ?>	
					</ul>
				</label>
			</div>
		</div>

		<div class="row">
			<div class="large-8 columns">
				<label>Content type filter:&nbsp;
					<select name="cboListContentFilter" id="cboListContentFilter" domain = "<?=$config['domain']?>" >
						<option value="" selected >---</option>
						<?php foreach ($list_type as $array){ ?>
						<option value="<?=$array['id']?>"><?=formatString($array['name'])?></option>
						<?php } ?>
					</select>
				</label>
			</div>
			<div class="large-4 columns">&nbsp;</div>
		</div>

		<div class="row">
			<div class="large-12 columns" id="out_ajax">
				<table style="width: 100%">
					<thead>
						<tr>
							<th>Language</th>
							<th>Title</th>
							<th>Title English</th>
							<th>Update Date</th>
							<th>Author</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contents_list as $array){ ?>
						<tr id="tr_<?=$array['id']?>">
							<td>
								<?php
									if (trim($array['title'])!='' && trim($array['title_english'])!=''){
										echo 'English/Spanish';
									}elseif (trim($array['title'])!='' && trim($array['title_english'])=='') {
										echo 'Spanish';
									}elseif (trim($array['title'])=='' && trim($array['title_english'])!='') {
										echo 'English';
									} 
								?>
							</td>
							<td><?=$array['title']!=''?formatString($array['title']):'<strong style="color: #E36569">Pending</strong>'?></td>
							<td><?=$array['title_english']!=''?formatString($array['title_english']):'<strong style="color: #E36569">Pending</strong>'?></td>
							<td><?=formatDate($array['date'])?></td>
							<td><?=$array['author']?></td>
							<td>
								<img src="<?=base_url()?>img/edit.png" alt="edit" class="cursor_pointer" onclick="redirect('<?=$config['domain']?>/content/manage/<?=$array['id']?>');">
								<?php if ($array['id']!='1'){ ?>
								<img src="<?=base_url()?>img/trash.png" alt="trash" class="cursor_pointer" onclick="deleteRecord('<?=$config['domain']?>/content/delete/<?=$array['id']?>','#tr_<?=$array['id']?>', '<?=formatString($array['title'])?>')">
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="large-12 columns">
				<div id="confirm-reveal" class="reveal-modal tiny" data-reveal>
					<h2>Delete Content</h2>
					<h5>Are you sure to delete:  </h5>
					<p>&nbsp;</p>
					<p>
						<a href="<?=$config['not_click']?>" id="delete" class="button radius small alert">Yes, I Agree</a>
					</p>
					<a class="close-reveal-modal">&#215;</a>
				</div>
			</div>
		</div>
	</article>
</div>