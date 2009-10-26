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
    $query = $this->db->get('subscription');
    return $query;
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
	$this->db->where('subscriptionEndDate >', Date("Y-m-d"));
	
	$query = $this->db->get('subscription');
    return $query;
  }
  
  /**
    * Determine if user has an active subscription of given course
    */
  
  function isActive($userId, $classId){
	$this->db->select('subscriptionClass');
    $this->db->where('subscriptionUser', $userId);
	$this->db->where('subscriptionEndDate >', Date("Y-m-d"));
	$this->db->where('subscriptionClass', $classId);
	
	$query = $this->db->get('subscription');
    return $query->num_rows()>0;
  }
}

?>
