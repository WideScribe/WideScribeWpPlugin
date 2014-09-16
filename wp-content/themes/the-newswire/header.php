<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title('|', true, 'left'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

    <div id="search-box-wrap">
        <div id="search-box">
           <div id="close-x"><?php _e( 'x', 'newswire' ); ?></div>
           <?php get_search_form(); ?>
        </div>
    </div>
    
    <div id="container">
        
    
        <header id="branding" role="banner">
        
          <div id="top-head" >
          
            <div id="top-nav" class="clearfix">
                <div class="cur-date"><?php  echo date(get_option('date_format')); ?></div>
                <?php wp_nav_menu( array( 'theme_location' => 'top-nav', 'container_class' => 'menu-top', 'fallback_cb' => false ) ); ?>
            </div>
          
            <div id="social-media">
            
                <?php if ( get_theme_mod( 'newswire_facebook' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_facebook' ) ); ?>" class="social-fb" title="<?php echo esc_url( get_theme_mod( 'newswire_facebook' ) ); ?>"><?php _e('Facebook', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_twitter' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_twitter' ) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( 'newswire_twitter' ) ); ?>"><?php _e('Twitter', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_google' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_google' ) ); ?>" class="social-gp" title="<?php echo esc_url( get_theme_mod( 'newswire_google' ) ); ?>"><?php _e('Google+', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_pinterest' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_pinterest' ) ); ?>" class="social-pi" title="<?php echo esc_url( get_theme_mod( 'newswire_pinterest' ) ); ?>"><?php _e('Pinterest', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_linkedin' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_linkedin' ) ); ?>" class="social-li" title="<?php echo esc_url( get_theme_mod( 'newswire_linkedin' ) ); ?>"><?php _e('Linkedin', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_youtube' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_youtube' ) ); ?>" class="social-yt" title="<?php echo esc_url( get_theme_mod( 'newswire_youtube' ) ); ?>"><?php _e('Youtube', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_tumblr' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_tumblr' ) ); ?>" class="social-tu" title="<?php echo esc_url( get_theme_mod( 'newswire_tumblr' ) ); ?>"><?php _e('Tumblr', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_instagram' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_instagram' ) ); ?>" class="social-in" title="<?php echo esc_url( get_theme_mod( 'newswire_instagram' ) ); ?>"><?php _e('Instagram', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_flickr' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_flickr' ) ); ?>" class="social-fl" title="<?php echo esc_url( get_theme_mod( 'newswire_flickr' ) ); ?>"><?php _e('Instagram', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_vimeo' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_vimeo' ) ); ?>" class="social-vi" title="<?php echo esc_url( get_theme_mod( 'newswire_vimeo' ) ); ?>"><?php _e('Vimeo', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_yelp' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_yelp' ) ); ?>" class="social-ye" title="<?php echo esc_url( get_theme_mod( 'newswire_yelp' ) ); ?>"><?php _e('Yelp', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_rss' ) ) : ?>
                <a href="<?php echo esc_url( get_theme_mod( 'newswire_rss' ) ); ?>" class="social-rs" title="<?php echo esc_url( get_theme_mod( 'newswire_rss' ) ); ?>"><?php _e('RSS', 'newswire') ?></a>
                <?php endif; ?>
                
                <?php if ( get_theme_mod( 'newswire_email' ) ) : ?>
                <a href="<?php _e('mailto:', 'newswire'); echo sanitize_email( get_theme_mod( 'newswire_email' ) ); ?>" class="social-em" title="<?php _e('mailto:', 'newswire'); echo sanitize_email( get_theme_mod( 'newswire_email' ) ); ?>"><?php _e('E-mail', 'newswire') ?></a>
                <?php endif; ?>
                
                <div id="search-icon"></div>
    
            </div>
            
          </div>
        
          <div id="inner-header" class="clearfix">
          
            <div id="site-heading">
                <?php if ( get_theme_mod( 'newswire_logo' ) ) : ?>
                <div id="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'newswire_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></div>
                <?php else : ?>
                <div id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
                <?php endif; ?>
            </div>
            
            
          <div id="newswire-banner">
          	<?php get_template_part('banner-header'); ?>
          </div>
    
            <div class="clearfix"></div>
          </div>
          
            <nav id="access" role="navigation">
                <h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'newswire' ); ?></h1>
                <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'newswire' ); ?>"><?php _e( 'Skip to content', 'newswire' ); ?></a></div>
    
                <?php newswire_main_nav(); // Adjust using Menus in Wordpress Admin ?>
    
            </nav><!-- #access -->
    
        </header><!-- #branding -->
