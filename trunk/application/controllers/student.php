<?php

class Student extends Controller
{
																 
	function Student(){
		parent::Controller();
	}
	
	/*
	 * Load the Student index view. If a parameter is given, load an announcement in the right panel.
	 *
	 * @param announcment id
	 */
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
	
	/*
	 * Determin if the user is logged in
	 *
	 * @return TRUE if logged in, FALSE otherwise. Load an unauthorized view if the user isnt authorized
	 */
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
	
	/*
	 * Destroy session and redirect to main
	 */
	function logout()
	{
		$this->session->destroy();
		redirect('main');
	}
	
	/*
	 * Load the subscriptions view if no id is given. If an id is given, then load the view to buy that subscription
	 *
	 * @param String view to be loaded
	 * @param int id of subscription you want to buy
	 */
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
	
	/*
	 * Given a subscription, find the extended date of the subscription. If the end date occurs after the current date, then
	 * the end date should be extended using the end date. If the end date occurs before the current date, the end date should
	 * be an extension of the current date.
	 *
	 * @param String view to be loaded
	 * @param int id of subscription you want to buy
	 * @return date
	 */
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
	
	/*
	 * Display the user's course list, lecture list, or individual lecture page
	 *
	 * @param int id of class
	 * @param int id of lecture
	 */
	function courses($classId = ' ', $lectureId = ' ')
	{
		if ($this->_is_authorized())
		{
			// If the are no parameters, just load the user's course list
			$data['content'] = 'student/courses';
	
			// If there are parameters...
			if($classId != ' '){
				// Get the lectures view information
				$data = $this->_loadClassId($data, $classId);
	
				if($data['content'] == 'student/notFound'){
					$this->load->view('student/template', $data);
					return;
				}
	
				// If there is a lecture id parameter, load the individual lecture view
				if($lectureId != ' '){
					$data = $this->_loadLectureId($data, $lectureId, $classId);		
				}
			}
	
			$this->load->view('student/template', $data);
		}
	}
	
	/*
	 * Determine if the user has access to this class page that displays lectures. Set the data that determines whether 
	 * the error page is displayed, or if the class's lectures are displayed.
	 *
	 * @param array of data
	 * @param int class id
	 * @return array of data
	 */
	function _loadClassId($data, $classId)
	{
		$id = $this->users_model->getId($this->session->userdata('email'));
		$data['classId'] = $classId;
		$result = $this->classes_model->getClassInfo($classId);
				
		// DOES THIS CLASS EXIST AND DOES THE USER HAVE ACCESS?
		if(is_null($result) || (!$this->subscriptions_model->isActive($id, $classId) && !$this->session->userdata('is_site_admin') && !$this->users_model->isAdminOf($id, $classId))){
				$data['content'] = 'student/notFound';
				$data['subject'] = 'Course';
				return $data;
		}
				
		$data['content'] = 'student/lectures';
		$data['classTitle'] = $result->classTitle;
		return $data;
	}
	
	/*
	 * Determine if the user has access to this lecture page that displays an individual lecture. 
	 * Set the data that determines whether the error page is displayed, or if the lecture is displayed.
	 *
	 * @param array of data
	 * @param int lecture id
	 * @param int class id
	 * @return array of data
	 */
	function _loadLectureId($data, $lectureId, $classId)
	{
		$data['lectureId'] = $lectureId;
		$result = $this->lectures_model->getLectureInfo($lectureId);
				
		// DOES THIS LECTURE EXIST?
		if($result==NULL){
			$data['content'] = 'student/notFound';
			$data['subject'] = 'Lecture';
			return $data;
		}
				
		// IS IT IN THE RIGHT CLASS?
		if($result->lectureClass != $classId){
			$data['content'] = 'student/notFound';
			$data['subject'] = 'Lecture';
			return $data;
		}
			
		$data['content'] = 'student/lecture';
		$data['lectureTopic'] = $result->lectureTopic;
		$data['lectureStartTime'] = $result->lectureStartTime;
		$data['lectureEndTime'] = $result->lectureEndTime;
		$data['lectureAdmin'] = $result->lectureAdmin;
		$data['lectureID'] = $lectureId;
		
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
	
	/*
	 * Load the settings/ update profile page
	 */
	function settings()
	{
		if ($this->_is_authorized())
		{
			$data['error'] = '';
			$data['content'] = 'student/settings';
			$this->load->view('student/template', $data);
		}
	}
	
	/*
	 * Update a user's information. If the data doesnt validate, print errors.
	 */
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
	
  /*
   * Verify that the email is not already being used
   *
   * @param String email
   * @return TRUE if the email isnt being used in the database, FALSE if the email is being used.
   */
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