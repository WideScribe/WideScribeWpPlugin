<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Singl
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function singl_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'singl_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function singl_body_classes( $classes ) {
	// Adds of class of has-header to blogs that have a primary menu or any social links.
	$twitter_link = get_theme_mod( 'singl_twitter_link' );
	$facebook_link = get_theme_mod( 'singl_facebook_link' );
	$pinterest_link = get_theme_mod( 'singl_pinterest_link' );
	$google_plus_link = get_theme_mod( 'singl_google_plus_link' );
	$instagram_link = get_theme_mod( 'singl_instagram_link' );
	$youtube_link = get_theme_mod( 'singl_youtube_link' );
	$vimeo_link = get_theme_mod( 'singl_vimeo_link' );
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
	               || '' != $soundcloud_link
	               || '' != $lastfm_link
	               || '' != $itunes_link
	               || '' != $spotify_link
	) ? true : false;
	if ( has_nav_menu( 'primary' ) || $social_links ) {
		$classes[] = 'has-header';
	}
	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'has-primary-nav';
	}

	return $classes;
}
add_filter( 'body_class', 'singl_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function singl_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'singl' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'singl_wp_title', 10, 2 );

/**
 * Returns the URL from the post.
 *
 * @uses get_the_link() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string URL
 */
function singl_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Use &hellip; instead of [...] for excerpts.
 */
function singl_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'singl_excerpt_more' );

/**
 * Wrap more link
 */
function singl_more_link( $link ) {
	return '<span class="more-link-wrapper">' . $link . '</span>';
}
add_filter( 'the_content_more_link', 'singl_more_link' );