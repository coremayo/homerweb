<?php

class Main extends Controller
{
	/*
	 *	Load the main page if the user isnt logged in. If the user is logged in, load the student view.
	 */
	function index()
	{
		if (!$this->_is_logged_in())
		{
			$data['content'] = 'index';
			$this->load->view('template', $data);
		}
		else
		{
			redirect("student");
		}
	}
	
	/*
	 *	If the user isnt logged in, query database to see if user id and pass are valid. If they are valid, set session variables
	 *	and load the student view. If the credentials arent valid, print an error or load an error page (depending if AJAX)
	 */
	function login()
	{	
		if (!$this->_is_logged_in())
		{
			// Query database to see if credentials are valid
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

	/*
	 *	Destroy this session and redirect to main page
	 */
	function logout()
	{
		$this->session->destroy();
		redirect('main');
	}

	/*
	 *	Determine if user is already logged in
	 *
	 *	@return TRUE if logged in, else FALSE
	 */
	function _is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if($is_logged_in)
		{
			//echo "already logged in";
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
	 *	Load the About page
	 */
	function about()
	{
		$data['content'] = 'about';
		$this->load->view('template', $data);
	}
	
	/*
	 *	Load the Registration page
	 */
	function registration()
	{
		$data['content'] = 'register';
		$this->load->view('template', $data);
	}
	
	/*
	 *	Load the Courses page
	 */
	function courses()
	{
		$data['content'] = 'courses';
		$this->load->view('template', $data);
	}
	
	/*
	 *	Load the QBank page
	 */
	function qbank()
	{
		$data['content'] = 'qbank';
		$this->load->view('template', $data);
	}
	
}
?>