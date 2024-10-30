<?php 
 
/* Add the media uploader script */
function ms_co_uploader_enqueue() {
    wp_enqueue_media();
    wp_register_script( 'ms-co-uploader', plugins_url( 'inc/js/upload.js' , dirname(__FILE__) )  , array('jquery') );
	wp_enqueue_script( 'ms-co-uploader' );
	
	wp_register_script( 'ms-co-dropdown-list', plugins_url( 'inc/js/dropdown.js' , dirname(__FILE__) ) , array('jquery'));
	wp_enqueue_script('ms-co-dropdown-list');
	
	wp_register_script( 'ms-co-chart', plugins_url( 'inc/js/chart.min.js', dirname(__FILE__)));
	wp_enqueue_script('ms-co-chart');
}
  
add_action('admin_enqueue_scripts', 'ms_co_uploader_enqueue'); 
 

function ms_co_load_style(){
	wp_enqueue_style('ms_co_admin_style',  plugins_url('css/plugin_style.css', __FILE__) );
}

add_action('admin_enqueue_scripts','ms_co_load_style');

?>