<?php

/**
  * The Users_model class is responsible for interfacing
  * between the database and controller classes.
  */
class Users_model extends Model {

  /**
    * Default constructor for the Users_model class.
    */
  function Users_model() {
    // call the Model constructor
    parent::Model();
  }

  /**
    * Returns an array containing all the users in the database.
    *
    * @return Array All the users in the database
    */
  function getAllUsers(){
    $query=$this->db->get('user');
    if($query->num_rows()>0){
      // return result set as an associative array
      return $query->result();
    }
  }

  /**
    * Returns the number of users in the database.
    *
    * @return int number of users
    */
  function getNumUsers(){
    return $this->db->count_all('user');
  }

  /**
    * Performs a select query for the specified user's id and attributes.
    *
    * @param int The id of the user
    * @param Array A list of attributes to retrieve, defaults to '*'
    * @return Array containing the values of each attribute
    */
  function getUserInfo($userId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $userId);

    return $this->db->get('user')->row();
  }

  /**
    * Adds a new user to the database with the email address and password.
    * Checks that the supplied email address is a valid  email address and
    * checks the password is at least 8 characters.
    *
    * @param String the email address of the user to add
    * @param String the user's password which will be hashed
    *        before being inserted into the database
    *
    * @return String empty string if inserting the user succeded,
    *         otherwise returns an error message.
    */
  function addUser($userEmail, $userPasswd, $fname, $lname) {
    // first, check that the Email is valid
    $emailRegex = '/^[A-Z0-9][A-Z0-9\._%-]*@([A-Z0-9_-]+\.)+[A-Z]{2,4}$/i';
    if (!preg_match($emailRegex, $userEmail)) {
      return ('Invalid Email Address');
    }

    // then check that the password is valid
    if ((strlen($userPasswd) < 5) || strlen($userPasswd > 20)) {
      return ('Password must be between 5 and 20 characters.');
    }

    if (strlen($fname) <= 0) {
      return ('First name is required');
    }

    if (strlen($lname) <= 0) {
      return ('Last name is required');
    }

    // check if the user already exists
    $this->db->where('userEmail', $userEmail);
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
      return "User Already Exists";
//      return "User Already Exists '" . $this->db->last_query() . "'";
    }

    // if all is good, add a new user
    $data = array(
      'userEmail'            => $userEmail,
      'userPasswdHash'       => sha1($userPasswd),
      'userRegistrationDate' => date('Y-m-d'),
      'userFirstName'        => $fname,
      'userLastName'         => $lname,
      'userActive'           => 1,
    );
    $this->db->insert('user',$data);

    return '';
  }

  /**
    * Returns the email address of the user with the given id.
    *
    * @param int Id of the user to query
    * @return String The user's email address
    */
  function getEmail($userId) {
    $this->db->where('id', $userId);
    $this->db->select('userEmail');
    $row = $this->db->get('user')->row();
    return $row->userEmail;
  }

  /**
    * Returns the first name of the user with the given id.
    *
    * @param int Id of the user to query
    * @return String The first name of the user
    */
  function getFirstName($userId) {
    $this->db->select('userFirstName');
    $this->db->where('id', $userId);

    $row = $this->db->get('user')->row();
    return $row->userFirstName;

  }

  /**
    * Sets the user's first name to the given value.
    *
    * @param int Id of the user to modify
    * @param String value to use as the user's first name
    */
  function setFirstName($userId, $firstName) {
    $data['userFirstName'] = $firstName;
    $this->db->where('id', $userId);
    $this->db->update('user', $data);
  }
  
  
  /**
    * Sets the user's confirmation code and expiration date to the given value.
    *
    * @param String email of the user to modify
    * @param String value to use as the user's confirmation code
    */
  function setConfirmationCode($userEmail, $conCode, $expDate) {
    $data['userConCodeHash'] = sha1($conCode);
	$data['userConCodeExpDate'] = $expDate;
    $this->db->where('userEmail', $userEmail);
    $this->db->update('user', $data);
  }
  /**
    * Checks whether the given code is valid.
    *
    * @param String code of confirmation code to check
    * @return int return user id if valid, otherwise return NULL
    */
  function verifyConfirmationCode($code){
	if($code != NULL){
		$query = $this->db->query('SELECT userConCodeExpDate, userEmail, id FROM user WHERE userConCodeHash = \''.sha1($code).'\'');
		if ($query->num_rows() > 0){
			// Check if the date is still valid
			if(strtotime(Date("Y-m-d H:i:s")) <= strtotime($query->row()->userConCodeExpDate)){
				// Reset code and date
				$this->setConfirmationCode($query->row()->userEmail, NULL, NULL);
				return $query->row()->id;
			}
		}
	}
	
	return NULL;
  }
  
  /**
    * Sets the user's active status to the given value.
    *
    * @param int Id of the user to modify
    * @param int value to use as the user's active status
    */
  function setActive($userId, $status) {
    $data['userActive'] = $status;
    $this->db->where('id', $userId);
    $this->db->update('user', $data);
  }
  
  /**
    * Sets the user's password to the given value.
    *
    * @param int Id of the user to modify
    * @param String value to use as the user's password
    */
  function setPassword($userId, $pass) {
    $data['userPasswdHash'] = sha1($pass);
    $this->db->where('id', $userId);
    $this->db->update('user', $data);
    
    //TODO: need to return error msg if password is not valid ex. too short
    
  }
  
  /**
    * Sets the user's email address to the given value.
    *
    * @param int Id of the user to modify
    * @param String value to use as the user's email address
    */
  function setEmail($userId, $email) {
    $data['userEmail'] = $email;
    $this->db->where('id', $userId);
    $this->db->update('user', $data);
    
    //TODO: need to return error msg if new email address already exists. or email is invalid
    
  }

  /**
    * Returns the last name of the user with the given id.
    *
    * @param int Id of the user to query
    * @return String The last name of the user
    */
  function getLastName($userId) {
    $this->db->select('userLastName');
    $this->db->where('id', $userId);

    $row = $this->db->get('user')->row();
    return $row->userLastName;

  }

  /**
    * Sets the user's last name to the given value.
    *
    * @param int Id of the user to modify
    * @param String value to use as the user's last name
    */
  function setLastName($userId, $lastName) {
    $data['userLastName'] = $lastName;
    $this->db->where('id', $userId);
    $this->db->update('user', $data);
  }

  /**
    * Returns the name of the user in the format 'First Last'
    *
    * @param int Id of the user to query
    * @return String The last name of the user
    */
  function getFullName($userId) {
    return $this->getFirstName($userId) . " " . $this->getLastName($userId);
  }

  /**
    * Checks whether the given credentials are correct.
    *
    * @param String Email address of the user to authenticate
    * @param String Password of the user to authenticate
    * @return boolean TRUE if credentials are correct, otherwise FALSE
    */
  function authenticate($userEmail, $userPassword) {
    $sql = 'SELECT id FROM user WHERE userEmail = ? AND userPasswdHash = \''.sha1($userPassword).'\'';
    $query = $this->db->query($sql, array($userEmail));
    return ($query->num_rows() > 0);
  }

  /**
    * Gets the id of the user with the specified email address.
    *
    * @param String The user's email address
    * @return int The id of the user
    */
  function getId($userEmail) {
    $this->db->where('userEmail', $userEmail);
    $this->db->select('id');
    $row = $this->db->get('user')->row();
	if($row != NULL)
   		return $row->id;
	else
		return NULL;
  }

  /**
    * Determines if the given user is a site admin for any site.
    *
    * @param int id of the user
    * @return boolean TRUE if the user is a site admin for at least one site, 
    *         FALSE otherwise or if the user does not exist
    */
  function isSiteAdmin($userId) {
    $regEx = '/^[0-9]+$/';
    // first check that the user id only contains numbers
    if  (!preg_match($regEx, $userId)) {
      return false;
    } else {
      $this->db->select("user.id FROM site, user, group_has_user WHERE group_has_user.group_id = site.siteAdmins AND user.id = group_has_user.user_id AND user_id = $userId");
      $query = $this->db->get();
      return ($query->num_rows() > 0);
    }
  }

  /**
    * Determines if the given user is a course admin for any site.
    *
    * @param int id of the user
    * @return boolean TRUE if the user is a course admin for at least one course, 
    *         FALSE otherwise or if the user does not exist
    */
  function isClassAdmin($userId) {
    $regEx = '/^[0-9]+$/';
    // first check that the user id only contains numbers
    if  (!preg_match($regEx, $userId)) {
      return false;
    } else {
      $this->db->select("user.id FROM class, user, group_has_user WHERE group_has_user.group_id = class.classAdmins AND user.id = group_has_user.user_id AND user_id = $userId");
      $query = $this->db->get();
      return ($query->num_rows() > 0);
    }
  }

  /**
    * Determines if the given user is a lecture admin for any site.
    *
    * @param int id of the user
    * @return boolean TRUE if the user is a lecture admin for at least one lecture, 
    *         FALSE otherwise or if the user does not exist
    */
  function isLectureAdmin($userId) {
    $this->db->select('lectureAdmin');
    $this->db->from('lecture');
    $this->db->where('lectureAdmin', $userId);
    $query = $this->db->get();
    return ($query->num_rows() > 0);
  }
}
