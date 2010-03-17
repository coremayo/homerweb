<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Chicago Board Review</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>css/student.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/student.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>js/flowplayer-3.1.4.min.js"></script>
	</head>
	<body>
	
	<div id="container">

	<div id="header">
    	<div id="UserEmail">
    		<?php echo $this->session->userdata('email');?> |
            <a href="<?php echo base_url();?>student/logout" style="color: rgb(0,0,0)"><font color="000000"><u>Logout</u></a>
    	</div>
		<h1 id="test">Chicago Review Courses</h1>
        
		<small>"The Preferred Neurosurgery Review since 1974"</small>
        
	</div>

	<ul id="navigation">
		<a class="tab" href="<?php echo base_url();?>student/index" id="annNav">Home</a>
		<a class="tab" href="<?php echo base_url();?>student/courses" id="coursesNav">Courses</a>
		<a class="tab" href="<?php echo base_url();?>student/subscriptions" id="subNav">Subscriptions</a>
        <a class="tab" href="<?php echo base_url();?>student/settings" id="SettingsNav">Edit Profile</a>
        
			<?php
				$isSiteAdmin = $this->session->userdata('is_site_admin');
				$isClassAdmin = $this->session->userdata('is_class_admin');
				$isLectureAdmin = $this->session->userdata('is_lecture_admin');
				
				/*echo 'site '.$isSiteAdmin.'<br>';
				echo 'class '.$isClassAdmin.'<br>';
				echo 'lecture '.$isLectureAdmin.'<br>';
				*/
				
				if($isSiteAdmin || $isClassAdmin || $isLectureAdmin)
				{
					echo '<button type="button" id="adminPanel" onclick="window.location.href=\''.base_url().'site_admin/\'">Admin Panel</button>';
				}
			
			?>

	</ul>
    <div class="navBar"></div>
    <div class="tabMain">
    
