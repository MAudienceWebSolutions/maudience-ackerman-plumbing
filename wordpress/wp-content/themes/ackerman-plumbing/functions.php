<?php
define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

# Load the debug functions early so they're available for all theme code
include_once(CRB_THEME_DIR . 'lib/debug.php');

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue jQuery
	wp_enqueue_script('jquery');

	# Enqueue Custom JS files
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	crb_enqueue_script('theme-bx-slider', $template_dir . '/js/jquery.bxslider.min.js', array('jquery'));
	crb_enqueue_script('theme-functions', $template_dir . '/js/functions.js', array('jquery'));

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	crb_enqueue_style('theme-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300italic,600,700');
	crb_enqueue_style('theme-sanchez', '//fonts.googleapis.com/css?family=Sanchez');
	crb_enqueue_style('theme-styles', $template_dir . '/style.css');

	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}

# Enqueue JS and CSS assets on admin pages
add_action('admin_enqueue_scripts', 'crb_admin_enqueue_scripts');
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Scripts
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	# crb_enqueue_script('theme-admin-functions', $template_dir . '/js/admin-functions.js', array('jquery'));
	
	# Enqueue Styles
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	# crb_enqueue_style('theme-admin-styles', $template_dir . '/css/admin-style.css');
}

# Attach Custom Post Types and Custom Taxonomies
add_action('init', 'crb_attach_post_types_and_taxonomies', 0);
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once(CRB_THEME_DIR . 'options/post-types.php');

	# Attach Custom Taxonomies
	include_once(CRB_THEME_DIR . 'options/taxonomies.php');
}

add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Common libraries
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-validator/carbon-validator.php');
		include_once(CRB_THEME_DIR . 'lib/admin-column-manager/carbon-admin-columns-manager.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-pagination/carbon-pagination.php');

		# Additional libraries and includes
		include_once(CRB_THEME_DIR . 'includes/comments.php');
		include_once(CRB_THEME_DIR . 'includes/title.php');
		include_once(CRB_THEME_DIR . 'includes/gravity-forms.php');
		include_once(CRB_THEME_DIR . 'includes/post-views.php');
		
		# Theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('title-tag');
		add_theme_support('menus');
		add_theme_support('html5', array('gallery'));

		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		# Add custom image sizes
		add_image_size( 'featured_post_image', 83, 64 );
		add_image_size( 'admin-thumbnail', 100, 100, 1 );
		add_image_size( 'feature_icon', 181, 107 );
		add_image_size( 'post_image', 372, 286 );
		add_image_size( 'section_slide', 466, 272 );
		add_image_size( 'section_image', 788, 514 );
		add_image_size( 'slider_image', 1600, 625 );

		# Register Theme Menu Locations
		register_nav_menus(array(
			'main-menu'=>__('Main Menu', 'crb'),
		));
		
		
		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/shortcodes.php');

		# Attach custom columns
		include_once(CRB_THEME_DIR . 'options/admin-columns.php');
		
		# Add Actions
		add_action('widgets_init', 'crb_widgets_init');

		add_action('carbon_register_fields', 'crb_attach_theme_options');
		add_action('carbon_after_register_fields', 'crb_attach_theme_help');

		# Add Filters
		add_filter('excerpt_more', 'crb_excerpt_more');
		add_filter('excerpt_length', 'crb_excerpt_length', 999);
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Default Sidebar',
		'id'   => 'default-sidebar',
	));
	
	register_sidebar($sidebar_options);
}

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	);
}

function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
}

function crb_attach_theme_help() {
	# Theme Help needs to be after options/theme-options.php
	include_once(CRB_THEME_DIR . 'lib/theme-help/theme-readme.php');
}

function crb_excerpt_more() {
	return '';
}

function crb_excerpt_length() {
	return 48;
}

function crb_socials_array() {
	$social_icons = array(
		'facebook',
		'instagram',
		'twitter',
	);	
	return $social_icons;
}

function crb_sanitize_phone($phone) {
	return preg_replace('~[^\d+]~', '', $phone );
}

add_filter( 'query_vars', 'crb_add_query_vars_filter' );
function crb_add_query_vars_filter( $vars ){
	$vars[] = "popular";

	return $vars;
}