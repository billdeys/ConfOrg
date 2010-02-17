<?php
 
/*
Plugin Name: Conference Organizer
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Plugin to handle, Registration, Session SignUps and Scheduling of a(n) (Un)Conference
Version: 0.1
Author: Bill Deys So Far
Author URI: http://deys.ca
License: Does CC-BY-NC-SA work here????
*/

$ConfOrg_db_version = "1.0";

function ConfOrg_install () 
{
	global $wpdb;
   	global $ConfOrg_db_version;
// Table of People Registered

/* wspaetzel: why not just use Wordpress's built in user tables? */

   	$table_name = $wpdb->prefix . "registrants";
   
   	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
   	{
    	$sql = "CREATE TABLE " . $table_name . " (
	  	reg_id mediumint(9) NOT NULL AUTO_INCREMENT,
	  	username VARCHAR(50) NOT NULL,
	  	fullName VARCHAR(50) NOT NULL,
	  	email VARCHAR(50) NOT NULL,
		twitter VARCHAR(50) NOT NULL,
		website VARCHAR(50) NOT NULL,
		blog VARCHAR(50) NOT NULL,
	  	UNIQUE KEY id (reg_id)
	);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    }
// Table of Sessions    
    $table_name = $wpdb->prefix . "session";
   
   	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
   	{
    	$sql = "CREATE TABLE " . $table_name . " (
	  	session_id mediumint(9) NOT NULL AUTO_INCREMENT,
		session_title VARCHAR(50) NOT NULL,
		description VARCHAR(250) NOT NULL,
		link VARCHAR(250),
	  	UNIQUE KEY id (session_id)
	);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    }
// Table of Session Id's and their Presentors (multiple reg_id to a session_id) 
	$table_name = $wpdb->prefix . "presentors";
   
   	if($wpdb->get_var("show tables like '$table_name'") != $table_name) 
   	{
    	$sql = "CREATE TABLE " . $table_name . " (
	  	session_id mediumint(9) NOT NULL,
	  	reg_id mediumint(9) NOT NULL
	);";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    }
    
//Still need a table for schedule and one for display options from the admin panel
    
    
    add_option("ConfOrg_db_version", $ConfOrg_db_version);

/*      $welcome_name = "Mr. Wordpress";
      $welcome_text = "Congratulations, you just completed the installation!";

      $insert = "INSERT INTO " . $table_name .
            " (time, name, text) " .
            "VALUES ('" . time() . "','" . $wpdb->escape($welcome_name) . "','" . $wpdb->escape($welcome_text) . "')";

      $results = $wpdb->query( $insert );
*/
 
}


function ConfOrg ($action)
{
//Figure out which action is called for 
//If [registration] call ConOrg_Register
//If [addSession] call ConOrg_AddSession
//If [displaySession] call ConOrg_DislpaySession
//If 


  return $output;
}




register_activation_hook(__FILE__,'ConfOrg_install');
add_filter('the_content','ConfOrg');

?>
