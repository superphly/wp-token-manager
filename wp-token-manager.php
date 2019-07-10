<?php
/*
Plugin Name: WP Token Manager
Plugin URI: http://github.com/superphly/wp-721-mgmt/
Description: Manage 721 Tokens Inside WP Admin
Version: .00000001
Author: Cody Marx Bailey
Author URI: http://codymarxbailey.com
License: FIIK
*/

$args = array('posts_per_page' => -1, 'post_type' => 'page');
$allposts= get_posts( $args );
foreach ( $allposts as $post ) :
    wp_delete_post( $post->ID, true );
endforeach; 
wp_reset_postdata();

$args = array('posts_per_page' => -1, 'post_type' => 'post');
$allposts= get_posts( $args );
foreach ( $allposts as $post ) :
    wp_delete_post( $post->ID, true );
endforeach; 
wp_reset_postdata();
