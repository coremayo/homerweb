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
				//if($result == 'site_admin')
				//{
					$data = array(
							'email' => $this->input->post('email'),
							'is_logged_in' => true,
							'is_site_admin' => true);

					$this->session->set_userdata($data);
					$redirect_location = 'site_admin';
				//}

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
	
	function registration()
	{
		$data['content'] = 'register';
		$this->load->view('template', $data);
	}
}
?>