<div id="main">
	<h1>Forgot Password</h2>
	<p>The forgot password page provides you with a means to reset a forgotten password. Remember to check your email after submitting. </p>
	
	<form id="forgotPassword_form" action="<?php echo base_url();?>forgotPassword/confirmEmail" method="post">
		<h2>Email Confirmation</h2>
<?php if ($error) {echo("<div style=\"color:red\">$error</div>");} ?>
		<p>Email Address: <input type="text" name="email" id="email" class="required email" /></p>
		<input type="submit" value="Submit" id="forgotPassword_button" />
	</form>
	<br>
	<br>
</div>