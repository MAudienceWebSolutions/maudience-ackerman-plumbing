<?php
// function to display number of posts.
function crb_get_post_views( $postID ){
	$count_key = '_crb_post_views';
	$count = get_post_meta( $postID, $count_key, true );
	if( $count === '' ){
		update_postmeta( $postID, $count_key, '0' );
		return "0 Views";
	}
	return $count . ' Views';
}
 
// function to count views.
function crb_set_post_views( $postID ) {
	$count_key = '_crb_post_views';
	$count = get_post_meta( $postID, $count_key, true );
	if( $count === '' ) {
		$count = 0;
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}

add_action( 'pre_get_posts', 'crb_order_posts_popularity' );
function crb_order_posts_popularity( $query ) {
	if ( isset($_GET['popular']) && $query->is_main_query() ){
			// Stock: sort by unsold first, then by date
			$query->set( 'meta_key', '_crb_post_views' );
			$query->set( 'orderby', array( 'meta_value_num' => 'DESC' ) );
		}
	return $query;
}