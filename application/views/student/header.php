<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Chicago Board Review</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>css/student.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/cupertino/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/student.js"></script> <!temp>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script> <!temp>
	</head>
	<body>
	
	<div id="container">

	<div id="header">
		<h1 id="test">Chicago Review Courses</h1>
		<small>"The Preferred Neurosurgery Review since 1974"</small>
		<div id="search">
			<small><input type="text" name="search" value="Search Keywords..." /> <input type="submit" name="submit" value="Go" /></small>
		</div>
	</div>

	
	<ul id="navigation">
		<li><a href="<?php echo base_url();?>student/index">Home</a></li>
		<li><a href="<?php echo base_url();?>student/courses">Courses</a></li>
		<li><a href="<?php echo base_url();?>student/qbank">QBank</a></li>
		<li><a href="<?php echo base_url();?>student/subscriptions">Subscriptions</a></li>
        <form id="logout" action="<?php echo base_url();?>student/logout" method="post">
			<input type="submit" value="Logout" id="logout_button">
			</form>
	</ul>
    
    
