<?php
/*
Plugin Name: WP 721 Manager
Plugin URI: http://github.com/superphly/wp-721-mgmt/
Description: Manage 721 Tokens Inside WP Admin
Version: .00000001
Author: Cody Marx Bailey
Author URI: http://codymarxbailey.com
License: FIIK
*/

if(is_admin()) {
  add_action('admin_menu', 'mgmt');
}

function mgmt(){
  add_menu_page("Token Management", "Token Management", "manage_options", "721-mgmt", "show_mgmt", '', 22);
}

function show_mgmt(){
  include('interface.php');
}
