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
  add_action('admin_menu', '721mgmt');
}

function 721mgmt(){
  add_options_page("721 Manager", "721 Manager", "edit_pages", "my-options", "show_mgmt");
}

function show_mgmt(){
  include('interface.php');
}
