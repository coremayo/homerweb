<?php

/**
 * Handles functions such as retrieving and adding course announce from the database.
 */
class Announcements_model extends Model {

  /**
    * Default constructor for Announcements_model class.
    */
  function Announcements_model() {
    parent::Model();
  }
  
  /**
   * Gets all announcements for a user. Only get announcements for courses 
   * which the user has an active subscription.
   *
   * This actually returns an array of holders of announcements, use like so:
	 * foreach ($total as $announcement) {
	 *			foreach ($announcement->result() as $a) {echo($a->id);}}
   *
   * @param int id of the user to query
   * @return Array announcements for the user queried
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
   * @param int id of the class to query
   * @param String fields from the announcement database table to return
   * @return Array announcements for the class queried
   */
  function getAnnouncements($annId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('announcementClass', $annId);
    $query = $this->db->get('announcement');
    return $query;
  }
}
  
?>
