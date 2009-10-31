<?php 
	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/users/">Users</a> &raquo; Add New User';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	$(document).ready(function() 
	{
		var randomPass = randomPassword(20);
		$('.pass_check').hide();
		$('.pass_field_manual').hide();
		$('.pass_field_random').html('<input type="hidden" name="password_random" value="' + randomPass + '" />' + randomPass);
	
		$("input[name='pass_option']").change(
			function()
			{
				var randomPass = randomPassword(20);
				var type = $("input[name='pass_option']:checked").val();
				$('.pass_check').toggle();
				$('.pass_field_manual').toggle();
				$('.pass_field_random').toggle();
				$('.pass_field_random').html('<input type="hidden" name="password_random" value="' + randomPass + '" />' + randomPass);
				$("input[name='pass_type']").val(type);
			}
		);
	
		$('.send_email').hide();
		$("input[name='email_subject']").val('Welcome to Chicago Board Review Online');
		$("textarea[name='email_message']").val('Chicago Board Review has sent you this email because an administrator has created an account registered to this email address. To use this account log into http://localhost/homerweb with the following credentials:\r\rEmail: {email}\rPassword: {password}');
	
		$("input[name='email_option']").change(
			function()
			{
				$('.send_email').toggle();
			}
		);
		
		function randomPassword(length)
		{
		   chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		   pass = "";
	
		   for(x = 0; x < length; x++)
		   {
			  i = Math.floor(Math.random() * 62);
			  pass += chars.charAt(i);
		   }
	
		   return pass;
		}
	});
</script>


<div id="content">
	<form action="<?php echo base_url();?>site_admin/db_addUser" method="POST">
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