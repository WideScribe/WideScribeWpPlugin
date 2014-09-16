
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <div class="entry-meta">
			<?php newswire_posted_on(); ?>
		</div><!-- .entry-meta -->
		<h1 class="entry-title"><?php the_title(); ?></h1>

		
	</header><!-- .entry-header -->

	<div class="entry-content post-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'newswire' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	
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
   
    <footer class="entry-meta">
    <?php
        /* translators: used between list items, there is a space after the comma */
        $tag_list = get_the_tag_list( '', ', ' );

        // This blog only has 1 category so we just need to worry about tags in the meta text
        if ( '' != $tag_list ) {
            printf ( __( '<span class="tag-meta">Tagged %s</span>', 'newswire' ), $tag_list);
        }
    ?>
    <?php edit_post_link( __( 'Edit', 'newswire' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-meta -->
         
	
</article><!-- #post-<?php the_ID(); ?> -->
