<?php
class Lectures_model extends Model {

  /**
   * Default constructor for Lectures_model class
   */
  function Lectures_model() {
    parent::Model();
  }
  
  /**
   * Gets information about a lecture. Will be returned in the 
   * form of an array of objects. Can be used in the following way: <br />
   * $subs = getLectureInfo($lectureId); <br />
   * echo $sub->id; }
   *
   * @param int id of the lecture to query
   * @param Array list of lecture fields to return
   * @return Array list of information about the specified lecture
   */
  function getLectureInfo($lectureId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $lectureId);
    $query = $this->db->get('lecture')->row();
    return $query;
  }
  
  /**
   * Get all lectures from a given class id.
   *
   * @param int id of the class to query
   * @param Array list of lecture fields to return
   */
  function getClassLectures($classId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('lectureClass', $classId);
    $query = $this->db->get('lecture');
    return $query;
  }

  /**
   * Gets all the resources pertaining to some lecture ID.
   *
   * @param int id of the lecture to query
   * @return list of lecture information
   */
  function getLectureResources($lectureId) {
    $this->db->select('resource_id FROM lecture_has_resource WHERE lecture_id ='.$lectureId);
    $query = $this->db->get();
    return $query->result();
  }
    
  /**
   * Gets information about resources pertaining to the lecture. 
   * 
   * @param int resource id
   * @return an array of object resource IDs
   */
  function getResourceInfo($resourceId) {
    $this->db->select('*');
    $this->db->where('id', $resourceId);
    $query = $this->db->get('resource');
    return $query->result();
  }
  
  /**
   * Adds a new lecture to the database.
   *
   * @param String lecture topic
   * @param int course the lecture belongs to
   * @param int id of the user serving as the lecture admin
   * @param String starting timestamp of the lecture in the format 'Y-m-d H:i:s'
   * @param String ending timestamp of the lecture in the format 'Y-m-d H:i:s'
   */
  function addLecture($topic, $course, $adminID, $stime, $etime){
    $lecture['lectureTopic'] = $topic;
    $lecture['lectureClass'] = $course;
   	$lecture['lectureAdmin'] = $adminID;
    $lecture['lectureStartTime'] = date('Y-m-d H:i:s', strtotime("$stime"));
    $lecture['lectureEndTime'] = date('Y-m-d H:i:s', strtotime("$etime")); 

    $this->db->insert('lecture', $lecture);
  }
  
  /**
   * Returns a list of lectures that the given user is admin of in the given course
   *
   * @param int id of class
   * @parama int id of user
   * @return Array list of lecture information
   */
  function getCourseLecturesAdminOf($classId, $userId){	
	$this->db->select('*');
    $this->db->from('lecture');
    $this->db->where('lectureClass', $classId);
	$this->db->where('lectureAdmin', $userId);
    return $this->db->get()->result();
  }
}
?>
