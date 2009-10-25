<?php $this->load->view('site_admin/header'); ?>

<div id="breadcrumb">
	<a href="<?php echo base_url();?>site_admin/users/">Users</a> &raquo; Add New User
</div>

<?php if ($this->session->flashdata('type'))
	  {
		echo '<div class="'.$this->session->flashdata('type').'">
			  '.$this->session->flashdata('msg').'
			  </div>';
	  }
?>

<div id="content">
	<form name="add_new_user_form" action="<?php echo base_url();?>site_admin/db_addUser" method="POST">
		<table width="700px" class="outer">
			<tr>
				<td>
					<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
						<tr height="40px">
							<td colspan="2" class="formHeading">Add New User</td>
						</tr>
	
						<tr>
							<td colspan="2" class="note" bgcolor="#E8E8E8">Note: All fields are required</td>
						<tr>
	
						<tr height="10px">
							<td colspan="2"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Email Address</td>
							<td width ="68%"><input type="text" name="email" size="35" maxlength"50" class="input"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">First Name</td>
							<td width ="68%"><input type="text" name="fname" size="35" maxlength"50" class="input"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Last Name</td>
							<td width ="68%"><input type="text" name="lname" size="35" maxlength"50" class="input"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Password Option</td>
							<td width ="68%">
								<input type="radio" name="pass_option" value="random" checked>Generate random password
								<br>
								<input type="radio" name="pass_option" value="manual">Manually set password
							</td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Password</td>
							
							<input type="hidden" name="pass_type" value="random">
							
							<td class="pass_field_manual" width ="68%">
								<input type="password" name="password_manual" size="35" maxlength"50" class="input">
							</td>
							<td class="pass_field_random" width ="68%">
								
							</td>
						</tr>
	
						<tr class="pass_check">
							<td align="right" bgcolor="#E8E8E8" width="32%">Re-type Password</td>
							<td width ="68%"><input type="password" name="password_check" size="35" maxlength"50" class="input"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Email options</td>
							<td width ="68%"><input type="checkbox" name="email_option" class="input">Email user notifying them of account creation</td>
						</tr>
						
						<tr class="send_email">
							<td align="right" bgcolor="#E8E8E8" width="32%">Subject</td>
							<td width ="68%"><input type="text" name="email_subject" size="62" maxlength="50" class="input"></td>
						</tr>
						
						<tr class="send_email">
							<td align="right" bgcolor="#E8E8E8" width="32%">Message</td>
							<td width ="68%"><textarea name="email_message" cols="60" rows="10" class="input"></textarea></td>
						</tr>
						
						<tr>
							<td></td>
							<td height="30">
								<button type="submit">Add User</button>
								<button type="button" onclick="window.location.href='<?php echo base_url();?>site_admin/users'">Cancel</button>
							</td>
						</tr>
					 </table>
				 </td>
			 </tr>
		</table>
	</form>
</div>

<?php $this->load->view('site_admin/footer'); ?>