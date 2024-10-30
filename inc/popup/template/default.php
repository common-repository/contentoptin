<?php ob_start();?>

		   
		   <!-- The Modal -->
           <div id="contentoptin_myModal" style="display: none; position: fixed!important; z-index: 999!important; left: 0!important;top: 0!important;bottom:0!important;right:0!important;overflow-x:hidden!important;overflow-y:auto!important;padding-top:10%!important;background-color: rgb(0,0,0)!important; background-color: rgba(0,0,0,0.9)!important; ">

            <!-- Modal content -->
               <div style="background-color: #fefefe!important;padding: 20px!important;border: 1px solid #888!important;width: 80%!important; margin:auto!important;">
			   
                  <span class="contentoptin_close">&times;</span>
                   
				  <?php $img_url = ms_co_popup_image_url(); if(!empty($img_url)):?>

				   <img id="contentoptin-form-image" src="<?php echo ms_co_popup_image_url(); ?>" onerror="this.style.display='none'" style="max-width:100%;"/>
				   
				   <div class="contentoptin-content-wrapper ">
				  
				    <?php echo ms_co_popup_heading('ms_co_default_heading'); ?>
					<img id="contentoptin-form-image-mobile" src="<?php echo ms_co_popup_image_url(); ?>" style="max-width:100%;"/>
				   
				    <p style="text-align:center;"><?php echo ms_co_popup_sub_heading(); ?></p>
                   
				    <div><?php echo ms_co_popup_status_message(); ?></div>
				    <div>
				      <?php echo ms_co_popup_form_name($name_placeholder='Enter First Name', $text_class='ms_co_default_input'); ?>
					  <?php echo ms_co_popup_form_email($email_placeholder='Enter Email Address', $text_class='ms_co_default_input'); ?>
					  <?php echo ms_co_popup_form_button($button_class='ms_co_default_button'); ?>			
					</div>
					<div style="text-align:center; color:#828282;font-size: 10pt; letter-spacing: 0em;"> <i class="contentoptin-icon-lock"></i> <?php echo ms_co_popup_privacy(); ?></div>
				   </div>	
				  <?php else: ?>
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
				  <?php endif; ?>
               </div>

           </div>

<?php $popup = ob_get_contents(); ?>
