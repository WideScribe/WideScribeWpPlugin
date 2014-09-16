<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Singl
 */

$twitter_link = get_theme_mod( 'singl_twitter_link' );
$facebook_link = get_theme_mod( 'singl_facebook_link' );
$pinterest_link = get_theme_mod( 'singl_pinterest_link' );
$google_plus_link = get_theme_mod( 'singl_google_plus_link' );
$instagram_link = get_theme_mod( 'singl_instagram_link' );
$youtube_link = get_theme_mod( 'singl_youtube_link' );
$vimeo_link = get_theme_mod( 'singl_vimeo_link' );
$vine_link = get_theme_mod( 'singl_vine_link' );
$soundcloud_link = get_theme_mod( 'singl_soundcloud_link' );
$lastfm_link = get_theme_mod( 'singl_lastfm_link' );
$itunes_link = get_theme_mod( 'singl_itunes_link' );
$spotify_link = get_theme_mod( 'singl_spotify_link' );
$social_links = ( '' != $twitter_link
               || '' != $facebook_link
               || '' != $pinterest_link
               || '' != $google_plus_link
               || '' != $instagram_link
               || '' != $youtube_link
               || '' != $vimeo_link
               || '' != $vine_link
               || '' != $soundcloud_link
               || '' != $lastfm_link
               || '' != $itunes_link
               || '' != $spotify_link
) ? true : false;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<div class="page-wrapper">
		<header id="masthead" class="site-header" role="banner">
			<?php if ( has_nav_menu( 'primary' ) || $social_links ) : ?>
				<div id="header-wrapper">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<h1 class="menu-toggle clear"><span class="fa fa-bars"></span><span class="screen-reader-text"><?php _e( 'Menu', 'singl' ); ?></span></h1>
							<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'singl' ); ?></a>

							<?php
								wp_nav_menu( array(
									'theme_location'  => 'primary',
									'container_class' => 'main-menu',
								) );
							?>
						</nav><!-- #site-navigation -->
					<?php  endif; ?>

					<?php if ( $social_links ) : ?>
						<div id="social-links-wrapper">
							<ul class="social-links clear">
								<?php if ( '' != $twitter_link ) : ?>
									<li class="twitter-link">
										<a href="<?php echo esc_url( $twitter_link ); ?>" class="fa fa-twitter" title="<?php esc_attr_e( 'Twitter', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Twitter', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $facebook_link ) : ?>
									<li class="facebook-link">
										<a href="<?php echo esc_url( $facebook_link ); ?>" class="fa fa-facebook" title="<?php esc_attr_e( 'Facebook', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Facebook', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $pinterest_link ) : ?>
									<li class="pinterest-link">
										<a href="<?php echo esc_url( $pinterest_link ); ?>" class="fa fa-pinterest" title="<?php esc_attr_e( 'Pinterest', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Pinterest', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $google_plus_link ) : ?>
									<li class="google-link">
										<a href="<?php echo esc_url( $google_plus_link ); ?>" class="fa fa-google-plus" title="<?php esc_attr_e( 'Google Plus', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Google Plus', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $instagram_link ) : ?>
									<li class="instagram-link">
										<a href="<?php echo esc_url( $instagram_link ); ?>" class="fa fa-instagram" title="<?php esc_attr_e( 'Instagram', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Instagram', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $youtube_link ) : ?>
									<li class="youtube-link">
										<a href="<?php echo esc_url( $youtube_link ); ?>" class="fa fa-youtube-play" title="<?php esc_attr_e( 'YouTube', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'YouTube', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $vimeo_link ) : ?>
									<li class="vimeo-link">
										<a href="<?php echo esc_url( $vimeo_link ); ?>" class="fa fa-vimeo-square" title="<?php esc_attr_e( 'Vimeo', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Vimeo', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>
								
								<?php if ( '' != $vine_link ) : ?>
									<li class="vine-link">
										<a href="<?php echo esc_url( $vine_link ); ?>" class="fa fa-vine" title="<?php esc_attr_e( 'Vine', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Vine', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $soundcloud_link ) : ?>
									<li class="soundcloud-link">
										<a href="<?php echo esc_url( $soundcloud_link ); ?>" class="fa fa-soundcloud" title="<?php esc_attr_e( 'SoundCloud', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'SoundCloud', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $lastfm_link ) : ?>
									<li class="lastfm-link">
										<a href="<?php echo esc_url( $lastfm_link ); ?>" class="fa fa-headphones" title="<?php esc_attr_e( 'Last.fm', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Last.fm', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $spotify_link ) : ?>
									<li class="spotify-link">
										<a href="<?php echo esc_url( $spotify_link ); ?>" class="fa fa-spotify" title="<?php esc_attr_e( 'Spotify', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'Spotify', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>

								<?php if ( '' != $itunes_link ) : ?>
									<li class="itunes-link">
										<a href="<?php echo esc_url( $itunes_link ); ?>" class="fa fa-apple" title="<?php esc_attr_e( 'iTunes', 'singl' ); ?>" target="_blank">
											<span class="screen-reader-text"><?php _e( 'iTunes', 'singl' ); ?></span>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
					<?php endif; ?>
				</div><!-- #header-wrapper -->
			<?php endif; ?>

			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>

			<?php
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
			?>
				<a class="site-image"  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width / 2; ?>" height="<?php echo get_custom_header()->height / 2; ?>" alt="" class="header-image" />
				</a>
			<?php endif; // if ( ! empty( $header_image ) ) ?>
		</header><!-- #masthead -->

		<div id="content" class="site-content">
