<?php
get_header();
news_magazine_update_page_layout_meta_settings(); ?>	
</div>	

<div id="content" class="page">
	<div class="container">
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1"  role="complementary">
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			</div>
			<?php } ?>
		   <div id="blog" class="blog error404">
				<h2 class="page-header"><span><?php _e('Not Found', 'news_magazine'); ?></span></h2>
				<p><?php _e('You are trying to reach a page that does not exist here. Either it has been moved or you typed a wrong address. Try searching:', 'news_magazine'); ?></p>
				<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">
					<div id="searchbox">
						<div class="searchback">
							<input  type="text" value="" name="s" id="s" class="searchbox_search" placeholder="<?php echo __('Type here','news_magazine'); ?>"/> 
							<input type="submit" id="searchsubmit" value="<?php echo __('Search','news_magazine'); ?>" class="read_more"/>
						</div>																		
				   </div>
				</form>
				<img class="imgBox" src="<?php  echo get_template_directory_uri('template_url'); ?>/images/404.png">
		  </div>

        <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
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
