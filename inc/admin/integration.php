<?php 

function ms_co_integration_function(){ 
   $contentoptin_integration_page_url = get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=contentoptin&page=ms_co_integration_page';
?>
	
	<div class="wrap">
	
	
	  
      <?php if($_GET['ms_co_int_menu_key']==""): ?>
	    
		<h2><?php _e('Addons', 'contentoptin'); ?></h2>
		
		<div class="ms_co_row">
		    
		<?php 
						
			//$submenu = array('intro' => array('title' =>'ContentOptin Mailchimp Addon', 'img' =>'http://localhost/wpdev/img/mail.jpg', 'desc' => 'Add your email subscribers to your Mailchimp desired email list'  ));
			$submenu = array();			
			$submenu = apply_filters('ms_co_integration_submenu', $submenu);
			
			if(empty($submenu)):
			     echo '<p style="font-weight:bold; font-size:16px;">Welcome to Addon Setting</p>';
				 echo '<p class="ms_co_font_size">This ContentOptin Addon page allow you to setup and configure your ContentOptin Addons. Kindly use the setting button to configure each of the addon functionality. <br/>If you have installed any addon that is not showing on this page, please ensure that the addon is activated under the plugin page </p>';
			     echo '<p><b>No Addons was detected, if you need addons to extend the functionality of ContentOptin plugin, kindly visit <a target="_blank" href="https://contentoptin.com/addon">ContentOptin Addon Page</a></b></p>';
				 echo '</div>';
				 echo '</div>';
			else:
			   
				 echo '<p style="font-weight:bold; font-size:16px;">Welcome to Addon Setting</p>';
				 echo '<p class="ms_co_font_size">This ContentOptin Addon page allow you to setup and configure your ContentOptin Addons. Kindly use the setting button to configure each of the addon functionality. <br/>If you have installed any addon that is not showing on this page, please ensure that the addon is activated under the plugin page </p>';
				
			     echo '<p style="font-weight:bold; font-size:18px; margin-top:20px;">Email Integration ('.count($submenu).')</p>';
				 
			   foreach($submenu as $key => $menu) { ?>
			        
				<ul style="">
				   <li style="display:inline;">
				     <div class="ms_co_plain_box" style="margin-bottom:10px;">
				        <img src="<?php echo $menu['img']; ?>" width="32px" height="32px"/>
						<p style="font-weight:bold;"><?php echo $menu['title']; ?></p>
						<p><?php echo $menu['desc']; ?></p>
						<p style="display:none;"> <a href="<?php echo $contentoptin_integration_page_url; ?>&ms_co_int_menu_key=<?php echo $key; ?>&ms_co_intmenu_name=<?php echo $menu['title']; ?>" class="" style="height:23px;">Open Setting</a></p>
					 </div>
					 
				   </li>
				</ul>
				
			   
		<?php  } endif; ?>
		
	    </div>
	 <?php else: ?>
	 
	    <h1 class="wp-heading-inline"><?php echo $_GET['ms_co_intmenu_name']; ?></h1>
		<a href="<?php echo $contentoptin_integration_page_url; ?>" class="page-title-action" style="text-align:right;">Back to Addons</a>
		
	  <div style="margin-top:10px;">	
		<?php do_action('ms_co_integration_setting_box'); ?>
	   </div>	
     <?php endif; ?>
	 
	</div>	
		
<?php } ?>