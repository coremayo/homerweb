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
    * @return String '' if the operation succeeded, otherwise error message
    */
  function addGroup($groupName) {
    //INSERT INTO cs4911.group (groupName) VALUES ('gt_site_admin');
    // First, check if group already exists
    $this->db->where('groupName', $groupName);
    $query = $this->db->get('cs4911.group');
    if ($query->num_rows > 0) {
      return "Group '$groupName' already exists.";
    }
    $data['groupName'] = $groupName;
    $this->db->insert('cs4911.group', $data);
    return '';
  }


  function getGroupId($groupName) {
    $this->db->where('groupName', $groupName);
    $this->db->select('id');
    $row = $this->db->get('group')->row();
    return $row->id;
    
  }
  
  function addToGroup($groupId, $userId) {
    $data['group_id'] = $groupId;
    $data['user_id'] = $userId;
    $this->db->insert('cs4911.group_has_user', $data);
  }

  function removeFromGroup($groupId, $userId) {
  }

  /**
    * Gets the members of a group.
    *
    * @param int Id of the group
    * @return Result a single column from the database with user ids of those 
    *         in the group or FALSE if group doesn't exist
    */
  function getGroupMembers($groupId) {
    // First check if group exists
    $this->db->where('id', $groupId);
    $query = $this->db->get('cs4911.group');
    if ($query->num_rows > 0) {
      return FALSE;
    }

    $this->db->where('group_id', $groupId);
    return $this->db->get('group_has_user');
  }
}

?>
