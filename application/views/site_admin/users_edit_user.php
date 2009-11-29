<?php 
	$userID = $this->uri->segment(4, 0);
	$userInfo = $this->users_model->getUserInfo($userID);
	
	$data['breadcrumb'] = '<a href="'.base_url().'site_admin/users">Users</a> &raquo; Edit User';
	$this->load->view('site_admin/header', $data); 
?>

<script>
	$(document).ready(function() 
	{
	
		$('.pass_field_new').hide();
	
		$("input[name='pass_option_edit']").change(
			function()
			{
				var type = $("input[name='pass_option_edit']:checked").val();
				$('.pass_field_new').toggle();
				$('.pass_field_keep').toggle();
				$("input[name='pass_type_edit']").val(type);
			}
		);
	
		$("#start_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
		$("#end_date").datepicker({dateFormat: 'yy-mm-dd', minDate: 0});
	});
	
</script>

<div id="content">
<?php echo validation_errors(); ?>
	<form name="edit_user_form" action="<?php echo base_url();?>site_admin/db_editUser/" method="POST">
		<input type="hidden" name="id" value="<?php echo $userID;?>">
		<table width="700px" class="outer">
			<tr>
				<td>
					<table class="text" border="0" cellpadding="4" cellspacing="3" width="100%">
						<tr height="40px">
							<td colspan="2" class="formHeading">Edit User</td>
						</tr>
	
						<tr>
							<td colspan="2" class="note" bgcolor="#E8E8E8">Edit '<?php echo $userInfo->userEmail;?>'s account</td>
						<tr>
	
						<tr height="10px">
							<td colspan="2"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Email Address</td>
							<td width ="68%"><input type="text" name="email" size="35" maxlength"50" class="input" value="<?php echo $userInfo->userEmail;?>"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">First Name</td>
							<td width ="68%"><input type="text" name="fname" size="35" maxlength"50" class="input" value="<?php echo $userInfo->userFirstName;?>"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Last Name</td>
							<td width ="68%"><input type="text" name="lname" size="35" maxlength"50" class="input" value="<?php echo $userInfo->userLastName;?>"></td>
						</tr>
	
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Password Option</td>
							<td width ="68%">
								<input type="radio" name="pass_option_edit" value="keep" checked>Keep current password
								<br>
								<input type="radio" name="pass_option_edit" value="new">Set a new password
							</td>
						</tr>

						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Password</td>

							<input type="hidden" name="pass_type_edit" value="keep_pass">

							<td class="pass_field_new" width ="68%">
								<input type="password" name="password" size="35" maxlength"50" class="input">
							</td>
							<td class="pass_field_keep" width ="68%">{Current password}</td>
						</tr>
						
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Active Status</td>
							<td width ="68%">
								<p><input type="checkbox" name="active_status" 
									<?php if ($userInfo->userActive)
											  {
												echo 'checked';
											  }
										?>
								
								>	
								</p>
							</td>
						</tr>
						
						<tr>
							<td align="right" bgcolor="#E8E8E8" width="32%">Registration Date</td>
							<td width ="68%"><p><?php echo $userInfo->userRegistrationDate;?></p></td>
						</tr>
						
						<tr>
							<td></td>
							<td height="30">
								<button type="submit">Save Changes</button>
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