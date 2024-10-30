
var $m = jQuery.noConflict();

/******* Detect PopUp Click *******/
        
		 $m(document).on('click', 'a.contentoptin-popup', function(e){ 
		   
			$m('#contentoptin_myModal').fadeIn(350);
			$m('body').toggleClass('contentoptin-no-scroll');
		
            var sco_element = $m(this);
			var placement_id_number = sco_element.attr("id");
			var sco_post = $m('#ms_co_post_id').val();

		    $m.ajax({
			   url : contentoptin_ajax.ajax_url,
		       type : 'POST',
			   datatype: "json",
			   cache: false,
		       data : {action:'content_optin_ajax_submit', stat_post_id:sco_post, stat_status:'1'},
			   error: function(jqXHR, textStatus, errorThrown) {
                   alert(errorThrown);
               },
		       success : function(data, textStatus, request) {
				  //console.log(data); 
				  //alert(data);
				 
			   }
	         });

			 //Set the Value of ContentOptin Placement Input
			 $m("#ms_co_placement_id").val(placement_id_number);
			
			e.preventDefault();
			 
		 });
		 
		  /******* Detect PopUp Close *******/
		  
		  $m(document).on('click', 'span.contentoptin_close', function(e){ 
		    
			$m('#contentoptin_myModal').fadeOut(350);
			$m('body').toggleClass('contentoptin-scroll');
			
			e.preventDefault();
		 });
		 
				 
		 
		 $m(document).on('click', '.ms_co_submit', function() {
			var co_name = $m('#ms_co_user_name').val();
			var co_email = $m('#ms_co_user_email').val();
			var co_post = $m('#ms_co_post_id').val();
			var co_list = $m('#ms_co_email_list').val();
			var co_placement = $m('#ms_co_placement_id').val();
			
			if(!isEmail(co_email)){
				$m(".ms_co_popup_error").show();
			
			}else if(co_email =="" || co_name ==""){
				$m(".ms_co_popup_missing").show();
			}else{
			
	        $m.ajax({
			   url : contentoptin_ajax.ajax_url,
		       type : 'POST',
			   dataType:'json',
		       data : {action:'content_optin_ajax_submit', post_id:co_post, email:co_email, name:co_name, elist:co_list, placement:co_placement},
			   beforeSend: function() { 
			           $m(".ms_co_popup_error").hide();
					   $m(".ms_co_popup_missing").hide();
                       $m(".ms_co_popup_transit").show();
                       $m(".ms_co_submit").prop('disabled', true); // disable button
               },
		       success : function(response) {
			      
				   if(response['0'] == 1){
					   document.location.href = response['1'];
				   }else{
					   alert(response['1']);
				   }
				   
				  
		        },
				
				complete: function() {
					$m(".ms_co_submit").prop('disabled', false); 
				}
	
	         });
			 
			}			
         });
		 
function isEmail(email) {
    var regex = /^^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
    return regex.test(email);
}

