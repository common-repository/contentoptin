<!-- The Modal -->
           <div id="contentoptin_myModal" style="display: none; position: fixed; z-index: 999; left: 0;top: 0;bottom:0;right:0; overflow-x:hidden; overflow-y:auto; padding-top:2%;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.9); ">

            <!-- Modal content -->
               <div class="contentoptin_modal-content_theme4" style=''>
                  <span class="contentoptin_close" id="contentoptin_close_theme4">&times;</span>
                   

				   <div>  
				  
					<?php echo ms_co_popup_heading('contentoptin_heading_theme4'); ?>
				    <p class="contentoptin_subheading_theme4"><?php echo ms_co_popup_sub_heading(); ?></p>
					
					<div><?php echo ms_co_popup_status_message($email_error='', $missing_error='', $transact='', $color=''); ?></div>
							
					<label class="contentoptin_label_theme3">Enter First Name</label>
					<?php echo ms_co_popup_form_name($name_placeholder='Enter First Name', $text_class='contentoptin_input_theme4'); ?>
					
					<label class="contentoptin_label_theme3">Enter Email Address</label>
					<?php echo ms_co_popup_form_email($email_placeholder='Enter Email Address', $text_class='contentoptin_input_theme4'); ?>
					
					<?php echo ms_co_popup_form_button($button_class='contentoptin_submit_theme4'); ?>	
				
				
				    <div class="contentoptin_privacy_theme4"> <span class="contentoptin-icon-lock"></span> <?php echo ms_co_popup_privacy(); ?> </div>
				   </div>	
				 
               </div>
			   
           </div>
		   