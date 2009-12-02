<?php

class Subscriptions_model extends Model {
  
  function Subscriptions_model() {
    parent::Model();
  }

  /**
    * Gets information about a user's subscriptions. Will be returned in the 
    * form of an array of objects. Can be used in the following way: <br />
    * $subs = getUserSubscriptions($userId); <br />
    * foreach ($subs ->result() as $sub) { echo($sub->subscriptionStartDate); }
    */
  function getUserSubscriptions($userId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('subscriptionUser', $userId);
//    $this->db->where('subscriptionPaid', 'Y');
    $query = $this->db->get('subscription');
    return $query;
  }

  /**
    * Gets a list of course id's for which the given student has never subscribed.
    */
  function getPossibleSubscriptions($userId) {
    $regEx = '/^[0-9]+$/';
    // first check that the user id only contains numbers
    if  (!preg_match($regEx, $userId)) {
      return false;
    } else {
      $this->db->select('c.*');
      $this->db->from('class c');
      $this->db->where('c.classEndDate > CURRENT_DATE()');
      $this->db->where("c.id NOT IN (SELECT s.subscriptionClass FROM subscription s WHERE s.subscriptionUser = $userId)");
    }
    return $this->db->get();
  }
  
  /**
    * Get the time remaining for a given subscription id 
    * 
    * 
    * 
    */
  
  function getTimeRemaining($subId){
	$sub = $this->getSubscription($subId);
	$datediff = strtotime($sub->subscriptionEndDate) - strtotime(Date("l F d, Y")); 
	
	if($datediff>86400)
		$res = round($datediff /86400);
	else if($datediff<0)
		$res = 0;
	else
		$res = 1;
		
	return $res;
  }
  
  /**
    * Get a subscription from a given subscription id
    * 
    * 
    * 
    */
  function getSubscription($subId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $subId);
    $query = $this->db->get('subscription')->row();
    return $query;
  }
  
  /**
    * Return valid course IDs (user has active subscription). Note the format of date comparisons 
    */
  
  function getValidCourseIDs($userId){
	$this->db->select('subscriptionClass');
    $this->db->where('subscriptionUser', $userId);
	$this->db->where('subscriptionEndDate >=', Date("Y-m-d"));
	
	$query = $this->db->get('subscription');
    return $query->result();
  }
  
  /**
    * Determine if user has an active subscription of given course
    */
  
  function isActive($userId, $classId){
	$this->db->select('subscriptionClass');
    $this->db->where('subscriptionUser', $userId);
	$this->db->where('subscriptionEndDate >=', Date("Y-m-d"));
	$this->db->where('subscriptionClass', $classId);
	
	$query = $this->db->get('subscription');
    return $query->num_rows()>0;
  }
  
  /**
    * Determine if user has a subscription of given course (can be old subscription)
    */
  
  function userHasSub($userId, $classId){
	$this->db->select('subscriptionClass');
    $this->db->where('subscriptionUser', $userId);
	$this->db->where('subscriptionClass', $classId);
	
	$query = $this->db->get('subscription');
    return $query->num_rows()>0;
  }
  
  /**
    * Add a subscription for a given user and course. If the course is in the 
    * future, the sub will begin on the start day of the course. If not, the 
    * sub will start immediately.  If the user has a current subscription for 
    * the course, a new one will be added with a start date of the day after 
    * his current subscription ends.
    */
  function addSub($userId, $classId) {

    // check if the user already has a current subscription
    if(($subId = $this->hasCurrentSub($userId, $classId)) >  0) {

      // then just extend the current sub
      $this->db->select('subscriptionEndDate');
      $this->db->from('subscription');
      $this->db->where('id', $subId);
      $startDate = $this->db->get()->row()->subscriptionEndDate;
      $startDate = date('Y-m-d', strtotime("$startDate +1 day"));
      
    } else { // we are going to create a new sub

      // find the starting date for the subscription
      $this->db->select('classStartDate');
      $this->db->where('id', $classId);
      $row = $this->db->get('class')->row();
      $startDate = $row->classStartDate;

      // we want to make sure the start date is in the future
      if (strtotime($startDate) < strtotime("today")) {
        $startDate = date('Y-m-d');
      }
    }

    $sub['subscriptionStartDate'] = $startDate;

    // find the length of the sub
    $this->db->select('classSubLength');
    $this->db->where('id', $classId);
    $row = $this->db->get('class')->row();
    $subLength = $row->classSubLength;

    $sub['subscriptionEndDate'] = date('Y-m-d', strtotime("$startDate +$subLength days"));
    $sub['subscriptionClass'] = $classId;
    $sub['subscriptionUser'] = $userId;

    $this->db->insert('subscription', $sub);
  }

  /**
    * Checks whether the given user has a current subscription for the given course. 
    * If so, returns the subscription id; otherwise returns a negative value.
    */
  function hasCurrentSub($userId, $classId) {
    $this->db->select('id');
    $this->db->from('subscription');
    $this->db->where('subscriptionUser', $userId);
    $this->db->where('subscriptionClass', $classId);
    $this->db->where('subscriptionStartDate <= CURRENT_DATE');
    $this->db->where('subscriptionEndDate >= CURRENT_DATE');
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
      $subId = $query->row()->id;
    } else {
      $subId = -1;
    }
    return $subId;
  }
}

?>
