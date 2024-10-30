<?php 

function ms_co_maillist_page_function(){
	if(isset($_GET['ms-co-list-ind']) && isset($_GET['ms-co-list-id'])):
	    ms_co_maillist_individual();
	else:
	   ms_co_maillist_general();
	endif;
}

//Connect Maillist Necessary Function & Hook
include(MS_CO_PLUGIN_DIR . '/inc/admin/list/listmanager.php');

include(MS_CO_PLUGIN_DIR . '/inc/admin/list/list.php');
?>