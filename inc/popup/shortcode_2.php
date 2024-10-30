<?php 
global $ms_co_display_count;
$ms_co_display_count = 0;


//Shortcode
add_shortcode('contentoptin', 'ms_co_display_shortcode');
function ms_co_display_shortcode(){

	
	$enable = get_post_meta(get_the_ID(), '_ms_co_enable', true);	
	$display_type = get_post_meta(get_the_ID(), '_ms_co_type', true);	
	
	if($enable == 1){
		
        if($display_type == 1): 
         
		 $box .= '<div id="preview1" style="background:#fffecf; padding:10px 12px; border:1px solid #e5e597;">';
         $box .=  get_post_meta(get_the_ID(), '_ms_co_box', true)." "."<a href='#' class='contentoptin-popup'>".get_post_meta(get_the_ID(), '_ms_co_cta', true)."</a>";          
		 $box .=  '</div>';

		else:
   
           $box = '<a href="#" class="contentoptin-popup">'.get_post_meta(get_the_ID(), '_ms_co_link', true).'</a>';
		
		endif; 	
		
		return $box;
		$ms_co_display_count ++;
	}
	
}



//add_action('wp_head', 'ms_co_optinbox_test');
function ms_co_optinbox_test() {
	global $post, $wpdb, $ms_co_stat_table, $ms_co_display_count;
	$postid = $post->ID;
	$ctoday = date('Y-m-d', time());
	
	$wpdb->query("UPDATE $ms_co_stat_table SET visitcount= visitcount + 1 WHERE stat_date='$ctoday' AND postid ='$postid' ");
	
	
}



//Popup
add_filter('the_content', 'ms_co_optinbox', 95 );

function ms_co_optinbox($content) {
    
	global $wpdb, $ms_co_stat_table, $ms_co_display_count;
	
	if (is_single()){
	    
	  $enable = get_post_meta(get_the_ID(), '_ms_co_enable', true);	
	  
	  $template = get_post_meta(get_the_ID(), '_ms_co_template', true);	
	   
	  if($enable == 1){
		  
		   $ctoday = date('Y-m-d', time());
		   $contentoptin_post_id = get_the_ID();
		
		   if(get_post_meta(get_the_ID(), '_ms_co_current_date', true) != false){
			 
			 if(get_post_meta(get_the_ID(), '_ms_co_current_date', true) != $ctoday){
				 
			    $update = update_post_meta(get_the_ID(), '_ms_co_current_date', $ctoday);
			
			    if($update){
				    $postid = get_the_ID();
				   //$wpdb->insert($ms_co_stat_table, array('postid' => get_the_ID(), 'stat_date' => $today, 'visitcount' => 1), array('%d','%s','%d' ) );
				   $wpdb->query("INSERT INTO $ms_co_stat_table (postid, stat_date, visitcount) VALUES ('$postid', '$ctoday', '1' ) ");
			    }
				
		    }else{
				
				$wpdb->query("UPDATE $ms_co_stat_table SET visitcount= visitcount + 1 WHERE stat_date='$ctoday' AND postid ='$contentoptin_post_id' ");
			    
			}
			
		   }else{
			 add_post_meta(get_the_ID(), '_ms_co_current_date', $ctoday);
			 
			 $wpdb->insert($ms_co_stat_table, array('postid' => get_the_ID(), 'visitcount' => 1, 'stat_date' => $ctoday), array('%d','%d','%s' ) );
		   }
	  
           if($template == 'default'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/default.php'); }	
	     
		 do_action('ms_co_popup_template');
		
	  }	
	}

	return $content . $popup;

}


//Popup Custom Shortcode and Function

function ms_co_popup_heading($class=''){
	global $post; 
	$title = get_post_meta( $post->ID, '_ms_co_heading', true );
	$heading = '<h2 class='.$class.'>'.$title.'</h2>';
	return $heading;
}

function ms_co_popup_status_message($email_error='', $missing_error='', $transact=''){
	
	if($email_error==''): $email_error ="Error:Incorrect Email Address"; endif;
	if($missing_error==''): $missing_error ="Error: All Fields are Required"; endif;
	if($transact==''): $transact ="Please Wait..."; endif;
	
	$box .="<p style='font-size:12px; color:red; display:none;' class='ms_co_popup_error'>".$email_error."</p>"; 
	$box .="<p style='font-size:12px; color:red; display:none;' class='ms_co_popup_missing'>".$missing_error."</p>";
	$box .="<p style='font-size:12px; color:green; display:none;' class='ms_co_popup_transit'>".$transact."</p>";
	
	return $box;
}

function ms_co_popup_form($name_placeholder='', $email_placeholder='', $text_class='', $button_class=''){
	global $post; 
	
	if($name_placeholder==''): $name_placeholder ="First Name"; endif;
	if($email_placeholder==''):  $email_placeholder ="Email Address"; endif;
	
	$form .= "<input type='text' id='ms_co_user_name' class='".$text_class."' placeholder='".$name_placeholder."'/>";
	$form .= "<input type='text' id='ms_co_user_email' class='".$text_class."' placeholder='".$email_placeholder."'/>";
	$form .= "<input type='hidden' id='ms_co_post_id' value='".$post->ID."'/>";
	$form .= "<input type='hidden' id='ms_co_email_list' value='".get_post_meta($post->ID, '_ms_co_email_list', true )."'/>";
	$form .= "<input type='submit' class='ms_co_submit ".$button_class."' value='".get_post_meta($post->ID, '_ms_co_button_text', true )."'/>";
	
	return $form;
}

function ms_co_popup_privacy($class=''){
	global $post;
	
	$privacy = "<spanp class='".$class."'>".get_post_meta($post->ID, '_ms_co_privacy', true )."</span>";
	
	return $privacy;
}				  
		
function ms_co_popup_id(){
	return " id='ms_co_popup_targeted' ";
}				  

function ms_co_popup_close($class=''){
	$close =" class='".$class." ms_co_closeme' ";
	return $close;
}				 

function ms_co_popup_image_url(){
	global $post;
	return get_post_meta($post->ID, '_ms_co_image', true );
}				  		

function ms_co_popup_sub_heading(){
	global $post;
	return get_post_meta($post->ID, '_ms_co_subheading', true );
}  

?>