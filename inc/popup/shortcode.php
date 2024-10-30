<?php 

//Double Entries In FireFox - Rel="NEXT"
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

//Shortcode
add_shortcode('contentoptin', 'ms_co_display_shortcode');

function ms_co_display_shortcode($atts){
	
	static $contentoptin_popup_status = NULL;
	static $contentoptin_popup_count = NULL;
	static $ms_co_placement_id = 1;
    

	$contentoptin_id = $atts['id'];
	
	if($contentoptin_id == 0 || $contentoptin_id=""){
		return false;
	}
	
	//Define Query Arguments
	$args = array('p'=>$contentoptin_id, 'post_type'=>'contentoptin', 'limit'=> '1');
	$the_query = new WP_Query($args);
	
	if($the_query->have_posts()):

	    while ( $the_query->have_posts() ) : $the_query->the_post();
		 
		        
				   
            //ContentOptin Parameters
	        $enable = get_post_meta(get_the_ID(), '_ms_co_enable', true);	
	        $display_type = get_post_meta(get_the_ID(), '_ms_co_type', true);	
	        $template = get_post_meta(get_the_ID(), '_ms_co_template', true);	
	
	        
	        if($enable == 1){
		
                if($display_type == 1): 
         
		          $box .= '<div id="preview1" style="background:#fffecf; padding:10px 12px; margin-bottom:10px; border:1px solid #e5e597;">';
                  $box .=  get_post_meta(get_the_ID(), '_ms_co_box', true)." "."<a id='".$ms_co_placement_id."' href='#' class='contentoptin-popup'>".get_post_meta(get_the_ID(), '_ms_co_cta', true)."</a>";          
		          $box .=  '</div>';

		       else:
   
                  $box = '<a href="#" id="'.$ms_co_placement_id.'" class="contentoptin-popup">'.get_post_meta(get_the_ID(), '_ms_co_link', true).'</a>';
		
		        endif; 	
		
		        if($contentoptin_popup_status == NULL){
					
		   
                   if($template == 'default'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/default.php'); }	
	               if($template == 'theme2'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme2.php'); }	
				   if($template == 'theme3'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme3.php'); }
                   if($template == 'theme3i'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme3i.php'); }
                   if($template == 'theme4'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme4.php'); }
                   if($template == 'theme4i'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme4i.php'); }				   
				   if($template == 'theme6'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme6.php'); }	
				   if($template == 'theme7'){ include(MS_CO_PLUGIN_DIR . '/inc/popup/template/theme7.php'); }	
		           do_action('ms_co_popup_template');
		           
				   
				   ms_co_optinbox_stat();
		         
		        }
		
	        }
        
		endwhile;
	    
		wp_reset_postdata();

    endif;
    
    $ms_co_placement_id++;
    $contentoptin_popup_count++;
	$contentoptin_popup_status = 'YES';
	return $box.$popup;
	
}


//Pageview Tracker
function ms_co_optinbox_stat() {

  
	global $post, $wpdb, $ms_co_stat_table, $wp, $pagename;
	
    $current_url = home_url(add_query_arg(array(),$wp->request));
	
	$postid = $post->ID;
	$ctoday = date('Y-m-d', time());
	
	
	if(get_post_meta($postid, '_ms_co_current_date', true) != "" ){
 
		if(get_post_meta($postid, '_ms_co_current_date', true) != $ctoday){
				
			//$wpdb->insert($ms_co_stat_table, array('postid' => $postid, 'stat_date' => $today, 'visitcount' => 1), array('%d','%s','%d' ) );
			$update =  $wpdb->query("INSERT INTO $ms_co_stat_table (postid, stat_date, visitcount) VALUES ('$postid', '$ctoday', '1' ) "); 
					   
			    if($update){
				   update_post_meta($postid, '_ms_co_current_date', $ctoday); 
			    }
				
		}else{
           
		    $wpdb->query("UPDATE ".$ms_co_stat_table." SET visitcount= visitcount + 1 WHERE stat_date='".$ctoday."' AND postid ='".$postid."' ");
				
	    }
			
	}else{
		 
			//$add_stat = $wpdb->insert($ms_co_stat_table, array('postid' => $postid, 'visitcount' => 1, 'stat_date' => $ctoday), array('%d','%d','%s' ) );
			$add_stat = $wpdb->query("INSERT INTO $ms_co_stat_table (postid, stat_date, visitcount) VALUES ('$postid', '$ctoday', '1' ) ");
			
			if($add_stat):
			
			   add_post_meta($postid, '_ms_co_current_date', $ctoday);
			endif;
	}
	  
	return true;

	
}


//Popup Custom Shortcode and Function

function ms_co_popup_heading($class=''){
	global $post; 
	$title = get_post_meta( $post->ID, '_ms_co_heading', true );
	$heading = '<h2 class='.$class.'>'.$title.'</h2>';
	return $heading;
}

function ms_co_popup_status_message($email_error='', $missing_error='', $transact='', $color=''){
	
	if($email_error==''): $email_error ="Error:Incorrect Email Address"; endif;
	if($missing_error==''): $missing_error ="Error: All Fields are Required"; endif;
	if($transact==''): $transact ="Please Wait..."; endif;
	if($color==''): $color ="red"; endif;
	
	$box .="<p style='font-size:12px; color:".$color."; display:none;' class='ms_co_popup_error'>".$email_error."</p>"; 
	$box .="<p style='font-size:12px; color:".$color."; display:none;' class='ms_co_popup_missing'>".$missing_error."</p>";
	$box .="<p style='font-size:12px; color:green; display:none;' class='ms_co_popup_transit'>".$transact."</p>";
	
	return $box;
}

function ms_co_popup_form_email($email_placeholder='', $text_class=''){
	global $post, $wp, $pagename;

	if($email_placeholder==''):  $email_placeholder ="Email Address"; endif;
	
	$email_input .= "<input type='text' id='ms_co_user_email' class='".$text_class."' placeholder='".$email_placeholder."'/>";
    
	return $email_input;
}

function ms_co_popup_form_button($button_class=''){
	global $post, $wp, $pagename;

	$current_url = home_url(add_query_arg(array(),$wp->request));
	
	$form .= "<input type='hidden' id='ms_co_post_id' value='".$post->ID."'/>";
	$form .= "<input type='hidden' id='ms_co_placement_id' value=''/>";
	$form .= "<input type='hidden' id='ms_co_page_name' value='".$pagename."'/>";
	$form .= "<input type='hidden' id='ms_co_page_url' value='".$current_url."'/>";
	$form .= "<input type='hidden' id='ms_co_email_list' value='".get_post_meta($post->ID, '_ms_co_email_list', true )."'/>";
	$form .= "<input type='submit' class='ms_co_submit ".$button_class."' value='".get_post_meta($post->ID, '_ms_co_button_text', true )."'/>";
	
	return $form;
}

function ms_co_popup_form_name($name_placeholder='', $text_class=''){
	global $post, $wp, $pagename;
	
	if($name_placeholder==''): $name_placeholder ="First Name"; endif;
		
	$form .= "<input type='text' id='ms_co_user_name' class='".$text_class."' placeholder='".$name_placeholder."'/>";

	return $form;
}




function ms_co_popup_privacy($class=''){
	global $post;
	
	$privacy = "<spanp class='".$class."'>".get_post_meta($post->ID, '_ms_co_privacy', true )."</span>";
	
	return $privacy;
}	

			  
//delete		
function ms_co_popup_id(){
	return " id='ms_co_popup_targeted' ";
}				  
//delete
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