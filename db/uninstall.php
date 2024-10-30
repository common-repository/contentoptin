<?php
register_uninstall_hook( MS_CO_PLUGIN_SLUG , 'ms_co_plugin_uninstall' );

function ms_co_plugin_uninstall() {
	
	global $wpdb;
	
	$ms_co_stat_table = $wpdb->prefix . 'ms_co_stats';
	
    $ms_co_email_table = $wpdb->prefix . 'ms_co_emails';
    
	//Drop Statistic Table
    $drop_stat = "DROP TABLE IF EXISTS $ms_co_stat_table";
    $wpdb->query($drop_stat);
	
	//Drop Email Entries Table
    $drop_email = "DROP TABLE IF EXISTS $ms_co_email_table";
    $wpdb->query($drop_email);
	
	//Delete Option & Cache
    delete_option('ms_co_license_status');
	
	delete_option('ms_co_license_key');
	
	delete_option('ms_co_db_version');
	
	delete_transient( 'ms_co_upgrade_content-optin' );
	
	//Delete all ContentOptin Custom Post
	
	$posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'contentoptin', // $post_type
        'post_status' => 'any' ) );

     foreach ( $posts as $post ) {
        wp_delete_post( $post->ID, true );
     }
  
}

?>