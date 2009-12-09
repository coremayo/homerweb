<?php 

	$data['breadcrumb'] = 'Settings &raquo; Home';
	$this->load->view('site_admin/header', $data);
	
	function listFiles($path)
	{
		if($handle = opendir("$path"))
		{
			while (false !== ($file = readdir($handle)))
			{
				if (($file != ".") && ($file != "..") && ($file != ".svn") && !is_dir("$path/$file"))
				{ 
					echo '<option value="'.$file.'">'.$file.'</option>';
				}
			}
		}
	}
?>

<script>
$(document).ready(function(){

	$.farbtastic('#banner_border_colorpicker').linkTo('#banner_border');
	
	$('#banner_border').click(function()
	{
		$('#banner_border_colorpicker').toggle();
	});
	
	$.farbtastic('#banner_text_color_colorpicker').linkTo('#banner_text_color');

	$('#banner_text_color').click(function()
	{
		$('#banner_text_color_colorpicker').toggle();
	});
	
	$.farbtastic('#background_color_colorpicker').linkTo('#background_color');

	$('#background_color').click(function()
	{
		$('#background_color_colorpicker').toggle();
	});
	
	$.farbtastic('#header_color_colorpicker').linkTo('#header_color');

	$('#header_color').click(function()
	{
		$('#header_color_colorpicker').toggle();
	});
	
	$.farbtastic('#header_text_color_colorpicker').linkTo('#header_text_color');

	$('#header_text_color').click(function()
	{
		$('#header_text_color_colorpicker').toggle();
	});
	
	$.farbtastic('#header_border_colorpicker').linkTo('#header_border');

	$('#header_border').click(function()
	{
		$('#header_border_colorpicker').toggle();
	});
	
	$.farbtastic('#module_background_color_colorpicker').linkTo('#module_background_color');

	$('#module_background_color').click(function()
	{
		$('#module_background_color_colorpicker').toggle();
	});
	
	$.farbtastic('#footer_border_colorpicker').linkTo('#footer_border');

	$('#footer_border').click(function()
	{
		$('#footer_border_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_background_color_colorpicker').linkTo('#inactive_tab_background_color');

	$('#inactive_tab_background_color').click(function()
	{
		$('#inactive_tab_background_color_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_border_colorpicker').linkTo('#inactive_tab_border');

	$('#inactive_tab_border').click(function()
	{
		$('#inactive_tab_border_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_text_color_colorpicker').linkTo('#inactive_tab_text_color');

	$('#inactive_tab_text_color').click(function()
	{
		$('#inactive_tab_text_color_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_hover_border_colorpicker').linkTo('#inactive_tab_hover_border');

	$('#inactive_tab_hover_border').click(function()
	{
		$('#inactive_tab_hover_border_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_hover_background_colorpicker').linkTo('#inactive_tab_hover_background');

	$('#inactive_tab_hover_background').click(function()
	{
		$('#inactive_tab_hover_background_colorpicker').toggle();
	});
	
	$.farbtastic('#inactive_tab_hover_text_color_colorpicker').linkTo('#inactive_tab_hover_text_color');

	$('#inactive_tab_hover_text_color').click(function()
	{
		$('#inactive_tab_hover_text_color_colorpicker').toggle();
	});
	
	$.farbtastic('#active_tab_background_colorpicker').linkTo('#active_tab_background');

	$('#active_tab_background').click(function()
	{
		$('#active_tab_background_colorpicker').toggle();
	});
	
	$.farbtastic('#active_tab_border_colorpicker').linkTo('#active_tab_border');

	$('#active_tab_border').click(function()
	{
		$('#active_tab_border_colorpicker').toggle();
	});
	
	$.farbtastic('#active_tab_text_color_colorpicker').linkTo('#active_tab_text_color');

	$('#active_tab_text_color').click(function()
	{
		$('#active_tab_text_color_colorpicker').toggle();
	});
	
	$.farbtastic('#tab_content_border_colorpicker').linkTo('#tab_content_border');

	$('#tab_content_border').click(function()
	{
		$('#tab_content_border_colorpicker').toggle();
	});
	
	
	
	
	
	var button1 = $('#banner_button');
	<?php echo 'var loc = \''.base_url().'uploader\';' ?>
	new AjaxUpload(button1,{
		action: loc,
		data: {type: 'images'},
		onSubmit : function(){
			this.disable();
		},
		onComplete: function(file, response){
			this.enable();
			var option = "<option value='" + file + "'>" + file + "</option>";
			$('#banner_image_select').append(option);
			$('#banner_image_select').val(file).attr("selected", "selected");
			$('#banner_image').replaceWith('<img id="banner_image" src="<?php echo base_url();?>images/' + file + '" width="410px" height="84px" style="border:1px solid black"/>');
		}
	});
	
	$('#banner_image_select').change(function()
	{
		var text = $('#banner_image_select :selected').text();
		$('#banner_image').replaceWith('<img id="banner_image" src="<?php echo base_url();?>images/' + text + '" width="410px" height="84px" style="border:1px solid black"/>');
	});
	
	var button2 = $('#module_button');
	<?php echo 'var loc = \''.base_url().'uploader\';' ?>
	new AjaxUpload(button2,{
		action: loc,
		data: {type: 'images'},
		onSubmit : function(){
			this.disable();
		},
		onComplete: function(file, response){
			this.enable();
			var option = "<option value='" + file + "'>" + file + "</option>";
			$('#module_background_image_select').append(option);
			$('#module_background_image_select').val(file).attr("selected", "selected");
			$('#module_background_image').replaceWith('<img id="module_background_image" src="<?php echo base_url();?>images/' + file + '" width="50px" height="50px" style="border:1px solid black"/>');
		}
	});

	$('#module_background_image_select').change(function()
	{
		var text = $('#module_background_image_select :selected').text();
		$('#module_background_image').replaceWith('<img id="module_background_image" src="<?php echo base_url();?>images/' + text + '" width="50px" height="50px" style="border:1px solid black"/>');
	});
	
	var button3 = $('#footer_button');
	<?php echo 'var loc = \''.base_url().'uploader\';' ?>
	new AjaxUpload(button3,{
		action: loc,
		data: {type: 'images'},
		onSubmit : function(){
			this.disable();
		},
		onComplete: function(file, response){
			this.enable();
			var option = "<option value='" + file + "'>" + file + "</option>";
			$('#footer_background_image_select').append(option);
			$('#footer_background_image_select').val(file).attr("selected", "selected");
			$('#footer_background_image').replaceWith('<img id="footer_background_image" src="<?php echo base_url();?>images/' + file + '" width="50px" height="50px" style="border:1px solid black"/>');
		}
	});

	$('#footer_background_image_select').change(function()
	{
		var text = $('#footer_background_image_select :selected').text();
		$('#footer_background_image').replaceWith('<img id="footer_background_image" src="<?php echo base_url();?>images/' + text + '" width="50px" height="50px" style="border:1px solid black"/>');
	});
	
	var button4 = $('#inactive_tab_button');
	<?php echo 'var loc = \''.base_url().'uploader\';' ?>
	new AjaxUpload(button4,{
		action: loc,
		data: {type: 'images'},
		onSubmit : function(){
			this.disable();
		},
		onComplete: function(file, response){
			this.enable();
			var option = "<option value='" + file + "'>" + file + "</option>";
			$('#inactive_tab_background_image_select').append(option);
			$('#inactive_tab_background_image_select').val(file).attr("selected", "selected");
			$('#inactive_tab_background_image').replaceWith('<img id="inactive_tab_background_image" src="<?php echo base_url();?>images/' + file + '" width="50px" height="50px" style="border:1px solid black"/>');
		}
	});

	$('#inactive_tab_background_image_select').change(function()
	{
		var text = $('#inactive_tab_background_image_select :selected').text();
		$('#inactive_tab_background_image').replaceWith('<img id="inactive_tab_background_image" src="<?php echo base_url();?>images/' + text + '" width="50px" height="50px" style="border:1px solid black"/>');
	});
});
</script>

<form action="<?php echo base_url();?>site_admin/db_editSettingsMain" method="POST">
	<table width="800px" class="outer">
		<tr>
			<td>
				<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
					<tr height="40px">
						<td colspan="2" class="formHeading">Edit Main Page</td>
					</tr>

					<tr height="10px">
						<td colspan="2"></td>
					</tr>
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Banner image</td>
						<td width ="68%">
							<select id="banner_image_select" style="width: 250px" name="banner_image">
								<?php
									listFiles("images");
								?>
							</select>
							<button id="banner_button" type="button">Upload New Image</button>
							<br>
							<br>
							<img id="banner_image" src="<?php echo base_url();?>images/<?php echo $this->settings_model->getValue('main_banner_image');?>" width="410px" height="84px" style="border:1px solid black"/>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Banner border</td>
						<td width ="68%">
							<input type="text" id="banner_border" name="banner_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_banner_border');?>">
							<div id="banner_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Banner text color</td>
						<td width ="68%">
							<input type="text" id="banner_text_color" name="banner_text_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_banner_text_color');?>">
							<div id="banner_text_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Banner text</td>
						<td width ="68%"><input type="text" name="banner_text" size="35" maxlength"50" class="input" value="<?php echo $this->settings_model->getValue('main_banner_text');?>"></td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Background color</td>
						<td width ="68%">
							<input type="text" id="background_color" name="background_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_background_color');?>">
							<div id="background_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>

					<tr>
						<td bgcolor="#E8E8E8" width="32%">Header color</td>
						<td width ="68%">
							<input type="text" id="header_color" name="header_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_header_color');?>">
							<div id="header_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Header text color</td>
						<td width ="68%">
							<input type="text" id="header_text_color" name="header_text_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_header_text_color');?>">
							<div id="header_text_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Header border</td>
						<td width ="68%">
							<input type="text" id="header_border" name="header_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_header_border');?>">
							<div id="header_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Module background color</td>
						<td width ="68%">
							<input type="text" id="module_background_color" name="module_background_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_module_background_color');?>">
							<div id="module_background_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Module background image</td>
						<td width ="68%">
							<select id="module_background_image_select" style="width: 250px" name="module_background_image">
								<?php
									listFiles("images");
								?>
							</select>
							<button id="module_button" type="button">Upload New Image</button>
							<br>
							<br>
							<img id="module_background_image" src="<?php echo base_url();?>images/<?php echo $this->settings_model->getValue('main_module_background_image');?>" width="50px" height="50px" style="border:1px solid black"/>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Footer border</td>
						<td width ="68%">
							<input type="text" id="footer_border" name="footer_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_footer_border');?>">
							<div id="footer_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>

					<tr>
						<td bgcolor="#E8E8E8" width="32%">Footer background image</td>
						<td width ="68%">
							<select id="footer_background_image_select" style="width: 250px" name="footer_background_image">
								<?php
									listFiles("images");
								?>
							</select>
							<button id="footer_button" type="button">Upload New Image</button>
							<br>
							<br>
							<img id="footer_background_image" src="<?php echo base_url();?>images/<?php echo $this->settings_model->getValue('main_footer_background_image');?>" width="50px" height="50px" style="border:1px solid black"/>
						</td>
					</tr>

					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab background color</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_background_color" name="inactive_tab_background_color" size="10" maxlength"7" class="input" value="#12345">
							<div id="inactive_tab_background_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab background image</td>
						<td width ="68%">
							<select id="inactive_tab_background_image_select" style="width: 250px" name="inactive_tab_background_image">
								<?php
									listFiles("images");
								?>
							</select>
							<button id="inactive_tab_button" type="button">Upload New Image</button>
							<br>
							<br>
							<img id="inactive_tab_background_image" src="<?php echo base_url();?>images/<?php echo $this->settings_model->getValue('main_inactive_tab_background_image');?>" width="50px" height="50px" style="border:1px solid black"/>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab border</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_border" name="inactive_tab_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_inactive_tab_border_color');?>">
							<div id="inactive_tab_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab text color</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_text_color" name="inactive_tab_text_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_inactive_tab_text_color');?>">
							<div id="inactive_tab_text_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab hover border</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_hover_border" name="inactive_tab_hover_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_inactive_tab_hover_border');?>">
							<div id="inactive_tab_hover_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab hover background</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_hover_background" name="inactive_tab_hover_background" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_inactive_tab_hover_background');?>">
							<div id="inactive_tab_hover_background_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Inactive tab hover text color</td>
						<td width ="68%">
							<input type="text" id="inactive_tab_hover_text_color" name="inactive_tab_hover_text_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_inactive_tab_hover_text_color');?>">
							<div id="inactive_tab_hover_text_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Active tab background</td>
						<td width ="68%">
							<input type="text" id="active_tab_background" name="active_tab_background" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_active_tab_background');?>">
							<div id="active_tab_background_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Active tab border</td>
							<td width ="68%">
								<input type="text" id="active_tab_border" name="active_tab_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_active_tab_border');?>">
								<div id="active_tab_border_colorpicker" style="display:none;"></div>
							</td>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Active tab text color</td>
						<td width ="68%">
							<input type="text" id="active_tab_text_color" name="active_tab_text_color" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_active_tab_text_color');?>">
							<div id="active_tab_text_color_colorpicker" style="display:none;"></div>
						</td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">Tab content border</td>
						<td width ="68%">
							<input type="text" id="tab_content_border" name="tab_content_border" size="10" maxlength"7" class="input" value="<?php echo $this->settings_model->getValue('main_tab_content_border');?>">
							<div id="tab_content_border_colorpicker" style="display:none;"></div>
						</td>
					</tr>

					<tr>
						<td bgcolor="#E8E8E8" width="32%">About Us Page</td>
						<td width ="68%"><textarea name="about_us" cols="60" rows="10" class="input"><?php echo $this->settings_model->getValue('main_about_us');?></textarea></td>
					</tr>
					
					<tr>
						<td bgcolor="#E8E8E8" width="32%">QBank Page</td>
						<td width ="68%"><textarea name="qbank" cols="60" rows="10" class="input"><?php echo $this->settings_model->getValue('main_qbank');?></textarea></td>
					</tr>
					
					<tr>
						<td></td>
						<td height="100">
							<button type="submit">Save Changes</button>
						</td>
					</tr>
				 </table>
			</td>
		</tr>
	</table>
</form>

<?php $this->load->view('site_admin/footer'); ?>
