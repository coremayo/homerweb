<?php

class Site_admin extends Controller
{
	function index()
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/cms_home';
			$this->load->view('site_admin/template', $data);
		}
	}
	
	function users_groups()
	{
		$page = $this->uri->segment(3, 'home');
		
		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/users_groups_'.$page);
		}
	}
	
	function courses()
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/courses_home';
			$this->load->view('site_admin/template', $data);
		}
	}
	
	function layout()
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/layout_home';
			$this->load->view('site_admin/template', $data);
		}
	}
	
	function db_addUser()
	{
		$email          = $this->input->post('email');
		$fname          = $this->input->post('fname');
		$lname          = $this->input->post('lname');
		$password_type  = $this->input->post('pass_type');
		$password       = $this->input->post('password_'.$password_type);
		$password_check = $this->input->post('password_check');
		$email_option   = $this->input->post('email_option');
		$email_subject  = $this->input->post('email_subject');
		$email_message  = $this->input->post('email_message');

		$newMsg1 = str_replace('{email}', $email, $email_message);
		$newMsg2 = str_replace('{password}', $password, $newMsg1);
		
		if ($password_type == 'random')
		{
			$result = $this->users_model->addUser($email, $password, $fname, $lname);

			if ($result == '')
			{
				$this->session->set_flashdata('type', 'message success');
				$this->session->set_flashdata('msg', $email.' was added successfully!');
				
				if ($email_option == 'on')
				{
					$this->email->from('chicagoboardreviewonline@gmail.com', 'Jason Faulk');
					$this->email->to($email);
					$this->email->subject($email_subject);
					$this->email->message($newMsg2);
					$this->email->send();
				}
				redirect('site_admin/users_groups/users/');
			}
			else
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', $result);
				redirect('site_admin/users_groups/add_user/');
			}
		}
		else
		{
			if (($password != $password_check) || ($password == '') || ($password_check == ''))
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', 'Passwords do not match or no password was entered');
				redirect('site_admin/users_groups/add_user/');
			}
			else
			{
				$result = $this->users_model->addUser($email, $password, $fname, $lname);
	
				if ($result == '')
				{
					$this->session->set_flashdata('type', 'message success');
					$this->session->set_flashdata('msg', $email.' was added successfully!');
					
					if ($email_option == 'on')
					{
						$this->email->from('chicagoboardreviewonline@gmail.com', 'Jason Faulk');
						$this->email->to($email);
						$this->email->subject($email_subject);
						$this->email->message($newMsg2);
						$this->email->send();
					}
					
					redirect('site_admin/users_groups/users/');
				}
				else
				{
					$this->session->set_flashdata('type', 'message error');
					$this->session->set_flashdata('msg', $result);
					redirect('site_admin/users_groups/add_user/');
				}
			}
		}
	}
	
	function db_editUser()
	{
		$id             = $this->input->post('id');
		$email          = $this->input->post('email');
		$fname          = $this->input->post('fname');
		$lname          = $this->input->post('lname');
		$password_type  = $this->input->post('pass_type_edit');
		$password       = $this->input->post('password');
		$active         = $this->input->post('active_status');
		
		if ($active == 'on')
		{
			$active = 1;
		}
		else
		{
			$active = 0;
		}
		
		$this->users_model->setEmail($id, $email);
		$this->users_model->setFirstName($id, $fname);
		$this->users_model->setLastName($id, $lname);
		$this->users_model->setActive($id, $active);
		
		if ($password_type == 'new')
		{
			$this->users_model->setPassword($id, $password);
		}
		
		$this->session->set_flashdata('type', 'message success');
	    $this->session->set_flashdata('msg', 'The account '.$email.' was updated successfully!');
		redirect('site_admin/users_groups/users/');
	}
	
	function _is_authorized()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['content'] = 'unauthorized';
			$data['type'] = 'unauthorized';
			$this->load->view('template', $data);

			return false;
		}
		else
		{
			$has_permissions = $this->session->userdata('is_site_admin');

			if(!isset($has_permissions) || $has_permissions != true)
			{
				$data['content'] = 'unauthorized';
				$data['type'] = 'unauthorized';
				$this->load->view('template', $data);

				return false;
			}
			else
			{
				return true; 
			}
		}
	}
}

?>