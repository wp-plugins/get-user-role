<?php
/*
Plugin Name: Get User Role
Plugin URI: http://wordpress.org/extend/plugins/get-user-role/
Description: A simple plugin to add the get_user_role() function to your site.
Version: 1.0
Author: Dave Legassick
License: Copyright (C) 2012  Dave Legassick

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//Returns the current user ID
function get_logged_in_user_id() {
	
	global $current_user;  //Include the global $current_user variable
	get_currentuserinfo();  //Populate the $current_user variable with the logged in users info
	
	if(is_user_logged_in()){  //If the user is logged in
		if(is_object($current_user)){  //Check the $current_user variable is populated
			$current_user_id = $current_user->ID;  //Retrieve the current users ID
		}
	}
	return $current_user_id;  //Return the current user ID
}

//Glue function that is actually called by the user
function get_user_role($user_id = NULL) {  //Optional parameter of user id
	global $wp_roles;  //Call global variable $wp_roles to get an array of all registered roles
	global $wpdb;  //Call global variable $wpdb to have the database to query
	$in_me = $wp_roles->role_names;  //Seperate role names from the $wp_roles array

	if(isset($user_id)){  //If a user id has been passed as a parameter
		$id = get_user_by('login', $user_id);  //Find the user data
		$id = $id->ID;  //Seperate the Wordpress user number from the user id
	}else{  //If no parameter has been passed
		$id = get_logged_in_user_id();  //Find the user id of the currently logged in user
	}
		$find = $wpdb->get_var("SELECT wp_usermeta.meta_value FROM $wpdb->usermeta WHERE user_id = $id AND wp_usermeta.meta_key = 'wp_capabilities'");  //Find the area of the databaes where the users role is stored
		$role = find_role($find, $in_me);  //Call the find_role function to pin it down

	return $role;  //Return the role
}

//Function that seperates the role from the array
function find_role($find, $in_me) {  //Passes the users role data and the list of all roles
      $target = array_keys(unserialize($find));  //Clean up the role data
	  $target = $target[0];  //Pick the first item in the array
	  $target = strtolower($target);  //Convert it to lower case for standardisation and recognition
      if(isset($in_me[$target]));  //If there's something to find then find it
	  return strtolower($in_me[$target]);  //Ensure the role is lower case and return it
}
?>