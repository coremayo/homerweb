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

				$row = $this->db->get('user')->row();
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
				* @return boolean TRUE if inserting the user succeded,
	*         otherwise returns an error message.
				*/
		function addUser($userEmail, $userPasswd) {
				// first, check that the Email is valid
				$emailRegex = '/^[A-Z0-9][A-Z0-9\._%-]*@([A-Z0-9_-]+\.)+[A-Z]{2,4}$/i';
				if (!preg_match($emailRegex, $userEmail)) {
						return ('Invalid Email Address');
				}

				// then check that the password is valid
				$passwdRegex = '/.{8,}/';
				if (!preg_match($passwdRegex, $userPasswd)) {
						return ('Password must be at least 8 characters.');
				}

				// check if the user already exists
				$this->db->where('userEmail', $userEmail);
				$query = $this->db->get('user');
				if ($query->num_rows() > 0) {
						return "User Already Exists";
				}

				// if all is good, add a new user
				$data = array(
						'userEmail' => $userEmail,
						'userPasswdHash' => sha1($userPasswd),
						'userRegistrationDate' => date('Y-m-d')
				);
				$this->db->insert('user',$data);

				return TRUE;
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
				return $row['userEmail'];
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
				return $row['userFirstName'];

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
				* Returns the last name of the user with the given id.
				*
				* @param int Id of the user to query
				* @return String The last name of the user
				*/
		function getLastName($userId) {
				$this->db->select('userLastName');
				$this->db->where('id', $userId);

				$row = $this->db->get('user')->row();
				return $row['userLastName'];

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
				return "$this->getFirstName($userId) $this->getLastName($userId)";
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
				return $row->id;
		}



		/**
				* Determines whether the user is logged in by checking whether a session
				* variable with the user's id has been set.
				*
				* @return boolean TRUE if the user is logged in, otherwise FALSE
				*/
		function isLoggedIn() {
				return (strlen($this->session->userdata('userId')) > 0);
		}

}
