<?php
/**
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 */


if ( ! function_exists( 'newswire_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function newswire_setup() {
		
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'newswire', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'top-nav' => __( 'Top Navigation Menu', 'newswire' ),
		'primary-nav' => __( 'Main Navigation Menu', 'newswire' ),
	) );

	add_theme_support('post-thumbnails'); 
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	
	// custom backgrounds
	$newswire_custom_background = array(
		// Background color default
		'default-color' => 'ffffff',
		// Background image default
		'default-image' => '',
		'wp-head-callback' => '_custom_background_cb'
	);
	add_theme_support('custom-background', $newswire_custom_background );

	
	// adding post format support
	add_theme_support( 'post-formats', 
		array( 
			'aside', /* Typically styled without a title. Similar to a Facebook note update */
			'gallery', /* A gallery of images. Post will likely contain a gallery shortcode and will have image attachments */
			'link', /* A link to another site. Themes may wish to use the first <a href=ÓÓ> tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it */
			'image', /* A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image */
			'quote', /* A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title */
			'status', /*A short status update, similar to a Twitter status update */
			'video', /* A single video. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin) */
			'audio', /* An audio file. Could be used for Podcasting */
			'chat' /* A chat transcript */
		)
	);
}
endif;
add_action( 'after_setup_theme', 'newswire_setup' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'newswire_content_width' ) ) :
	function newswire_content_width() {
		global $content_width;
		if (!isset($content_width))
			$content_width = 635; /* pixels */
	}
endif;
add_action( 'after_setup_theme', 'newswire_content_width' );


/**
 * Title filter 
 */
if ( ! function_exists( 'newswire_filter_wp_title' ) ) :
	function newswire_filter_wp_title( $old_title, $sep, $sep_location ) {
		
		if ( is_feed() ) return $old_title;
	
		$site_name = get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' );
		// add padding to the sep
		$ssep = ' ' . $sep . ' ';
		
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			return $site_name . ' | ' . $site_description;
		} else {
			// find the type of index page this is
			if( is_category() ) $insert = $ssep . __( 'Category', 'newswire' );
			elseif( is_tag() ) $insert = $ssep . __( 'Tag', 'newswire' );
			elseif( is_author() ) $insert = $ssep . __( 'Author', 'newswire' );
			elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __( 'Archives', 'newswire' );
			else $insert = NULL;
			 
			// get the page number we're on (index)
			if( get_query_var( 'paged' ) )
			$num = $ssep . __( 'Page ', 'newswire' ) . get_query_var( 'paged' );
			 
			// get the page number we're on (multipage post)
			elseif( get_query_var( 'page' ) )
			$num = $ssep . __( 'Page ', 'newswire' ) . get_query_var( 'page' );
			 
			// else
			else $num = NULL;
			 
			// concoct and return new title
			return $site_name . $insert . $old_title . $num;
			
		}
	
	}
endif;
// call our custom wp_title filter, with normal (10) priority, and 3 args
add_filter( 'wp_title', 'newswire_filter_wp_title', 10, 3 );


/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'newswire_theme_customizer' ) ) :
	function newswire_theme_customizer( $wp_customize ) {
		
		$wp_customize->remove_section( 'title_tagline');

		
		/* logo option */
		$wp_customize->add_section( 'newswire_logo_section' , array(
			'title'       => __( 'Site Logo', 'newswire' ),
			'priority'    => 31,
			'description' => __( 'Upload a logo to replace the default site name in the header', 'newswire' ),
		) );
		
		$wp_customize->add_setting( 'newswire_logo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'newswire_logo', array(
			'label'    => __( 'Choose your logo (ideal width is 100-300px and ideal height is 40-100px)', 'newswire' ),
			'section'  => 'newswire_logo_section',
			'settings' => 'newswire_logo',
		) ) );
		
		
		/* color scheme option */
		$wp_customize->add_setting( 'newswire_site_title_color_settings', array (
			'default'	=> '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newswire_site_title_color_settings', array(
			'label'    => __( 'Site Title Color', 'newswire' ),
			'section'  => 'colors',
			'settings' => 'newswire_site_title_color_settings',
			'priority'    => 101,
		) ) );
		
		
		$wp_customize->add_setting( 'newswire_color_settings', array (
			'default'	=> '#dd3333',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newswire_color_settings', array(
			'label'    => __( 'Theme Color Scheme', 'newswire' ),
			'section'  => 'colors',
			'settings' => 'newswire_color_settings',
			'priority'    => 102,
		) ) );
		
		
		$wp_customize->add_setting( 'newswire_nav_color_settings', array (
			'default'	=> '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'newswire_nav_color_settings', array(
			'label'    => __( 'Navigation Bar Background Color', 'newswire' ),
			'section'  => 'colors',
			'settings' => 'newswire_nav_color_settings',
			'priority'    => 103,
		) ) );
		
		
		/* social media option */
		$wp_customize->add_section( 'newswire_social_section' , array(
			'title'       => __( 'Social Media Icons', 'newswire' ),
			'priority'    => 33,
			'description' => __( 'Optional social media buttons in the header', 'newswire' ),
		) );
		
		$wp_customize->add_setting( 'newswire_facebook', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_facebook', array(
			'label'    => __( 'Enter your Facebook url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_facebook',
			'priority'    => 101,
		) ) );
	
		$wp_customize->add_setting( 'newswire_twitter', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_twitter', array(
			'label'    => __( 'Enter your Twitter url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_twitter',
			'priority'    => 102,
		) ) );
		
		$wp_customize->add_setting( 'newswire_google', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_google', array(
			'label'    => __( 'Enter your Google+ url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_google',
			'priority'    => 103,
		) ) );
		
		$wp_customize->add_setting( 'newswire_pinterest', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_pinterest', array(
			'label'    => __( 'Enter your Pinterest url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_pinterest',
			'priority'    => 104,
		) ) );
		
		$wp_customize->add_setting( 'newswire_linkedin', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_linkedin', array(
			'label'    => __( 'Enter your Linkedin url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_linkedin',
			'priority'    => 105,
		) ) );
		
		$wp_customize->add_setting( 'newswire_youtube', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_youtube', array(
			'label'    => __( 'Enter your Youtube url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_youtube',
			'priority'    => 106,
		) ) );
		
		$wp_customize->add_setting( 'newswire_tumblr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_tumblr', array(
			'label'    => __( 'Enter your Tumblr url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_tumblr',
			'priority'    => 107,
		) ) );
		
		$wp_customize->add_setting( 'newswire_instagram', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_instagram', array(
			'label'    => __( 'Enter your Instagram url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_instagram',
			'priority'    => 108,
		) ) );
		
		$wp_customize->add_setting( 'newswire_flickr', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_flickr', array(
			'label'    => __( 'Enter your Flickr url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_flickr',
			'priority'    => 109,
		) ) );
		
		$wp_customize->add_setting( 'newswire_vimeo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_vimeo', array(
			'label'    => __( 'Enter your Vimeo url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_vimeo',
			'priority'    => 110,
		) ) );
		
		$wp_customize->add_setting( 'newswire_yelp', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_yelp', array(
			'label'    => __( 'Enter your Yelp url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_yelp',
			'priority'    => 111,
		) ) );
			
		$wp_customize->add_setting( 'newswire_rss', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_rss', array(
			'label'    => __( 'Enter your RSS url', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_rss',
			'priority'    => 113,
		) ) );
		
		$wp_customize->add_setting( 'newswire_email', array (
			'sanitize_callback' => 'sanitize_email',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_email', array(
			'label'    => __( 'Enter your email address', 'newswire' ),
			'section'  => 'newswire_social_section',
			'settings' => 'newswire_email',
			'priority'    => 114,
		) ) );

		
		/* slider options */
		
		$wp_customize->add_section( 'newswire_slider_section' , array(
			'title'       => __( 'Slider Options', 'newswire' ),
			'priority'    => 33,
			'description' => __( 'Adjust the behavior of the image slider.', 'newswire' ),
		) );
		
		$wp_customize->add_setting( 'newswire_slider_effect', array(
			'default' => 'scrollHorz',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 'effect_select_box', array(
			'settings' => 'newswire_slider_effect',
			'label' => __( 'Select Effect:', 'newswire' ),
			'section' => 'newswire_slider_section',
			'type' => 'select',
			'choices' => array(
				'scrollHorz' => 'Horizontal (Default)',
				'scrollVert' => 'Vertical',
				'tileSlide' => 'Tile Slide',
				'tileBlind' => 'Blinds',
				'shuffle' => 'Shuffle',
			),
		));
		
		$wp_customize->add_setting( 'newswire_slider_timeout', array(
			'sanitize_callback' => 'newswire_sanitize_integer',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'newswire_slider_timeout', array(
			'label'    => __( 'Autoplay Speed in Seconds', 'newswire' ),
			'section'  => 'newswire_slider_section',
			'settings' => 'newswire_slider_timeout',
		) ) );
		
		/* google font options */
		
		$wp_customize->add_section( 'newswire_fonts_section' , array(
			'title'       => __( 'Fonts', 'newswire' ),
			'priority'    => 34,
			'description' => __( 'Choose Google fonts for Newswire', 'newswire' ),
		) );
		
		$wp_customize->add_setting( 'newswire_site_title_font', array(
			'default' => 'Varela',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 'title_font_select_box', array(
			'settings' => 'newswire_site_title_font',
			'label' => __( 'Site Title (Logo) Font:', 'newswire' ),
			'section' => 'newswire_fonts_section',
			'type' => 'select',
			'choices' => array(
				'Varela' => 'Varela (Default)',
				'Merriweather' => 'Merriweather',
				'Open Sans' => 'Open Sans',
				'Open Sans Condensed' => 'Open Sans Condensed',
				'Vollkorn' => 'Vollkorn',
			),
		));
		
		$wp_customize->add_setting( 'newswire_nav_font', array(
			'default' => 'Open Sans',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 'nav_font_select_box', array(
			'settings' => 'newswire_nav_font',
			'label' => __( 'Nav, Widget, Link Button, Footer:', 'newswire' ),
			'section' => 'newswire_fonts_section',
			'type' => 'select',
			'choices' => array(
				'Open Sans' => 'Open Sans (Default)',
				'Varela' => 'Varela',
				'Merriweather' => 'Merriweather',
				'Open Sans Condensed' => 'Open Sans Condensed',
				'Vollkorn' => 'Vollkorn',
			),
		));
		
		$wp_customize->add_setting( 'newswire_head_font', array(
			'default' => 'Varela',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 'head_font_select_box', array(
			'settings' => 'newswire_head_font',
			'label' => __( 'Headings, Post/Page Title', 'newswire' ),
			'section' => 'newswire_fonts_section',
			'type' => 'select',
			'choices' => array(
				'Varela' => 'Varela (Default)',
				'Merriweather' => 'Merriweather',
				'Open Sans' => 'Open Sans',
				'Open Sans Condensed' => 'Open Sans Condensed',
				'Vollkorn' => 'Vollkorn',
			),
		));
		
		$wp_customize->add_setting( 'newswire_body_font', array(
			'default' => 'Lucida Sans Unicode',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 'body_font_select_box', array(
			'settings' => 'newswire_body_font',
			'label' => __( 'Body Text', 'newswire' ),
			'section' => 'newswire_fonts_section',
			'type' => 'select',
			'choices' => array(
				'Lucida Sans Unicode' => 'Lucida Sans Unicode (Default)',
				'Arial' => 'Arial',
				'Georgia' => 'Georgia',
				'Trebuchet MS' => 'Trebuchet MS',
				'Verdana' => 'Verdana',
			),
		));

	}
endif;
add_action('customize_register', 'newswire_theme_customizer');

/**
 * Sanitize integer input
 */
if ( ! function_exists( 'newswire_sanitize_integer' ) ) :
	function newswire_sanitize_integer( $input ) {
		return absint($input);
	}
endif;


/**
* Apply Color Scheme
*/
if ( ! function_exists( 'newswire_apply_color' ) ) :
  function newswire_apply_color() {
	if ( get_theme_mod('newswire_color_settings') || get_theme_mod('newswire_site_title_color_settings') || get_theme_mod('newswire_nav_color_settings') ) {
	?>
	<style id="newswire-color-settings">
		<?php if ( get_theme_mod('newswire_color_settings') ) : ?>
        a, a:visited, .entry-title a:hover, .post-content ol li:before, .post-content ul li:before, .colortxt { 
            color: <?php echo get_theme_mod('newswire_color_settings'); ?>;
        }
        
        #search-box-wrap, #social-media a, #search-icon, nav[role=navigation] .menu > ul li a:hover, nav[role=navigation] .menu ul li.current-menu-item a, .nav ul li.current_page_item a, nav[role=navigation] .menu ul li.current_page_item a, .cat-meta-color, .colorbar, .pagination li a:hover, .pagination li.active a, #comment-nav-above a, #comment-nav-below a, #nav-above a:hover, #nav-below a:hover, #image-navigation a:hover, #sidebar .widget-title,  .commentlist .comment-reply-link, .commentlist .comment-reply-login, #respond #submit:hover {
            background-color: <?php echo get_theme_mod('newswire_color_settings'); ?>;
        }
        
		<?php endif; ?>
		
		<?php if ( get_theme_mod('newswire_site_title_color_settings') ) : ?>
		#site-title a {
			color: <?php echo get_theme_mod('newswire_site_title_color_settings'); ?>;
		}
		<?php endif; ?>
		
		<?php if ( get_theme_mod('newswire_nav_color_settings') ) : ?>
		nav[role=navigation] div.menu {
			background-color: <?php echo get_theme_mod('newswire_nav_color_settings'); ?>;
		}
		<?php endif; ?>
    </style>
	<?php
	}
	
	if ( get_theme_mod('newswire_body_font') || get_theme_mod('newswire_site_title_font') || get_theme_mod('newswire_nav_font') || get_theme_mod('newswire_head_font') ) { ?>
	<style id="newswire-font-settings">
		<?php if ( get_theme_mod('newswire_body_font') ) : ?>
		body {
			font-family: "<?php echo get_theme_mod('newswire_body_font');  ?>", sans-serif;
		}
		<?php endif; ?>
	
		<?php if ( get_theme_mod('newswire_site_title_font') ) : ?>
		#site-title {
			font-family: "<?php echo get_theme_mod('newswire_site_title_font');  ?>", sans-serif;
			<?php if ( get_theme_mod('newswire_site_title_font') != 'Varela') : ?>
			font-weight: 700;
			<?php endif; ?>
		}
		<?php endif; ?>
		
		<?php if ( get_theme_mod('newswire_nav_font') ) : ?>
		#top-nav, nav[role=navigation] .menu > ul li a, nav[role=navigation] .menu > #menu-icon, .cat-meta-color, #sidebar .widget-title , footer[role=contentinfo], .commentlist .comment-reply-link, .commentlist .comment-reply-login, .comment-meta, #respond #submit {
			font-family: "<?php echo get_theme_mod('newswire_nav_font');  ?>", sans-serif;
		}
		<?php endif; ?>
		
		<?php if ( get_theme_mod('newswire_head_font') ) : ?>
		.entry-title, .page-header, .heading-latest, #comments-title, .commentlist .vcard, #reply-title, #respond label, .slides .slide-noimg, .slide-title {
			font-family: "<?php echo get_theme_mod('newswire_head_font');  ?>", sans-serif;
			<?php if ( get_theme_mod('newswire_head_font') != 'Varela') : ?>
			font-weight: 700;
			<?php endif; ?>
		}
		<?php endif; ?>
	</style>
	<?php
    }
  }
endif;
add_action( 'wp_head', 'newswire_apply_color' );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
if ( ! function_exists( 'newswire_main_nav' ) ) :
function newswire_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'theme_location' => 'primary-nav', /* where in the theme it's assigned */
    		'container_class' => 'menu', /* container class */
    		'fallback_cb' => 'newswire_main_nav_fallback' /* menu fallback */
    	)
    );
}
endif;

if ( ! function_exists( 'newswire_main_nav_fallback' ) ) :
	function newswire_main_nav_fallback() { wp_page_menu( 'show_home=Home&container_class=menu' ); }
endif;

if ( ! function_exists( 'newswire_enqueue_comment_reply' ) ) :
	function newswire_enqueue_comment_reply() {
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
			}
	 }
endif;
add_action( 'comment_form_before', 'newswire_enqueue_comment_reply' );

if ( ! function_exists( 'newswire_page_menu_args' ) ) :
	function newswire_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
endif;
add_filter( 'wp_page_menu_args', 'newswire_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function newswire_widgets_init() {
	
	register_sidebar( array(
		'name' => __( 'Sidebar Home', 'newswire' ),
		'id' => 'sidebar-home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Main', 'newswire' ),
		'id' => 'sidebar-main',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Posts', 'newswire' ),
		'id' => 'sidebar-posts',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

}
add_action( 'widgets_init', 'newswire_widgets_init' );

if ( ! function_exists( 'newswire_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function newswire_content_nav( $nav_id ) {
	global $wp_query;

	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'newswire' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr; Previous', 'Previous post link', 'newswire' ) . '</span>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( 'Next &rarr;', 'Next post link', 'newswire' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'newswire' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'newswire' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif;


if ( ! function_exists( 'newswire_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function newswire_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'newswire' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'newswire' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<footer class="clearfix comment-head">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 50 ); ?>
					<?php printf( __( '%s', 'newswire' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'newswire' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'newswire' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'newswire' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif;

if ( ! function_exists( 'newswire_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function newswire_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'newswire' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'newswire' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'newswire_body_classes' ) ) :
	function newswire_body_classes( $classes ) {
		// Adds a class of single-author to blogs with only 1 published author
		if ( ! is_multi_author() ) {
			$classes[] = 'single-author';
		}
	
		return $classes;
	}
endif;
add_filter( 'body_class', 'newswire_body_classes' );

/**
 * Returns true if a blog has more than 1 category
 */
if ( ! function_exists( 'newswire_categorized_blog' ) ) :
function newswire_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so newswire_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so newswire_categorized_blog should return false
		return false;
	}
}
endif;
/**
 * Flush out the transients used in newswire_categorized_blog
 */
if ( ! function_exists( 'newswire_category_transient_flusher' ) ) :
	function newswire_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}
endif;
add_action( 'edit_category', 'newswire_category_transient_flusher' );
add_action( 'save_post', 'newswire_category_transient_flusher' );

/**
 * Remove WP default gallery styling
 */
add_filter( 'use_default_gallery_style', '__return_false' );



/**
 * The Pagination Function
 */
if ( ! function_exists( 'newswire_pagination' ) ) :
function newswire_pagination() {
	
		global $wp_query; 
		
		$big = 999999999;
		  
		$total_pages = $wp_query->max_num_pages;  
		  
		if ($total_pages > 1){  
		  
		  $wp_query->query_vars['paged'] > 1 ? $current_page = $wp_query->query_vars['paged'] : $current_page = 1;  
			
		  echo '<div class="pagination">';  
			
		  echo paginate_links(array(  
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 
			  'format' => '/page/%#%',  
			  'current' => $current_page,  
			  'total' => $total_pages,  
			  'prev_text' => __('&lsaquo; Prev', 'newswire'),  
			  'next_text' => __('Next &rsaquo;', 'newswire')  
			));  
		  
		  echo '</div>';  
			
		}
}
endif;


/**
 * Add "Untitled" for posts without title, 
 */
function newswire_post_title($title) {
	if ($title == '') {
		return __('Untitled', 'newswire');
	} else {
		return $title;
	}
}
add_filter('the_title', 'newswire_post_title');


/**
 * Custom excerpt function
 */
if ( ! function_exists( 'newswire_excerpt' ) ) :
	function newswire_excerpt($limit) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}	
		$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		return $excerpt;
	}
endif;

/**
 * Fix for W3C validation
 */
if ( ! function_exists( 'newswire_w3c_valid_rel' ) ) :
	function newswire_w3c_valid_rel( $text ) {
		$text = str_replace('rel="category tag"', 'rel="tag"', $text); return $text; 
	}
endif;
add_filter( 'the_category', 'newswire_w3c_valid_rel' );

/*
 * Modernizr functions
 */
if ( ! function_exists( 'newswire_modernizr_addclass' ) ) :
	function newswire_modernizr_addclass($output) {
		return $output . ' class="no-js"';
	}
endif;
add_filter('language_attributes', 'newswire_modernizr_addclass');

if ( ! function_exists( 'newswire_modernizr_script' ) ) :
	function newswire_modernizr_script() {
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/library/js/modernizr-2.6.2.min.js', false, '2.6.2');
	}  
endif;  
add_action('wp_enqueue_scripts', 'newswire_modernizr_script');

/**
 * Ignore Sticky
 */
 
function newswire_ignore_sticky($query) {
	if ( is_home() && $query->is_main_query() ) {
    	$query->set( 'ignore_sticky_posts', true );
	}
	return $query;
}
add_action('pre_get_posts', 'newswire_ignore_sticky');

/**
 * Enqueue scripts & styles
 */
if ( ! function_exists( 'newswire_custom_scripts' ) ) :
	function newswire_custom_scripts() {
		wp_register_script( 'imagesloaded', get_template_directory_uri() . '/library/js/imagesloaded.pkgd.min.js');
		wp_register_script( 'cycle2', get_template_directory_uri() . '/library/js/jquery.cycle2.min.js' );
		wp_register_script( 'cycle2_tile', get_template_directory_uri() . '/library/js/jquery.cycle2.tile.min.js' );
		wp_register_script( 'cycle2_shuffle', get_template_directory_uri() . '/library/js/jquery.cycle2.shuffle.min.js' );
		wp_register_script( 'cycle2_scrollvert', get_template_directory_uri() . '/library/js/jquery.cycle2.scrollVert.min.js' );
		wp_enqueue_script( 'newswire_custom_js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery', 'imagesloaded', 'cycle2', 'cycle2_tile', 'cycle2_shuffle', 'cycle2_scrollvert', 'jquery-masonry' ), '1.0.0' );
		wp_enqueue_style( 'newswire_style', get_stylesheet_uri() );
	}
endif;
add_action('wp_enqueue_scripts', 'newswire_custom_scripts');

?>