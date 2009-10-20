<?php

/**
  * Sites_model class handles all communication between controllers and db.
  */
class Sites_model extends Model {

  /**
    * Default constructor for Sites_model class.
    */
  function Sites_model() {
    parent::Model();
    $this->load->database();
  }

  /**
    * Adds a new site to the database.
    *
    * @param String Name of the site to add
    * @param int Id of the group that will admin the site
    * @return boolean TRUE if the operation succeeded, otherwise an error message.
    */
  function addSite($siteName, $siteAdmins) {
    //INSERT INTO site (siteAdmins, siteName) VALUES (1, 'gt');
  }

  /**
    * Gets all relavent information for a site.
    *
    * @param int ID of the site
    * @return Array Information about the site or FALSE if id is invalid
    */
  function getSiteInfo($siteId) {
    // SELECT site.id, site.siteName, cs4911.group.groupName AS siteAdmins, cs4911.group.id AS siteAdminsId FROM site LEFT JOIN cs4911.group ON cs4911.group.id = site.siteAdmins WHERE id = ?;
  }
}

?>
