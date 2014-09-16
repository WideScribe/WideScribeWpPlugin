<?php
/**
 * Singl functions and definitions
 *
 * @package Singl
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'singl_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function singl_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Singl, use a find and replace
	 * to change 'singl' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'singl', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured-image', 768, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'singl' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'singl_custom_background_args', array(
		'default-position'   => 'center',
		'default-repeat'     => 'no-repeat',
		'default-attachment' => 'fixed',
		'default-image'      => get_template_directory_uri() . '/images/background.jpg',
		'default-color'      => '777777',
	) ) );

}
endif; // singl_setup
add_action( 'after_setup_theme', 'singl_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function singl_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area One', 'singl' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Two', 'singl' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area Three', 'singl' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'singl_widgets_init' );

/**
 * Register Google fonts for Singl
 */
function singl_fonts() {
	/* translators: If there are characters in your language that are not supported
	   by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'singl' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Roboto character subset specific to your language, translate this to 'cyrillic'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Roboto font: add new subset (cyrillic, greek or vietnamese)', 'singl' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic-ext,cyrillic';
		}
		if ( 'greek' == $subset ) {
			$subsets .= ',greek-ext,greek';
		}
		if ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic',
			'subset' => $subsets,
		);
		wp_register_style( 'singl-roboto', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

}
add_action( 'init', 'singl_fonts' );

/**
 * Enqueue scripts and styles.
 */
function singl_scripts() {
	wp_enqueue_style( 'singl-roboto' );

	wp_enqueue_style( 'singl-font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), null );

	wp_enqueue_style( 'singl-style', get_stylesheet_uri() );

	wp_enqueue_script( 'singl-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'singl-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'singl-media', get_template_directory_uri() . '/js/media.js', array( 'jquery', 'underscore' ), '20140411', true );
	
	wp_enqueue_script( 'singl-script', get_template_directory_uri() . '/js/singl.js', array( 'jquery', 'underscore' ), '20140106', true );

	if ( '' != get_theme_mod( 'singl_background_size' ) ) {
		wp_enqueue_script( 'singl-backstretch', get_template_directory_uri() . '/js/backstretch.js', array( 'jquery' ), '20130619', true );
	}

	wp_localize_script( 'singl-script', 'singl_background_image_vars', array(
			'header_bg' => get_theme_mod( 'singl_background_size' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'singl_scripts' );

/**
 * Retrieve background image URL for body background.
 */
function singl_background_image_url() {

	$bg_image_url = get_background_image();

	/* If there is an image, prepare it for use in custom.js */
	if ( ! empty( $bg_image_url ) ) {
		wp_localize_script( 'singl-script', 'singl_script_vars', array(
				'bg_image_url' => $bg_image_url,
			)
		);
	} else {
		wp_localize_script( 'singl-script', 'singl_script_vars', array(
				'bg_image_url' => false,
			)
		);
	}

}
add_action( 'wp_enqueue_scripts', 'singl_background_image_url' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function singl_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix ) {
		return;
	}

	wp_enqueue_style( 'singl-roboto' );
}
add_action( 'admin_enqueue_scripts', 'singl_admin_fonts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( file_exists( get_template_directory() . '/inc/jetpack.php' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
