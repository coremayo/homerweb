<div id="main">
<script type="text/javascript"> javascript:changeClass('mainNav'); </script>
	<div id="qbank_level1">
		<div id="qbank">
      <h2>Email Confirmation</h2>
      <p> Please enter your email that was used to register your account. <br /><br />A message will be sent to this address with the password.
      <form id="forgotPassword_form" action="<?php echo base_url();?>forgotPassword/confirmEmail" method="post">
<?php if ($error) {echo("<div style=\"color:red\">$error</div>");} ?>
      <p>Email Address: <input type="text" name="email" id="email" class="required email" /></p>
      <input type="submit" value="Submit" id="forgotPassword_button" />
      </form>
    </div>
  </div>
	<br>
</div>
