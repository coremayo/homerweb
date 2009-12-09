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
   * Gets all the lectures in a particular class.
   *
   * @param int id of the class to query
   * @return Array lectures of the class queried
   */
  function getSchedule($classId){
    $this->db->select('*');
    $this->db->from('lecture');
    $this->db->where('lectureClass', $classId);
    return $this->db->get()->result();
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
  
  /**
   * Gets a list of admins for the given class.
   *
   * @param int Id of the class queried
   * @return Array list of the user id's for those who are admins in a class
   */
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
  
  /**
   * Gets a list of students who are in a given class.
   *
   * @param int Id of the class queried
   * @return Array list of the user id's who are current students in the class
   */
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
  
  /**
   * Checks whether the given title already exists in the database.
   *
   * @param String class title to query for in the database
   * @param int id of class to exclude in the search
   * @return boolean True if the class title already exists, otherwise false
   */
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
   * @param int Id of the class to query
   * @return String the title of the class
   */
  function getClassTitle($classId) {
    $this->db->select('classTitle');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classTitle;
  }
  
  /**
   * Gets the price of the specified class.
   *
   * @param int Id of the class to query
   * @return String price of the specified class
   */
  function getClassPrice($classId) {
    $this->db->select('classPrice');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classPrice;
  }
  
  /**
   * Gets the length of the default subscription for the specified class.
   *
   * @param int Id of the class to query
   * @return int length in days of the default subscription
   */
  function getClassSubLength($classId) {
    $this->db->select('classSubLength');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classSubLength;
  }

  /**
   * Gets the starting date for the specified class.
   *
   * @param int Id of the class to query
   * @return String starting date of the specified class
   */
  function getClassStartDate($classId) {
    $this->db->select('classStartDate');
    $this->db->where('id', $classId);

    $row = $this->db->get('class')->row();
    return $row->classStartDate;
  }

  /**
   * Sets the title of a class to the specified value.
   *
   * @param int Id of the class to modify
   * @param String new value for the class's title
   */
  function setTitle($classId, $title) {
    $data['classTitle'] = $title;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  /**
   * Sets the description of a class to the specified value.
   *
   * @param int id of the class to modify
   * @param String new value for the class's description
   */
  function setDesc($classId, $desc) {
    $data['classDesc'] = $desc;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  /**
   * Sets the price of a class to the specified value.
   *
   * @param int id of the class to modify
   * @param String new value for the class's price
   */
  function setPrice($classId, $price) {
    $data['classPrice'] = $price;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  /**
   * Sets the default subscription length of a class.
   *
   * @param int id of the class to modify
   * @param int new value for the class's default subscription length
   */
  function setSubLength($classId, $length) {
    $data['classSubLength'] = $length;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  /**
   * Sets the start date for a class to the specified value.
   *
   * @param int id of the class to modify
   * @param String new value for the class's start date
   */
  function setStartDate($classId, $start) {
    $data['classStartDate'] = $start;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }
  
  /**
   * Sets the end date of a class to the specified value.
   *
   * @param int id of the class to modify
   * @param String new value fo the class's end date
   */
  function setEndDate($classId, $end) {
    $data['classEndDate'] = $end;
    $this->db->where('id', $classId);
    $this->db->update('class', $data);
  }

  /**
   * Gets information about a class. Will be returned in the 
   * form of an array of objects.
   *
   * @param int id of the class to query
   * @param Array list of fields to return information about
   * @return Array list of information about the specified class
   */
  function getClassInfo($classId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $classId);
    return $this->db->get('class')->row();
  }

  /**
   * Gets all the user ids that are students in the class and are not admins 
   * in that same course.
   *
   * @param int The course id to lookup
   * @return Array list of user id's that are students but not admins
   */
  function getNonAdmins($courseId) {
    $this->db->select('s.subscriptionUser AS id');
    $this->db->from('subscription s');
    $this->db->where('s.subscriptionClass', $courseId);
    $this->db->where('s.subscriptionStartDate <= CURRENT_DATE()');
    $this->db->where('s.subscriptionEndDate >= CURRENT_DATE()');
    $this->db->where('s.subscriptionUser NOT IN (SELECT g.user_id FROM group_has_user g, class c WHERE c.id = s.subscriptionClass AND g.group_id = c.classAdmins)');
    return $this->db->get()->result();
  }
  
   /**
    * Gets all the user ids that are not course admins in the course.
    *
    * @param int The course id to lookup
    * @return Array list of user id's that are not admins
    */
  function getNonCourseAdmins($classId) {
    $this->db->select('u.*');
    $this->db->from('user u');
    $this->db->where('u.id NOT IN(SELECT g.user_id FROM group_has_user g, class c WHERE c.id = '.$classId.' AND g.group_id = c.classAdmins)');
 
    $query = $this->db->get();
    return $query->result();
  }


  /**
   * Gets all the user id's of admins who aren't students in a given course.
   *
   * @param int The course id to lookup
   * @return Array list of id's for admins who aren't also students
   */
  function getNonStudents($courseId) {
    $this->db->select('g.user_id AS id');
    $this->db->from('group_has_user g');
    $this->db->from('class c');
    $this->db->where('c.id', $courseId);
    $this->db->where('g.group_id = c.classAdmins');
    $this->db->where('g.user_id NOT IN (SELECT s.subscriptionUser FROM subscription s WHERE s.subscriptionClass = c.id AND s.subscriptionStartDate <= CURRENT_DATE() AND s.subscriptionEndDate >= CURRENT_DATE())');
    return $this->db->get()->result();
	
  }
  
  /**
   * Gets all the user id's of users who aren't students or admins in a given course.
   *
   * @param int The course id to lookup
   * @return Array list of id's who aren't students or admins
   */
  function getNonStudentsAdmins($courseId) {
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->where('u.id NOT IN (SELECT s.subscriptionUser FROM subscription s WHERE s.subscriptionClass = '.$courseId.')');
	$this->db->where('u.id NOT IN (SELECT g.user_id FROM group_has_user g, class c WHERE c.id = '.$courseId.' AND g.group_id = c.classAdmins)');
    return $this->db->get()->result();
	
  }
  
  /**
   * Get all the courses that the user is a course admin for.
   * 
   * @param int user ID
   * @return list of course's info
   */
  function getCoursesAdminOf($userId){
    $this->db->select('class.* FROM class, user, group_has_user WHERE group_has_user.group_id = class.classAdmins AND user.id = group_has_user.user_id AND user_id = '.$userId.'');
    return $this->db->get()->result();
  }
  
  /**
   * Get all the courses that the user is a lecture admin for.
   * 
   * @param int user ID
   * @return list of course's info
   */
  function getCoursesLectureAdminOf($userId){
    $this->db->select('class.* FROM class, lecture WHERE lecture.lectureClass = class.id AND lecture.lectureAdmin = '.$userId.'');
    return $this->db->get()->result();
  }
  
  /**
   * Get all the courses that the user is a lecture or course admin for
   * 
   * @param int user ID
   * @return list of course's info
   */
  function getCoursesLectureOrCourseAdminOf($userId){
    $this->db->select('class.* FROM class, user, group_has_user, lecture WHERE (group_has_user.group_id = class.classAdmins AND user.id = group_has_user.user_id AND user_id = '.$userId.') OR (lecture.lectureClass = class.id AND lecture.lectureAdmin = '.$userId.')');

    $this->db->distinct();
    return $this->db->get()->result();
  }

  /**
   * Gets information about all the classes the user is subscribed to. Also, 
   * if the user is a lecture admin or class admin, it will get information 
   * about those classes as well.
   *
   * @param int user id
   * @return list of course information
   */
  function getClassInfoForUser($userId) {
    $regEx = '/^[0-9]+$/';
    // first check that the user id only contains numbers
    if  (!preg_match($regEx, $userId)) {
      return false;
    } else {
      $query = $this->db->query("SELECT class.* FROM class WHERE class.id IN (SELECT s.subscriptionClass FROM subscription s WHERE s.subscriptionStartDate <= CURRENT_DATE AND s.subscriptionEndDate >= CURRENT_DATE AND s.subscriptionUser = $userId) UNION SELECT class.* FROM class WHERE class.classAdmins IN (SELECT g1.group_id FROM group_has_user g1 WHERE g1.user_id = $userId) UNION SELECT class.* FROM class, lecture l WHERE class.id = l.lectureClass AND l.lectureAdmin = $userId GROUP BY id ORDER BY id;");

      return $query->result();
    }
  }
}
?>
