<?php
/**
 * de-pikke functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package de-pikke
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function de_pikke_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on de-pikke, use a find and replace
		* to change 'de-pikke' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'de-pikke', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.

	register_nav_menus(
		array(
			'menu-main' => esc_html__( 'primary', 'de-pikke' ),
			'menu-main-home' => esc_html__( 'primary-home', 'de-pikke' ),
			'menu-footer' => esc_html__( 'footer-menu', 'de-pikke' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'de_pikke_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'de_pikke_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function de_pikke_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'de_pikke_content_width', 640 );
}
add_action( 'after_setup_theme', 'de_pikke_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function de_pikke_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'de-pikke' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'de-pikke' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'de_pikke_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function de_pikke_scripts() {
	wp_enqueue_style( 'de-pikke-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main.min.css">', array(), _S_VERSION );

	wp_enqueue_script( 'de-pikke-main-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), _S_VERSION, true );

	wp_localize_script( 
		'de-pikke-main-scripts', 
		'my_ajax_object', 
		array( 
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('ajax-nonce') 
		) 
	);

}
add_action( 'wp_enqueue_scripts', 'de_pikke_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Removes from admin menu
add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


//remove Emoji start
add_filter('emoji_svg_url', '__return_empty_string');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');    
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');  
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
function wph_remove_emojis_tinymce($plugins) {
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}
add_filter('tiny_mce_plugins', 'wph_remove_emojis_tinymce');

remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

//remove  Emoji end

//svg

function my_custom_mime_types( $mimes ) {
// New allowed mime types.
	$mimes['svg'] = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';

// Optional. Remove a mime type.
	unset( $mimes['exe'] );
	return $mimes;
}
add_filter( 'upload_mimes', 'my_custom_mime_types' );

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# fix MIME type for SVG.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
	$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
	$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

	if( $dosvg ){

	if( current_user_can('manage_options') ){

		$data['ext']  = 'svg';
		$data['type'] = 'image/svg+xml';
	}

	else {
		$data['ext'] = $type_and_ext['type'] = false;
	}

	}

	return $data;
}

add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );

# data for SVG media library.
function show_svg_in_media_library( $response ) {
	if ( $response['mime'] === 'image/svg+xml' ) {
	// file name
	$response['image'] = [
		'src' => $response['url'],
	];
	}

	return $response;
}

//svg end


if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' => 'Header Content',
		'menu_slug' => 'header-content',
		'position' => '22',
		'icon_url' => 'dashicons-table-row-before',
	));

	acf_add_options_page(array(
		'page_title' => 'Footer Content',
		'menu_slug' => 'footer-content',
		'position' => '22',
		'icon_url' => 'dashicons-table-row-after',
	));

	acf_add_options_sub_page(array(
        'page_title'     => 'Follow Links',
        'menu_title'    => 'Follow Links',
        'parent_slug'    => 'edit.php',
    ));
}

function register_purpose_post_type() {

	$labels = array(
		'name'                => __( 'Purpose', 'de-pikke' ),
		'singular_name'       => __( 'Purpose', 'de-pikke' ),
		'add_new'             => _x( 'Add New', 'de-pikke'),
		'add_new_item'        => __( 'Add New Purpose', 'de-pikke' ),
		'edit_item'           => __( 'Edit Purpose', 'de-pikke' ),
		'new_item'            => __( 'New Item', 'de-pikke' ),
		'view_item'           => __( 'View Purpose', 'de-pikke' ),
		'search_items'        => __( 'Search Purpose', 'de-pikke' ),
		'not_found'           => __( 'No Purpose found', 'de-pikke' ),
		'not_found_in_trash'  => __( 'No Purpose found in Trash', 'de-pikke' ),
		'menu_name'           => __( 'Purpose', 'de-pikke' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 34,
		'menu_icon'           => 'dashicons-cart',
		'show_in_nav_Menu'   => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array('slug' => 'purpose'),
		'capability_type'     => 'post',
		'supports'            => array('title', 'author')
	);

	register_post_type( 'purpose', $args );
}

add_action( 'init', 'register_purpose_post_type' );


function register_service_post_type() {

	$labels = array(
		'name'                => __( 'Service', 'de-pikke' ),
		'singular_name'       => __( 'Service', 'de-pikke' ),
		'add_new'             => _x( 'Add New', 'de-pikke'),
		'add_new_item'        => __( 'Add New Service', 'de-pikke' ),
		'edit_item'           => __( 'Edit Service', 'de-pikke' ),
		'new_item'            => __( 'New Item', 'de-pikke' ),
		'view_item'           => __( 'View Services', 'de-pikke' ),
		'search_items'        => __( 'Search Services', 'de-pikke' ),
		'not_found'           => __( 'No Service found', 'de-pikke' ),
		'not_found_in_trash'  => __( 'No Service found in Trash', 'de-pikke' ),
		'menu_name'           => __( 'Service', 'de-pikke' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 34,
		'menu_icon'           => 'dashicons-groups',
		'show_in_nav_Menu'    => true,
		'show_in_rest'        => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array('slug' => 'services'),
		'capability_type'     => 'post',
		'supports'            => array('title', 'editor', 'author', 'revisions')
	);

	register_post_type( 'service', $args );
}

add_action( 'init', 'register_service_post_type' );


function load_more_news() {
	if ( !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
		die ();
	}

	$paged = $_POST['page'];
	$postsPerPage = $_POST['posts_per_page'];

	$args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $postsPerPage,
	);

	$query = new WP_Query($args);
  
	if ($query->have_posts()) {

		while ($query->have_posts()) {
			$query->the_post();

			get_template_part('template-parts/news-card');

		}
	} else {
		echo 'Sorry, No News Found';
	}

	wp_die();
  
	}
add_action('wp_ajax_load_more_news', 'load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'load_more_news');


// add arrows for mobile sub menu
add_filter( 'walker_nav_menu_start_el', 'add_arrow',10,4); 

function add_arrow( $output, $item, $depth, $args ){ 
	if('menu-main' == $args->theme_location && $depth < 1 || 'menu-main-home' == $args->theme_location && $depth < 1){ 
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"></span>'; 
		} 
	} 
	return $output; 
}