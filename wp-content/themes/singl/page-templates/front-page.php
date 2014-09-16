<?php
/**
 * Template Name: Front Page
 *
 * @package Singl
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php
				$args = array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'post_parent'    => $post->ID,
					'order'          => 'ASC',
					'orderby'        => 'menu_order',
				);
				$parent = new WP_Query( $args );
			?>

			<?php if ( $parent->have_posts() ) : ?>

				<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

			<?php wp_reset_query(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>