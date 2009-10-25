<?php 
$data['breadcrumb'] = 'Home';
$this->load->view('site_admin/header', $data); 
?>

<div id="content">
	<ul>
		<li>
			<img src="<?php echo base_url();?>images/site_admin/test_icon.png" alt="Users Image" />
			<div id="description">
				<a href="<?php echo base_url();?>site_admin/users">Users</a>
				<br>
				<label>
					This is where you can manage user accounts.
					<br>
					Subitems: <a href="<?php echo base_url();?>site_admin/users/add_users">Add User</a>
				</label>
			</div>
		</li>
		<li>
			<img src="<?php echo base_url();?>images/site_admin/test_icon.png" alt="Courses Image" />
			<div id="description">
				<a href="<?php echo base_url();?>site_admin/courses">Courses</a>
				<br>
				<label>
					This is where you can manage courses, lectures, and their resources.
					<br>
					Subitems:
				</label>
			</div>
		</li>
		<li>
			<img src="<?php echo base_url();?>images/site_admin/test_icon.png" alt="Settings Image" />
			<div id="description">
				<a href="<?php echo base_url();?>site_admin/settings">Settings</a>
				<br>
				<label>
					Manage all settings including themes, colors, images and other option for the site here.
					<br>
					Subitems: <a href="<?php echo base_url();?>site_admin/settings/themes">Theme Manager</a>, <a href="<?php echo base_url();?>site_admin/settings/stylesheets">Stylesheets</a>, <a href="<?php echo base_url();?>site_admin/settings/templates">Templates</a>
				</label>
			</div>
		</li>
	</ul>
</div>

<?php $this->load->view('site_admin/footer'); ?>