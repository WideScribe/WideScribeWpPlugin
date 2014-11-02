<?php
      // --------------------------------------------------------------------------

// Start Add NextPage Button

// --------------------------------------------------------------------------

add_filter('mce_buttons','wysiwyg_editor');

function wysiwyg_editor($mce_buttons) {

$pos = array_search('wp_more',$mce_buttons,true);

if ($pos !== false) {

$tmp_buttons = array_slice($mce_buttons, 0, $pos+1);

      $tmp_buttons[] = 'wp_page';

      $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));

  }

return $mce_buttons;

}

// --------------------------------------------------------------------------

// End Add NextPage Button

// --------------------------------------------------------------------------
	//Load Scripts
	function supremo_load_scripts() {
    $url = get_template_directory_uri().'/';
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('superfish', $url.'js/superfish.js','','',true);
	wp_enqueue_script('cycle', $url.'js/cycle.js','','',true);
	wp_enqueue_script('default', $url.'js/default.js','','',true);
	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	}
	add_action('wp_enqueue_scripts', 'supremo_load_scripts');

	
	
	//Load styles
	function supremo_load_styles()
	{ 
		$src = get_template_directory_uri();
	
		if(!is_admin())
		{
			wp_register_style( 'screen', $src . '/css/screen.css','','','screen' );
			wp_enqueue_style( 'screen');
	
			wp_register_style( 'print', $src . '/css/print.css','','','print' );
			wp_enqueue_style( 'print');
	
			wp_register_style( 'default', $src . '/css/default.css','','','screen' );
			wp_enqueue_style( 'default');
			
			wp_register_style( 'superfish', $src . '/css/superfish.css','','','screen' );
			wp_enqueue_style( 'superfish');
			
			wp_register_style( 'style', $src . '/style.css','','','all' );
			wp_enqueue_style( 'style');
	
		}
	}	
	add_action('wp_enqueue_scripts', 'supremo_load_styles');
	
	function supremo_add_editor_styles() {
		add_editor_style( 'hephaestus-editor-style.css' );
	}
	add_action( 'init', 'supremo_add_editor_styles' );
	
	// Load Theme Textdomain
	function supremo_theme_setup(){
		load_theme_textdomain('hephaestus', get_template_directory() . '/languages');
	}
	add_action('after_setup_theme', 'supremo_theme_setup');
	
	
	// Load Background
	$hephaestus_background_args = array(
	'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $hephaestus_background_args );
	
	//Load Custom Header
	add_theme_support( 'custom-header' );
	
	$hephaestus_header_defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 890,
	'height'                 => 270,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $hephaestus_header_defaults );
	
	// Set $content_width
	if ( ! isset( $content_width ) )
	$content_width = 575;
	
	// Add RSS links to <head> section
	add_theme_support( 'automatic-feed-links' );
	
	// Theme's Custom Menus
	register_nav_menu( 'primary', 'Main Menu' );
	register_nav_menu( 'secondary', 'Footer Menu' );
	
	// Thumbnail Sizes
	add_theme_support( "post-thumbnails" );
	add_image_size( 'thumb-one', '260', '160', true );
	add_image_size( 'thumb-two', '125', '125', true );
	
	//Widgets
	function supremo_widgets_init() {
	
	register_sidebar(array(
		'name' => __('Sidebar', 'hephaestus' ),
		'id'   => 'sidebar',
		'description' => __('This is the widgetized sidebar.', 'hephaestus' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Footer Left', 'hephaestus' ),
		'id'   => 'footer-left',
		'description' => __('This is the Left Area of the Footer.', 'hephaestus' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Footer Center', 'hephaestus' ),
		'id'   => 'footer-center',
		'description' => __('This is the Center Area of the Footer.', 'hephaestus' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Footer Right', 'hephaestus' ),
		'id'   => 'footer-right',
		'description' => __('This is the Right Area of the Footer.', 'hephaestus' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	}
	add_action( 'widgets_init', 'supremo_widgets_init' );
	
	//Shorten Home Titles
	function the_title_shorten($len,$rep='...') {
	$title = the_title('','',false);
	$shortened_title = mb_substr($title, 0, $len,'UTF-8');
	echo $shortened_title.$rep;
	}
	
	/* Navigation
	   Function that Rounds To The Nearest Value.
	   Needed for the pagenavi() function */
	function round_num($num, $to_nearest) {
	   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
	   return floor($num/$to_nearest)*$to_nearest;
	}
	 
	/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
	   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
	function pagenavi($before = '', $after = '') {
		global $wpdb, $wp_query;
		$pagenavi_options = array();
		$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
		$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
		$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
		$pagenavi_options['first_text'] = ('First Page');
		$pagenavi_options['last_text'] = ('Last Page');
		$pagenavi_options['next_text'] = 'Next &raquo;';
		$pagenavi_options['prev_text'] = '&laquo; Previous';
		$pagenavi_options['dotright_text'] = '...';
		$pagenavi_options['dotleft_text'] = '...';
		$pagenavi_options['num_pages'] = 5; //continuous block of page numbers
		$pagenavi_options['always_show'] = 0;
		$pagenavi_options['num_larger_page_numbers'] = 0;
		$pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
		//If NOT a single Post is being displayed
		/*http://codex.wordpress.org/Function_Reference/is_single)*/
		if (!is_single()) {
			$request = $wp_query->request;
			//intval � Get the integer value of a variable
			/*http://php.net/manual/en/function.intval.php*/
			$posts_per_page = intval(get_query_var('posts_per_page'));
			//Retrieve variable in the WP_Query class.
			/*http://codex.wordpress.org/Function_Reference/get_query_var*/
			$paged = intval(get_query_var('paged'));
			$numposts = $wp_query->found_posts;
			$max_page = $wp_query->max_num_pages;
	 
			//empty � Determine whether a variable is empty
			/*http://php.net/manual/en/function.empty.php*/
			if(empty($paged) || $paged == 0) {
				$paged = 1;
			}
	 
			$pages_to_show = intval($pagenavi_options['num_pages']);
			$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
			$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
			$pages_to_show_minus_1 = $pages_to_show - 1;
			$half_page_start = floor($pages_to_show_minus_1/2);
			//ceil � Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
			$half_page_end = ceil($pages_to_show_minus_1/2);
			$start_page = $paged - $half_page_start;
	 
			if($start_page <= 0) {
				$start_page = 1;
			}
	 
			$end_page = $paged + $half_page_end;
			if(($end_page - $start_page) != $pages_to_show_minus_1) {
				$end_page = $start_page + $pages_to_show_minus_1;
			}
			if($end_page > $max_page) {
				$start_page = $max_page - $pages_to_show_minus_1;
				$end_page = $max_page;
			}
			if($start_page <= 0) {
				$start_page = 1;
			}
	 
			$larger_per_page = $larger_page_to_show*$larger_page_multiple;
			//round_num() custom function - Rounds To The Nearest Value.
			$larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
			$larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
			$larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
			$larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
			if($larger_start_page_end - $larger_page_multiple == $start_page) {
				$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
				$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
			}
			if($larger_start_page_start <= 0) {
				$larger_start_page_start = $larger_page_multiple;
			}
			if($larger_start_page_end > $max_page) {
				$larger_start_page_end = $max_page;
			}
			if($larger_end_page_end > $max_page) {
				$larger_end_page_end = $max_page;
			}
			if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
				/*http://php.net/manual/en/function.str-replace.php */
				/*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
				$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
				$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
				echo $before.'<div class="pagenavi">'."\n";
	 
				if(!empty($pages_text)) {
					echo '<span class="pages">'.$pages_text.'</span>';
				}
				//Displays a link to the previous post which exists in chronological order from the current post.
				/*http://codex.wordpress.org/Function_Reference/previous_post_link*/
				previous_posts_link($pagenavi_options['prev_text']);
	 
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					//esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
					/*http://codex.wordpress.org/Data_Validation*/
					//get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
					echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
					if(!empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
					}
				}
	 
				if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
					for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
					}
				}
	 
				for($i = $start_page; $i  <= $end_page; $i++) {
					if($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">'.$current_page_text.'</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
					}
				}
	 
				if ($end_page < $max_page) {
					if(!empty($pagenavi_options['dotright_text'])) {
						echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
	 
				if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
					for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
					}
				}
				echo '</div>'.$after."\n";
			}
		}
	}

	class WP_Widget_Recent_Comments_Supremo_Hosting extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'widget_recent_comments', 'description' => __( 'The most recent comments', 'hephaestus' ) );
			parent::__construct('recent-comments', __('Recent Comments', 'hephaestus'), $widget_ops);
			$this->alt_option_name = 'widget_recent_comments';

			if ( is_active_widget(false, false, $this->id_base) )
				add_action( 'wp_head', array(&$this, 'recent_comments_style') );

			add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
			add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
		}

		function recent_comments_style() {
			if ( ! current_theme_supports( 'widgets' ) 
				|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
				return;
			?>
		<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
	<?php
		}

		function flush_widget_cache() {
			wp_cache_delete('widget_recent_comments', 'widget');
		}

		function widget( $args, $instance ) {
			global $comments, $comment;

			$cache = wp_cache_get('widget_recent_comments', 'widget');

			if ( ! is_array( $cache ) )
				$cache = array();

			if ( isset( $cache[$args['widget_id']] ) ) {
				echo $cache[$args['widget_id']];
				return;
			}

			extract($args, EXTR_SKIP);
			$output = '';
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments', 'hephaestus') : $instance['title']);

			if ( ! $number = absint( $instance['number'] ) )
				$number = 5;

			$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );
			$output .= $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;

			$output .= '<ul id="recentcomments">';
			if ( $comments ) {
				foreach ( (array) $comments as $comment) {
					$comments = get_comments('status=approve');
					$output .= '<li class="recentcomments">';
					$output .= get_avatar( $comment, '46' );
					$output .= '<a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="on '.$comment->post_title.'">'.strip_tags($comment->comment_author).' '.wp_html_excerpt( $comment->comment_content, 35 ).'</a>'.'<span>Posted on '.$comment->comment_date.'</span></li>';
				}
			}
			$output .= '</ul>';
			$output .= $after_widget;

			echo $output;
			$cache[$args['widget_id']] = $output;
			wp_cache_set('widget_recent_comments', $cache, 'widget');
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = absint( $new_instance['number'] );
			$this->flush_widget_cache();

			$alloptions = wp_cache_get( 'alloptions', 'options' );
			if ( isset($alloptions['widget_recent_comments']) )
				delete_option('widget_recent_comments');

			return $instance;
		}

		function form( $instance ) {
				$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
				$number = isset($instance['number']) ? absint($instance['number']) : 5;
				?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'hephaestus'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show:', 'hephaestus'); ?></label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
				<?php
			}
		}
		add_action( 'widgets_init', create_function('', 'return register_widget("WP_Widget_Recent_Comments_Supremo_Hosting");') );


	/* Install Supremo Framework */
	require_once ('SupremoPanel/admin/index.php');
	
	/* hephaestus_comment */
	if ( ! function_exists( 'hephaestus_comment' ) ) :
	function hephaestus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'hephaestus' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'hephaestus' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'hephaestus' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'hephaestus' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'hephaestus' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'hephaestus' ); ?></em>
					<br />
				<?php endif; ?>

			</div>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'hephaestus' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->

	<?php
			break;
	endswitch;
	}
	endif; // ends check for hephaestus_comment()
  
	?>