<?php get_header(); 
wp_reset_query();
global $news_magazine_general_settings_page,$post;
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) {
	if ( isset($value['var_name']) ) { $$value['var_name'] = $value['std']; }
}
if(isset($blog_style) && $blog_style=="on") 
{ ?>								
   <style>
	 #content.page .blog-post img{
		height: 180px !important;
		width: 240px;
	 }
   </style>
<?php }   
?>

</div>
<div id="content" class="page">
	<div class="container">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" role="complementary">
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-1' );  ?>
				</div>
			</div>
			<?php } ?>


	<div id="blog" class="blog">
            <?php $post = $posts[0];  ?> 
			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Archive for the','news_magazine'); ?>  &#8216;<?php single_cat_title(); ?>&#8217; <?php echo __('Category', 'news_magazine'); ?>:</span></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Posts Tagged','news_magazine'); ?> &#8216;<?php single_tag_title(); ?>&#8217;</span></h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Archive for','news_magazine'); ?> <?php echo get_the_date(); ?></span></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Archive for','news_magazine'); ?> <?php echo get_the_date('F Y'); ?></span></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Archive for','news_magazine'); ?> <?php echo get_the_date('Y'); ?></span></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h2 class="styledHeading page-header"><span><?php if(isset($_GET['author'])) printf( __( 'All posts by %s', 'news_magazine' ), '<span class="vcard">' . get_the_author_meta('user_login', $_GET['author']) . '</span>' ); ?></span></h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h2 class="styledHeading page-header"><span><?php echo __('Blog Archives','news_magazine'); ?></span></h2>
		<?php } ?>
		<?php if (have_posts()) :
		
    		while(have_posts()) : the_post(); ?>	
				<div class="post">
					
					<?php news_magazine_entry_cont(); ?>
					
				</div>				
       <?php endwhile; ?>	
		<div class="navigation">
			<?php news_magazine_nav_link(); ?>
		</div>
	   <?php else : ?>
	   
			<p id="empty_category"><?php _e('There are not posts belonging to this category or tag. Try searching below:', 'news_magazine'); ?></p>
			<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">
				<div class="searchback">
					<input  type="text" value="" name="s" id="s" class="searchbox_search" placeholder="<?php echo __('Type here','news_magazine'); ?>"/> 
					<input type="submit" id="searchsubmit" value="<?php echo __('SEARCH','news_magazine'); ?>"  />
				</div>
			</form>
		
		<?php endif; ?>
		<div class="clear"></div>

   </div>
   <?php			
		 if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2" role="complementary">         
				 <div class="sidebar-container">
					 <?php dynamic_sidebar( 'sidebar-2' );   ?>
				 </div>
			</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
</div>
	
<?php get_footer(); ?>