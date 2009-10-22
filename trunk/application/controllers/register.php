<?php

class Register extends Controller {

  function Register() {
    parent::Controller();
    $this->load->library('session');
  }

  function index() {
    $data['formData'] = '';
    $data['error'] = '';
		$data['content'] = 'register';
		$this->load->view('template', $data);
  }

  function adduser() {
    $email =  $this->input->post('email');
    $fname =  $this->input->post('fname');
    $lname =  $this->input->post('lname');
    $passwd =  $this->input->post('password');

    $ret = $this->users_model->addUser($email, $passwd, $fname, $lname);
    if ($ret == FALSE) {
        redirect('main');
//      echo('worked');
    } else {
//        echo ($ret);
      $data['formData'] = ARRAY (
        'email' => $email,
        'fname' => $fname,
        'lname' => $lname
      );
      $data['content'] = 'register';
      $data['error'] = $ret;
      $this->load->view('template',$data);
    }
  }
}

?>
