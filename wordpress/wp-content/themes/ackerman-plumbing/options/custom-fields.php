<?php
$options_array = array();
$categories = get_categories();
foreach ( $categories as $category ) {
	$options_array[$category->term_id] = $category->cat_name;
};

Carbon_Container::factory('custom_fields', __('Blog Page Options', 'crb'))
	->show_on_post_type('page')
	->show_on_page(intval(get_option( 'page_for_posts' )))
	->add_fields(array(
		Carbon_Field::factory("association", "crb_categories", __('Categories Links', 'crb'))
			->set_types(array(
				array(
					'type' => 'term',
					'taxonomy' => 'category',
				)
			)),
	));

Carbon_Container::factory('custom_fields', __('Sidebar Options', 'crb'))
	->show_on_post_type('page')
	->hide_on_template('templates/home.php')
	->add_fields(array(
		Carbon_Field::factory("sidebar", "crb_custom_sidebar", __('Sidebar', 'crb'))
			->help_text( __('Select which sidebar to show in this page, or click "Add New" to create a new one.', 'crb' ) )
	));

Carbon_Container::factory('custom_fields', __('Post Options', 'crb'))
	->show_on_post_type('post')
	->add_fields(array(
		Carbon_Field::factory("checkbox", "crb_feature_post", __('Feature This Post', 'crb')),
		Carbon_Field::factory("text", "crb_post_views", __('Post Views', 'crb')),
	));

Carbon_Container::factory('custom_fields', __('Page Options', 'crb'))
	->show_on_post_type('page')
	->show_on_template('templates/home.php')
	->add_tab( 'Home Intro Slides', array(
		Carbon_Field::factory("complex", "crb_home_intro_slides", __('Home Intro Slides', 'crb'))
			->add_fields(array(
				Carbon_Field::factory("attachment", "image", __('Slide Image', 'crb'))->set_required(true),
				Carbon_Field::factory("text", "text", __('Slide Text', 'crb')),
			)),
	))
	->add_tab( 'Home Intro Features', array(
		Carbon_Field::factory("complex", "crb_home_intro_features", __('Home Intro Features', 'crb'))
			->add_fields(array(
				Carbon_Field::factory("attachment", "image", __('Feature Image', 'crb'))
					->set_required(true)
					->set_width(33),
				Carbon_Field::factory("text", "title", __('Feature Title', 'crb'))
					->set_width(33),
				Carbon_Field::factory("rich_text", "content", __('Feature Content', 'crb'))
					->set_required(true)
					->set_width(33),
				Carbon_Field::factory("text", "link", __('Feature Link', 'crb'))
					->set_required(true)
			)),
	))
	->add_tab( 'Sections', array(
		Carbon_Field::factory("relationship", "crb_home_section_association", __('Sections', 'crb'))
			->set_post_type('crb_sections'),
	));

Carbon_Container::factory('custom_fields', __('Section Options', 'crb'))
	->show_on_post_type('crb_sections')
	->add_fields(array(
		Carbon_Field::factory("checkbox", "crb_show_title", __( 'Show Title', 'crb'))
			->set_default_value('yes')
			->help_text(__('Show secton title on top.', 'crb')),
		Carbon_Field::factory("select", "type", __('Section Type', 'crb'))
			->add_options(array(
				'slider' => 'Slider Section',
				'section_image' => 'Content And Image section',
				'columns_section' => 'Section With Columns',
				'list_section' => 'List Section',
			)),
		Carbon_Field::factory("complex", "crb_slides", __('Slides Options', 'crb'))
			->set_conditional_logic(array(
				array(
					'field' => 'type',
					'value' => 'slider',
				)
			))
			->add_fields(array(
				Carbon_Field::factory("text", "title", __( 'Slide Title', 'crb')),
				Carbon_Field::factory("attachment", "image", __( 'Slide Image', 'crb'))
					->set_required(true)
					->set_width(50),
				Carbon_Field::factory("rich_text", "content", __( 'Slide Content', 'crb'))
					->set_width(50),
				Carbon_Field::factory("text", "button_text", __( 'Button Text', 'crb'))
					->set_width(30),
				Carbon_Field::factory("text", "button_link", __( 'Button Link', 'crb'))
					->set_width(70),
			)),
		Carbon_Field::factory("complex", "crb_list_items", __('List Items', 'crb'))
			->set_max(4)
			->set_conditional_logic(array(
				array(
					'field' => 'type',
					'value' => 'list_section',
				)
			))
			->add_fields(array(
				Carbon_Field::factory("text", "text", __( 'List Item Text', 'crb')),
			)),
		Carbon_Field::factory("rich_text", "crb_section_content", __('Content Left', 'crb'))
			->set_width(50)
			->set_conditional_logic(array(
				'relation' => 'OR',
				array(
					'field' => 'type',
					'value' => 'section_image',	
				),
				array(
					'field' => 'type',
					'value' => 'columns_section',
				),
			)),
		Carbon_Field::factory("rich_text", "crb_section_content_aside", __('Content Right', 'crb'))
			->set_width(50)
			->set_conditional_logic(array(
				array(
					'field' => 'type',
					'value' => 'columns_section',	
				),
			)),
		Carbon_Field::factory("complex", "crb_section_content_list", __('Content List', 'crb'))
			->set_conditional_logic(array(
				array(
					'field' => 'type',
					'value' => 'columns_section',	
				),
			))
			->add_fields(array(
				Carbon_Field::factory("text", "title", __('List Item Title', 'crb'))->set_required(true),
				Carbon_Field::factory("textarea", "content", __('List Item Content', 'crb'))->set_required(true),
			)),
		Carbon_Field::factory("attachment", "crb_section_image", __('Section Image', 'crb'))
			->set_width(50)
			->set_conditional_logic(array(
				array(
					'field' => 'type',
					'value' => 'section_image',	
				),
			)),
	));

