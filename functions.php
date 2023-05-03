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
  wp_enqueue_script( 'webfont', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', array('jquery'), '1.6.26', true );
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
		'page_title'    => 'Theme Options',
		'menu_title'    => 'Theme Options',
		'menu_slug'     => 'theme-options',
		'icon_url'      => 'dashicons-admin-generic',
		'position'      => 6,
		'capability'    => 'edit_posts',
		'redirect'      => false
	));
}

/* ================== Custom Login ======================== */

function meta_custom_login() { 
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background: transparent url(<?php bloginfo('template_directory'); ?>/images/meta-logo-small.webp) no-repeat 50% 5%;
            background-size: contain;
            margin: 0px auto 25px auto;
            overflow: hidden;
            text-indent: -9999px;
            height: 100px;
            width: 100px;
        }
    
        body {
            height: 100vh;
            background: url(<?php bloginfo('template_directory'); ?>/images/meta-bg.webp) center / cover no-repeat fixed !important;
        }
    
        #wrap {
            position: absolute !important;
            top: 0;
            bottom: 0;
            left: 0;
            width: 40%;
            min-width: 350px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: translateX(-100%);
            background-color: #fcfcfc;
        }
    
        .language-switcher {
            display: none;
        }
    
        .message {
            border-left: 4px solid #72aee6;
            padding: 12px;
            margin-bottom: 20px;
            word-wrap: break-word;
            background-color: #fff;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
    
        #login {
            opacity: 0;
            transition: transform 0.5s ease-in-out;
        }
    
        .login form {
            background-color: #fcfcfc;
            border: none;
            padding: 24px 0;
            box-shadow: none;
        }
    </style>
    <script>
        // Wrap all body contents into wrap div and show it on page load 
        window.addEventListener('load', () => {
          const wrap = document.createElement('div');
          wrap.id = 'wrap';
          while (document.body.firstChild) {
            wrap.appendChild(document.body.firstChild);
          }
          document.body.appendChild(wrap);

          // Append message div after first h1 element in body 
          const message = document.createElement('div');
          message.innerHTML = '<p>Need help logging in? Email our support team at <a href="mailto:support@metadigital.co.nz">support@metadigital.co.nz</a></p>';
          message.classList.add('message');
          document.querySelector('h1').after(message); // changed from document.body.querySelector to document.querySelector 

          // Slide in wrap on page load after 1 seconds
          setTimeout(() => {
            wrap.style.transform = 'translateX(0)';
          }, 1000); // updated timer to 1000ms

          // Fade in #login on page load
          document.getElementById('login').style.opacity = '1'; 
        });
    </script>

    <?php
}
add_action( 'login_enqueue_scripts', 'meta_custom_login' );

add_filter( 'login_headerurl', function() { return home_url(); } );
add_filter( 'login_headertitle', function() { return 'Your Site Name and Info'; } );

/* ================== Meta CSS ======================== */

function wpacg_meta_admin_color_scheme() {
  //Get the theme directory
  $theme_dir = get_stylesheet_directory_uri();

  //Meta
  wp_admin_css_color( 'meta', __( 'Meta' ),
    $theme_dir . '/meta.css',
    array( '#23282d', '#ffffff', '#df5284' , '#3aab47')
  );
}
add_action('admin_init', 'wpacg_meta_admin_color_scheme');

function remove_admin_color_schemes() {
  global $_wp_admin_css_colors;
  $keep_color_schemes = array('meta');
  $new_color_schemes = array();
  foreach ($_wp_admin_css_colors as $key => $color_scheme) {
      if (in_array($key, $keep_color_schemes)) {
          $new_color_schemes[$key] = $color_scheme;
      }
  }
  $_wp_admin_css_colors = $new_color_schemes;
}
add_action('admin_enqueue_scripts', 'remove_admin_color_schemes', 11);

function custom_admin_logo() {
  echo '<style type="text/css">
      #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
          background-image: url('.get_stylesheet_directory_uri().'/images/meta-logo-small.webp) !important;
          background-position: 0 0;
          color:rgba(0, 0, 0, 0);
          background-size: contain;
          background-repeat: no-repeat;
      }
      #wpadminbar #wp-admin-bar-wp-logo:hover > .ab-item .ab-icon:before {
          background-image: url('.get_stylesheet_directory_uri().'/images/meta-logo-small.webp) !important;
          background-position: 0 0;
          color:rgba(0, 0, 0, 0);
          background-size: contain;
          background-repeat: no-repeat;
      }
  </style>';
}

add_action('wp_before_admin_bar_render', 'custom_admin_logo');

?>
