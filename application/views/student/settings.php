<div id="main">
<script type="text/javascript"> javascript:changeClass('SettingsNav'); </script>
	<div id="settings_level1">
		<div id="settings">
        	<?php $id = $this->users_model->getId($this->session->userdata('email')) ?>
			<h2>Profile</h2>

<?php echo validation_errors(); ?>


            <form id="settings_form" action="<?php echo base_url();?>student/updateProfile" method="post">
            <table width="700px" class="outer">
			<tr>
				<td>
					<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
						<tr>
							<td align="right" bgcolor="#addbf0" width="25%">First Name:</td>
							<td width ="75%"><input type="text" name="fName" size="35" maxlength"50" class="required" value="<?php echo $this->users_model->getFirstName($id);?>"></td>
						</tr>
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Last Name:</td>
							<td width ="75%"><input type="text" name="lName" size="35" maxlength"50" class="required" value="<?php echo $this->users_model->getLastName($id);?>"></td>
						</tr>
                        <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Email:</td>
							<td width ="75%"><input type="text" name="email" size="35" maxlength"50" class="required email" value="<?php echo $this->users_model->getEmail($id);?>"></td>
						</tr>
                         <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Password:</td>
							<td width ="75%"><input type="password" name="pass" id="pass" size="35" maxlength"50" class="input" value=""></td>
						</tr>
                         <tr>
							<td align="right" bgcolor="#addbf0" width="25%">Confirm Password:</td>
							<td width ="75%"><input type="password" name="repass" id="repass" size="35" maxlength"50" class="input" value=""></td>
						</tr>
                        <tr>
                        	<td align="right" width="25%"></td>
							<td width="75%">Leave password fields blank if you do not wish to change</td>
						</tr>
                        <tr>
							<td></td>
							<td height="30">
								<button type="submit">Save Changes</button>
								<button type="button" onclick="window.location.href='<?php echo base_url();?>student/'">Cancel</button>
							</td>
						</tr>
                      </table>
				 </td>
			  </tr>
			  </table>
              </form>
        
		</div>
	</div>
</div>