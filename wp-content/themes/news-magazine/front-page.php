<?php get_header();
      news_magazine_slideshow();  ?>
</div>	
<div id="content" >
	<div class="container">
		
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" >
				<div class="sidebar-container">				
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>					
				</div>
			</div>
			<?php }  ?>
			
			<div id="blog" class="blog" >
				<?php news_magazine_top_posts();
				if( 'posts' == get_option( 'show_on_front' ) )
					news_magazine_content_posts();
				elseif('page' == get_option( 'show_on_front' ))
					news_magazine_content_posts_for_home();	?>
					
				<?php news_magazine_categories_vertical_tabs(); ?>
				  
				<div class="clear"></div>
				<?php wp_reset_query();  ?>
			</div>
			 
			<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div id="sidebar2">
					<div class="sidebar-container">
						<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
					</div>
				</div>
          <?php } ?>
		<div class="clear"></div>

  </div>
</div>
<?php get_footer(); ?>
