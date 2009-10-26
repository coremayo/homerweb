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
    * foreach ($subs ->result() as $sub) { echo($sub->id); }
    */
  function getLectureInfo($lectureId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('id', $lectureId);
    $query = $this->db->get('lecture');
    return $query;
  }
  
  /**
    * Get all lectures from a given class id
    * 
    * 
    * 
    */
  function getClassLectures($classId, $fields = '*') {
    $this->db->select($fields);
    $this->db->where('lectureClass', $classId);
    $query = $this->db->get('lecture');
    return $query;
  }

}
?>