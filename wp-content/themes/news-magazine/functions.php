<?php

/////////////////////// include admin


require_once('admin/main_admin_controler.php');
require_once('front_end/front_end_functions.php');
require_once('categories-vertical-tabs/index.php');


function news_magazine_setup() {
add_theme_support( 'custom-header', array(
	// Header image default
	'default-image'       => '',
	// Header text display default
	'header-text'         => false,
	'wp-head-callback'    => 'news_magazine_header_style',
	
) );

$news_magazine_defaults = array(
	'default-color'          => 'ffffff',
	'default-image'          => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $news_magazine_defaults );
     if(!get_theme_mod('background_color',false)){
		set_theme_mod('background_color','ffffff')	;
	}

	//Enable post and comments RSS feed links to head

	add_theme_support('automatic-feed-links');

	// Enable post thumbnails


    add_theme_support('post-thumbnails', array('post'));

    set_post_thumbnail_size(140, 130, true);
	
	add_image_size( 'news-magazine-width', 240, 182, true );
	
    load_theme_textdomain('news_magazine', get_template_directory() . '/languages' );
	 
	add_editor_style();
	 
	 global $news_magazine_layout_page;
	 foreach ($news_magazine_layout_page->options_themeoptions as $value) {
		if(isset($value['id'])){
			if (get_theme_mod($value['id']) === FALSE) {
				
				$$value['var_name'] = $value['std'];
			} else {
				
				$$value['var_name'] = get_theme_mod($value['id']);
			}
		}

	}	
     global $content_width;
	 if ( !isset( $content_width  ) ) {
			$content_width  = $content_area;
		}	
	 
}

add_action( 'after_setup_theme', 'news_magazine_setup' );

function news_magazine_header_style(){
	$header_image = get_header_image(); ?>
	
	<style type="text/css">
		
	<?php if ( ! empty( $header_image ) ) { ?>
	.site-title {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
		}
		
	<?php } ?>
	</style>
	
	<?php
}

add_action('wp_head', 'news_magazine_header');


function news_magazine_header(){
	global  $news_magazine_layout_page,		// leayut class variable
		$news_magazine_typography_page,	// typagraphi class variable
		$news_magazine_color_control_page;// color control class variable
	foreach ($news_magazine_color_control_page->options_colorcontrol as $value) {
     $$value['var_name'] = $value['std']; 
	}	
	
	if ( is_singular() && get_theme_mod( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_get_post_tags('type=monthly&format=link');	

	$news_magazine_layout_page->update_layout_editor();
	$news_magazine_typography_page->print_fornt_end_style_typography();
	$news_magazine_color_control_page->update_color_control();

	news_magazine_favicon_img();
	news_magazine_custom_head();
	
	////////
	$menu_slug = 'primary-menu';
	 if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_slug ] ) && $locations[ $menu_slug ]!=0) {
	$menu = wp_get_nav_menu_object( $locations[ $menu_slug ] );

	if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
	<style>
	   #footer_eft{
	      width: 55%;
		  float: left;
		  border-right: 1px solid #D0D0D0;
	   }
	</style>
	<?php
	}
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	?>
	<script type="text/javascript">
	setTimeout(function(){
    <?php
	foreach ( (array) $menu_items as $key => $menu_item ) {
	    $id = $menu_item->ID; ?>
		
       if(jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-item")){
	        jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "<?php echo $menu_color; ?>  url(<?php echo get_template_directory_uri('template_url'); ?>/images/arrow.menu.png) 100% 0% no-repeat !important");
		  }
		  if(jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-parent")){
	        jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/arrow.menu.png) 100% 0% no-repeat");
		  }
		  if(jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-page-parent")){
	        jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/arrow.menu.png) 100% 0% no-repeat");
		  }
		  if(jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub").hasClass("current-menu-ancestor")){
	        jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > ul").css("display", "block");
			jQuery(".phone .top-nav-list .menu-item-<?php echo $id; ?>.has-sub > a").css("background", "url(<?php echo get_template_directory_uri('template_url'); ?>/images/arrow.menu.png)  100% 0% no-repeat");
		  }
		 

	<?php } ?>
	},1500);
	</script>
	
<?php
 
}	
		
}



function news_magazine_entry_meta() {
    echo '<div class="entry-meta">';
    printf( __( '<div class="entry-meta-cat"><span class="sep date"></span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep author"></span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span></div>', 'news_magazine' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'news_magazine' ), get_the_author() ) ),
		get_the_author()
	);
    
    $categories_list = get_the_category_list(', ' );
    echo '<div class="entry-meta-cat">';
	if ( $categories_list && !is_category() ) {
		echo '<span class="categories-links"><span class="sep category"></span> ' . $categories_list . '</span>';
	}
	$tag_list = get_the_tag_list( '', ' , ' );
	
	if ( $tag_list && !is_tag() ) {
		echo '<span class="tags-links"><span class="sep tag"> </span>' . $tag_list . '</span>';
	}
	echo '</div></div>';
}


function news_magazine_posted_on_blog() { ?>
     <div class="post-date"> <?php echo get_the_date(); ?> </div>
<?php

}


function news_magazine_post_nav() {
	global $post;
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next    = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
		<nav class="page-navigation">
			<?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title', 'Previous post link' ); ?>
			<?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>', 'Next post link'  ); ?>
		</nav>
	<?php
}


function news_magazine_widgets_init()
{

    // Area 1, located at the top of the sidebar.

    register_sidebar(array(

            'name' => __('Primary Widget Area', 'news_magazine'),

            'id' => 'sidebar-1',

            'description' => __('The primary widget area', 'news_magazine'),

            'before_widget' => '<div id="%1$s" class="widget-area %2$s">',

            'after_widget' => '</div> ',

            'before_title' => '<h3>',

            'after_title' => '</h3>',

        )
    );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.

    register_sidebar(array(

            'name' => __('Secondary Widget Area', 'news_magazine'),

            'id' => 'sidebar-2',

            'description' => __('The secondary widget area', 'news_magazine'),

            'before_widget' => '<div id="%1$s" class="widget-area %2$s">',

            'after_widget' => '</div>',

            'before_title' => '<h3 class="widget-title">',

            'after_title' => '</h3>',
        )
    );
	
	// Area 3, located below the Primary Widget Area in the sidebar. Empty by default.
	
	 register_sidebar(array(
            'name' => __('Footer Left Widget Area', 'news_magazine'),
			
            'id' => 'sidebar-3',
			
            'description' => __('The footer left widget area', 'news_magazine'),
			
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			
            'after_widget' => '</div> ',
			
            'before_title' => '<h3>',
			
            'after_title' => '</h3>',
        )
    );
	
	 register_sidebar(array(
            'name' => __('Footer Right Widget Area', 'news_magazine'),
			
            'id' => 'sidebar-4',
			
            'description' => __('The footer right widget area', 'news_magazine'),
			
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
			
            'after_widget' => '</div> ',
			
            'before_title' => '<h3>',
			
            'after_title' => '</h3>',
        )
    );
  
}


//Register sidebars by running news_magazine_widgets_init() on the widgets_init hook.

add_action('widgets_init', 'news_magazine_widgets_init');

//Add support for WordPress 3.0's custom menus

add_action('init', 'news_magazine_register_menu');

//Register area for custom menu


function news_magazine_register_menu()
{

    register_nav_menu('primary-menu', __('Primary Menu','news_magazine'));

}

add_filter( 'wp_nav_menu_objects', 'news_magazine_add_menu_parent_class' );

function news_magazine_add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}

	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'haschild';
		}
	}

	return $items;
}

function news_magazine_post_classes( $classes ) {
		$classes[] = 'single-post';
	
	return $classes;
}
add_filter( 'post_class', 'news_magazine_post_classes' );

add_filter('nav_menu_css_class' , 'news_magazine_special_nav_class' , 10 , 2);

function news_magazine_special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}

function news_magazine_add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="menu-item', $output, 1);  
  $output = substr_replace($output, 'class="last menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}

add_filter('wp_nav_menu', 'news_magazine_add_first_and_last');


function news_magazine_add_first_and_last_page_list($output) {
  $output = preg_replace('/class="page_item/', 'class="first page_item', $output, 1);  
  if(strripos($output, 'class="page_item'))
  $output = substr_replace($output, 'class="last page_item', strripos($output, 'class="page_item'), strlen('class="page_item'));
  return $output;
}

add_filter('wp_list_pages', 'news_magazine_add_first_and_last_page_list');


if( !function_exists('news_magazine_the_excerpt_max_charlength')){
	function news_magazine_the_excerpt_max_charlength($charlength,$content=false) {
	if($content)
	{
		$excerpt=$content;
	}
	else
	{
		$excerpt = get_the_excerpt();
	}
		$charlength++;
	
		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut ).'...';
			} else {
				echo $subex.'...';
			}
			
		} else {
			echo $excerpt;
		}
	}
}

function news_magazine_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'news_magazine_excerpt_more' );

function news_magazine_post_thumbnail($width, $height)
{

    $thumb = get_post_custom_values("Image");

    if (!empty($thumb)) {

        $str = '<img src="' . $thumb[0] . '" width="' . $width . '" height="' . $height . '" alt="' . get_the_title() . '" width="' . $width . '" height="' . $height . '" border="0" />';
        return $str;

    }

    return !empty($thumb);
}

function news_magazine_catch_that_image()
{

    global $post, $posts;

    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/', $post->post_content, $matches);
	if(isset($matches [1] [0])){	
    	$first_img = $matches [1] [0];
	}
    if (empty($first_img)) {

        //Defines a default image

        $first_img = get_template_directory_uri('template_url') . "/images/default.jpg";

    }

    return $first_img;
}


function news_magazine_first_image($width, $height,$url_or_img=0)
{
    $thumb = news_magazine_catch_that_image();
    if ($thumb) {

        $str = "<img src=\"";
        $str .= $thumb;

        $str .= '"';
        $str .= 'alt="'.get_the_title().'" width="'.$width.'" height="'.$height.'" border="0" />';
        return $str;
    }
}

function news_magazine_empty_thumb()
{

    $thumb = get_post_custom_values("Image");

    return !empty($thumb);

}

function news_magazine_display_thumbnail($width, $height)
{
    if (has_post_thumbnail()) the_post_thumbnail(array($width, $height));

    elseif (!news_magazine_empty_thumb()) {
        return news_magazine_first_image($width, $height);
    } else {
        return news_magazine_post_thumbnail($width, $height);
    }
}

function news_magazine_thumbnail($width, $height)
{

    if (has_post_thumbnail())

        the_post_thumbnail(array($width, $height));

    elseif (news_magazine_empty_thumb()) {

        return news_magazine_post_thumbnail($width, $height);

    }
}



function news_magazine_remove_more_jump_link($link)
{

    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"', $offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end - $offset);
    }

    return $link;

}

add_filter('the_content_more_link', 'news_magazine_remove_more_jump_link');

function news_magazine_p2h_comment($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment;
	
	switch ($comment->comment_type){
		case '' :
		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-avatar"><?php echo get_avatar($comment, $size = '54'); ?></div>
		<div class="comment-body">
			<p class="comment-meta"><span
					class="comment-author"><?php comment_author_link(); ?></span><?php _e(' on ', 'news_magazine'); ?><?php comment_date() ?><?php _e(' at ', 'news_magazine'); ?><?php comment_time() ?>
				.</p>
			<?php if ($comment->comment_approved == '0') { ?>
				<p><strong><?php _e('Your comment is awaiting moderation.', 'news_magazine'); ?></strong></p>
			<?php } ?>
		
			<?php comment_text(); ?>
		
			<p class="comment-reply-meta"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>
		</div>
		<?php
		break;
		
		case 'pingback'  :
		case 'trackback' :
		?>
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" class="post pingback">
		<p><?php _e('Pingback:', 'news_magazine'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'news_magazine'), ' '); ?></p>
		<?php
		break;
		
	}
}


function news_magazine_update_page_layout_meta_settings()
{
	
	global $news_magazine_layout_page, $post;
	foreach ($news_magazine_layout_page->options_themeoptions as $value) {
		if(isset($value['id'])){
			if (get_theme_mod($value['id']) === FALSE) {
				
				$$value['var_name'] = $value['std'];
			} else {
				
				$$value['var_name'] = get_theme_mod($value['id']);
			}
		}

	}

    /*update page layout*/
  
	
	if(isset($post))
    $web_business_meta = get_post_meta($post->ID, 'news_magazine_meta_date', TRUE);
		
		if(!isset($web_business_meta['content_width']))
		$web_business_meta['content_width'] = $content_area;
		if(!isset($web_business_meta['main_col_width']))
		$web_business_meta['main_col_width'] = $main_column;
		if(!isset($web_business_meta['layout']))
		$web_business_meta['layout'] = $default_layout;
		if(!isset($web_business_meta['pr_widget_area_width']))
		$web_business_meta['pr_widget_area_width'] = $pwa_width;

	if (isset($web_business_meta['fullwidthpage']) && $web_business_meta['fullwidthpage']=='on') {		
		$them_content_are_width='99%';
		?><script>var full_width_web_buisnes=1</script>
		  <style  type="text/css">
				     #footer-bottom{
						padding: 15px !important;
					}
		  </style><?php		
	}
	else {
			
		if(isset($web_business_meta['content_width']))
			$them_content_are_width=$web_business_meta['content_width'] . "px;";
		else
			$them_content_are_width=$content_area;
			
		?><script> var full_width_web_buisnes=0</script><?php
	}
  
    switch ($web_business_meta['layout']) {
        //set styles leauts
        case 1:		
			?>
            <style type="text/css">
			#sidebar1,
			#sidebar2 {
				display:none;
			}
			#blog	{
				display:block; 
				float:left;
			};
       
            .container{
            width:<?php echo $them_content_are_width; ?>
            }        
            #blog{
            width:100%;
            }               
            </style>
			<?php
            break;
        case 2:
			?>
            <style type="text/css">
			#sidebar2{
				display:none;
			} 
			#sidebar1 {
				display:block;
				float:right;
			}
			#blog{
				display:block;
				float:left;
			} 
            .container{
				width:<?php echo $them_content_are_width; ?>
            }
            #blog{
				width:<?php echo $web_business_meta['main_col_width']-1; ?>%;
            }
            #sidebar1{
				width:<?php echo (100  - $web_business_meta['main_col_width']-1); ?>%;
            }
            </style>
			<?php
            break;
        case 3:
			?>
            <style type="text/css">
			#sidebar2{
				display:none;
			} 
			#sidebar1 {
				display:block;
				float:left;
			} 
			#blog{
				display:block;
				float:left;
			}
            .container{
				width:<?php echo $them_content_are_width; ?>
            }
            #blog{
				width:<?php echo $web_business_meta['main_col_width']; ?>%;
            }
            #sidebar1{
				width:<?php echo (100  - $web_business_meta['main_col_width']-1); ?>%;
				margin-right: 1%;
            }
            </style>
			<?php
            break;
        case 4:
		?>
            <style type="text/css">
			#sidebar2{
				display:block;
				float:right;
			} 
			#sidebar1 {
				display:block; float:right;
			} 
			#blog{
				display:block;
				float:left;
			}
            .container{
				width:<?php echo $them_content_are_width; ?>
            }
            #blog{
				width:<?php echo ($web_business_meta['main_col_width']-2) ; ?>%;
            }
            #sidebar1{
				width:<?php echo $web_business_meta['pr_widget_area_width']; ?>%;
            }
            #sidebar2{
				width:<?php echo (100  - $web_business_meta['pr_widget_area_width'] - $web_business_meta['main_col_width']); ?>%;
				margin-right: 1%;
            }
            </style>
			 <?php
            break;
        case 5:
		?>
            <style type="text/css">
			#sidebar2{
				display:block;
				float:left;
			} 
			#sidebar1 {
				display:block;
				float:left;
			} 
			#blog{
				display:block;
				float:right;
			}
            .container{
				width:<?php echo $them_content_are_width; ?>
            }
            #blog{
				width:<?php echo ($web_business_meta['main_col_width']-2); ?>%;
            }
            #sidebar1{
				width:<?php echo $web_business_meta['pr_widget_area_width']; ?>%;
				margin-right: 1%;
            }
            #sidebar2{
				width:<?php echo (100  - $web_business_meta['pr_widget_area_width'] - $web_business_meta['main_col_width']); ?>%;
				margin-right: 1%;
            }
            </style>
			<?php
            break;
        case 6:
		?>
            <style type="text/css">
			#sidebar2{
				display:block;
				float:right;
			} 
			#sidebar1 {
				display:block;
				float:left; 
			} 
			#blog{
				display:block;
				float:left;
			}    			       
            .container{
				width:<?php echo $them_content_are_width; ?>
            }
            #blog{
				width:<?php echo ($web_business_meta['main_col_width']-2); ?>%;
            }
            #sidebar1{
				width:<?php echo $web_business_meta['pr_widget_area_width']; ?>%;
				margin-right: 1%;
            }
            #sidebar2{
				width:<?php echo (100  - $web_business_meta['pr_widget_area_width'] - $web_business_meta['main_col_width']); ?>%;
            }            
            </style><?php
            break;
    }
    /*update page layout end*/
}

/*customize*/


function news_magazine_wp_title( $title, $sep ) {
	global $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";


	return $title;
}
add_filter( 'wp_title', 'news_magazine_wp_title', 10, 2 );





/// include requerid scripts and styles


add_filter('wp_head','news_magazine_include_requerid_scripts_for_theme',1);

function news_magazine_include_requerid_scripts_for_theme(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-effects-transfer');
	wp_enqueue_script('conect_js',get_template_directory_uri().'/scripts/conect_js.js');	
	wp_enqueue_style('nivo_slider',get_template_directory_uri().'/slideshow/style.css');
	wp_enqueue_script('custom_js',get_template_directory_uri().'/scripts/javascript.js');
	wp_enqueue_script('response', get_template_directory_uri().'/scripts/responsive.js');
	wp_enqueue_style( 'webdr-style', get_stylesheet_uri(), array(), '2013-11-18' );

	if ( is_singular() && get_theme_mod( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );
}



add_action( 'pre_get_posts', 'news_magazine_main_queries' );

function news_magazine_main_queries($query){
	if(is_home() && is_front_page() && $query->is_main_query()){
		
		global $news_magazine_home_page;
		foreach ($news_magazine_home_page->options_homepage as $value) 
		{
			if(isset($value['id']))
			{
				if (get_theme_mod( $value['id'] ) === FALSE)
				{
					 $$value['var_name'] = $value['std']; 
				} 
				else { 		
					$$value['var_name'] = get_theme_mod( $value['id'] );
				}	
			}
		}
        $cat_query="";
		$cat_checked="";
        $n_of_home_post=get_option( 'posts_per_page', 6 );       
		$cat_query=substr($content_post_categories, 0, -1);
		$query->set( 'posts_per_page', $n_of_home_post );
		$query->set( 'paged',get_query_var('paged') );
		$query->set( 'cat', $cat_query );
		$query->set( 'order', 'DESC' );
	}
}


function news_magazine_ligthest_brigths($color,$pracent){

	$new_color=$color;
	if(!(strlen($new_color==6) || strlen($new_color)==7))
	{
		return $color;
	}
	$color_vandakanishov=strpos($new_color,'#');
	if($color_vandakanishov == false) {
		$new_color= str_replace('#','',$new_color);
	}
	$color_part_1=substr($new_color, 0, 2);
	$color_part_2=substr($new_color, 2, 2);
	$color_part_3=substr($new_color, 4, 2);
	$color_part_1=dechex( (int) (hexdec( $color_part_1 ) + (( 255-( hexdec( $color_part_1 ) ) ) * $pracent / 100 )));
	$color_part_2=dechex( (int) (hexdec( $color_part_2)  + (( 255-( hexdec( $color_part_2 ) ) ) * $pracent / 100 )));
	$color_part_3=dechex( (int) (hexdec( $color_part_3 ) + (( 255-( hexdec( $color_part_3 ) ) ) * $pracent / 100 )));
	$new_color=$color_part_1.$color_part_2.$color_part_3;
	if($color_vandakanishov == false){
		return $new_color;
	}
	else{
		return '#'.$new_color;
	}

}
function news_magazine_remove_last_comma($string=''){
	
	if(substr($string,-1)==',')
		return substr($string, 0, -1);
	else
		return $string;
	
}

add_filter('body_class', 'news_magazine_multisite_body_classes');
function news_magazine_multisite_body_classes($classes){
	foreach($classes as $key=>$class)
	{
		if($class=='blog')
		$classes[$key]='blog_body';
	}
	return $classes;
	
}

function news_magazine_custom_head(){
	
global $news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value ) {
	if(isset($value['id'])){
		if ( get_theme_mod( $value['id'] ) === FALSE ) {
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}
} ?>
<script>
	var skzbi_hasce="<?php echo get_template_directory_uri(); ?>";
	$ = jQuery;
</script>
<?php
echo "<style>".stripslashes($custom_css)."</style>";
	
	
}
		
function news_magazine_do_nothing($parametr=null){
	return $parametr;
}
?>
