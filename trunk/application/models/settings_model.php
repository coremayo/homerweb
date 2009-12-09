<?php

/**
 * Handles getting and setting values of application settings in the form of 
 * key value pairs.
 */
class Settings_model extends Model {

  function Settings_model() {
    parent::Model();
  }

  /**
   * Gets the value associated with a given key.
   *
   * @param String key
   * @return String value for that key if it exists, otherwise false
   */
  function getValue($key) {
    $this->db->select('value');
    $this->db->from('settings');
    $this->db->where('key', $key);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->value;
    } else {
      return false;
    }
  }

  /**
   * Sets the value for key. If the key doesn't exist, it is created.
   *
   * @param String key
   * @param String value
   */
  function setValue($key, $value) {
    $data['key'] = $key;
    $data['value'] = $value;
    if ($this->hasKey($key)) {
      $this->db->update('settings', $data);
    } else {
      $this->db->insert('settings', $data);
    }
  }

  /**
   * Deletes a key, if it exists.
   *
   * @param String key
   */
  function deleteKey($key) {
    if ($this->hasKey($key)) {
      $this->db->where('key', $key);
      $this->db->delete('settings');
    }
  }

  /**
   * Determines whether a key exists.
   *
   * @param String key
   * @return true if the key exists, otherwise false
   */
  function hasKey($key) {
    $this->db->select('COUNT(*) count');
    $this->db->from('settings');
    $this->db->where('key', $key);
    $query = $this->db->get();
    if ($query->row()->count > 0) {
      return true;
    } else {
      return false;
    }
  }
}

?>
