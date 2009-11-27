<?php

class Site_admin extends Controller
{
	function index()
	{
		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/home');
		}
	}
	
	function users()
	{
		$page = $this->uri->segment(3, 'home');
		
		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/users_'.$page);
		}
	}
	
	function courses()
	{
		$page = $this->uri->segment(3, 'home');

		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/courses_'.$page);
		}
	}
	
	function settings()
	{
		$page = $this->uri->segment(3, 'home');

		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/settings_'.$page);
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
				redirect('site_admin/users/');
			}
			else
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', $result);
				redirect('site_admin/users/add_user/');
			}
		}
		else
		{
			if (($password != $password_check) || ($password == '') || ($password_check == ''))
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', 'Passwords do not match or no password was entered');
				redirect('site_admin/users/add_user/');
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
					
					redirect('site_admin/users/');
				}
				else
				{
					$this->session->set_flashdata('type', 'message error');
					$this->session->set_flashdata('msg', $result);
					redirect('site_admin/users/add_user/');
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
		redirect('site_admin/users/');
	}
	
	function db_addCourse()
	{
		$title       = $this->input->post('title');
		$description = $this->input->post('description');
		$price       = $this->input->post('price');
		$start       = $this->input->post('start_date');
		$end         = $this->input->post('end_date');
		$sub_length  = $this->input->post('subscription_length');
		$admins      = explode("&", $this->input->post('selected_admins'));
		
		$resultAddUsersGroup = $this->groups_model->addGroup($title.' Users');
		
		if ($resultAddUsersGroup == '')
		{
			$resultAddAdminsGroup = $this->groups_model->addGroup($title.' Admins');
			
			if ($resultAddAdminsGroup == '')
			{
				$userGroupId = $this->groups_model->getGroupId($title.' Users');
				$adminGroupId = $this->groups_model->getGroupId($title.' Admins');
				
				foreach ($admins as $admin)
				{
					$key_value = explode("=", $admin);
					$key = $key_value[0];
	
					if($key != 'none')
					{
						$this->groups_model->addToGroup($adminGroupId, $key_value[1]);	
					}
				}
				
				$data = array(
				  'classTitle'     => $title,
				  'classDesc'      => $description,
				  'classPrice'     => (float)$price,
				  'classSubLength' => $sub_length,
				  'classAdmins'    => $adminGroupId,
				  'classStartDate' => $start,
				  'classEndDate'   => $end,
				  'classSite'      => 1,
				);
				
				$this->classes_model->addClass($data);
				$this->session->set_flashdata('type', 'message success');
				$this->session->set_flashdata('msg', 'The course '.$title.' was created successfully!');
				redirect('site_admin/courses/');
			}
			else
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', $resultAddAdminsGroup);
				redirect('site_admin/courses/add_course');
			}
		}
		else
		{
			$this->session->set_flashdata('type', 'message error');
			$this->session->set_flashdata('msg', $resultAddUsersGroup);
			redirect('site_admin/courses/add_course');
		}
	}
	
	function db_editCourseInfo()
	{
		$id          = $this->input->post('id');
		$title       = $this->input->post('title');
		$description = $this->input->post('description');
		$price       = $this->input->post('price');
		$start       = $this->input->post('start_date');
		$end         = $this->input->post('end_date');
		$sub_length  = $this->input->post('subscription_length');

		$this->classes_model->setTitle($id, $title);
		$this->classes_model->setDesc($id, $description);
		$this->classes_model->setPrice($id, $price);
		$this->classes_model->setStartDate($id, $start);
		$this->classes_model->setEndDate($id, $end);
		$this->classes_model->setSubLength($id, $sub_length);
		
		$this->session->set_flashdata('type', 'message success');
		$this->session->set_flashdata('msg', 'The course information for '.$title.' was updated successfully!');
		redirect('site_admin/courses/edit_course/'.$id);
			
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