<?php

/**
  * Classes_model class handles comm between controllers and database.
  */
class Announcements_model extends Model {

  /**
    * Default constructor for Classes_model class
    */
  function Classes_model() {
    parent::Model();
  }
  
  /**
    * Gets all announcements for a user. Only get announcements if sub is active
    *
    * 
    * This actually returns an array of holders of announcements, use like so:
	* foreach ($total as $announcement) {
	*			foreach ($announcement->result() as $a) {echo($a->id);}}
    */
  function getStudentAnnouncements($userId) {
	$total = array();
	$subs = $this->subscriptions_model->getUserSubscriptions($userId);
    foreach ($subs ->result() as $sub) {
		if($this->subscriptions_model->getTimeRemaining($sub->id)>0){
			$classId = $sub->subscriptionClass;
			array_push($total, $this->getAnnouncements($classId));
			
		}
	}

	return $total;
  }
  
  /**
    * Gets all announcements for a class.
    *
    * 
    * 
    */
  function getAnnouncements($annId, $fields = '*') {
	$this->db->select($fields);
    $this->db->where('id', $annId);
    $query = $this->db->get('announcement');
    return $query;
  }
}
  
?>