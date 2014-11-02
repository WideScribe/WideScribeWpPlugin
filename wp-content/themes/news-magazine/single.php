<?php
global $news_magazine_general_settings_page;
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) {
    if (get_theme_mod( $value['var_name'] ) === FALSE)
	{ 
		$$value['var_name'] = $value['std'];
	}
	else
    { 
		$$value['var_name'] = get_theme_mod( $value['id'] );
    }
}

get_header(); 
news_magazine_update_page_layout_meta_settings();
?>

</div>
<div id="content" class="page">
<div class="container">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
	<div id="sidebar1">
		<div class="sidebar-container">
		  <?php dynamic_sidebar( 'sidebar-1' );  ?>
		</div>
	</div>
		<?php }	?>
	
	<div id="blog" class="blog">
		<?php if(have_posts()) { 
    		while(have_posts()) { the_post(); ?>
			<div <?php post_class(); ?>>			
				<h2 class="page-header">
					<span><?php the_title(); ?></span>
				</h2>				
				
				<div class="entry">	
					<?php
					if ( has_post_thumbnail() ) { ?>
					<div class="post-thumbnail-div post-thumbnail">
					      <?php echo the_post_thumbnail(240,182); ?>
						  
					 </div> 
					<?php } 
					the_content(); ?>
				</div>
			</div>
			<?php if($date_enable){
			news_magazine_entry_meta();
			}
			
			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page', 'news_magazine' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); 
			news_magazine_post_nav(); ?>
			
			<div class="clear"></div>
			
			<?php 
			
			global $post;
			$withcomments = true;
			if(comments_open()){	
			wp_reset_query(); ?>
				   <div class="comments-template">
					  <?php echo comments_template(); ?>
				   </div>	
		   <?php  } ?>
	</div>			

<?php }
} 



		if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2">
				<div class="sidebar-container">
				  <?php dynamic_sidebar( 'sidebar-2' );  ?>
				</div>
			</div>     
			<?php } ?>
		
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>