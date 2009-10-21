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
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/users_groups_home';
			$this->load->view('site_admin/template', $data);
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
	
	function users()
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/users_groups_users';
			$this->load->view('site_admin/template', $data);
		}
	}
	
	function add_user()
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'site_admin/users_groups_add_user';
			$this->load->view('site_admin/template', $data);
		}
	}
	
	function add_user_db()
	{
		$result = $this->users_model->addUser($this->input->post('email'), $this->input->post('password'));
		
		redirect('site_admin/users');

	}
	
	function _is_authorized()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			if (IS_AJAX)
			{
				$data['type'] = 'unauthorized';
				$this->load->view('unauthorized');
			}
			else
			{
				$data['content'] = 'unauthorized';
				$data['type'] = 'unauthorized';
				$this->load->view('template', $data);
			}

			return false;
		}
		else
		{
			$has_permissions = $this->session->userdata('is_site_admin');

			if(!isset($has_permissions) || $has_permissions != true)
			{
				if (IS_AJAX)
				{
					$data['type'] = 'unauthorized';
					$this->load->view('unauthorized');
				}
				else
				{
					$data['content'] = 'unauthorized';
					$data['type'] = 'unauthorized';
					$this->load->view('template', $data);
				}

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