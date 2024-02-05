<?php
/*
Plugin Name: Dashboard
Plugin URI: Dashboard
Description: Dashboard
Author: Matin Lahijani
Author URI: https://www.linkedin.com/in/matt-lahijani-48858b113/
License: GPLv2 or later
Text Domain:Dashboard
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

define('DASHPATH', plugin_dir_path( __FILE__ ));
define('DASHURL' , plugin_dir_url( __FILE__ ));
// var_dump(ABSPATH);
// require_once( ABSPATH . "wp-includes/wp-load.php" );
// require_once( ABSPATH . "wp-includes/pluggable.php" );
include ABSPATH . 'wp-includes/pluggable.php';
require_once(DASHPATH . 'main/main.php');
require_once DASHPATH . 'view.php';
require_once(DASHPATH . 'router/router.php');
require_once(DASHPATH . 'routes/web.php');



new main;

// add_action('init', main::class , 'newPage');
