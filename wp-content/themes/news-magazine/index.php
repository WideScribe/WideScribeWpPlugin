<?php get_header(); ?>
</div>	
<div id="content" >	
		<div class="container">		
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" >
				<div class="sidebar-container">				
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>					
				</div>
			</div>
			<?php } 
			
		    news_magazine_content_posts();  
            if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
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
