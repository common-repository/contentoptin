var $m = jQuery.noConflict();

$m(document).ready(function(){
	 $m('#msco_optin_type').on("change",function(){
		var selectedtype = this.value;
		if(selectedtype == '2'){
			$m('#ms_co_box').hide();
			$m('#ms_co_link').show();
			$m('#preview-box').hide();
			$m('#preview-link').show();
		}else{
		    $m('#ms_co_box').show();
			$m('#ms_co_link').hide();
			$m('#preview-box').show();
			$m('#preview-link').hide();
		}
	 });
	 
	  $m('#msco_delivery_type').on("change",function(){
		var selectedtype = this.value;
		if(selectedtype == '2'){
			$m('#ms_co_bonus').hide();
			$m('#ms_co_redirect').show();
		}else{
		    $m('#ms_co_bonus').show();
			$m('#ms_co_redirect').hide();
		}
	 });
});
