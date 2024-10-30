<?php

//ShortCode Metabox
add_action( 'add_meta_boxes', 'add_ms_co_shortcode_metabox' );

function add_ms_co_shortcode_metabox() {
	add_meta_box('ms_co_shorcode_metabox', 'ShortCode', 'ms_co_shortcode_metabox', 'contentoptin', 'side', 'default');
}

function ms_co_shortcode_metabox() {
	global $post;
	
	if(get_post_status($post->ID) == 'publish'):
	
	    $contentoptin_shortcode = '[contentoptin id="'.$post->ID.'"]';
	
	    echo "<input type='text' value='".$contentoptin_shortcode."' class='ms_co_form-control' />";
		echo '<p style="font-size:12px;">Paste this ShortCode Within Post or Page to Display this Optin</p>';
		
    else:
	
	    echo '<p>It seems like you have not created this Optin, Once you create your optin, the shortcode will appear here.</p>';
		
	endif;
}


add_action( 'add_meta_boxes', 'ms_co_add_metaboxes' );

function ms_co_add_metaboxes(){
	add_meta_box('ms_co_configuration_basic', '<span>Basic Configuration</span>', 'ms_co_metabox_content', 'contentoptin', 'normal', 'default');
}


//ContentOptin Metabox Function
function ms_co_metabox_content(){
	global $post;
	
	//Verify the Orginality of Data Source
    echo '<input type="hidden" name="content_optin_meta_noncename" id="content_optin_meta_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';

?>	


			  <div class="ms_co_heading_section">Basic</div>
				
				
				
					 <table width="100%" style="margin-top:10px; margin-bottom:20px;">
	                   <tr>
		                 <td width="100%">
		                  <div class="ms_co_form_group">
		                     <label class="ms_co_label">Select Display Type</label>
		                       <select id="msco_optin_type" class="ms_co_form-control" name="_ms_co_type">
			                    <option <?php if(get_post_meta($post->ID, '_ms_co_type', true) =="1"): echo "selected"; endif; ?> value="1">Optin Box </option>
			                    <option <?php if(get_post_meta($post->ID, '_ms_co_type', true) =="2"): echo "selected"; endif; ?> value="2">Simple Link</option>
			                   </select>
		                   </div>
		                 </td>
		 
		             </table> 
					 
					 <div class="ms_co_heading_section" style="margin-bottom:20px;">PopUp Theme</div>
					 <label class="ms_co_label">Select PopUp Theme</label>
					 
					 <?php add_thickbox(); ?>
			 
					 
					 <div class="ms_co_row">
					   <div style="margin-top:20px; display:inline; margin-bottom:20px;">
					 
		                  <?php 
					
							  $templates = array(
								'default' => __('Default Theme', 'contentoptin'),
								'theme2' => __('Theme 2', 'contentoptin'),
								'theme3' => __('Theme 3', 'contentoptin'),
								'theme4' => __('Theme 4', 'contentoptin'),
								
								'theme6' => __('Theme 6', 'contentoptin'),
								
								'theme4i' => __('Theme 4 Image', 'contentoptin'),
								'theme7' => __('Theme 7', 'contentoptin'),
								'theme3i' => __('Theme 3 Image', 'contentoptin')
								
							  );
							
							  $templates = apply_filters('ms_co_available_popup_template', $templates);
							 
							    foreach($templates as $key => $template) {
									echo '<div style="float:left; width:25%;">';
									echo '<div style="padding:5px;">';
									echo '<label class="ms_co_radio_container">';
									echo '<input type="radio" '.checked($key, get_post_meta($post->ID, '_ms_co_template', true), false).'  name="_ms_co_template" value="' . $key . '" />';
									echo '<img style="max-width:100%; height:100px;" src="'.MS_CO_PLUGIN_URL.'/inc/popup/template/images/'.$key.'.png">';
								    echo '</label>';
									echo '<a name="'.$template.' rel="gallery" Preview" href="#TB_inline?width=670&height=200&inlineId=ms_co_preview_box_'.key.'" class="thickbox" style="font-size:12px; text-decoration:none; display:none; text-align:center;">Preview '.$template.'</a>';
									echo '</div>';
									echo '</div>';
									
									echo '<div id="ms_co_preview_box_'.key.'" style="display:none;">';
									echo '<p><div align="center"><div style="width:100%;"><img style="max-width:100%;"  src="'.MS_CO_PLUGIN_URL.'/inc/popup/template/images/'.$key.'.png"></div></div></p>';
									echo '</div>';
                                }	
                             						
						   ?>
			            </div>
	                 </div>
	
                     <div style=" display:none;"> 
	                 <table width="100%" style="margin-bottom:20px;">
	    
	                    <tr>
		                  <td width="49%">
		                    <label class="ms_co_label">Enable Content Optin on this Post</label>
		                    <select class="ms_co_form-control" name="_ms_co_enable">
			
			                  <option <?php if(get_post_meta($post->ID, '_ms_co_enable', true) =="1"): echo "selected"; endif; ?> value="1">Enable</option>
			                  <option <?php if(get_post_meta($post->ID, '_ms_co_enable', true) =="2"): echo "selected"; endif; ?> value="2">Disable</option>
			                </select>
		                 </td>
		   
		                 <td></td>

		                 <td width="49%">

		                 </td>
	   
		                </tr>
	                 </table>
	                </div>
					
					
			  <!---display---->
			  <div class="ms_co_heading_section" style="margin-top:20px; margin-bottom:20px;">Display Setting</div>
				
				
				<?php
                    $ms_co_type_toggle = get_post_meta($post->ID, '_ms_co_type', true); 
	                if(empty($ms_co_type_toggle)): $ms_co_type_toggle = 0; endif; 
	
                    if($ms_co_type_toggle =="1" || $ms_co_type_toggle =="0" ): ?>	
	                  
					  <div id="ms_co_box">
					    <div class="ms_co_label" style="background:#fff;">Display Box</div>	
	                    <table width="100%" style=" margin-bottom:20px;">
 						  <tr>
		                    <td width="49%">
		                       <div class="ms_co_form_group">
		                         <label class="ms_co_label">Box Content</label>
		                         <input type="text" id="box-content" value="<?php echo get_post_meta($post->ID, '_ms_co_box', true); ?>" name="_ms_co_box" class="ms_co_form-control">
		                      </div>
		                   </td>
		 
		                   <td></td>
		 
		                   <td width="49%">
		                     <div class="ms_co_form_group">
		                       <label class="ms_co_label">CTA Text</label>
		                       <input type="text" id="box-linktext" value="<?php echo get_post_meta($post->ID, '_ms_co_cta', true); ?>" name="_ms_co_cta" class="ms_co_form-control">
		                     </div>
		                   </td>
		                  </tr>
	                   </table>	
                      </div> 
	
	
	                  <div id="ms_co_link" style="display:none;">
                         <div class="ms_co_label">Link Setting</div>	
	                       <table width="100%" style="margin-bottom:20px;">
	                          <tr>
		                        <td width="49%">
		                          <div class="ms_co_form_group">
		                            <label class="ms_co_label">Link Text</label>
		                            <input type="text" id="linktext" value="<?php echo get_post_meta($post->ID, '_ms_co_link', true); ?>" name="_ms_co_link" class="ms_co_form-control">
		                          </div> 
		                        </td>
		 
		                        <td></td>
		 
		                        <td width="49%"></td>
		                      </tr>
	                      </table>	
                      </div> 
					  

					  <?php elseif($ms_co_type_toggle == "2"): ?>


					  <div id="ms_co_box" style="display:none;">
                         <div class="ms_co_heading_section" style="background:#fff;">Box Display</div>	
	                       <table width="100%" style="margin-bottom:20px;">
	                          <tr>
		                        <td width="49%">
		                          <div class="ms_co_form_group">
		                            <label class="ms_co_label">Box Content</label>
		                            <input type="text" id="box-content" value="<?php echo get_post_meta($post->ID, '_ms_co_box', true); ?>" name="_ms_co_box" class="ms_co_form-control">
		                         </div>
		                       </td>
		 
		                       <td></td>
		 
		                       <td width="49%">
		                         <div class="ms_co_form_group">
		                           <label class="ms_co_label">CTA Text</label>
		                           <input type="text" id="box-linktext" value="<?php echo get_post_meta($post->ID, '_ms_co_cta', true); ?>" name="_ms_co_cta" class="ms_co_form-control">
		                         </div>
		                      </td>
		 
		                     </tr>
	                      </table>	
                       </div> 
	
	
	                   <div id="ms_co_link" >
                         <div class="ms_co_heading_section" style="background:#fff;">Link Setting</div>	
	                       <table width="100%" style="margin-bottom:20px;">
	                          <tr>
		                        <td width="49%">
		                          <div class="ms_co_form_group">
		                            <label class="ms_co_label">Link Text</label>
		                            <input type="text" id="linktext" value="<?php echo get_post_meta($post->ID, '_ms_co_link', true); ?>" name="_ms_co_link" class="ms_co_form-control">
		                          </div>
		                      </td>
		 
		                      <td></td>
		 
		                      <td width="49%"></td>
		 
		                     </tr>
	                       </table>	
                       </div> 

                <?php endif; ?>	
				
				
			     <div class="ms_co_heading_section" style="margin-bottom:10px; ">Preview</div>
				 <div style="padding:15px;"> 	
											
					<div id="preview-box" style="background:#fffecf; padding:8px; border:1px solid #e5e597; display:<?php if($ms_co_type_toggle =="1" || $ms_co_type_toggle =="0"): echo "block;"; else: echo "none;" ; endif; ?>">
		                <p id="text"><span id="maintext" style="color:#333333;">
						  <?php if(get_post_meta($post->ID, '_ms_co_box', true)=="") : ?> 
							<b>Featured Download:</b> Grab the latest 21st Cenutry Bloggers are Entrepreneurs Checklist for quick implementation of all you have learnt</span>
		                    <span id="cta" style="color:#23527c; cursor:pointer;"><span id="ctatext">Download Checklist Now</span></span>
						  <?php else: ?>
						     <?php echo get_post_meta($post->ID, '_ms_co_box', true);?>
							 <span id="cta" style="color:#23527c; cursor:pointer;"><span id="ctatext"><?php echo get_post_meta($post->ID, '_ms_co_cta', true);?></span></span>
						  <?php endif; ?>
		                </p>
		            </div>
							
							
				    <div id="preview-link" style="margin-top:20px; display:<?php if($ms_co_type_toggle == "2"): echo "block;"; else: echo "none;" ; endif; ?>">
						<p>The Link Type can be embedded inline within your website content like this, <span id="linkcta" style="color:#23527c; cursor:pointer;"><span id="ctatext">Download Checklist Now</span></span></p>
				    </div>
				</div>
				
				
				
				
				
			  <div class="ms_co_heading_section">PopUp Optin</div>
				 	
					<div class="ms_co_row" style="display:inline; margin-top:10px;">
					   
					   <div class="" style="padding:10px; float:left; width:65%;">
					         
							<div class="ms_co_form_group">
		                      <label class="ms_co_label">Heading Text</label>
		                      <input type="text" placeholder="Enter Heading Title that Will Appear in PopUp Template" value="<?php echo get_post_meta($post->ID, '_ms_co_heading', true); ?>" name="_ms_co_heading" class="ms_co_form-control">
			                </div> 
							
	                       <div class="ms_co_form_group" style="">
	                         <label class="ms_co_label">Intro/Sub-Heading Text</label>
		                     
                             <textarea placeholder="This could be your sub heading or introductory text that will appear under the heading " style="height:100px !important;" name="_ms_co_subheading" class="ms_co_form-control"><?php echo get_post_meta($post->ID, '_ms_co_subheading', true); ?></textarea>
						  </div> 
						  
						  
		                    <div class="ms_co_form_group">
			                 <label class="ms_co_label">Button Text</label>
		                     <input placeholder="PopUp Submit Text. Ex: Download My Checklist" type="text" value="<?php echo get_post_meta($post->ID, '_ms_co_button_text', true); ?>" name="_ms_co_button_text" class="ms_co_form-control">
                            </div> 
							
							
			                <div class="ms_co_form_group">
			                   <label class="ms_co_label">Footer Privacy Text</label>
		                       <input type="text" placeholder="Enter Privacy Text that Will Appear at PopUp Footer" value="<?php echo get_post_meta($post->ID, '_ms_co_privacy', true); ?>" name="_ms_co_privacy" class="ms_co_form-control">
                            </div> 
              
					   </div>
					   
					   <div class="" style="padding:10px; float:right; width:30%;">
					    
							   <div class="ms_co_form_group">
			                     <label class="ms_co_label">Display Image</label>
								 
								     
							        <div class="uploadsection" style="margin-bottom: -20px;">
								
								       <div id="preview">
								        <img id="ms_co_thumbnail" style="width:227px; height:220px; border-radius:3px; border: 1px solid #ccc;" src="<?php if(get_post_meta($post->ID, '_ms_co_image', true) == ""): echo MS_CO_PLUGIN_URL.'inc/img/noimage.png'; else: echo esc_url( get_post_meta($post->ID, '_ms_co_image', true) ); endif; ?>" height="100px" width="100px">
							
                                       </div> 								
								   </div>
									    
			                      <input type="hidden" id="ms_co_image_file" style="width:70%;" readonly="readonly" name="_ms_co_image" size="40" value="<?php echo esc_url( get_post_meta($post->ID, '_ms_co_image', true) ); ?>"><br/>
			                      <input id="ms_co_upload_button" type="button" class="ms_co_btn ms_co_default_btn" style="width:227px;" value="<?php _e('Select Popup Image', 'contentoptin'); ?>">
	                           </div>
							   
							   <div style="padding:10px; text-align:center; font-size:12px;">Recommended Image Size: <br/><strong>227px X 220px</strong></div>
			
					   
					   </div>
				
					</div>
					<div class="clear:both"></div>
                    
					
					
					
					  <div class="ms_co_heading_section">What Action Do Want After User Subscribe</div>
				
				
				<div>
                
	               <table width="100%" style="margin-bottom:20px;">
	                  <tr>
		                <td width="49%">
		                  <div class="ms_co_form_group">
		                    <label class="ms_co_label">Delivery Type</label>
		                      <select id="msco_delivery_type" class="ms_co_form-control" name="_ms_co_delivery">
			                   <option <?php if(get_post_meta($post->ID, '_ms_co_delivery', true) =="1"): echo "selected"; endif; ?> value="1">Redirect to Custom URL</option>
			                   <option <?php if(get_post_meta($post->ID, '_ms_co_delivery', true) =="2"): echo "selected"; endif; ?> value="2">Redirect to WordPress Page </option>
			                  </select>
		                  </div>	 
		                </td>
		 
		                <td></td>
		 
		                <td width="49%">
		                <?php

                          $ms_co_delivery_toggle = get_post_meta($post->ID, '_ms_co_delivery', true); 
	                      if(empty($ms_co_delivery_toggle)): $ms_co_delivery_toggle = 0; endif; 
	
                          if($ms_co_delivery_toggle =="1" || $ms_co_delivery_toggle =="0" ): ?>	
			
			                <div id="ms_co_bonus"> 
			                  <div class="ms_co_form_group">
			                    <label class="ms_co_label">Enter Custom URL</label>
			                    <input type="url" value="<?php echo esc_url( get_post_meta($post->ID, '_ms_co_custom_url', true) ); ?>" name="_ms_co_custom_url" class="ms_co_form-control"/>
	                          </div>
			                </div>
			
			                <div style="display:none;" id="ms_co_redirect"> 
			                  <div class="ms_co_form_group">
			                    <label class="ms_co_label" >Redirect URL</label>
		                        <input type="text" value="" name="_ms_co_bonus_old" class="ms_co_form-control" style="display:none;">
			                    <?php wp_dropdown_pages( array('name'=> '_ms_co_page', 'class' => 'ms_co_form-control', 'selected' => get_post_meta($post->ID, '_ms_co_page', true) )); ?>
			                 </div> 
			                </div> 
			
	                    <?php elseif($ms_co_delivery_toggle =="2"): ?>
		  
		  			
			              <div id="ms_co_bonus" style="display:none;"> 
			                <div class="ms_co_form_group">      
			                  <label class="ms_co_label">Enter Custom URL</label>
			                  <input type="url" value="<?php echo esc_url( get_post_meta($post->ID, '_ms_co_custom_url', true) ); ?>" name="_ms_co_custom_url" class="ms_co_form-control"/>
			                </div>
			              </div> 
			
			              <div id="ms_co_redirect"> 
			                <div class="ms_co_form_group">
			                  <label class="ms_co_label" >Select Page</label>
			                    <?php wp_dropdown_pages( array('name'=> '_ms_co_page', 'class' => 'ms_co_form-control', 'selected' => get_post_meta($post->ID, '_ms_co_page', true) )); ?>
			                  </div>
			               </div> 
		  
		                <?php endif; ?>
		                </td>
		              </tr>
		
		              <tr>
		                 <td>
		                  <div class="ms_co_form_group">      
			                <label class="ms_co_label">Connect to Email List</label>
		                     <?php 
							    $lists = array(
								   'local,0' => __('Inbuilt', 'contentoptin')
								);
							
							   $lists = apply_filters('ms_co_available_lists', $lists);
							   echo '<select class="ms_co_form-control" name="_ms_co_email_list">';
							     foreach($lists as $key => $list) {
								    echo '<option value="' . $key . '" ' . selected($key, get_post_meta($post->ID, '_ms_co_email_list', true), false) . '>' . $list . '</option>';
							    }	
                               echo '</select>';							
						      ?>
			   
			               </div>
		                 </td>  
		              </tr>
		
	               </table>	
               </div> 
			   
			

					
	

 <?php	
}

// Save the Metabox Data

function ms_co_save_metadata($post_id, $post) {
	
	$totaloptin = wp_count_posts('contentoptin')->publish;
	
	if($totaloptin >= 10){
		return false;
	}
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['content_optin_meta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$ms_co_meta['_ms_co_enable'] = intval($_POST['_ms_co_enable']);
	$ms_co_meta['_ms_co_type'] = intval($_POST['_ms_co_type']);
	$ms_co_meta['_ms_co_template'] = $_POST['_ms_co_template'];
	
	$ms_co_meta['_ms_co_box'] = sanitize_text_field($_POST['_ms_co_box']);
	$ms_co_meta['_ms_co_cta'] = sanitize_text_field($_POST['_ms_co_cta']);
	$ms_co_meta['_ms_co_link'] = sanitize_text_field($_POST['_ms_co_link']);
	
	$ms_co_meta['_ms_co_heading'] = sanitize_text_field($_POST['_ms_co_heading']);
	$ms_co_meta['_ms_co_subheading'] = sanitize_text_field($_POST['_ms_co_subheading']);
	$ms_co_meta['_ms_co_privacy'] = sanitize_text_field($_POST['_ms_co_privacy']);
	$ms_co_meta['_ms_co_image'] = esc_url($_POST['_ms_co_image']);
	$ms_co_meta['_ms_co_button_text'] = sanitize_text_field($_POST['_ms_co_button_text']); 
	
	
	$ms_co_meta['_ms_co_email_list'] = $_POST['_ms_co_email_list'];
	
	$ms_co_meta['_ms_co_delivery'] = intval($_POST['_ms_co_delivery']);
	$ms_co_meta['_ms_co_custom_url'] = esc_url($_POST['_ms_co_custom_url']);
	$ms_co_meta['_ms_co_page'] = intval($_POST['_ms_co_page']);
	
	// Add values of $ms_co_meta as custom fields
	foreach ($ms_co_meta as $key => $value) { // Cycle through the $ms_dd_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'ms_co_save_metadata', 1, 2); // save the custom fields


