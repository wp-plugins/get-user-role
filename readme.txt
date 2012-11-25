=== Plugin Name ===
Contributors: theslink2000
Tags: roles, users
Requires at least: 3.0.1
Tested up to: 3.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple plugin that add's the get_user_role() function to your site.

== Description ==

This plugin doesn't do anything on the surface but if you call the get_user_role() function then you can achieve one of two results.

<b>Function</b>

Returns the role of the specified user.


<b>Usage</b>

<?php get_user_role($user_id) ?>


<b>Parameters</b>

$user_id
<i>(string)(optional)</i> 'username'


<b>Return Values</b>

<i>(string)</i>  If no $user_id is specified in the function call the function will return the role of the currently logged in user, otherwise the role of the specified user will be returned.


<b>Examples</b>

$role = get_user_role("admin");

This will return "administrator".


<b>Notes</b>

This plugin may call the following global variables:

$current_user
$wp_roles
$wpdb


This plugin is designed to work with any correctly made custom roles.



== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `get_user_role.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Call get_user_role() as required


== Frequently Asked Questions ==

= Can I use you plugin within my own plugins? =

Of course you can, so long as you ask first.  Just send me a message and add my name to the Contributors section.



== Changelog ==

= 1.0 =
* Creation.