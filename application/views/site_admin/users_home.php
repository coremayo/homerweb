<?php 
$data['breadcrumb'] = 'Users</a> &raquo; Home';
$this->load->view('site_admin/header', $data); 
?>

<div id="content">
	<h2>Current Users</h2>
	<hr>
	<br>
	
	<div id="add_new_user_link">
		<img src="<?php echo base_url();?>images/site_admin/add_user.gif" alt="Add User Image" />
		<div id="description">
			<a href="<?php echo base_url();?>site_admin/users/add_user">Add New User</a>
		</div>
	</div>
	
	<div id="table">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th>Email Address</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Registration Date</th>
					<th>Active Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$users = $this->users_model->getAllUsers();
	
					foreach ($users as $user)
					{
						$email = $user->userEmail;
						$fname = $user->userFirstName;
						$lname = $user->userLastName;
						$regDate = $user->userRegistrationDate;
						$active = $user->userActive;
						
						if ($active)
						{
							$active = '<img src="'.base_url().'images/site_admin/active_icon.gif" alt="Active Image" />';
						}
						else
						{
							$active = '<img src="'.base_url().'images/site_admin/inactive_icon.gif" alt="Inactive Image" />';
						}
						
						echo '
							<tr>
								<td><a href="'.base_url().'site_admin/users/edit_user/'.$user->id.'">'.$email.'</a></td>
								<td>'.$fname.'</td>
								<td>'.$lname.'</td>
								<td>'.$regDate.'</td>
								<td>'.$active.'</td>
							</tr>';
					}
				?>	
			</tbody>
		</table>
	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>