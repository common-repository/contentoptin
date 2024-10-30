<?php

function ms_co_maillist_individual(){
	
	global $wpdb, $ms_co_stat_table, $ms_co_email_table;
	
	$current_page_url = get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=contentoptin&page=ms_co_maillist_page&ms-co-list-ind=1&ms-co-list-id='.$_GET['ms-co-list-id'];
	$prev_page_url = get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=contentoptin&page=ms_co_maillist_page';
	
    $list_id = $_GET['ms-co-list-id'];
	
	if (isset($_GET['p'])) $page = $_GET['p']; else $page = 1;
		$per_page = 10;
		if(isset($_GET['show']) && $_GET['show'] > 0) {
			$per_page = intval($_GET['show']);
		}
		$total_pages = 1;
		$offset = $per_page * ($page-1);
		
		$emails = ms_co_get_email($offset, $per_page, $list_id);
		$emails_count = ms_co_count_emails($list_id);
		$total_pages = ceil($emails_count/$per_page);
?>	
<div class="wrap">
   
   <h1 class="wp-heading-inline"><?php _e('List', 'contentoptin'); ?>: 
    <?php if(get_the_title($list_id)): echo get_the_title($list_id); else: echo "Contact ".$list_id." - <span style='color:ccc'>[Deleted Post]</span>"; endif; ?>
   </h1>
   <a href="<?php echo $prev_page_url; ?>" class="page-title-action" style="text-align:right;">Back to List</a>
   <hr/>
   
   <p><b>Basic Stat</b></p>
    
	<div class="ms_co_row" style="display:inline;" id="basic-stat">
	
	           <div style="float:left; width:25%; ">

		  		    <div class="ms_co_panel panel-default ms_co_box_adjuster">
					    <div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats ">
						    <p>Impression</p>
							<span class="ms_co_info-box-title">Overall Impression</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure ">
						     <p><?php $impression_query = $wpdb->get_var("SELECT SUM(visitcount) FROM $ms_co_stat_table WHERE postid ='$list_id'"); echo number_format($impression_query);  ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:#ACC26D;"></div>
						</div>
					 </div>
		  
		  
                </div>
				
				
	            <div style="float:left; width:25%; ">
		            <div class="ms_co_panel panel-default ms_co_box_adjuster">
					    <div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats ">
						    <p>Clicks</p>
							<span class="ms_co_info-box-title">CTA Clicks</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure ">
						    <?php 
                               $clickopt = $wpdb->get_var("SELECT SUM(clickcount) FROM $ms_co_stat_table WHERE postid = '$list_id'");
				            ?>
						     <p><?php echo number_format($clickopt); ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:blue;"></div>
						</div>
					 </div>
		  
                </div>
	   
	            <div style="float:left; width:25%;">

		  
		             <div class="ms_co_panel panel-default ms_co_box_adjuster">
		   
					    <div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats ">
						    <p>Subscribers</p>
							<span class="ms_co_info-box-title">Optin/Leads</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure ">
						    <?php 
                               $subscriber_query = $wpdb->get_var("SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE postid = '$list_id'");
				            ?>
						     <p><?php echo number_format($subscriber_query); ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:rgba(151,187,205,1);"></div>
						</div>
		            </div>
		  
                </div>
	   
	            <div style="float:left; width:25%; ">
		           <div class="ms_co_panel panel-default">
		    	      <div class="ms_co_panel-body">
					    <div class="ms_co_info-box-stats ">
						    <p style="margin-top:-15px; margin-bottom:5px;">Performance</p>
							
						</div>
                        <div style="clear:both"></div>						
				         <span ><div style="background:rgba(151,187,205,1); display:inline-block; width:10px; height:10px;" class="square"><img/></div><span style="color:#b0b0b0;"> Conversion Rate</span> <span style="float:right; font-size:15px;"><?php echo @number_format((($subscriber_query/$clickopt) * 100), 2); ?>%</span></span>
				         <hr/>
						 <span> <div style="background:green; display:inline-block; width:10px; height:10px;" class="square"><img/></div> <span style="color:#b0b0b0;"> Growth Rate</span> <span style="float:right; font-size:15px;"><?php echo ms_co_growth_rate(); ?>%</span></span>
			          </div>
		           </div>
                </div>
	
	</div>
	
   
   <?php $list_array = explode(',' , get_post_meta($list_id, '_ms_co_email_list', true ));
         list($list_provider, $list_provider_id) =  $list_array;
   ?>
   
<?php if( $list_provider_id == 0): ?>   
   <div class="ms_co_row" id="ms_co_stat_main">
	
    <div class="ms_co_row" style="margin-top:10px;">
	  
	  
	  <div style="float: right; margin-bottom:5px;">    
       
        <form  action="" method="get" style="display:inline;">
		  
			 <input type="hidden" name="page" value="ms_co_maillist_page"/>
			 <input type="hidden" name="post_type" value="contentoptin"/>
			 <input type="hidden" name="ms-co-list-ind" value="1"/>
			 <input type="hidden" name="ms-co-list-id" value="<?php echo $list_id; ?>"/>
			 
			<label><strong><?php _e('List Per Page', 'contentoptin'); ?></strong></label>
			<input type="text" class="regular-text" style="width:50px; margin-top:3px; display:inline;" name="show" value="<?php echo isset($_GET['show']) ? $_GET['show'] : '10'; ?>"/>
			<input type="submit" class="button-secondary" value="<?php _e('Show', 'contentoptin'); ?>"/>
		</form>
		
		 
		<form action="<?php echo $current_page_url; ?>" method="get" style="display:inline;">
			<input type="hidden" name="contentoptin_nav" value="maillist"/>
			<input type="hidden" name="ms_co_csv_export_id" value="<?php echo $list_id; ?>"/>
			
			<input type="hidden" name="ms_co_list_export" value="1"/>
			<input type="submit" class="button-secondary" value="<?php _e('Export CSV', 'contentoptin'); ?>"/>
		</form>
		
		
		
	  </div>
    </div>  	
	
	<table class="wp-list-table widefat fixed striped posts" style="background:#fff;">
			<thead>
				<tr>
					<th width="25%" style="font-weight:bold;"><?php _e('Subscriber Email Address', 'contentoptin'); ?></th>
					<th style="text-align:center; font-weight:bold;" width="15%" style="font-weight:bold;"><?php _e('Subscriber Name', 'contentoptin'); ?></th>
					
					<th style="text-align:center; font-weight:bold;" width="15%" style="font-weight:bold;"><?php _e('Placement Position', 'contentoptin'); ?></th>
					
					<th style="text-align:center; font-weight:bold;" width="17%" style="font-weight:bold;"><?php _e('Dated Added', 'contentoptin'); ?></th>
					
				</tr>
			</thead>
			
			<tbody>
				<?php
					if($emails) :
						$i = 0;
						foreach($emails as $email) : ?>
							<tr class="ms_co_email">
							    <td>
								  <?php echo $email->email; ?>
								   <div class="row-actions" style="color:#ddd;">Added to <?php if($email->provider): echo $email->provider; else: echo "Inbuilt Mail List"; endif; ?></div>
								</td>
								<td align="center"><?php echo $email->name; ?></td>
								
								<td align="center">
								  <?php echo "Placement ". $email->placement; ?>
								  <div class="row-actions" style="color:#ddd;">Subscriber Optin at <?php echo "Placement ". $email->placement; ?></div>
								</td>
								
								<td align="center"><?php echo date('d/M/Y', strtotime($email->created_at)); ?></td>
							</tr>
						<?php
						$i++;
						endforeach;
					else : ?>
					<tr><td colspan="6"><?php _e('No Entries', 'contentoptin'); ?></td></tr>
				<?php endif;?>
			</tbody>	
	 </table>	
	
		<?php if ($total_pages > 1) : ?>
				<div class="tablenav">
					<div class="tablenav-pages alignright">
						<?php
							if(isset($_GET['show']) && $_GET['show'] > 0) {
								$base = $current_page_url.'&show=' . $_GET['show'] . '%_%';
							} else {
								$base = $current_page_url.'%_%';
							}
							echo paginate_links( array(
								'base' => $base,
								'format' => '&p=%#%',
								'prev_text' => __('&laquo; Previous'),
								'next_text' => __('Next &raquo;'),
								'total' => $total_pages,
								'current' => $page,
								'end_size' => 1,
								'mid_size' => 5,
							));
						?>	
				    </div>
				</div><!--end .tablenav-->
			<?php endif; ?>
	
   </div>
  
  <?php else: ?>
        <div style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6;">
		  <h4 style="margin:0;">Third Party Integration <span style="text-transform:capitalize;"><?php echo $list_provider; ?></span>, List ID [<?php echo $list_provider_id; ?>]</h4>
		  <h5 style="margin:0; font-size:12.5px;">This ContentOptin is currently connected to <?php echo $list_provider; ?>, some advanced statistics associated with Inbuilt list are not available for this Optin</h5>
		</div>
  <?php endif; ?>
  
</div>
 
<?php 

}

//Growth Rate

function ms_co_growth_rate(){
	global $wpdb, $ms_co_stat_table;
	
	$day = date('w');
    $this_week_start = date('Y-m-d', strtotime('-'.$day.' days'));
    $this_week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
	
	$this_week_string_start = strtotime('-'.$day.' days') - (60 * 60 * 24 * 7);
	$this_week_string_end = strtotime('+'.(6-$day).' days') - (60 * 60 * 24 * 7);
	
	$last_week_start = date('Y-m-d', $this_week_string_start);
	$last_week_end = date('Y-m-d', $this_week_string_end);
	
	$thiswk = $wpdb->get_var("SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$this_week_start' AND '$this_week_end'");
	$lastwk = $wpdb->get_var("SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$last_week_start' AND '$last_week_end'");
	
	if($lastwk == 0): $lastwk = 1; endif;
	$growth = $thiswk/$lastwk * 100;
	return $growth;
}

// retrieve mailist from the database
function ms_co_get_email( $offset = 0, $number = 10, $list_id ) {
	global $wpdb, $ms_co_email_table;
	if($number > 0)
		$emails = $wpdb->get_results("SELECT * FROM " . $ms_co_email_table. " WHERE post_id ='$list_id' ORDER BY id DESC LIMIT " . $offset . "," . $number);
	else
		$emails = $wpdb->get_results("SELECT * FROM " . $ms_co_email_table . " WHERE post_id ='$list_id' ORDER BY id DESC"); // this is to get all list
	return $emails;
}

// returns the total number of emails
function ms_co_count_emails($list_id) {
	global $wpdb, $ms_co_email_table;
	$count = $wpdb->get_var("SELECT COUNT(id) FROM " . $ms_co_email_table . " WHERE post_id ='$list_id'");
	return $count;
}

?>