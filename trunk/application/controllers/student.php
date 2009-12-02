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
			return true; 
		}
	}
	
	function logout()
	{
		$this->session->destroy();
		redirect('main');
	}
	
	function subscriptions($subDir = ' ', $id = ' ')
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'student/subscriptions';
			if($subDir != ' ')
				$data['content'] = 'student/'.$subDir;
			if($id != ' '){
				if($this->subscriptions_model->userHasSub($this->users_model->getId($this->session->userdata('email')), $id)){
					$data['id'] = $id;
					$sub = $this->subscriptions_model->getSubscription($id);
					$data['extendedDate'] = $this->_getExtendedDate($sub);
				}
				else{
					$data['content'] = 'student/notFound';
					$data['subject'] = 'Subscription';
				}
			}
			$this->load->view('student/template', $data);
		}
	}
	
	function _getExtendedDate($sub){
		$userId = $this->users_model->getId($this->session->userdata('email'));
		$subClass = $sub->subscriptionClass;
		$subLength = $this->classes_model->getClassSubLength($sub->subscriptionClass);
		
		$endDate = strtotime($sub->subscriptionEndDate);
		if(strtotime($endDate) - strtotime(Date("l F d, Y")) < 0);
			$endDate = strtotime(Date("l F d, Y"));
		$endDate += 24 * 60 * 60 * $subLength; // Add $subLength days
		$newDate = date("Y-m-d", $endDate);

		return $newDate;
	}
	
	function extend(){
		
	}
	
	function courses($classId = ' ', $lectureId = ' ')
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'student/courses';
	
			if($classId != ' '){
				$data = $this->_loadClassId($data, $classId);
	
				if($data['content'] == 'student/notFound'){
					$this->load->view('student/template', $data);
					return;
				}
	
				if($lectureId != ' '){
					$data = $this->_loadLectureId($data, $lectureId, $classId);		
				}
			}
	
			$this->load->view('student/template', $data);
		}
	}
	
	function _loadClassId($data, $classId)
	{
		$data['classId'] = $classId;
		$result = $this->classes_model->getClassInfo($classId);
				
		// DOES THIS CLASS EXIST AND DOES THE USER HAVE ACCESS?
		if(is_null($result) || (!$this->subscriptions_model->isActive($this->users_model->getId($this->session->userdata('email')), $classId) && !$this->session->userdata('is_site_admin'))){
				$data['content'] = 'student/notFound';
				$data['subject'] = 'Course';
				return $data;
		}
				
		$data['content'] = 'student/lectures';
		$data['classTitle'] = $result->classTitle;
		return $data;
	}
	
	function _loadLectureId($data, $lectureId, $classId)
	{
		$data['lectureId'] = $lectureId;
		$result = $this->lectures_model->getLectureInfo($lectureId);
				
		// DOES THIS LECTURE EXIST?
		if($result->num_rows()==0){
			$data['content'] = 'student/notFound';
			$data['subject'] = 'Lecture';
			return $data;
		}
				
		foreach ($result->result() as $info) {
			// IS IT IN THE RIGHT CLASS?
			if($info->lectureClass != $classId){
				$data['content'] = 'student/notFound';
				$data['subject'] = 'Lecture';
				return $data;
			}
			$data['content'] = 'student/lecture';
			$data['lectureTopic'] = $info->lectureTopic;
			$data['lectureStartTime'] = $info->lectureStartTime;
			$data['lectureEndTime'] = $info->lectureEndTime;
			$data['lectureAdmin'] = $info->lectureAdmin;
			$data['lectureID'] = $lectureId;
		}
		
		return $data;
	}
	
	function lecture($lectureNumber='rest')
	{
		if ($this->_is_authorized())
		{
			$data['content'] = 'student/lecture';
			$data['lectureNumber']= 'red';
			$this->load->view('student/template', $data);
		}
	}
	
	function settings()
	{
		if ($this->_is_authorized())
		{
			$data['error'] = '';
			$data['content'] = 'student/settings';
			$this->load->view('student/template', $data);
		}
	}
	
	function updateProfile()
	{
		if ($this->_is_authorized())
		{
			// Get form data
			$id = $this->users_model->getId($this->session->userdata('email'));
			$email =  $this->input->post('email');
    		$fname =  $this->input->post('fName');
			$lname =  $this->input->post('lName');
			$passwd =  $this->input->post('pass');
			$repasswd =  $this->input->post('repass');
			
			// Set Validation Rules
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');	
			$this->form_validation->set_rules('fName', 'First Name', 'required');
			$this->form_validation->set_rules('lName', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
			if($passwd != '' || $repasswd != ''){ // Dont check passwords if blank
				$this->form_validation->set_rules('pass', 'Password', 'required|matches[repass]|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('repass', 'Password Confirmation', 'required');
			}
			
			// Run Validation
			if ($this->form_validation->run() == FALSE)
			{
				$data['content'] = 'student/settings';
				$this->load->view('student/template', $data);
				return;
			}
			
			// Update Database
			$this->users_model->setLastName($id, $lname);
			$this->users_model->setFirstName($id, $fname);
			if($passwd != ''){ // Dont update password if blank
				$this->users_model->setPassword($id, $passwd);
			}
			$this->users_model->setEmail($id, $email);

			// Also need to update the session data
			$this->session->set_userdata('email', $email);
		
			$data['content'] = 'student/settings';
			$this->load->view('student/template', $data);
		}
	}
	
	function email_check($email)
	{
		$id = $this->users_model->getId($this->session->userdata('email'));
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
	
}

?>