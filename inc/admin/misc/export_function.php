<?php
//Export Function
function ms_co_csv_export() {

	
	if ( ! is_super_admin() ) {
		return;
	}
	if ( ! isset($_GET['ms_co_list_export'] ) ) {
		return;
	}
	
	$list_id = $_GET['ms_co_csv_export_id'];
	$filename = 'contentoptin-email-' . time() . '.csv';
	$header_row = array(
		0 => 'Name',
		1 => 'Email',
		2 => 'Joined Date',
		3 => 'Post',
	);
	$data_rows = array();
	global $wpdb, $ms_co_email_table;
	$lists = $wpdb->get_results("SELECT * FROM " . $ms_co_email_table. ' WHERE post_id='.$list_id);
	
	foreach ( $lists as $list ) {
		$row = array();
		$row[0] = $list->name;
		$row[1] = $list->email;
		$row[2] = $list->created_at;
		$row[3] = get_the_title($list->post_id);
		
		$data_rows[] = $row;
	}
	$fh = @fopen( 'php://output', 'w' );
	fprintf( $fh, chr(0xEF) . chr(0xBB) . chr(0xBF) );
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	header( 'Content-Description: File Transfer' );
	header( 'Content-type: text/csv' );
	header( "Content-Disposition: attachment; filename={$filename}" );
	header( 'Expires: 0' );
	header( 'Pragma: public' );
	fputcsv( $fh, $header_row );
	foreach ( $data_rows as $data_row ) {
		fputcsv( $fh, $data_row );
	}
	fclose( $fh );
	die();
}
add_action( 'admin_init', 'ms_co_csv_export' );

