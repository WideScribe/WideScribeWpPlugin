<?php get_header(); ?>

    <div id="content" class="clearfix">
    	<div id="slide-wrap">
        	<?php 
                $args = array(
                    'posts_per_page' => 10,
					'post_status' => 'publish',
                    'post__in' => get_option("sticky_posts")
                );
                $fPosts = new WP_Query( $args );
				$countPosts = $fPosts->found_posts;
              ?>
			  
			<?php if ( $fPosts->have_posts() ) : ?>
            
            <div id="load-cycle"></div>
              <div class="cycle-slideshow" <?php 
				  	if ( get_theme_mod('newswire_slider_effect') ) {
						echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('newswire_slider_effect') ) . '" data-cycle-tile-count="10"';
					} else {
						echo 'data-cycle-fx="scrollHorz"';
					}
				  ?> data-cycle-slides="> div.slides" <?php
                  	if ( get_theme_mod('newswire_slider_timeout') ) {
						$slider_timeout = wp_kses_post( get_theme_mod('newswire_slider_timeout') );
						echo 'data-cycle-timeout="' . $slider_timeout . '000"';
					} else {
						echo 'data-cycle-timeout="5000"';
					}
				  ?>>
            
            <div class="cycle-pager"></div>
            <?php while ( $fPosts->have_posts() ) : $fPosts->the_post();  ?>
			 
			<div class="slides">
            <h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newswire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              <div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>
                 <?php if ( has_post_thumbnail()) : ?>
                    <div class="slide-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( array(1000, 640) ); ?></a></div>
                 <?php else : ?>
                 
                    <?php $postimgs =& get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
                    if ( !empty($postimgs) ) :
                        $firstimg = array_shift( $postimgs );
                        $my_image = wp_get_attachment_image( $firstimg->ID, array( 1000, 640 ), false );
                    ?>
                    <div class="slide-thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $my_image; ?></a></div>
                    
                    <?php else : ?>
                    
                    <div class="slide-noimg">
                    	<div class="slide-noimg-copy">
							<?php echo newswire_excerpt(30); ?><br /><br />
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading &rarr;', 'newswire'); ?></a>
                        </div>
                    </div>
                    
                   <?php endif; ?>
                   
                 <?php endif; ?>					
              </div>
            </div>
            
 			<?php endwhile; ?>

            </div>
            <?php endif; ?> 

            </div>
        
        <div id="main" class="col620 clearfix" role="main">
        
			<?php if ( have_posts() ) : ?>
            
            <h2 class="heading-latest"><?php _e('Latest News', 'newswire'); ?></h2>
            	
                <div id="grid-wrap" class="clearfix">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="grid-box">
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>
                    </div>

				<?php endwhile; ?>
                
                </div>

				<?php if (function_exists("newswire_pagination")) {
							newswire_pagination(); 
				} elseif (function_exists("newswire_content_nav")) { 
							newswire_content_nav( 'nav-below' );
				}?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'newswire' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content post-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newswire' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

        </div> <!-- end #main -->

        <?php get_sidebar('home'); ?>

    </div> <!-- end #content -->
        
<?php get_footer(); ?>