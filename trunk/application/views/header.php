<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Chicago Board Review</title>
		
		<link rel="stylesheet" href="<?php echo base_url();?>css/main.css" media="screen"> 
		<link rel="stylesheet" href="<?php echo base_url();?>css/slide.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" charset="utf-8">
		<link rel="stylesheet" href="<?php echo base_url();?>css/demo_table.css" type="text/css" media="screen" charset="utf-8">
		
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/slide.js" ></script>
	</head>
	
	<body> 
		<div id="container">
						<div id="toppanel">
				<div id="panel">
					<div class="content clearfix">
						<div class="left">
							<!-- Login Form -->
							<form class="clearfix" action="<?php echo base_url();?>main/login" method="post">
								<h3>Member Login</h3>
								<table>
								<tr>
								<th><label class="grey" for="log">Email:</label></th>
								<td><input type="text" name="email" id="email" class="required email" /></td>
								<td><label class="grey" for="pwd">Password:</label></td>
								<td><input type="password" name="password" id="password" class="required" /></td>
								</tr>
								</table>
								<!--<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label>-->
								<div class="clear"></div>
								<input type="submit" value="Login" id="login_button" class="bt_login" />
								<a class="lost-pwd" href="<?php echo base_url();?>forgotPassword">Forgot Password?</a>
							</form>
						</div> <!--class="left"-->
						<div class="left right">			
								<h3>Not a member yet?</h3>	
								<p><a href="<?php echo base_url();?>register">Click here to Register!</a></p>			
						</div> <!--class="left right"-->
					</div> <!--class="content clearfix"-->
				</div> <!-- /login (id="panel")-->	

				<!-- The tab on top -->	
				<div class="ptab">
					<ul class="login">
						<li class="left">&nbsp;</li>
						<li>Hello Guest!</li>
						<li class="sep">|</li>
						<li id="toggle">
							<a id="open" class="open" href="#">Log In | Register</a>
							<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
						</li>
						<li class="right">&nbsp;</li>
					</ul> 
				</div> <!-- ptab -->
			</div> <!-- toppanel-->


			<div id="space"> <br /></div> 
	<div id="banner" text-align="center">
		<h1>Chicago Review Courses</h1>
		<p>The Preferred Neurosurgery Review since 1974</p>
	</div>
	
	<div id="navigation">
		<a class="tab" href="<?php echo base_url();?>main" id="mainNav">Home</a>
		<a class="tab" href="<?php echo base_url();?>main/courses" id="courseNav">Courses</a>
		<a class="tab" href="<?php echo base_url();?>main/qbank" id="qbankNav">QBank</a>
		<a class="tab" href="<?php echo base_url();?>main/about" id="aboutNav">About</a>
	</div>
    <div class="navBar"></div>
    <div class="tabMain">
    

    
