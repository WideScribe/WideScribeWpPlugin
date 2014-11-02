<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta name="viewport" content="initial-scale=1.0" />
	<meta name="HandheldFriendly" content="true"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<?php $header_image = get_header_image(); ?>
 
<div id="wrapper">
	<header>
	     <?php if(! empty($header_image)){  ?>
		      <div class="container">
				<a class="custom-header-a" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo header_image(); ?>" class="custom-header">	
				</a>
			  </div>	
		 <?php } ?>				
			<div id="header">
			   <div id="header-middle-block">
					<div class="container">
					     <?php news_magazine_logo_img(); ?>
					</div>
               </div>
				<div class="phone-menu-block">
					<nav id="top-nav">
					   <div class="container">
					    <?php wp_nav_menu(	array(
										'theme_location'  => 'primary-menu',
										'container'       => false,
										'container_class' => '',
										'container_id'    => '',
										'menu_class'      => 'top-nav-list',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul id="top-nav-list" class=" %2$s">%3$s</ul>',
										'depth'           => 0,
										'walker'          => ''
									)); ?>
					   </div> 
				  </nav>
			 </div>
		  </div> 
  </header>			