<?php

class Subscriptions_model extends Model {
  
  function Subscriptions_model() {
    parent::Model();
  }
 
	/**
	  * Set subscription start date of given subscription
	  * 
	  * @param int sub id of sub to update
	  * @param date to set
	  */
	  function setStartDate($subID, $date){
		  $data['subscriptionStartDate'] = $date;
    	  $this->db->where('id', $subID);
    	  $this->db->update('subscription', $data);
	  }
	  
	  /**
	  * Set subscription end date of given subscription
	  * 
	  * @param int sub id of sub to update
	  * @param date to set
	  */
	  function setEndDate($subID, $date){
		  $data['subscriptionEndDate'] = $date;
    	  $this->db->where('id', $subID);
    	  $this->db->update('subscription', $data);
	  }
	  
	  /**
	  * Extend subscription end date of given subscription
	  * 
	  * @param int sub id of sub to update
	  * @param date to set
	  */
	  function extendEndDate($subID, $days){
		   $this->db->select('subscriptionEndDate');
      	  $this->db->from('subscription');
      	  $this->db->where('id', $subID);
		  $endDate = $this->db->get()->row()->subscriptionEndDate;
		  
		  $data['subscriptionEndDate'] = date('Y-m-d', strtotime("$endDate +$days day"));;
    	  $this->db->where('id', $subID);
    	  $this->db->update('subscription', $data);
	  }
	  
	  /**
	  * Extend subscription start date of given subscription
	  * 
	  * @param int sub id of sub to update
	  * @param date to set
	  */
	  function extendStartDate($subID, $days){
		   $this->db->select('subscriptionStartDate');
      	  $this->db->from('subscription');
      	  $this->db->where('id', $subID);
		  $startDate = $this->db->get()->row()->subscriptionStartDate;
		  
		  $data['subscriptionStartDate'] = date('Y-m-d', strtotime("$startDate +$days day"));;
    	  $this->db->where('id', $subID);
    	  $this->db->update('subscription', $data);
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
    * the course, that subscription will be extended if the end date is in the future,
    * or renewed if it is expired
    */
  function addSub($userId, $classId) {
	  
	 // find the length of the sub
    $this->db->select('classSubLength');
    $this->db->where('id', $classId);
    $row = $this->db->get('class')->row();
    $subLength = $row->classSubLength;

    // check if the user already has a subscription
    if(($subId = $this->hasSub($userId, $classId)) >  0) {
	  $this->db->select('subscriptionEndDate');
      $this->db->from('subscription');
      $this->db->where('id', $subId);
	  $endDate = $this->db->get()->row()->subscriptionEndDate;
	  
	  // If the end date is in the future, extend the subscription's end date
	  if($endDate > date('Y-m-d')){
		  $data['subscriptionEndDate'] = date('Y-m-d', strtotime("$endDate +$subLength days"));
		  $this->db->where('id', $subId);
		  $this->db->update('subscription', $data);
		  return;
	  }
	  else{// Otherwise make today the start date and extend it
		  $data['subscriptionStartDate'] = date('Y-m-d');
		  $startDate = date('Y-m-d');
		  $data['subscriptionEndDate'] = date('Y-m-d', strtotime("$startDate +$subLength days"));
		  $this->db->where('id', $subId);
		  $this->db->update('subscription', $data);
		  return;
	  }
      
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
  
    /**
    * Checks whether the given user has a subscription for the given course (does not have to be current) 
    * If so, returns the subscription id; otherwise returns a negative value.
    */
  function hasSub($userId, $classId) {
    $this->db->select('id');
    $this->db->from('subscription');
    $this->db->where('subscriptionUser', $userId);
    $this->db->where('subscriptionClass', $classId);
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
      $subId = $query->row()->id;
    } else {
      $subId = -1;
    }
    return $subId;
  }
  
  /**
 	* Get a list of subscriptions of students subscriped to the course
  	*/
  
  function getAllStudentSubscriptions($classID){
	  
	  $this->db->select('s.id as subID, u.id, u.userFirstName, u.userLastName, u.userEmail, s.subscriptionEndDate, s.subscriptionStartDate');
	  $this->db->from('subscription s');
	  $this->db->where('s.subscriptionClass', $classID);
   	  $this->db->join('user u', 's.subscriptionUser = u.id');
	  
	  $query = $this->db->get();
      return $query->result();
  }
}

?>
