<?php global $data; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="author" content="Alex Itsios" />
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200,300,700' rel='stylesheet' type='text/css'>
	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'hephaestus' ), max( $paged, $page ) );

	?></title>
	<link rel="shortcut icon" href="<?php echo ($data['favicon']) ? $data['favicon'] : get_template_directory_uri().'/images/favicon.ico'; ?>" />
	<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css" type="text/css" media="screen, projection"/><![endif]-->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
	<?php echo ($data['analytics']) ? $data['analytics'] : null; ?> 
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
	<div class="prepend-top prepend-1 span-5 append-1 append-bottom">
		<a href="<?php echo home_url(); ?>" rel="nofollow" id="thelogolink">
        <?php echo get_bloginfo('name'); ?>
        </a>
	</div>
	<div class="prepend-top span-14 top last append-bottom top">
		<div class="span-11 top first">
		<ul class="sf-menu mainnav">
			 <?php wp_nav_menu(array(
           'theme_location'  => 'primary',
           'container'       => '',
           'items_wrap'      => '%3$s',
           'link_before'     => '',
           'link_after'     => '',
           'depth'           => 0
         ) ); ?>	
		</ul>
		</div>
		<div class="span-2 append-1 last top" id="socialicons">
			<a href="<?php echo ($data['twitteruri']) ? $data['twitteruri'] : '#'; ?>" rel="nofollow" target="_blank"><?php echo '<img src="'.get_template_directory_uri().'/images/twitter.png" alt="twitter" />'?></a>
			<a href="<?php echo ($data['facebookuri']) ? $data['facebookuri'] : '#'; ?>" rel="nofollow" target="_blank"><?php echo '<img src="'.get_template_directory_uri().'/images/facebook.png" alt="facebook" />'?></a>
			<a href="<?php echo ($data['rssuri']) ? $data['rssuri'] : '#'; ?>" rel="nofollow"><?php echo '<img src="'.get_template_directory_uri().'/images/rss.png" alt="rss" />'?></a>
		</div>
	</div>
	<div class="clear"></div>