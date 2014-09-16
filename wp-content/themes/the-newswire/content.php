
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'newswire' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

	</header><!-- .entry-header -->
    
    <?php if ( has_post_thumbnail()) : ?>
     	<div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a></div>
		
	<?php else : ?>
    <?php
    	$postimgs =& get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		if ( !empty($postimgs) ) {
			$firstimg = array_shift( $postimgs );
			$th_image = wp_get_attachment_image( $firstimg->ID, 'full', false );
		 ?>
			<div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $th_image; ?></a></div>
            
	<?php } ?>
    <?php endif; ?>
    

	<div class="entry-content post-content">
    	<?php if (has_excerpt()) { 
			the_excerpt();
		} else {
    		echo newswire_excerpt(20);
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
