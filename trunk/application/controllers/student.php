<?php

class Student extends Controller
{
	function Student(){
		parent::Controller();
	}
	
	function index($ann = ' ')
	{
		if ($this->_is_authorized())
		{
			$data['topic'] = 'Selected Announcement';
			$data['message'] = 'Nothing Selected';
			$data['date'] = '';
			$data['class'] = '';
			$data['content'] = 'student/index';
			if(is_numeric($ann) && $ann >= 1){
				$data['ann'] = $ann;
				$result = $this->announcements_model->getStudentAnnouncements($this->users_model->getId($this->session->userdata('email')));
				foreach ($result as $announcement) {
				foreach ($announcement->result() as $a) {
					if($a->id == $ann){
						$data['topic'] = $a->announcementTitle;
						$data['message'] = $a->announcementMessage;
						$data['date'] = $a->announcementCreatedDate;
						$data['class'] = $this->classes_model->getClassTitle($a->announcementClass);
						
						break 2;
					}
				}}
			}
			$this->load->view('student/template', $data);
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
			$has_permissions = $this->session->userdata('is_student');

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
	
	function logout()
	{
		$this->session->destroy();
		redirect('main');
	}
	
	function subscriptions()
	{
		$data['content'] = 'student/subscriptions';
		$this->load->view('student/template', $data);
	}
	
	function courses($classId = ' ', $lectureId = ' ')
	{
		$data['content'] = 'student/courses';
		if($classId != ' '){
				$data['classId'] = $classId;
				$result = $this->classes_model->getClassInfo($classId);
				
				// DOES THIS CLASS EXIST AND DOES THE USER HAVE ACCESS?
				if($result->num_rows()==0 || !$this->subscriptions_model->isActive($this->users_model->getId($this->session->userdata('email')), $classId)){
					$this->load->view('student/template', $data); // MAKE AN ERROR PAGE LATER
					return;
				}
				
				$data['content'] = 'student/lectures';
				foreach ($result->result() as $info) {
						$data['classTitle'] = $info->classTitle;
				}
		}
		if($lectureId != ' '){
				$data['lectureId'] = $lectureId;
				$result = $this->lectures_model->getLectureInfo($lectureId);
				
				// DOES THIS LECTURE EXIST?
				if($result->num_rows()==0){
					$this->load->view('student/template', $data); // MAKE AN ERROR PAGE LATER
					return;
				}
				
				foreach ($result->result() as $info) {
					// IS IT IN THE RIGHT CLASS?
					if($info->lectureClass != $classId){
						$this->load->view('student/template', $data); // MAKE AN ERROR PAGE LATER
						return;
					}
						$data['content'] = 'student/lecture';
						$data['lectureTopic'] = $info->lectureTopic;
						$data['lectureStartTime'] = $info->lectureStartTime;
						$data['lectureEndTime'] = $info->lectureEndTime;
						$data['lectureAdmin'] = $info->lectureAdmin;
				}
		}

		$this->load->view('student/template', $data);
	}
	
	function lecture($lectureNumber='rest')
	{
		$data['content'] = 'student/lecture';
		$data['lectureNumber']= 'red';
		$this->load->view('student/template', $data);
	}
	
	
}

?>