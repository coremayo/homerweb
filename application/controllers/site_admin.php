<?php

class Site_admin extends Controller
{
	function index()
	{
		if ($this->_is_authorized())
		{
			$this->load->view('site_admin/template');
		}
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