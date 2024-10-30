<?php 


function ms_co_maillist_general(){
	
	global $wpdb, $ms_co_stat_table, $ms_co_email_table;
    $current_page_url = get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=contentoptin&page=ms_co_maillist_page';
    
	
	if (isset($_GET['p'])) $page = $_GET['p']; else $page = 1;
	
	if(isset($_GET['list_orderby'])) $orderby = $_GET['list_orderby']; else $orderby = 'postid';
	
		$per_page = 10;

		if(isset($_GET['show']) && $_GET['show'] > 0) {
			$per_page = intval($_GET['show']);
		}
		$total_pages = 1;
		$offset = $per_page * ($page-1);
		
		$lists = ms_co_get_list($offset, $per_page, $orderby);
		$list_count = ms_co_list_count();
		$total_pages = ceil($list_count/$per_page);
?>	
<div class="wrap">
   
	<div class="">
      <div class="">
        
		<h1 class="wp-heading-inline"><?php _e('Central List Manager', 'contentoptin'); ?></h1>
		
		<div class="tablenav top">
		
		  <div class="alignleft actions bulkactions">
			<label for="bulk-action-selector-top" class="screen-reader-text">Select Sort action</label>
			<form  action="" method="get" style="display:inline;">
			    <input type="hidden" name="page" value="ms_co_maillist_page"/>
			    <input type="hidden" name="post_type" value="contentoptin"/>
			    <select name="list_orderby" id="bulk-action-selector-top">
                   <option value="postid">Sort By ID</option>
				   <option value="visitcount">Sort By Impression</option>
				   <option value="clickcount">Sort By Click</option>
				   <option value="emailcount">Sort By Optin</option>
                </select>
                <input type="submit" class="button action" value="Apply"/>
			</form>
		 </div>
		
		   <div class="alignleft pageshow">
		     
            <form  action="" method="get" style="display:inline;">
		    <input type="hidden" name="page" value="ms_co_maillist_page"/>
			<input type="hidden" name="post_type" value="contentoptin"/>
			<input type="hidden" name="contentoptin_nav" value="maillist"/>
			<input type="text" class="regular-text" style="width:50px; display:inline;" name="show" value="<?php echo isset($_GET['show']) ? $_GET['show'] : '10'; ?>"/>
			<input type="submit" style="" class="button-secondary" value="<?php _e('List Per Page', 'contentoptin'); ?>"/>
		   </form>
	
		   </div>
		
		<div class="tablenav-pages one-page">
		   <span class="displaying-num"><?php if(ms_co_list_count() == 0): echo "No List"; elseif(ms_co_list_count() == 1): echo "1 List"; elseif(ms_co_list_count() > 1): echo ms_co_list_count() ." Lists"; endif; ?></span>
		</div>
	
	  
	  </div>
	<div style="margin-top:5px;">
		
	  <table class="wp-list-table widefat fixed striped posts">
	  
	       <thead>
				<tr >
				    <th width="5%" ><?php _e('ID', 'contentoptin'); ?></th>
					<th width="40%" ><?php _e('List Title', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Impression', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Click', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Subscribers', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Conversion', 'contentoptin'); ?></th>
					
				</tr>
			</thead>
			
		    <tfoot>
				<tr >
				    <th width="5%" ><?php _e('ID', 'contentoptin'); ?></th>
					<th width="40%" ><?php _e('List Title', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Impression', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Click', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Subscribers', 'contentoptin'); ?></th>
					<th style="text-align:center;"><?php _e('Conversion', 'contentoptin'); ?></th>
					
				</tr>
			</tfoot>
			
			<tbody>
				<?php
					if($lists) :
						
						foreach($lists as $list) : ?>
							<tr class="ms_co_email">
							   
								<td align="">
								   <?php echo $list->postid; ?>
								   
								</td>
								
								<td>
								  <a class="row-title" href="<?php echo $current_page_url;?>&ms-co-list-ind=1&ms-co-list-id=<?php echo $list->postid; ?>"><?php if(get_the_title($list->postid)): echo get_the_title($list->postid); else: echo "Contact ".$list->postid." - <span style='color:red'>[Deleted]</span>"; endif; ?></span>
								  <div class="row-actions"><a href="<?php echo $current_page_url;?>&ms-co-list-ind=1&ms-co-list-id=<?php echo $list->postid; ?>"><span class="edit">Browse List</span></a></div>
								</td>
								
								<td align="center">
								   <?php echo $list->visitcount; ?>
								   <div class="row-actions"><a href="#"><span style="color:#aaa; font-size:12px;">Impression/Visitor</span></a></div>
								</td>
								
								<td align="center">
								   <?php echo $list->clickcount; ?>
								   <div class="row-actions"><a href="#"><span style="color:#aaa; font-size:12px;">Click on Optin</span></a></div>
								</td>
								
								<td align="center">
								    <?php echo $list->emailcount; ?>
								    <div class="row-actions"><a href="#"><span style="color:#aaa; font-size:12px;">Total Optin</span></a></div>
								</td>
								
								<td align="center">
								   <?php echo @number_format((($list->emailcount/$list->clickcount) * 100), 2); ?>%
								   <div class="row-actions"><a href="#"><span style="color:#aaa; font-size:12px;">Optin/Click Conversion</span></a></div>
								 </td>
							</tr>
				<?php
						
						endforeach;
					else : ?>
					<tr><td colspan="6"><?php _e('No List', 'contentoptin'); ?></td></tr>
				<?php endif;?>
			</tbody>	
	</table>	
	</div>
	</div>
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
<?php 	
}

// retrieve mailist from the database
function ms_co_get_list( $offset = 0, $number = 10, $orderby = 'postid' ) {
	
	
	global $wpdb, $ms_co_stat_table;
	if($number > 0)
		$lists = $wpdb->get_results("SELECT postid, SUM(visitcount) AS visitcount, SUM(emailcount) AS emailcount, SUM(clickcount) AS clickcount FROM " . $ms_co_stat_table. " GROUP BY postid ORDER BY ".$orderby." ASC  LIMIT " . $offset . "," . $number);
	else
		$lists = $wpdb->get_results("SELECT postid, SUM(visitcount) AS visitcount, SUM(emailcount) AS emailcount, SUM(clickcount) AS clickcount FROM " . $ms_co_stat_table. " GROUP BY postid ORDER BY ".$orderby." ASC "); // this is to get all list
	return $lists;
}

// returns the total number of emails
function ms_co_list_count() {
	global $wpdb, $ms_co_stat_table;  
	$count = $wpdb->get_var("SELECT COUNT(DISTINCT postid) FROM " . $ms_co_stat_table);
	return $count;
}


?>