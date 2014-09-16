<?php
/**
 * Setup the WordPress core custom header feature.
 *
 * @uses singl_header_style()
 * @uses singl_admin_header_style()
 * @uses singl_admin_header_image()
 *
 * @package Singl
 */
function singl_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'singl_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1440,
		'height'                 => 810,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'singl_header_style',
		'admin-head-callback'    => 'singl_admin_header_style',
		'admin-preview-callback' => 'singl_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'singl_custom_header_setup' );

if ( ! function_exists( 'singl_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see singl_custom_header_setup().
 */
function singl_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-branding,
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
		.site-branding {
			padding: 0;
			margin: 0;
			border: none;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
		.site-branding {
			border-top-color: #<?php echo $header_text_color; ?>;
			border-bottom-color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // singl_header_style

if ( ! function_exists( 'singl_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see singl_custom_header_setup().
 */
function singl_admin_header_style() {
?>
	<style type="text/css">
		#headimg h1,
		#desc {
			max-width: 720px;
		}
		#headimg h1 {
			margin: 0;
			font-family: Roboto, sans-serif;
			font-size: 36px;
			line-height: 1.2;
			text-transform: uppercase;
			font-weight: 900;
		}
		#headimg h1 a {
			color: inherit;
			text-decoration: none;
		}
		#desc {
		}
		#headimg img {
			display: block;
			margin: 0 auto 40px auto;
			max-width: 50%;
		}
		#headimg {
			padding: 40px 0 0;
			max-width: 720px;
			background: #777;
			text-align: center;
		}
		.site-branding {
			display: inline-block;
			padding: 20px 40px;
			margin: 0 auto 40px auto;
			max-width: 720px;
			border-top: 3px solid #fff;
			border-bottom: 3px solid #fff;
			color: #fff;
			text-align: center;
			-webkit-box-sizing: border-box;
			-moz-box-sizing:    border-box;
			box-sizing:         border-box;
		}
	</style>
<?php
}
endif; // singl_admin_header_style

if ( ! function_exists( 'singl_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see singl_custom_header_setup().
 */
function singl_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
	$border = sprintf( ' style="border-top-color:#%1s;border-bottom-color:#%2s"', get_header_textcolor(), get_header_textcolor() );
?>
	<div id="headimg">
		<div class="site-branding displaying-header-text"<?php echo $border; ?>>
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		</div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // singl_admin_header_image
