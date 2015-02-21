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