<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Administrator Panel</title>
		<link type="text/css" href="<?php echo base_url();?>css/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo base_url();?>css/site_admin.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/farbtastic.css" type="text/css" media="screen" charset="utf-8">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jquery.delay.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/site_admin.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/ajaxupload.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/farbtastic.js"></script>
	</head>
	<body>
	
	<div id="container">

	<div id="header">
		<h1>Administrator Panel</h1>
		<div id="logout_link">
			<?php echo $this->session->userdata('email');?> | <a href="<?php echo base_url();?>main/logout">Logout</a>
		</div>
	</div>
	
	<ul id="navigation">
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/">Home</a>
		</li>
		<li class="headlink">
			<?php if($siteAdmin){echo '<a href="'.base_url().'site_admin/users">Users</a>';}?>
		</li>
		<li class="headlink">
			<a href="<?php echo base_url();?>site_admin/courses">Courses</a>
		</li>
		<li class="headlink">
			<?php if($siteAdmin){echo '<a href="'.base_url().'site_admin/settings">Settings</a>';}?>
		</li>
		<li align="right" class="headlink">
			<a href="<?php echo base_url();?>student">Student View</a>
		</li>
	</ul>
	
	<div id="breadcrumb">
		<?php echo $breadcrumb;?>
	</div>
	
	<noscript>
		<div class="message warning">
			Warning: The administrator panel will not function properly with JavaScript disabled!
		</div>
	</noscript>
	
	<?php 
	if ($this->session->flashdata('type'))
	{
		echo '<div class="'.$this->session->flashdata('type').'">
		     '.$this->session->flashdata('msg').'
		     </div>';
	}
	?>
	