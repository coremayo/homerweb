<?php

class ForgotPassword extends Controller {

  function ForgotPassword() {
    parent::Controller();
    $this->load->library('session');
  }

  /*
   * Set initial data and load the Forgot Password page
   */
  function index()
	{
		$data['formData'] = '';
    	$data['error'] = '';
		$data['content'] = 'forgotPassword';
		$this->load->view('template', $data);
	}
	
	/*
	 *	Test to see if the given email is in the database. If it is, generate a random confirmation code and email it to
	 *  the user's email address. Set the confirmation code and an expiration date in the database.
	 *	If the email is not in the database, print an error
	 */
	function confirmEmail()
	{
		$email =  $this->input->post('email');
		$ret = $this->users_model->getId($email);
		
		// Correct email
		if ($ret != NULL) {
			// Random confirmation code
			$confirmCode=md5(uniqid(mt_rand(), true));
			
			// 4 hours from now
			$total = (4 * 60 * 60) + strtotime(Date("Y-m-d H:i:s")); 
			$newDate = date("Y-m-d H:i:s", $total);
			
			$this->email->from('chicagoboardreviewonline@gmail.com', 'Jason Faulk');
			$this->email->to($email);
			$this->email->subject('Forgot Password');
			$this->email->message('Please follow the link to reset your password: '.base_url().'forgotPassword/confirm/'.$confirmCode);
			$this->email->send();
			
			$this->users_model->setConfirmationCode($email, $confirmCode, $newDate);
			$data['content'] = 'status';
			$data['type'] = 'confirmSent';
			$this->load->view('template', $data);
		}  // Incorrect email
		else {
		  
			$data['content'] = 'forgotPassword';
			$data['error'] = 'No matching email found';
			$this->load->view('template', $data);
		}
	}
	
	/*
	 * Test if the given confirmation code is valid, and if it is, create a random password, reset the user's password,
	 * and email them the randomly created password. Redirect them to a page that informs of a success.
	 * If the code is not valid, redirect to a page that tells them the code is expired.
	 *
	 * @param int confirmation code
	 */
	function confirm($code = ' ')
	{
		$id = $this->users_model->verifyConfirmationCode($code);
		if(is_numeric($id)){
			
			// Create a random password
			$pass = substr(md5(uniqid(mt_rand(), true)), 0, 20);
			
			// Reset user's password
			$this->users_model->setPassword($id, $pass);
			
			// Send new password in email
			$this->email->from('chicagoboardreviewonline@gmail.com', 'Jason Faulk');
			$this->email->to($this->users_model->getEmail($id));
			$this->email->subject('New Password');
			$this->email->message('Your new password: '.$pass."\n".'Login: '.base_url());
			$this->email->send();
			
			$data['content'] = 'status';
			$data['type'] = 'confirmVerified';
			$this->load->view('template', $data);
		}
		else{
			$data['content'] = 'status';
			$data['type'] = 'expired';
			$this->load->view('template', $data);
		}
	}
	
}

?>
