<?php
Carbon_Admin_Columns_Manager::modify_columns('post', array( 'post' ) )
	->add( array(
		Carbon_Admin_Column::create('Featured Image')
			->set_width( '110px' )
			->set_callback('crb_column_render_post_thumbnail'),
	));

add_filter( 'manage_posts_columns', 'crb_posts_column_views' );
add_action( 'manage_posts_custom_column', 'crb_posts_custom_column_views', 5, 2 );
function crb_posts_column_views( $defaults ) {
	$screen = get_current_screen();
	if ( $screen->post_type === 'post' ) {
		$defaults['post_views'] = __( 'Views', 'crb' );
	}
	return $defaults;
}

function crb_posts_custom_column_views($column_name, $id){
	if( $column_name === 'post_views' ) {
		echo crb_get_post_views( get_the_ID() );
	}
}

add_action( 'pre_get_posts', 'crb_views_column_orderby' );  
function crb_views_column_orderby( $query ) {  
	if( ! is_admin() )  
		return;  

	$orderby = $query->get( 'orderby');  

	if( 'post_views' === $orderby ) {  
		$query->set('meta_key','_crb_post_views');  
		$query->set('orderby','meta_value_num');  
	};
}

add_filter( "manage_edit-post_sortable_columns", "crb_sortable_columns" );
function crb_sortable_columns() {
	return array(
		'post_views'	=> 'post_views'
	);
}

function crb_column_render_post_thumbnail( $post_id ) {
	if ( has_post_thumbnail( $post_id ) ) {
		$thumbnail = get_the_post_thumbnail( $post_id, 'admin-thumbnail' );
	} else {
		$thumbnail = '';
	};

	return $thumbnail;
}