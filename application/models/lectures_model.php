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
    return $this->db->get()->result();
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
   * @param int id of user
   * @return Array list of lecture information
   */
  function getCourseLecturesAdminOf($classId, $userId){	
	$this->db->select('*');
    $this->db->from('lecture');
    $this->db->where('lectureClass', $classId);
	$this->db->where('lectureAdmin', $userId);
    return $this->db->get()->result();
  }
  
  /**
   * Determines if the given user is a lecture admin for the given lecture.
   *
   * @param int id of the user, int id of lecture
   * @return boolean TRUE if the user is a lecture admin for the lecture, 
   *         FALSE otherwise or if the user does not exist
   */
  function isLecturesAdminOf($userId, $lectureId){	
	$this->db->select('*');
    $this->db->from('lecture');
    $this->db->where('id', $lectureId);
	$this->db->where('lectureAdmin', $userId);
    return $this->db->get()->num_rows() > 0;
  }
  
  function addResource($lectureId, $title, $desc, $loc, $type){
    
    //make sure type is a vaild type in the enum in db first
    
    if ($type == "ppt" || $type == "pptx" || $type == "wmv" || $type == "doc" || $type == "docx" || $type == "txt" || $type == "pdf" || $type == "url")
    {
        $resource['resourceTitle'] = $title;
        $resource['resourceDescription'] = $desc;
        $resource['resourceLocation'] = $loc;
        $resource['resourceType'] = $type;
        $resource['resourceCreatedDate'] = date('Y-m-d');
    
        $this->db->insert('resource', $resource);
    
        $this->db->select('id');
        $this->db->where('resourceTitle', $title);
        $this->db->where('resourceDescription', $desc);
        $this->db->where('resourceLocation', $loc);
        $this->db->where('resourceType', $type);
        $this->db->where('resourceCreatedDate', date('Y-m-d'));
        $row = $this->db->get('resource')->row();
    
        $lecture_resource['lecture_id'] = $lectureId;
        $lecture_resource['resource_id'] = $row->id;
        $this->db->insert('lecture_has_resource', $lecture_resource);
        return true;
    }
    else
    {
        return false;
    }
  }
  
  /**
   * Updates a lecture to the database.
   *
   * @param int lectuere Id
   * @param String lecture topic
   * @param int course the lecture belongs to
   * @param int id of the user serving as the lecture admin
   * @param String starting timestamp of the lecture in the format 'Y-m-d H:i:s'
   * @param String ending timestamp of the lecture in the format 'Y-m-d H:i:s'
   */
  function updateLecture($lectureId, $topic, $course, $adminID, $stime, $etime){
	
	
	$lecture['lectureTopic'] = $topic;
    $lecture['lectureClass'] = $course;
   	if($adminID != NULL) $lecture['lectureAdmin'] = $adminID;
    $lecture['lectureStartTime'] = date('Y-m-d H:i:s', strtotime("$stime"));
    $lecture['lectureEndTime'] = date('Y-m-d H:i:s', strtotime("$etime")); 
    $this->db->where('id', $lectureId);
    $this->db->update('lecture', $lecture);
  }
}
?>
