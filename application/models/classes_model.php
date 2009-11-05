<?php
//mysql> desc class;
//+----------------+-------------+------+-----+---------+----------------+
//| Field          | Type        | Null | Key | Default | Extra          |
//+----------------+-------------+------+-----+---------+----------------+
//| id             | int(11)     | NO   | PRI | NULL    | auto_increment | 
//| classTitle     | varchar(45) | YES  |     | NULL    |                | 
//| classUsers     | int(11)     | YES  | MUL | NULL    |                | 
//| classAdmins    | int(11)     | YES  | MUL | NULL    |                | 
//| classStartDate | date        | YES  |     | NULL    |                | 
//| classEndDate   | date        | YES  |     | NULL    |                | 
//| classSite      | int(11)     | NO   | MUL | NULL    |                | 
//+----------------+-------------+------+-----+---------+----------------+

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
  function getNumUsers($classID){
    $this->db->select('classUsers');
    $this->db->where('id', $classID);
    $row = $this->db->get('class')->row();
    $user_group = $row->classUsers;
    
    $this->db->from('group_has_user');
    $this->db->where('group_id', $user_group);
    return $this->db->count_all_results();  
  }
  
  /**
    * Returns the number of admins assigned to a class.
    *
    * @param int the class id of the class to return the number of admins for
    * @return int number of admins
    */
  function getNumAdmins($classID){
    $this->db->select('classAdmins');
    $this->db->where('id', $classID);
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
    * <li>classUsers - int, id of the group that will be users</li>
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
  
  
  function getAllAdmins($classID) {
    $this->db->select('classAdmins');
    $this->db->where('id', $classID);
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
  
  
  function getAllStudents($classID) {
    $this->db->select('classUsers');
    $this->db->where('id', $classID);
    $row = $this->db->get('class')->row();
    $users_group = $row->classUsers;

    $this->db->from('group_has_user');
    $this->db->where('group_id', $users_group);
    $this->db->get();

    $this->db->from('user');
    $this->db->where('group_id', $users_group);
    $this->db->join('group_has_user', 'group_has_user.user_id = user.id');

    $query = $this->db->get();
    return $query->result();
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

// Awesome SQL statement that gets info about a class
// SELECT class.id, classTitle, classAdminsGroup.id AS classAdminsId, classAdminsGroup.groupName AS classAdminsName, classUsersGroup.id AS classUsersGroup, classUsersGroup.groupName AS classUsersName, classStartDate, classEndDate, site.id AS classSiteId, site.siteName as classSiteName FROM class LEFT JOIN cs4911.group AS classAdminsGroup ON classAdmins = classAdminsGroup.id LEFT JOIN cs4911.group AS classUsersGroup ON class.classUsers = classUsersGroup.id LEFT JOIN site ON classSite = site.id;




  /**
    * returns all users who are not course admins in this course;
    */
  function getNonAdmins($courseID) {
  }

  /**
    * returns all users who are not students in this course;
    */
  function getNonStudents($courseID) {
  } 
}
?>
