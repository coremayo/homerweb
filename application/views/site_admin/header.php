<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Site Administrator Panel</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>css/site_admin.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		<link type="text/css" href="http://jqueryui.com/latest/themes/base/ui.all.css" rel="stylesheet" />
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/site_admin.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.delay.js"></script>
	</head>
	<body>
	
	<div id="container">

	<div id="header">
		<h1>Site Administrator Panel</h1>
		<a href="<?php echo base_url();?>main/logout" id="logout_link">Logout</a>
	</div>
	
	<ul id="navigation">
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/">Home</a>
		</li>
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/users">Users</a>
		</li>
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/courses">Courses</a>
		</li>
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/settings">Settings</a>
			<ul>
				<li><a href="<?php echo base_url();?>site_admin/settings/themes">Theme Manager</a></li>
				<li><a href="<?php echo base_url();?>site_admin/settings/stylesheets">Stylesheets</a></li>
				<li><a href="<?php echo base_url();?>site_admin/settings/templates">Templates</a></li>
			</ul>
		</li>
	</ul>
	
	<div id="clear"> </div>
	