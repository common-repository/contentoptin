<?php ob_start();?>
		   <!-- The Modal -->
           <div id="contentoptin_myModal" style="display: none!important; position: fixed!important; z-index: 999!important; left: 0!important; top: 0!important; bottom:0!important; right:0!important; overflow-x:hidden!important; overflow-y:auto!important; padding-top:5%!important; background-color: rgb(0,0,0)!important; background-color: rgba(0,0,0,0.4)!important;">

            <!-- Modal content -->
               <div class="contentoptin_modal-content_theme7" style=''>
                  <span class="contentoptin_close" id="contentoptin_close_theme7">&times;</span>
                   

				   <div> 

                    <div style="padding:15px 30px; background: #f2f2f2; border-bottom: 1px solid #ddd;">
                       <div class="contentoptin_clearfix contentoptin_divider_box_theme7">
                        <div class="contentoptin_header_text_theme7">
                          <?php echo ms_co_popup_heading($class='contentoptin_heading_theme7'); ?>						
				     
				          <p class="contentoptin_subheading_theme7"><?php echo ms_co_popup_sub_heading();?></p>
					    </div> 
						<div class="contentoptin_header_image_theme7">
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
					   <div class="contentoptin_clearfix contentoptin_divider_box_theme7">
					       <div class="contentoptin_divider_theme7">
						     <div class="contentoptin_input_box_theme7">
                               <?php echo ms_co_popup_form_name($name_placeholder='Enter First Name', $text_class='contentoptin_input_theme7'); ?>
					      
						     </div>
						   </div>
					      
						  <div class="contentoptin_divider_theme7">
						     <div class="contentoptin_input_box_theme7">  
					            <?php echo ms_co_popup_form_email($email_placeholder='Enter Email Address', $text_class='contentoptin_input_theme7') ?>
					         </div>
						   </div>
						   
						   <div class="contentoptin_divider_theme7">
						     <div class="contentoptin_input_box_theme7"> 
                                 <?php echo ms_co_popup_form_button($button_class='contentoptin_submit_theme7'); ?>							 
					         </div>
						   </div>
					
					   </div>
					  
					   <div class="contentoptin_privacy_theme7"> <span class="contentoptin-icon-lock"></span> <?php echo ms_co_popup_privacy($class=''); ?></div>

                    </div> 
				
				    
				   </div>	
				 
               </div>
			   
           </div>
		   
<?php $popup = ob_get_contents(); ob_end_clean();   ?>		   