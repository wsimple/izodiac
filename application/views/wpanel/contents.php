<?php
	if (empty($wp_user) && $wp_user['id']==''){
		redirect($config['domain'].'/wpanel');
		die();
		exit();
	}
	
	$cboLanguage = $this->uri->segment(4)!='' ? $this->uri->segment(4) : '1';

	if ($cboLanguage==1){ //English
		$_title = isset($info->title_english) ? $info->title_english : '';
		$_summary = isset($info->summary_english) ? $info->summary_english : '';
		$_body = isset($info->body_english) ? $info->body_english : '';
	}else{
		$_title = isset($info->title) ? $info->title : '';
		$_summary = isset($info->summary) ? $info->summary : '';
		$_body = isset($info->body) ? $info->body : '';
	}
?>

<div class="row">
	&nbsp;
</div>

<div class="row panel radius">
	<article>
		<div class="row">
			<form data-abide name="frmSections" id="frmSections" action="<?=$config['domain']?>/content/<?=(isset($new)?'insert':'update')?>" method="POST" enctype="multipart/form-data">
				<div class="large-12 columns">

					<div class="row">
						<div class="large-3 columns">
							<label>Language:&nbsp;<small>(Requiered)</small>
								<select name="cboLanguage" id="cboLanguage" <?php if (isset($id_content)){ ?> onchange="if (this.value!='') redirect('<?=$config['domain']?>/content/manage/<?=$id_content?>/'+this.value); " <?php } ?> required >
									<option value="1" <?php if ($cboLanguage=='1') echo 'selected'; ?> >English</option>
									<option value="2" <?php if ($cboLanguage=='2') echo 'selected'; ?> >Spanish</option>
								</select>
							</label>
							<small class="error">Language is requiered.</small>
						</div>
					</div>

					<div class="row">
						<div class="large-12 columns">
							<label>Title&nbsp;<small>(Requiered)</small>
								<input type="text" name="txtTitulo" id="txtTitulo" value="<?=isset($_title)?$_title:''?>" required />
							</label>
							<small class="error radius">Titulo es Requiered.</small>
						</div>
					</div>

					<?php if (isset($info->image)&&file_exists($info->image)){  ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Image:&nbsp;<small>(Requiered)</small></label>
							</div>
						</div>	

						<div class="row">
							<div class="large-1 columns">
								<img src="<?=base_url().$info->image?>" width="24" height="24" alt="">
							</div>
							<div class="large-11 columns">
								<label>
									<input type="file" name="image" id="image" />
								</label>
								<small class="error radius">Image is Requiered.</small>
							</div>
						</div>
					<?php }else{ ?>
						<div class="row">
							<div class="large-12 columns">
								<label>Image:&nbsp;<small>(Requiered)</small>
									<input type="file" name="image" id="image" required />
								</label>
								<small class="error radius">Image is Requiered.</small>
							</div>
						</div>
					<?php } ?>
					
					<div class="row">
						<div class="large-12 columns">
							<label>Summary:&nbsp;<small>(Requiered)</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<textarea name="summary" id="summary" rows="10" cols="80"><?=isset($_summary)?$_summary:''?></textarea>
						</div>
					</div>
					<div class="row">&nbsp;</div>
					<div class="row">
						<div class="large-12 columns">
							<label>Body:&nbsp;<small>(Requiered)</label>
						</div>
					</div>
					<div class="row">
						<div class="large-12 columns">
							<textarea name="body" id="body" rows="10" cols="80"><?=isset($_body)?$_body:''?></textarea>
						</div>
					</div>

					<div class="row">&nbsp;</div>

					<div class="row">
						<div class="large-4 columns">
							<label>Author:&nbsp;<small>(Requiered)</small>
								<input type="text" name="txtAuthor" id="txtAuthor" value="<?=isset($info->author)?$info->author:'izodiac'?>" required >
							</label>
							<small class="error">Author is requiered.</small>
						</div>
						<div class="large-8 columns">
							&nbsp;
						</div>
					</div>	

					<div class="row">
						<div class="large-3 columns">
							<label>Status:&nbsp;<small>(Requiered)</small>
								<select name="cboStatus" id="cboStatus" required >
									<option value="1" <?php if (isset($info->id_status) && $info->id_status=='1') echo 'selected'; ?> >Enable</option>
									<option value="2" <?php if (isset($info->id_status) && $info->id_status=='2') echo 'selected'; ?> >Disable</option>
								</select>
							</label>
							<small class="error">Status is requiered.</small>
						</div>
						<div class="large-9 columns">
							<input type="hidden" name="id" id="id" value="<?=isset($info->id)?$info->id:''?>" >
							<input type="hidden" name="old_icon" id="old_icon" value="<?=isset($info->icon)?$info->icon:''?>" >
							<input type="hidden" name="old_image" id="old_image" value="<?=isset($info->image)?$info->image:''?>" >
						</div>
					</div>

					<div class="row">&nbsp;</div>
					
					<div class="row">
						<div class="large-4 columns">
							<button type="button" id="btnSectionsSave" name="btnSectionsSave" class="button radius tiny success">&nbsp;&nbsp;&nbsp;&nbsp;Save Changes&nbsp;&nbsp;&nbsp;&nbsp;</button>
						</div>
						<div class="large-2 columns">
							&nbsp;
							<input type="hidden" id="id_type" name="id_type" value="<?=isset($id_content)?$info->id_type:$id_type?>">
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
	</article>
</div>

<div class="row">
	&nbsp;
</div>
