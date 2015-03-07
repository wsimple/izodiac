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
<article>
	<div class="row">
	<div class="large-12 columns">
		
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
							<th>Update Date</th>
							<th>Language</th>
							<th>Title</th>
							<th>Title English</th>
							<th>Type</th>
							<th>Rate</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($contents_list as $array){ 
								$_rate = has_rate($array['id'], $rates);
								$_type = get_content_type($array['id_type']);
						?>
						<tr id="tr_<?=$array['id']?>">
							
							<td><?=formatDate($array['date'])?></td>

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
							
							<td><strong><?=formatString($_type[0]['name'])?></strong></td>
							
							<td <?=isset($_rate['id'])?'id="td_rate_'.$_rate['id'].'"':''?>>
								<?php  if (count($_rate)>0){ ?>
									<a data-dropdown="drop_<?=$array['id']?>" aria-controls="drop1" data-options="is_hover:true; hover_timeout:5000" aria-expanded="false"><?=number_format($_rate['amount'],2,'.',',')?></a>
									<ul id="drop_<?=$array['id']?>" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
									  <li><a href="<?=$config['not_click']?>" onclick="$('#rates-reveal').foundation('reveal', 'open', '<?=$config['domain']?>/rates/index/<?=$array['id']?>');" >Edit</a></li>
									  <li><a href="<?=$config['not_click']?>" onclick="removeRate('<?=$_rate['id']?>');" >Delete</a></li>
									</ul>
								<?php }elseif (in_array($array['id_type'], array('2','4') )){ ?>
									<a href="<?=$config['not_click']?>" onclick="$('#rates-reveal').foundation('reveal', 'open', '<?=$config['domain']?>/rates/index/<?=$array['id']?>');">+ Add Rate</a>
								<?php }else{ echo 'N/A'; } ?>
							</td>

							<td>
								<img src="<?=base_url()?>img/edit.png" alt="edit" class="cursor_pointer" title="Edit" onclick="redirect('<?=$config['domain']?>/content/manage/<?=$array['id']?>');" width="30" height="30">
								<?php if ($array['id']!='1'){ ?>
								<img src="<?=base_url()?>img/delete.png" alt="trash" class="cursor_pointer" title="Delete" onclick="deleteRecord('<?=$config['domain']?>/content/delete/<?=$array['id']?>','#tr_<?=$array['id']?>', '<?=formatString($array['title'])?>')"  width="30" height="30" >
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
				<div id="rates-reveal" class="reveal-modal tiny" data-reveal></div>
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

	</div>
	</div>
</article>