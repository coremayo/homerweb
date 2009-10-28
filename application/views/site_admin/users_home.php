<?php 
$data['breadcrumb'] = 'Users &raquo; Home';
$this->load->view('site_admin/header', $data); 
?>

<div id="content">
	<h2>All Users</h2>
	<hr>
	<br>
	
	<div id="add_new_user_link">
		<img src="<?php echo base_url();?>images/site_admin/add_user.gif" alt="Add User Image" />
		<div id="description">
			<a href="<?php echo base_url();?>site_admin/users/add_user">Add New User</a>
		</div>
	</div>
	
	<div id="table">
		<?php 
			$data['show_email'] = '';
			$data['show_fname'] = '';
			$data['show_lname'] = '';
			$data['show_regDate'] = '';
			$data['show_active'] = '';
			$this->load->view('site_admin/table_users', $data);
		?>
	</div>
</div>

<?php $this->load->view('site_admin/footer'); ?>