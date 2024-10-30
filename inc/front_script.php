<?php 

function ms_co_front_style(){
	wp_enqueue_style('ms_co_frontstyle', MS_CO_PLUGIN_URL.'inc/css/frontend_style.css');
	
	wp_enqueue_script('contentoptin', MS_CO_PLUGIN_URL.'inc/js/optin.js' , array('jquery'));
	
	wp_localize_script('contentoptin', 'contentoptin_ajax', array('ajax_url' => admin_url( 'admin-ajax.php' ) ));
}                         

add_action('wp_enqueue_scripts','ms_co_front_style'); 



?>

