<?php 

//Remove Unncessary Page Action
add_filter( 'post_row_actions', 'ms_co_optin_row_actions', 10, 2 );
function ms_co_optin_row_actions( $actions, $post ) {
	
      if(get_post_type() == 'contentoptin'){
	      unset( $actions['inline hide-if-no-js'] );
          unset( $actions['view'] );
      }
	  
    return $actions;
}

//Change Update Wording
add_filter( 'gettext', 'change_publish_button', 10, 2 );
function change_publish_button( $translation, $text ) {
    if('contentoptin' == get_post_type())
		
       if($text == 'Publish'){
           
		   return 'Create Optin';
		   
       }elseif($text == 'Update'){
		   
		    return 'Update Optin';
			
	   }
	   
    return $translation;
}


//Sets the post status to published
function ms_co_optin_force_published( $post ) {
    if( 'trash' !== $post[ 'post_status' ] ) { 
        if( in_array( $post[ 'post_type' ], array( 'contentoptin' ) ) ) {
            $post['post_status'] = 'publish';
        }
        return $post;
    }
}

// Hook to wp_insert_post_data
//add_filter( 'wp_insert_post_data', 'ms_co_optin_force_published' );


// Modify the Publishing Action Using CSS
function ms_co_optin_hide_minor_publishing() {
    $screen = get_current_screen();
    if( in_array( $screen->id, array('contentoptin' ) ) ) {
        echo '<style>#minor-publishing { display: none; } #major-publishing-actions{background:#fff;}</style>';
    }
}

// Hook to admin_head for the CSS to be applied earlier
add_action( 'admin_head', 'ms_co_optin_hide_minor_publishing' );
?>