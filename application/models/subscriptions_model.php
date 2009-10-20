<?php

class Subscriptions_model extends Model {
  
  function Subscriptions_model() {
    parent::model();
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
}

?>
