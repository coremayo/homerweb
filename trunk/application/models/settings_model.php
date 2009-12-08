<?php

class Settings_model extends Model {

  function Settings_model() {
    parent::Model();
  }

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

  function setValue($key, $value) {
    $data['key'] = $key;
    $data['value'] = $value;
    if ($this->hasKey($key)) {
      $this->db->update('settings', $data);
    } else {
      $this->db->insert('settings', $data);
    }
  }

  function deleteKey($key) {
    if ($this->hasKey($key)) {
      $this->db->where('key', $key);
      $this->db->delete('settings');
    }
  }

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
