<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

/* ================== Scripts/Styles ======================== */

function meta_resources() {
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/libraries/bootstrap.min.css');
  wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/libraries/all.min.css');
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.1.0', true );
  wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.2/webfont.js', array('jquery'), '1.6.26', true );
  wp_enqueue_script( 'meta-js', get_template_directory_uri() . '/js/meta.js', array('jquery'), '1', true );
}
add_action('wp_enqueue_scripts', 'meta_resources');

// Add title tag to header
add_theme_support( 'title-tag' );

/* ================== Admin layouts ======================== */

/* Move Yoast to bottom */
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/* Disable XML-RPC */
add_filter( 'xmlrpc_enabled', '__return_false' );

/* Hide Meta Boxes */
add_action( 'do_meta_boxes', 'remove_default_custom_fields_meta_box', 1, 3 );
function remove_default_custom_fields_meta_box( $post_type, $context, $post ) {
  remove_meta_box( 'postcustom', $post_type, $context );
  remove_meta_box( 'commentstatusdiv', $post_type, $context );
  remove_meta_box( 'commentsdiv', $post_type, $context );
}
add_action('wp_dashboard_setup', 'remove_all_dashboard_meta_boxes', 9998 );

function remove_all_dashboard_meta_boxes()
{
  global $wp_meta_boxes;
  $wp_meta_boxes['dashboard']['normal']['core'] = array();
  $wp_meta_boxes['dashboard']['side']['core'] = array();
}

// Remove tags from posts
function myprefix_unregister_tags() {
  unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');

// Remove comments from admin bar
function my_admin_bar_render() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

/* ================== Menus ======================== */

/* Add Menus */
function register_my_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

/* Add Wrappers for Sub Menus */
class megaMenu extends Walker_Nav_Menu {
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			'menu-depth-' . $display_depth
		);
		$class_names = implode( ' ', $classes );

		// build html
		if ($display_depth == 1) {
			$output .= "\n" . $indent . '
			<div class="sub-menu-wrap">
				<div class="container">
					<div class="row">
						<ul class="' . $class_names . ' col-12">' . "\n";
		} else {
			$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
		}
	}
}

/* ================== ACF ======================== */

/* Add ACF Options Page */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'    => 'Site Settings',
		'menu_title'    => 'Site Settings',
		'menu_slug'     => 'site-settings',
		'icon_url'      => 'dashicons-share',
		'position'      => 6,
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}

/* Add Names to ACF Areas */
function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {
	// load text sub field
	if( $text = get_sub_field('heading') ) {
		$title .= ' - '. $text ;
	}
	// return
	return $title;
}
add_filter('acf/fields/repeater/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);
add_filter('acf/fields/flexible_content/layout_title', 'my_acf_flexible_content_layout_title', 10, 4);

?>