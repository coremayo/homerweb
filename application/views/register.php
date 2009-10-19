<div id="main">
	<h1>Registration</h2>
	<p>Registration provides you with access to the various courses which include lecture notes, a video of the lecture, and any other resources the instructor provides. </p>
	<p><small><a href="#">Privacy Concerns</a> | <a href="#">FAQ's</a></small></p>
	
	<form id="registration_form" action="<?php echo base_url();?>main/register" method="post">
		<h2>Create an Account (Required)</h2>
		<p>Email Address: <input type="text" name="email" id="email" class="required email" /></p>
		<p>First name: <input type="text" name="fname" id="fname" class="required" /></p>
		<p>Last name: <input type="text" name="lname" id="lname" class="required" /></p>
		<p>Choose a Password: <input type="password" name="password" id="password" class="required" /> (Must be between 5 and 20 characters)</p>
		<p>Re-enter your Password: <input type="password" name="password_check" id="password_check" class="required" /></p>
		<p>Secret Question: <input type="text" name="secret_question" id="secret_question" class="required" /> <small><a href="#">What's this?</a></small></p>
		<p>Secret Answer: <input type="password" name="secret_answer" id="secret_answer" class="required" /> </p>
		<br>
		<br>
		<h2>Choose Courses to Enroll In (Required)</h2>
		
		
		<p>Insert a list of courses here</p>
		<input type="submit" value="Register" id="register_button">
	</form>
	<br>
	<br>
</div>