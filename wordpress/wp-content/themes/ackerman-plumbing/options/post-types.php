<?php

register_post_type('crb_sections', array(
	'labels' => array(
		'name' => __('Sections', 'crb'),
		'singular_name' => __('Section', 'crb'),
		'add_new' => __('Add New', 'crb'),
		'add_new_item' => __('Add new Section', 'crb'),
		'view_item' => __('View Section', 'crb'),
		'edit_item' => __('Edit Section', 'crb'),
		'new_item' => __('New Section', 'crb'),
		'view_item' => __('View Section', 'crb'),
		'search_items' => __('Search Sections', 'crb'),
		'not_found' =>  __('No sections found', 'crb'),
		'not_found_in_trash' => __('No sections found in trash', 'crb'),
	),
	'public' => false,
	'exclude_from_search' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'_edit_link' => 'post.php?post=%d',
	'rewrite' => false,
	'query_var' => false,
	'menu_icon' => 'dashicons-images-alt2',
	'supports' => array('title'),
));
