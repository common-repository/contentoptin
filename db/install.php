<?php
//Install Database
register_activation_hook(MS_CO_PLUGIN_SLUG, 'ms_co_create_db');

function ms_co_create_db() {
    	
	global $wpdb;
     
    $ms_co_stat_table = $wpdb->prefix . 'ms_co_stats';
	
    $ms_co_email_table = $wpdb->prefix . 'ms_co_emails';	
	
	$charset_collate = $wpdb->get_charset_collate();
	
	
	if($wpdb->get_var('SHOW TABLES LIKE ' . $ms_co_stat_table) != $ms_co_stat_table){

	$sql = "CREATE TABLE $ms_co_stat_table (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		postid varchar(150) NOT NULL DEFAULT '',
		visitcount bigint(20) NOT NULL,
		emailcount bigint(20) NOT NULL,
		clickcount bigint(20) NOT NULL,
		stat_date date DEFAULT '0000-00-00' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";
	
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	
	}
	
	//Second Table
    if($wpdb->get_var('SHOW TABLES LIKE ' . $ms_co_email_table) != $ms_co_email_table){ 
	$sql2 = "CREATE TABLE $ms_co_email_table (
		
		id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
		name varchar(70) NOT NULL DEFAULT '',
		email varchar(70) NOT NULL DEFAULT '',
		provider varchar(70) NOT NULL DEFAULT '',
		placement varchar(70) NOT NULL DEFAULT '',
        created_at date DEFAULT '0000-00-00' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql2 );
	}
	
	//Add Database Version
	add_option('ms_co_db_version', MS_CO_VERSION);

}

//Add Demo ContentOptin Data
register_activation_hook(MS_CO_PLUGIN_SLUG, 'ms_co_db_demo_data');

function ms_co_db_demo_data(){
	
	$post = array( 
		'post_title'	=> 'My First ContentOptin',
		'post_status'	=> 'publish',
		'post_type' 	=> 'contentoptin'
	);
	
	$my_post_id = wp_insert_post($post); 
	
	//add_post_meta($my_post_id, '_your_custom_meta', $var); //add custom meta data, after the post is inserted
	
}


?>