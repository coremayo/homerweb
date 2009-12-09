<?php

class Register extends Controller {

  function Register() {
    parent::Controller();
    $this->load->library('session');
  }

  /*
   * Set initial data and load the Register page
   */
  function index() {
    $data['formData'] = '';
    $data['error'] = '';
		$data['content'] = 'register';
		$this->load->view('template', $data);
  }

  /*
   * Retrieve data from Register view and validate it. If it validates, add the new user. Otherwise, print validation errors.
   */
  function adduser() {
    $email =  $this->input->post('email');
    $fname =  $this->input->post('fname');
    $lname =  $this->input->post('lname');
    $passwd =  $this->input->post('password');
    $password_check = $this->input->post('password_check');

    // Set Validation Rules
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
    $this->form_validation->set_rules('fname', 'First Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required|matches[password_check]|min_length[5]|max_length[20]');
    $this->form_validation->set_rules('password_check', 'Password Confirmation', 'required');

    // Run Validation
    if ($this->form_validation->run() == FALSE)
    {
      $data['formData'] = ARRAY (
          'email' => $email,
          'fname' => $fname,
          'lname' => $lname
        );
      $data['content'] = 'register';
      $data['error'] = validation_errors();
      $this->load->view('student/template', $data);
      return;
    }

    $ret = $this->users_model->addUser($email, $passwd, $fname, $lname);
		$data['content'] = 'welcome';
    $data['email'] = $email;
		$this->load->view('template', $data);
  }

  /*
   * Verify that the email is not already being used
   *
   * @param String email
   * @return TRUE if the email isnt being used in the database, FALSE if the email is being used.
   */
  function email_check($email)
  {
    $id = $this->users_model->getId($this->session->userdata('email'));
    if (!$this->users_model->isValidEmail($id, $email))
    {
      $this->form_validation->set_message('email_check', 'That email is already being used.');
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
}

?>
