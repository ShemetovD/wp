<?php

/*
Plugin Name: Events managment
Plugin URI:  https://www.facebook.com/
Description: Very very simple events managment plugin
Version:     0.1
Author:      Shemetov Denis
Text Domain: my-em
*/

define( 'EM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 
require_once( EM__PLUGIN_DIR . 'class.events-management.php' );
require_once( EM__PLUGIN_DIR . 'class.events-management-widget.php' );

add_action('init', array( 'EventsManager', 'init' ) );
add_action( 'init', array('EventsManager', 'create_post_type') );
add_action( 'init', array('EventsManager', 'period_taxonomy') );

 
register_activation_hook( EM__PLUGIN_DIR, array('EventsManager', 'activation_hook'));
register_deactivation_hook( EM__PLUGIN_DIR, array('EventsManager', 'deactivation_hook'));


?>