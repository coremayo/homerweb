<div id="main">
<script type="text/javascript"> javascript:changeClass('mainNav'); </script>
	<div id="qbank_level1">
		<div id="qbank">
      <h2>Registration</h2>
      <p>Registration provides you with access to the various courses which include lecture notes, a video of the lecture, and any other resources the instructor provides. </p>
    </div>
  </div>
	<div id="qbank_level1">
		<div id="qbank">
      <form id="registration_form" action="<?php echo base_url();?>register/adduser" method="post">
        <h2>Create an Account (Required)</h2>
        <?php if ($error) {echo("<div style=\"color:red\">$error</div>");} ?>
      <table>
      <tr>
        <td>Email Address:</td>
        <td><input type="text" name="email" id="email" class="required email" <?php if($formData) echo 'value="'.$formData['email'].'"' ?>/></td>
      </tr>
      <tr>
        <td>First name:</td>
        <td><input type="text" name="fname" id="fname" class="required" <?php if($formData) echo 'value="'.$formData['fname'].'"' ?>/></td>
      </tr>
      <tr>
        <td>Last name:</td>
        <td><input type="text" name="lname" id="lname" class="required" <?php if($formData) echo 'value="'.$formData['lname'].'"' ?>/></td>
      </tr>
      <tr>
        <td>Choose a Password:</td>
        <td><input type="password" name="password" id="password" class="required" /> (Must be between 5 and 20 characters)</td>
      </tr>
      <tr>
        <td>Re-enter your Password:</td>
        <td><input type="password" name="password_check" id="password_check" class="required" /></td>
      </tr>
      <tr>
        <td><input type="submit" value="Register" id="register_button" /></td>
      </tr>
      </table>
      </form>
    </div>
  </div>
</div>
