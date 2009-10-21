<div id="breadcrumb">
	<a href="<?php echo base_url();?>site_admin/users_groups">Users &amp; Groups</a> &raquo; <a href="<?php echo base_url();?>site_admin/users">Users</a> &raquo; Add New User
</div>

<div id="content">
	<h2>Add New User</h2>
	<hr>
	<br>
	<form id="add_user_form" action="<?php echo base_url();?>site_admin/add_user_db" method="post">
		<p>Email Address: <input type="text" name="email" id="email" class="required email" /></p>
		<p>First name: <input type="text" name="fname" id="fname" class="required" /></p>
		<p>Last name: <input type="text" name="lname" id="lname" class="required" /></p>
		<p>Choose a Password: <input type="password" name="password" id="password" class="required" /> (Must be at least 8 characters)</p>
		<p>Re-enter your Password: <input type="password" name="password_check" id="password_check" class="required" /></p>
		<input type="submit" value="Add User" id="add_user_button">
	</form>
</div>