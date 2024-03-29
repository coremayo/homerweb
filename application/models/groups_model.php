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
    // First, check if group already exists
    $db_name = $this->db->database;
    $this->db->where('groupName', $groupName);
    $query = $this->db->get($db_name.".group");
    if ($query->num_rows > 0) {
      return "Group '$groupName' already exists.";
    }
    $data['groupName'] = $groupName;
    $this->db->insert($db_name.'.group', $data);
    return '';
  }

  /**
   * Gets the id of the group with the specified name.
   *
   * @param String Group name
   * @return int Group id
   */
  function getGroupId($groupName) {
    $this->db->where('groupName', $groupName);
    $this->db->select('id');
    $row = $this->db->get('group')->row();
    return $row->id;
    
  }
  
  /**
   * Adds the given user to the given group.
   *
   * @param int group id
   * @param int user id
   */
  function addToGroup($groupId, $userId) {
    $db_name = $this->db->database;
    $data['group_id'] = $groupId;
    $data['user_id'] = $userId;
    $this->db->insert($db_name . '.group_has_user', $data);
  }

  /**
   * Removes the given user from the given group.
   *
   * @param int group id
   * @oaram int user id
   */
  function removeFromGroup($groupId, $userId) {
    $this->db->where('group_has_user.group_id', $groupId);
    $this->db->where('group_has_user.user_id', $userId);
    $this->db->delete('group_has_user'); 
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
    $db_name = $this->db->database;
    $query = $this->db->get($db_name . ".group");
    if ($query->num_rows > 0) {
      return FALSE;
    }

    $this->db->where('group_id', $groupId);
    return $this->db->get('group_has_user');
  }
}

?>
