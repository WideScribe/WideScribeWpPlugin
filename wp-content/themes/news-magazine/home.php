<?php get_header(); ?>
</div>	

<div id="content" >
		<div class="container">		
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" style="margin-top:10px !important;">
				<div class="sidebar-container">				
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>					
				</div>
			</div>
			<?php } ?>
			
			<div id="blog" class="blog" >
			
		    <?php news_magazine_content_posts_for_home(); ?>
			
			</div>
			
			<?php wp_reset_query();  ?>
			
            <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div id="sidebar2"  style="margin-top:10px !important;">
					<div class="sidebar-container">
						<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
					</div>
				</div>
          <?php } ?>
		<div class="clear"></div>
  </div>
</div>
<?php get_footer(); ?>