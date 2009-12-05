<?php

include 'application/views/site_admin/table_constants.php';

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
		
		// Set Validation Rules
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		
		// Run Validation
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('type', 'message error');
			$this->session->set_flashdata('msg', validation_errors());
			redirect('site_admin/users/add_user/');
		}
		
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
			// Set up Password validation
			$this->form_validation->set_rules('password_'.$password_type, 'Password', 'required|matches[password_check]|min_length[5]|max_length[20]');
		$this->form_validation->set_rules('password_check', 'Password Confirmation', 'required');
			// Check valication
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('type', 'message error');
				$this->session->set_flashdata('msg', validation_errors());
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
		
		// Set Validation Rules
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check['.$id.']');
		if ($password_type == 'new')
		{
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[20]');
		}
		
		// Run Validation
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('type', 'message error');
			$this->session->set_flashdata('msg', validation_errors());
			redirect('site_admin/users/edit_user/'.$id);
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
		
		// Set Validation Rules
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('title', 'Title', 'required|callback_title_check');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required|callback_end_check['.$start.']');
		$this->form_validation->set_rules('subscription_length', 'Subscription Length', 'required|integer');

		
		// Run Validation
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('type', 'message error');
			$this->session->set_flashdata('msg', validation_errors());
			redirect('site_admin/courses/add_course/');
		}

		$resultAddAdminsGroup = $this->groups_model->addGroup($title.' Admins');
			
		if ($resultAddAdminsGroup == '')
		{
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
	
	function db_editCourseInfo()
	{
		$id          = $this->input->post('id');
		$title       = $this->input->post('title');
		$description = $this->input->post('description');
		$price       = $this->input->post('price');
		$start       = $this->input->post('start_date');
		$end         = $this->input->post('end_date');
		$sub_length  = $this->input->post('subscription_length');
		
		// Set Validation Rules
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	
		$this->form_validation->set_rules('title', 'Title', 'required|callback_title_check['.$id.']');
		$this->form_validation->set_rules('price', 'Price', 'required|numeric');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required|callback_end_check['.$start.']');
		$this->form_validation->set_rules('subscription_length', 'Subscription Length', 'required|integer');

		
		// Run Validation
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('type', 'message error');
			$this->session->set_flashdata('msg', validation_errors());
			redirect('site_admin/courses/edit_course/'.$id);
		}

		$this->classes_model->setTitle($id, $title);
		$this->classes_model->setDesc($id, $description);
		$this->classes_model->setPrice($id, $price);
		$this->classes_model->setStartDate($id, $start);
		$this->classes_model->setEndDate($id, $end);
		$this->classes_model->setSubLength($id, $sub_length);
		
		$this->session->set_flashdata('type', 'message success');
		$this->session->set_flashdata('msg', 'The course information for '.$title.' was updated successfully!');
		redirect('site_admin/courses/edit_course/'.$id.'/0');
	}
	
	function db_editCourseAdmins(){
		$id          = $this->input->post('id');
		$classID     = $this->input->post('classID');
		$admins      = explode("&", $this->input->post('selected_admins'));
		
		foreach ($admins as $admin)
		{
			$key_value = explode("=", $admin);
			$key = $key_value[0];
	
			if($key != 'none')
			{
				$this->groups_model->addToGroup($classID, $key_value[1]);	
			}
		}
		
		$this->session->set_flashdata('type', 'message success');
		$this->session->set_flashdata('msg', 'Course Admins added successfully!');
		redirect('site_admin/courses/edit_course/'.$id.'/1');
	}
	
	function db_editCourseStudents()
	{
		$id           = $this->input->post('id');
		$classID      = $this->input->post('classID');
		$students     = explode("&", $this->input->post('selected_students'));
		
		foreach ($students as $student)
		{
			$key_value = explode("=", $student);
			$key = $key_value[0];

			if($key != 'none')
			{
				$this->subscriptions_model->addSub($key_value[1], $classID);	
			}
		}

		$this->session->set_flashdata('type', 'message success');
		$this->session->set_flashdata('msg', 'Course Students added successfully!');
		redirect('site_admin/courses/edit_course/'.$id.'/2');
	}
	
	function db_editCourseSchedule()
	{
		echo "called db_editCourseSchedule";
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
	
	function email_check($email, $id)
	{
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
	
	function title_check($title, $id)
	{
		if (!$this->classes_model->isValidTitle($title, $id))
		{
			$this->form_validation->set_message('title_check', 'That title is already being used.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function end_check($end, $start)
	{
		if (strtotime($start) > strtotime($end))
		{
			$this->form_validation->set_message('end_check', 'Start Date must occur before End Date.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

?>