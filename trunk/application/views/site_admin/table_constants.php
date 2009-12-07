<?php
	/*------------------------------\
	|  Table Options                | 
	\------------------------------*/
	if (!defined('USERS'))						define('USERS', 1);
	if (!defined('COURSES'))					define('COURSES', 2);
	if (!defined('SCHEDULE'))					define('SCHEDULE', 10);
	if (!defined('SUBSCRIPTIONS'))					define('SUBSCRIPTIONS', 11);
	if (!defined('SHOW_ALL_USERS')) 			define('SHOW_ALL_USERS', 3);
	if (!defined('SHOW_ALL_COURSES'))			define('SHOW_ALL_COURSES', 4);
	if (!defined('SHOW_ADMINS_IN_COURSE'))		define('SHOW_ADMINS_IN_COURSE', 5);
	if (!defined('SHOW_STUDENTS_IN_COURSE'))	define('SHOW_STUDENTS_IN_COURSE', 6);
	if (!defined('SHOW_ADMINS_NOT_IN_COURSE'))	define('SHOW_ADMINS_NOT_IN_COURSE', 7);
	if (!defined('SHOW_STUDENTS_NOT_IN_COURSE'))define('SHOW_STUDENTS_NOT_IN_COURSE', 8);
	if (!defined('SHOW_SCHEDULE_IN_COURSE'))    define('SHOW_SCHEDULE_IN_COURSE', 9);
	
	/*------------------------------\
	|  User Fields                  | 
	\------------------------------*/
	if (!defined('SELECT_FIELD')) 	define('SELECT_FIELD', 1);
	if (!defined('EMAIL_FIELD')) 	define('EMAIL_FIELD', 2);
	if (!defined('FNAME_FIELD')) 	define('FNAME_FIELD', 4);
	if (!defined('LNAME_FIELD')) 	define('LNAME_FIELD', 8);
	if (!defined('REGDATE_FIELD'))	define('REGDATE_FIELD', 16);
	if (!defined('ACTIVE_FIELD')) 	define('ACTIVE_FIELD', 32);
	if (!defined('RADIO_FIELD')) 	define('RADIO_FIELD', 64);
	
	/*------------------------------\
	|  Course Fields                | 
	\------------------------------*/
	if (!defined('SELECT_FIELD')) 		define('SELECT_FIELD', 1);
	if (!defined('TITLE_FIELD')) 		define('TITLE_FIELD', 2);
	if (!defined('DESC_FIELD')) 		define('DESC_FIELD', 4);
	if (!defined('PRICE_FIELD')) 		define('PRICE_FIELD', 8);
	if (!defined('SUBLENGTH_FIELD'))	define('SUBLENGTH_FIELD', 16);
	if (!defined('USERS_FIELD')) 		define('USERS_FIELD', 32);
	if (!defined('ADMINS_FIELD')) 		define('ADMINS_FIELD', 64);
	if (!defined('STARTDATE_FIELD')) 	define('STARTDATE_FIELD', 128);
	if (!defined('ENDDATE_FIELD')) 	    define('ENDDATE_FIELD', 256);
	
	/*------------------------------\
	|  Schedule Fields              | 
	\------------------------------*/
	if (!defined('TOPIC_FIELD')) 		define('TOPIC_FIELD', 1);
	if (!defined('STARTTIME_FIELD')) 	define('STARTTIME_FIELD', 2);
	if (!defined('ENDTIME_FIELD')) 		define('ENDTIME_FIELD', 4);
	if (!defined('ADMIN_FIELD')) 		define('ADMIN_FIELD', 8);
	if (!defined('TYPE_FIELD')) 		define('TYPE_FIELD', 16);
	
	/*------------------------------\
	|  Subscription Fields                  | 
	\------------------------------*/
	if (!defined('SELECT_FIELD')) 	define('SELECT_FIELD', 1);
	if (!defined('SUB_FIELD')) 		define('SUB_FIELD', 2);
	if (!defined('EMAIL_FIELD')) 	define('EMAIL_FIELD', 4);
	if (!defined('FNAME_FIELD')) 	define('FNAME_FIELD', 8);
	if (!defined('LNAME_FIELD')) 	define('LNAME_FIELD', 16);
	if (!defined('STARTDATE_FIELD'))	define('STARTDATE_FIELD', 32);
	if (!defined('ENDDATE_FIELD'))	define('ENDDATE_FIELD', 64);
	if (!defined('SUB_ACTIVE_FIELD')) 	define('SUB_ACTIVE_FIELD', 128);