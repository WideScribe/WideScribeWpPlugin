<?php  get_header(); ?>
</div>	

<div id="content" class="page">
 <div class="container">
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<div id="sidebar1" role="complementary">
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-1' );  ?>
				</div>
			</div>
			<?php }  ?>
			<div id="blog" class="blog search">
				<div class="single-post">
					<h2 class="page-header">
						<span><?php echo __('Search','news_magazine'); ?></span>
					</h2>						
				</div>
				<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">
							<div class="searchback">
								<input  type="text" name="s" id="s" class="searchbox_search" value="<?php echo get_search_query(); ?>"/> 
								<input type="submit" id="searchsubmit" value="<?php echo __('SEARCH','news_magazine'); ?>"  />
							</div>
				</form>
					<?php /*print page content*/ 
					if( have_posts() ) { 
						while( have_posts()){ 
							the_post(); ?>
							 <div class="single-post">
									<a href="<?php the_permalink(); ?>">
										<h3><?php the_title(); ?></h3>
									</a>
								<?php news_magazine_entry_cont_for_search(); ?>
								<div class="clear"></div>
							</div>
				  <?php } ?>
						<div class="page-navigation">
							<?php posts_nav_link(); ?>
						</div>
				  
				<?php	} 	?>
	      </div>
		  <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<div id="sidebar2" role="complementary">         
				 <div class="sidebar-container">
					 <?php dynamic_sidebar( 'sidebar-2' ); ?>
				 </div>
			</div>
		  <?php } ?>
	   <div style="clear:both"></div>
	</div>
</div>

<?php get_footer(); ?>
