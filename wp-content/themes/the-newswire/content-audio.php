
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newswire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	 <?php if (! is_single() ) : ?>
		<?php if ( has_post_thumbnail()) : ?>
            <div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a></div><!-- .imgthumb -->
        <?php endif; ?>
    <?php endif; ?>

	<div class="entry-content post-content">
		<?php if (has_excerpt()) {
			the_excerpt();
		} else {
			the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'newswire' ) );
			wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newswire' ), 'after' => '</div>' ) );
		} ?>
	</div><!-- .entry-content -->

      
	<footer class="entry-meta">
		
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'newswire' ) );
				if ( $categories_list && newswire_categorized_blog() ) :
			?>
			<span class="cat-meta-color">
				<?php printf( __( '%s', 'newswire' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

		<?php endif; // End if 'post' == get_post_type() ?>

		<div class="colorbar"></div>
        
        
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
