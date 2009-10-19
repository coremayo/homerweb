<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Site Administrator Panel</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>css/site_admin.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		<link type="text/css" href="http://jqueryui.com/latest/themes/base/ui.all.css" rel="stylesheet" />
		<script type="text/javascript" src="http://jqueryui.com/latest/jquery-1.3.2.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/site_admin.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.core.js"></script>
		<script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.tabs.js"></script>

	</head>
	<body>
	
	<div id="container">

	<div id="header">
		<h1>Site Administrator Panel</h1>
		<label id="logged_in_as">Logged in as: Site Administrator</label>
		<a href="main/logout" id="logout_link">Logout</a>
	</div>
	
	<div id="navigation">
		<ul>
			<li><a href="#user_management"><span>User Management</span></a></li>
			<li><a href="#courses"><span>Course Management</span></a></li>
			<li><a href="#registration"><span>Registration Configuration</span></a></li>
		</ul>
		
		<div id="content">