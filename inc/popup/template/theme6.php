<?php ob_start();?>
		   <!-- The Modal -->
           <div id="contentoptin_myModal" style="display: none; position: fixed; z-index: 999; left: 0;top: 0;bottom:0;right:0; overflow-x:hidden; overflow-y:auto; padding-top:20px;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.9); ">

            <!-- Modal content -->
               <div class="contentoptin_modal-content_theme6" style=''>
                  <span class="contentoptin_close" id="contentoptin_close_theme6">&times;</span>
                   

				   <div> 

                    <div style="padding:15px 30px; background:#333;">
                       <div class="contentoptin_clearfix contentoptin_divider_box_theme6">
                        <div class="contentoptin_header_text_theme6">
                          <?php echo ms_co_popup_heading($class='contentoptin_heading_theme6'); ?>						
				     
				          <p class="contentoptin_subheading_theme6"><?php echo ms_co_popup_sub_heading();?></p>
					    </div> 
						<div class="contentoptin_header_image_theme6">
                           <div style="padding:20px;">
                             <div align="center"> 						   
						        <img src="<?php echo ms_co_popup_image_url(); ?>" style="max-width:100%; height:220px; width:227px;"/>
							 </div> 
						   </div>	  
						</div>
					   </div>
					</div>
					
					<div style="padding:30px; background:linear-gradient(to bottom, #ffffff 0%,#f9faf5 100%);">
					   <div><?php echo ms_co_popup_status_message(); ?></div>
					   <div class="contentoptin_clearfix contentoptin_divider_box_theme6">
					       <div class="contentoptin_divider_theme6">
						     <div class="contentoptin_input_box_theme6">
                               <?php echo ms_co_popup_form_name($name_placeholder='Enter First Name', $text_class='contentoptin_input_theme6'); ?>
					      
						     </div>
						   </div>
					      
						  <div class="contentoptin_divider_theme6">
						     <div class="contentoptin_input_box_theme6">  
					            <?php echo ms_co_popup_form_email($email_placeholder='Enter Email Address', $text_class='contentoptin_input_theme6') ?>
					         </div>
						   </div>
						   
						   <div class="contentoptin_divider_theme6">
						     <div class="contentoptin_input_box_theme6"> 
                                 <?php echo ms_co_popup_form_button($button_class='contentoptin_submit_theme6'); ?>							 
					         </div>
						   </div>
					
					   </div>
					  
					   <div class="contentoptin_privacy_theme6"> <span class="contentoptin-icon-lock"></span> <?php echo ms_co_popup_privacy($class=''); ?></div>

                    </div> 
				
				    
				   </div>	
				 
               </div>
			   
           </div>
		   
<?php $popup = ob_get_contents(); ob_end_clean(); ?>		   