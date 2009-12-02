<?php

/**
  * Classes_model class handles comm between controllers and database.
  */
class Classes_model extends Model {

  /**
    * Default constructor for Classes_model class
    */
  function Classes_model() {
    parent::Model();
  }

  /**
    * Returns an array containing all the classes in the database.
    *
    * @return Array All the classes in the database
    */
  function getAllClasses(){
    $query=$this->db->get('class');
    if($query->num_rows()>0){
      // return result set as an associative array
      return $query->result();
    }
  }
  
  /**
    * Returns the number of users assigned to a class.
    *
    * @param int the class id of the class to return the number of users for
    * @return int number of users
    */
  function getNumUsers($classId){
    $this->db->select('s.id');
    $this->db->from('subscription s');
    $this->db->where('s.subscriptionClass', $classId);
    $this->db->where('subscriptionStartDate <= CURRENT_DATE()');
    $this->db->where('subscriptionEndDate >= CURRENT_DATE()');
    return $this->db->count_all_results();
  }
  
  /**
    * Returns the number of admins assigned to a class.
    *
    * @param int the class id of the class to return the number of admins for
    * @return int number of admins
    */
  function getNumAdmins($classId){
    $this->db->select('classAdmins');
    $this->db->where('id', $classId);
    $row = $this->db->get('class')->row();
    $admin_group = $row->classAdmins;

    $this->db->from('group_has_user');
    $this->db->where('group_id', $admin_group);
    return $this->db->count_all_results();  
  }
  
  /**
    * Adds a new class to the database.
    *
    * @param Array fields for the new class. Should contain the following:
    * <ul>
    * <li>classTitle - String, the title of the class</li>
    * <li>classDesc - String, the description of the class</li>
    * <li>classPrice - String, the price of the class</li>
    * <li>classAdmins - int, id of the group that will be admins</li>
    * <li>classStartDate - Date, starting date for the class</li>
    * <li>classEndDate - Date, ending date for the class</li>
    * <li>classSite - int, id of the site the class belongs to</li>
    * </ul>
    *
    * @return boolean TRUE if the insert succeeded, otherwise an error message
    */
  function addClass($classInfo) {
    $this->db->insert('class', $classInfo);
  }
  
  
  function getAllAdmins($classId) {
    $this->db->select('classAdmins');
    $this->db->where('id', $classId);
    $row = $this->db->get('class')->row();
    $admin_group = $row->classAdmins;

    $this->db->from('group_has_user');
    $this->db->where('group_id', $admin_group);
    $this->db->get();
    
    $this->db->from('user');
    $this->db->where('group_id', $admin_group);
    $this->db->join('group_has_user', 'group_has_user.user_id = user.id');
    
    $query = $this->db->get();
    return $query->result();
  }
  
  
  function getAllStudents($classId) {
    $this->db->select('u.*');
    $this->db->from('subscription s');
    $this->db->from('user u');
    $this->db->where('u.id = s.subscriptionUser');
    $this->db->where('s.subscriptionClass', $classId);
    $this->db->where('s.subscriptionStartDate <= CURRENT_DATE()');
    $this->db->where('s.subscriptionEndDate >= CURRENT_DATE()');
    $this->db->group_by('u.id');
    return $this->db->get()->result();
  }
  
  function isValidTitle($title, $id){
	  // check if the title already exists
    $this->db->where('classTitle', $title);
	$this->db->where('id !=', $id);
    $query = $this->db->get('class');
    return ($query->num_rows() == 0);
  }
 
  
/**
    * Gets the class title of the class with the specified id.
    *
    * 
    * 
    */
  
  function getClassTitle($classId) {
    $this->db->select('classTitle');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classTitle;
  }
  
  function getClassPrice($classId) {
    $this->db->select('classPrice');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classPrice;
  }
  
  function getClassSubLength($classId) {
    $this->db->select('classSubLength');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classSubLength;
  }

  function getClassStartDate($classId) {
    $this->db->select('classStartDate');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classStartDate;
  }

  function setTitle($classId, $title) {
    $data['classTitle'] = $title;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  function setDesc($classId, $desc) {
    $data['classDesc'] = $desc;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  function setPrice($classId, $price) {
    $data['classPrice'] = $price;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  function setSubLength($classId, $length) {
    $data['classSubLength'] = $length;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  function setStartDate($classId, $start) {
    $data['classStartDate'] = $start;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  function setEndDate($classId, $end) {
    $data['classEndDate'] = $end;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }

  /**
    * Gets information about a class. Will be returned in the 
    * form of an array of objects.
    */
  function getClassInfo($classId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $classId);
    return $this->db->get('class')->row();
  }

  /**
    * Gets all the user ids that are students in the course and are not admins in that same course.
    *
    * @param int The course id to lookup
    */
  function getNonAdmins($courseId) {
    $this->db->select('s.subscriptionUser AS id');
    $this->db->from('subscription s');
    $this->db->where('s.subscriptionClass', $courseId);
    $this->db->where('s.subscriptionStartDate <= CURRENT_DATE()');
    $this->db->where('s.subscriptionEndDate >= CURRENT_DATE()');
    $this->db->where('s.subscriptionUser NOT IN (SELECT g.user_id FROM group_has_user g, class c WHERE c.id = s.subscriptionClass AND g.group_id = c.classAdmins)');
    return $this->db->get();
  }
  
   /**
    * Gets all the user ids that are not course admins in the course.
    *
    * @param int The course id to lookup
    */
  function getNonCourseAdmins($classId) {
	$this->db->select('u.*');
    $this->db->from('user u');
	$this->db->where('u.id NOT IN(SELECT g.user_id FROM group_has_user g, class c WHERE c.id = '.$classId.' AND g.group_id = c.classAdmins)');
    
	$query = $this->db->get();
    return $query->result();
  }


  /**
    * Gets all the user id's of admins who aren't students in a given course
    *
    * @param int The course id to lookup
    */
  function getNonStudents($courseId) {
    $this->db->select('g.user_id AS id');
    $this->db->from('group_has_user g');
    $this->db->from('class c');
    $this->db->where('c.id', $courseId);
    $this->db->where('g.group_id = c.classAdmins');
    $this->db->where('g.user_id NOT IN (SELECT s.subscriptionUser FROM subscription s WHERE s.subscriptionClass = c.id AND s.subscriptionStartDate <= CURRENT_DATE() AND s.subscriptionEndDate >= CURRENT_DATE())');
    return $this->db->get();
	
  }
  
  /**
  	* Get all the courses that the user is a course admin for
	* 
	* @param int user ID
	* @return list of course's info
  	*/
  function getCoursesAdminOf($userId){
	  $this->db->select("class.* FROM class, user, group_has_user WHERE group_has_user.group_id = class.classAdmins AND user.id = group_has_user.user_id AND user_id = $userId");
	  return $this->db->get()->result();
  }
}
?>
