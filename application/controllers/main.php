<?php

class Main extends Controller
{
	function index()
	{
		$data['content'] = 'index';
		$this->load->view('template', $data);
	}
	
	function login()
	{	
		if (!$this->_is_logged_in())
		{
			$result = $this->users_model->authenticate($this->input->post('email'), $this->input->post('password'));

			if ($result)
			{
				$userID = $this->users_model->getId($this->input->post('email'));
				$isSiteAdmin = $this->users_model->isSiteAdmin($userID);
				$isClassAdmin = $this->users_model->isClassAdmin($userID);
				$isLectureAdmin = $this->users_model->isLectureAdmin($userID);
				
				$data = array('email' => $this->input->post('email'),
							  'is_logged_in' => true,
							  'is_site_admin' => $isSiteAdmin,
							  'is_class_admin' => $isClassAdmin,
							  'is_lecture_admin' => $isLectureAdmin);

				$this->session->set_userdata($data);
				$redirect_location = 'student';

				if (!IS_AJAX)
				{
					redirect($redirect_location);
				}
				else
				{
					echo $redirect_location;
				}
			}
			else
			{
				if (IS_AJAX)
				{
					echo 'invalid_login';
				}
				else
				{
					$data['content'] = 'unauthorized';
					$data['type'] = 'invalid';
					$this->load->view('template', $data);
				}
			}
		}
	}

	function logout()
	{
		$this->session->destroy();
		redirect('main');
	}

	function _is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if($is_logged_in)
		{
			echo "already logged in";
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function register()
	{
		echo 'ok';
	}
	
	function about()
	{
		$data['content'] = 'about';
		$this->load->view('template', $data);
	}
	
	function registration()
	{
		$data['content'] = 'register';
		$this->load->view('template', $data);
	}
	
	function courses()
	{
		$data['content'] = 'courses';
		$this->load->view('template', $data);
	}
	
}
?>