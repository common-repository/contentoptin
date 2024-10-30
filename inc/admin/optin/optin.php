<?php 

	// Registers the new post type and taxonomy
    add_action( 'init', 'ms_co_optin_posttype' );
    
	//Corresponding Menu
    add_action( 'admin_menu', 'ms_co_admin_main_menu' );
	
    function ms_co_admin_main_menu(){
       add_submenu_page('edit.php?post_type=contentoptin', 'Analytic Insight', 'Analytic Insight', 'manage_options', 'ms_co_statistic_page', 'ms_co_statistic_page_function');
       add_submenu_page('edit.php?post_type=contentoptin', 'List Manager', 'List Manager', 'manage_options', 'ms_co_maillist_page', 'ms_co_maillist_page_function');
       add_submenu_page('edit.php?post_type=contentoptin', 'Addons', 'Addons', 'manage_options', 'ms_co_integration_page', 'ms_co_integration_function');
       add_submenu_page('edit.php?post_type=contentoptin', 'Help', 'Help', 'manage_options', 'ms_co_help', 'ms_co_help_function');

    }



   //ContentOptin Post Type Parameters
   function ms_co_optin_posttype() {
	register_post_type( 'contentoptin',
		array(
			'labels' => array(
				'name' => __( 'ContentOptin' ),
				'singular_name' => __( 'ContentOptin' ),
				'add_new' => __( 'Add New Optin' ),
				'add_new_item' => __( 'Add New Optin' ),
				'edit_item' => __( 'Edit Optin' ),
				'new_item' => __( 'Add New Optin' ),
				'view_item' => __( 'View Optin' ),
				'search_items' => __( 'Search Optin' ),
				'not_found' => __( 'No Optin found' ),
				'not_found_in_trash' => __( 'No Optin found in trash' )
			),
			'public' => false,
			'menu_icon' => MS_CO_PLUGIN_URL.'/inc/img/menu_icon.png',
			'supports' => array( 'title'),
			'show_ui' => true, 
			'capability_type' => 'post',
			'rewrite' => array("slug" => "ms-contentoptin"), // Permalinks format
			'menu_position' => 5
			
		)
	);
}


// Add the custom columns to the book post type:
add_filter( 'manage_contentoptin_posts_columns', 'set_custom_edit_book_columns' );
function set_custom_edit_book_columns($columns) {
    unset( $columns['author'] );
	unset( $columns['date'] );
    $columns['optin_shortcode'] = __( 'Shortcode', 'contentoptin' );
    $columns['optin_subscriber'] = __( 'Optins', 'contentoptin' );
	$columns['author'] = __( 'Created By', 'contentoptin' );
	$columns['date'] = __( 'Added On', 'contentoptin' );
   
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_contentoptin_posts_custom_column' , 'custom_book_column', 10, 2 );
function custom_book_column( $column, $post_id ) {
    switch ( $column ) {

        case 'optin_shortcode' :
		  
	        $contentoptin_shortcode = '[contentoptin id="'.$post_id.'"]';
	
            if ($post_id)
				
               echo "<span class='ms_co_shortcode'><input type='text' readonly='readonly' onfocus='this.select();' value='".$contentoptin_shortcode."' class='large-text code' /></span>";
	
            else
                _e( 'Cant get Shortcode', 'contentoptin' );
            break;

        case 'optin_subscriber' :
		  
		  $total_optin = ms_co_optin_count($post_id);
		  
		  if($total_optin)
			  echo $total_optin." Optins";
		  else
			  _e( 'No Optin Yet', 'contentoptin' );
		break;
    }
}

//optin total
function ms_co_optin_count($id) {
	global $wpdb, $ms_co_email_table;
	$count = $wpdb->get_var("SELECT COUNT(id) FROM " . $ms_co_email_table . " WHERE post_id ='$id'");
	return $count;
}
?>