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
			
			<td>
				<?php  if (count($_rate)>0){ ?>
					<a data-dropdown="drop_<?=$array['id']?>" aria-controls="drop1" data-options="is_hover:true; hover_timeout:5000" aria-expanded="false"><?=number_format($_rate['amount'],2,'.',',')?></a>
					<ul id="drop_<?=$array['id']?>" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
					  <li><a href="<?=$config['not_click']?>" onclick="$('#rates-reveal').foundation('reveal', 'open', '<?=$config['domain']?>/rates/index/<?=$array['id']?>');" >Edit</a></li>
					  <li><a href="<?=$config['not_click']?>">Delete</a></li>
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
<script>
	$(document).foundation();
</script>