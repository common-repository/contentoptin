<?php

/*
Plugin Name: ContentOptin Lite
Plugin URI: http://contentoptin.com/
Description: Simple WordPress tool for Implementing Content Upgrade 
Author: Mark Ugwuanyi
Author URI: http://marksignals.com
Version: 1.1
*/

ini_set('display_errors', 'on');

// Plugin version.
if ( ! defined( 'MS_CO_VERSION' ) ) {
	define( 'MS_CO_VERSION', '1.0' );
}

//Plugin Base Slug
if ( ! defined( 'MS_CO_PLUGIN_SLUG' ) ) {
	define( 'MS_CO_PLUGIN_SLUG',  __FILE__ );
}

// plugin folder url
if(!defined('MS_CO_PLUGIN_URL')) {
	define('MS_CO_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
 
// plugin folder path
if(!defined('MS_CO_PLUGIN_DIR')) {
	define('MS_CO_PLUGIN_DIR', dirname(__FILE__));
}


global $ms_co_stat_table;
$ms_co_stat_table = $wpdb->prefix . 'ms_co_stats';



global $ms_co_email_table;
$ms_co_email_table = $wpdb->prefix . 'ms_co_emails';


/*************************************
* includes
*************************************/

if(is_admin()) {
	
	include(MS_CO_PLUGIN_DIR . '/inc/admin_hook.php');
	include(MS_CO_PLUGIN_DIR . '/inc/admin_script.php');
	

} elseif(!is_admin()) {
	include(MS_CO_PLUGIN_DIR . '/inc/front_script.php');
	include(MS_CO_PLUGIN_DIR . '/inc/popup/shortcode.php');
}


include(MS_CO_PLUGIN_DIR . '/inc/popup/ajax_process.php');
include(MS_CO_PLUGIN_DIR . '/db/install.php');
include(MS_CO_PLUGIN_DIR . '/db/uninstall.php');
