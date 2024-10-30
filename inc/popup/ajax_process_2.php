<?php

/*

function my_scripts_method() {
    wp_enqueue_script(
        'ajax_script',
        get_stylesheet_directory_uri() . '/js/ajax_script.js',
        array( 'jquery' )
    );
    wp_localize_script('ajax_script', 'WPURLS', array( 'siteurl' => get_option('siteurl') ));
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

*/
add_action('wp_ajax_nopriv_content_optin_ajax_submit', 'content_optin_ajax_submit');
add_action('wp_ajax_content_optin_ajax_submit', 'content_optin_ajax_submit');

function content_optin_ajax_submit() {
	
    global $wpdb, $ms_co_email_table, $ms_co_stat_table;
	
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
	    
		//Click Tracker
	    if(isset($_POST['stat_post_id']) && $_POST['stat_status'] == 1):
		
		    $ctoday = date('Y-m-d', time());
			$post_id = $wpdb->escape($_POST['stat_post_id']);
			
		    $update = $wpdb->query("UPDATE $ms_co_stat_table SET clickcount= clickcount + 1 WHERE stat_date='$ctoday' AND postid ='$post_id' ");   
			
			if($update): 
						
			   $result = array('1', 'DONE');		   
			   echo json_encode($result);
			
			else: 
			   		
			   $result = array('0', 'FAILED');		   
			   echo json_encode($result);
			
			endif;
			
		endif;
   
		//Email Provider Data
	    $list_data = explode(',' ,$_POST['elist']);
		global $email_provider; 
		$email_provider = $list_data[0];
		$email_list_id = $list_data[1];
		
		if($email_provider == "local"){
			
			if(isset($_POST['email']) && isset($_POST['post_id']) && isset($_POST['name'])){
				
				$post_id = $wpdb->escape($_POST['post_id']);
				$name = $wpdb->escape($_POST['name']);
				$email = $wpdb->escape($_POST['email']);
				$ctoday = date('Y-m-d', time());
				$placement = $_POST['placement'];
				
			
				//Process
				$add = $wpdb->insert($ms_co_email_table, array('post_id' => $post_id, 'name' => $name, 'email' => $email, 'created_at' => $ctoday, 'provider' =>'Inbuilt', 'placement'=> $placement), array('%d','%s' , '%s', '%s', '%s', '%s' ) );
				
				if($add):
				
				
				   $update = $wpdb->query("UPDATE $ms_co_stat_table SET emailcount= emailcount + 1 WHERE stat_date='$ctoday' AND postid ='$post_id' ");
				   
				     
				   
				   if($update){
					   //Get Permalink
					 
					  
					   $mode = get_post_meta($post_id, '_ms_co_delivery', true); 
					   
					   
					   
					   if($mode == 1){
						   //Redirect to Custom URL
						   $success_page = get_post_meta($post_id, '_ms_co_custom_url', true);
						   
					   }else{
						   //Redirect to WP Page
						   $success_page_id = get_post_meta($post_id, '_ms_co_page', true );
						   
						   $success_page = get_permalink($success_page_id);
					   }
					   
					   $result = array('1', $success_page);
					   
					   echo json_encode($result);
				   }else{
					   //Error Reporting
				        $result = array('0', 'Internal Error: Stat Update Failure');
					   
				        echo json_encode($result);
					   
				   }
				   
				endif; 
			}else{
				//Error Reporting
				 $result = array('0', 'Internal Error Just Occurred');
					   
				 echo json_encode($result);
			}
			
		}
		
		
		do_action('ms_co_email_provider_submit', $_POST);
	}
	
	wp_die();
	
  } 



?>