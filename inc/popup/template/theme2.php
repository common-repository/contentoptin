<?php ob_start();?>

		   
		   <!-- The Modal -->
           <div id="contentoptin_myModal" class="contentoptin_modal">

            <!-- Modal content -->
               <div class="contentoptin_modal-content">
			   
                  <span class="contentoptin_close">&times;</span>
                   

				   <div>  
				    <?php echo ms_co_popup_heading('ms_co_default_heading'); ?>
				    <p style="text-align:center;"><?php echo ms_co_popup_sub_heading(); ?></p>
                     
					 <div><?php echo ms_co_popup_status_message(); ?></div>
				     <div>
				      <?php echo ms_co_popup_form_name($name_placeholder='Enter First Name', $text_class='ms_co_default_input'); ?>
					  <?php echo ms_co_popup_form_email($email_placeholder='Enter Email Address', $text_class='ms_co_default_input'); ?>
					  <?php echo ms_co_popup_form_button($button_class='ms_co_default_button'); ?>			
					</div>
				    <div style="text-align:center; color:#828282;font-size: 10pt; letter-spacing: 0em;"> <i class="contentoptin-icon-lock"></i> <?php echo ms_co_popup_privacy(); ?></div>
				   </div>	
				 
               </div>

           </div>

<?php $popup = ob_get_contents(); ?>
