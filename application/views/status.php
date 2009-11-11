<?php if ($type == 'confirmSent')
	  {
	  	echo 'Please check your email for a confirmation link';
	  }
	  else if($type == 'confirmVerified')
	  {
	  	echo 'Your email address has been confirmed. <br>Please check your email once more for your new password. Be sure to check your spam folder.';
	  }
	  else if($type == 'expired')
	  {
		  echo 'Your confirmation link is no longer valid.  Please request another confirmation link.<br>';
		  echo '<a href="'.base_url().'forgotPassword">Forgot Password</a><br>';
	  }
?>