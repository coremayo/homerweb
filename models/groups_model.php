<?php

/**
	* The Groups_model class handles all the communication between 
	* the various controller classes and the database.
	*/
class Groups_model extends Model {

	/**
		* Default constructor for the Groups_model class.
		*/
	function Groups_model() {
		parent::Model();
		$this->load->database();
	}

	/**
		* Adds a new group to the database.
		*
		* @param String Name of the new group.
		* @return boolean TRUE if the operation succeeded, otherwise error message
		*/
	function addGroup($groupName) {
		//INSERT INTO cs4911.group (groupName) VALUES ('gt_site_admin');
	}

	/**
		* Gets the members of a group.
		*
		* @param int Id of the group
		* @return Array List of members in the group or FALSE if group doesn't exist
		*/
	function getGroupMembers($groupId) {
	}
}

?>
