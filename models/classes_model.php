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
class Classes_model extends model {
	
	/**
		* Default constructor for Classes_model class
		*/
	function Classes_model() {
		parent::model();
	}

	/**
		* Adds a new class to the database.
		*
		* @param Array fields for the new class. Should contain the following:
		* <ul>
		* <li>classTitle - String, the title of the class</li>
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
	}
}

// Awesome SQL statement that gets info about a class
// SELECT class.id, classTitle, classAdminsGroup.id AS classAdminsId, classAdminsGroup.groupName AS classAdminsName, classUsersGroup.id AS classUsersGroup, classUsersGroup.groupName AS classUsersName, classStartDate, classEndDate, site.id AS classSiteId, site.siteName as classSiteName FROM class LEFT JOIN cs4911.group AS classAdminsGroup ON classAdmins = classAdminsGroup.id LEFT JOIN cs4911.group AS classUsersGroup ON class.classUsers = classUsersGroup.id LEFT JOIN site ON classSite = site.id;

?>
