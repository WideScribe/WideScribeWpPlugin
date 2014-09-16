<?php
/**
 * The Sidebar for the Posts template, containing the main widget areas.
 */
?>
		<div id="sidebar" class="widget-area col300" role="complementary">
        
        	<div id="banner-sidebar">
                <?php get_template_part('banner-sidebar'); ?>
            </div>

			<?php if ( ! dynamic_sidebar( 'sidebar-posts' ) ) : ?>
            	
                <aside id="categories" class="widget">
					<div class="widget-title"><?php _e( 'Categories', 'newswire' ); ?></div>
					<ul>
						<?php wp_list_categories( array( 
							'title_li' => '',
							'hierarchical' => 1
						) ); ?>
					</ul>
				</aside>
                
                <aside id="recent-posts" class="widget">
					<div class="widget-title"><?php _e( 'Latest Posts', 'newswire' ); ?></div>
					<ul>
						<?php
							$args = array( 'numberposts' => '10', 'post_status' => 'publish' );
							$recent_posts = wp_get_recent_posts( $args );
							
							foreach( $recent_posts as $recent ){
								if ($recent["post_title"] == '') {
									 $recent["post_title"] = __('Untitled', 'newswire');
								}
								echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' . $recent["post_title"] .'</a> </li> ';
							}
						?>
                    </ul>
				</aside>

				<aside id="archives" class="widget">
					<div class="widget-title"><?php _e( 'Archives', 'newswire' ); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #sidebar .widget-area -->
