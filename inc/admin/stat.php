<?php
function ms_co_statistic_page_function(){

global $wpdb, $ms_co_stat_table;
$current_page_url = get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=contentoptin&page=ms_co_statistic_page'; 


//Date Picker 
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('ms_co_jquery-ui-css', MS_CO_PLUGIN_URL. 'inc/css/jquery-ui-fresh.min.css');


//Check the Report Parameter
$ms_co_search_state = 0;
 if(!wp_verify_nonce( $_POST['content_optin_search'], plugin_basename(__FILE__) )) { 

	 
   $start = time()- 24* 3600 * 7;
   $start_date = date('Y-m-d', $start);
   
   $end_date = date('Y-m-d', time());

   $impression_query = "SELECT SUM(visitcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' ";
   $signup_query = "SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date'";
   $click_query = "SELECT SUM(clickcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' ";
   //$chart_query = "SELECT emailcount, visitcount, stat_date FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date'";
   $chart_query = "SELECT stat_date, SUM(emailcount) AS email_stat, SUM(visitcount) AS view_stat, SUM(clickcount) AS click_stat FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' GROUP BY stat_date";
		
}else{
 

   $ms_co_search_state = 1;	
   $selectedpost =  $_POST['ms_co_select_post'];   
   $start_date = $_POST['ms_co_start_date'];
   $end_date = $_POST['ms_co_end_date'];
   
   
   if($selectedpost == 0):
      $impression_query = "SELECT SUM(visitcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' ";
    
      $signup_query = "SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' ";
      
	  $click_query = "SELECT SUM(clickcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' ";
	  
      $chart_query = "SELECT stat_date, SUM(emailcount) AS email_stat, SUM(visitcount) AS view_stat, SUM(clickcount) AS click_stat FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' GROUP BY stat_date";
   
   else:
   
      $impression_query = "SELECT SUM(visitcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' AND postid ='$selectedpost'";
    
      $signup_query = "SELECT SUM(emailcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' AND postid ='$selectedpost'";
	  
	  $click_query = "SELECT SUM(clickcount) FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' AND postid ='$selectedpost'";
  
      $chart_query = "SELECT stat_date, SUM(emailcount) AS email_stat, SUM(visitcount) AS view_stat, SUM(clickcount) AS click_stat FROM $ms_co_stat_table WHERE stat_date BETWEEN '$start_date' AND '$end_date' AND postid ='$selectedpost' GROUP BY stat_date";
   
   endif;  
 
}

?>

<div class="wrap">
   
   <h1><?php _e('Analytic', 'contentoptin'); ?></h1>
   
   <div style="font-size:13px; margin-bottom:10px;">
     <?php if($ms_co_search_state == 1 && $selectedpost != 0): ?>Stats for <span class="ms_co_color"><?php echo get_the_title($selectedpost); else: ?>Analytic for All ContentOptin<?php endif; ?></span>
   </div>
   
    <div style="background-image:linear-gradient(to top,#f5f5f5,#fafafa); border-color: #dfdfdf; padding: 12px;">
		
		  <div class="">
			
			<form action="<?php echo $current_page_url; ?>" method="POST">
						 
			    <input type="hidden" name="content_optin_search" id="content_optin_search" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
						 
			    <select name="ms_co_select_post" style="margin-top:-4px;">
							  <option value="0" <?php if($selectedpost == 0): echo "selected"; endif; ?>>All Optins</option>
                            <?php
                                global $post;
                                 $args = array( 'numberposts' => -1, 'post_type' =>'contentoptin');
                                 $posts = get_posts($args);
                                  foreach( $posts as $post ) : setup_postdata($post); ?>
                                   <option value="<? echo $post->ID; ?>" <?php if($selectedpost == $post->ID): echo "selected"; endif; ?>><?php the_title(); ?></option>
                            <?php endforeach; ?>
                </select>
				
				<input type="date" value="<?php echo $start_date; ?>" name="ms_co_start_date" class="ms_co_datepicker " required>
				<input type="date" value="<?php echo $end_date; ?>" name="ms_co_end_date" class="ms_co_datepicker" required>
				
			
                <input type="submit" class="button action" value="Apply"/>
			</form>
		 </div>
		</div>	   
		
			<div class="ms_co_row" id="ms_co_stat_main" style="margin-top:10px;">
			  
			  <div class="">
			  
             	 <div class="ms_co_row" style="display:inline;">	
				 
				    <div style="float:left; width:25%;">
				     <div class="ms_co_panel panel-default ms_co_box_adjuster">
					    <div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats ms_co_info-box-stats_alt">
						    <p>Impression</p>
							<span class="ms_co_info-box-title">Website Impression</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure">
						     <p><?php $impression = $wpdb->get_var($impression_query); echo number_format($impression);  ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:#ACC26D;"></div>
						</div>
					 </div>
				    </div>
				
				    <div style="float:left; width:25%;">
				     <div class="ms_co_panel panel-default ms_co_box_adjuster">
					   
						<div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats">
						    <p>Clicks</p>
							<span class="ms_co_info-box-title">Popup Click</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure">
						     <p><?php $clickopt = $wpdb->get_var($click_query);  echo number_format($clickopt);  ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:blue;"></div>
						</div>
						
						
					 </div>
				    </div>
					
					
				    <div style="float:left; width:25%; ">
				     <div class="ms_co_panel panel-default ms_co_box_adjuster">
					   
						<div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats">
						    <p>Subscribers</p>
							<span class="ms_co_info-box-title">Optins/Leads</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure">
						     <p><?php $signup = $wpdb->get_var($signup_query);  echo number_format($signup);  ?></p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:rgba(151,187,205,1);"></div>
						</div>
						
					 </div>
				    </div>
					
					
				    <div style="float:left; width:25%;">
				     <div class="ms_co_panel panel-default ms_co_box_adjuster">
					   
						<div class="ms_co_panel-body">
						  <div class="ms_co_info-box-stats">
						    <p>Conversion </p>
							<span class="ms_co_info-box-title">Click/Optins CR</span>
						  </div>
						   
						  <div class="ms_co_info-box-figure">
						     <p><?php echo @number_format((($signup/$clickopt) * 100), 2); ?>%</p>
						  </div>
						   
						   <div style="clear:both"></div>
						   <div class="ms_co_progress" style="background:#5bc0de;"></div>
						</div>
						
					 </div>
			        </div>
				
					
			     </div>
				
				 
				 <!-----Chart Section---->
				 
                 <div class="ms_co_row">
			       
			       <div style="float:left; width:75%">
                   
				      <div class="ms_co_panel panel-default" style="margin:2px;">
				         <div class="ms_co_panel-body">
				          <span style="font-size: 15px; color: #b0b0b0;"><strong>Impression, Click & Optin </strong></span>
			        
				         </div>
					     <div class="ms_co_panel-body">
					
					        <div style="width:100%">
				              <canvas class="canva" id="impression" width="700" height="300" ></canvas>
					        </div>
				         </div>
						 
						 
						 <div class="demo-container">
			                <div id="placeholder" class="demo-placeholder"></div>
		                 </div>
                      </div> 				   
					
			       </div>
				   
				   <div style="float:left; width:25%">
                             
							 
				    <div class="ms_co_panel panel-default" style="margin:2px;">
					    <div class="ms_co_panel-body"><span style="font-size: 15px; color: #b0b0b0;"><strong>Top Converting Optins</strong></span></div>
						<div class="ms_co_panel-body">
						
						<?php
						  $top_query = "SELECT stat_date, postid, SUM(emailcount) AS email_stat FROM $ms_co_stat_table GROUP BY postid ORDER BY email_stat DESC LIMIT 0, 4";
						   
						  $performance = $wpdb->get_results($top_query);
	    
						   if($performance):
						?>
						    <table> 
						        <?php foreach($performance as $per): ?>
						          <tr>
								    <td><?php if(get_the_title($per->postid)): echo get_the_title($per->postid); else: echo "Contact ".$per->postid. " [Deleted]"; endif; ?></td>
									<td align="right"><span class="ms_co_badge"><?php echo $per->email_stat; ?></span></td>
								  </tr>
								 
								<?php endforeach; ?>  
						    </table>
                        <?php else: ?>
                               <p>No Data available</p>
                        <?php endif; ?>						
						</div>
					 </div>
							 
                   </div>
				   
			     </div>   
				 
			  </div>	
			  
			    
			
			</div>
			
</div>			
			   
<?php 
//Chart Parameter
  
   $charts = $wpdb->get_results($chart_query);
   if($charts):
      
	  $date_between = ms_co_day_diff($start_date, $end_date);
	  
	  $chart_data = ms_co_actual_date($start_date, $date_between);
	 
	   foreach($charts as $chart):
	      //Replace Chart_data
		  
		  $chart_data[$chart->stat_date] = array('date' =>$chart->stat_date , 'visit' => $chart->view_stat , 'signup' => $chart->email_stat, 'click' => $chart->click_stat );
          
	   endforeach;
	  
	 
	  
	   $i = 1;
	  //Generate Chart Display Data
	   foreach($chart_data as $data):
	    
	      if($i == count($chart_data)):	
		  
			$label .= '"'.$data['date'].'"'; 
			$visit .= $data['visit'];
			$email .= $data['signup'];
			$optin_click .= $data['click'];
			
          else:
		  
            $label .= '"'.$data['date'].'",'; 
			$visit .= $data['visit'] .",";
			$email .= $data['signup'] .",";
			$optin_click .= $data['click'] .",";
			
          endif;
		  
	    $i++;
	   endforeach;
	 
   else:
     //FallBack In case no data was found for specified date
     $date_between = ms_co_day_diff($start_date, $end_date) + 1;
	
	 for($i=0; $i < $date_between; $i++){

      if($i == 0):	
		
		 $label .= '"'.$start_date.'",';
		 $email .= "0".",";
         $visit	.= "0".",";	
         $optin_click	.= "0".",";	 		 
		 
	  elseif($i == ($date_between - 1)):
         
         $string_date = str_replace('-', '/', $start_date);
         $nxt_date = date('Y-m-d',strtotime($string_date . "+".$i."days"));
		 $label .= '"'.$nxt_date.'"';
		 $email .= "0";
         $optin_click	.= "0";	 
	  else:
          
         $string_date = str_replace('-', '/', $start_date);
         $nxt_date = date('Y-m-d',strtotime($string_date . "+".$i."days"));
		 $label .= '"'.$nxt_date.'",';
		 $email .= "0".",";
         $visit	.= "0".",";
		 $optin_click .= "0".",";	  
      endif;	  
	 }
	
   endif; ?>
   
 
 <script>

	 var buyerData = {
		
         labels : [<?php echo $label; ?>],
         datasets : [
                      {  
					     label: "Impression",
                         backgroundColor : "rgba(220,220,220,0.2)",
                         borderColor : "#ACC26D",
                         pointColor : "#fff",
                         pointStrokeColor : "#9DB86D",
						 pointHighlightFill : "#333",
					     pointHighlightStroke : "rgba(220,220,220,1)",
                         data : [<?php echo $visit; ?>] 
                      },
					  
					  {  
					     label: "SignUp",
					     backgroundColor : "rgba(151,187,205,0.2)",
					     borderColor : "rgba(151,187,205,1)",
					     pointColor : "rgba(151,187,205,1)",
					     pointStrokeColor : "#fff",
					     pointHighlightFill : "#fff",
					     pointHighlightStroke : "rgba(151,187,205,1)",
						 
                         data : [<?php echo $email; ?>] 
                      }, 
					  
					  {  
					     label: "Optin Click",
					     backgroundColor : "rgba(161,167,215,0.2)",
					     borderColor : "blue",
					     pointColor : "rgba(151,187,205,1)",
					     pointStrokeColor : "#333",
					     pointHighlightFill : "#fff",
					     pointHighlightStroke : "rgba(151,187,205,1)",
						 
                         data : [<?php echo $optin_click; ?>] 
                      }
					  
         ]
    }
	
	var chartOptions = {
      legend: {
           display: true,
           position: 'right',
        labels: {
            boxWidth: 10,
            fontColor: 'black'
        }
      }
    };
	
	var impress = document.getElementById('impression');
	var lineChart = new Chart(impress, {
       type: 'line',
       data: buyerData,
       options: chartOptions
    });
	 

</script>

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.ms_co_datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });
});
</script>

<?php }  



 function ms_co_day_diff($begin, $end){  
    $begin = strtotime($begin);
    $end = strtotime($end);
    $datediff = $end - $begin;

    return floor($datediff / (60 * 60 * 24));
 }
 
 function ms_co_actual_date($start, $count){

	for($i=0; $i < $count + 1; $i++){
		if($i == 0){
			$date[$start] = array('date' =>$start, 'visit' => '0', 'signup' => '0', 'click' => '0'); 
		}else{
			$string_date = str_replace('-', '/', $start);
            $nxt_date = date('Y-m-d',strtotime($string_date . "+".$i."days"));
			$date[$nxt_date] = array('date' =>$nxt_date, 'visit' => '0', 'signup' => '0', 'click' => '0'); 
		}
	} 
	return $date;
 }
 
?>
