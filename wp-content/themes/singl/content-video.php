<?php
/**
 * @package Singl
 */
// Access global variable directly to adjust the content width for video post format
if ( isset( $GLOBALS['content_width'] ) ) {
	$GLOBALS['content_width'] = 768;
}

$content = apply_filters( 'the_content', get_the_content( __( 'Continue reading', 'singl' ) ) );
$media = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
if ( ! empty( $media ) ) {
    foreach( $media as $embed_html ) {
        $content = str_replace( $embed_html, '', $content );
    }
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! empty( $media ) ) : ?>
	    <div class="entry-media">
		    <?php
		        foreach ( $media as $embed_html ) {
		            printf( '%s', $embed_html );
		        }
		    ?>
	    </div><!-- .entry-media -->
	<?php endif; ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_time(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
				<span class="entry-format">&mdash; <a href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'singl' ), get_post_format_string( 'video' ) ) ); ?>"><?php echo get_post_format_string( 'video' ); ?></a></span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link">&mdash; <?php comments_popup_link( __( 'Leave a comment', 'singl' ), __( '1 Comment', 'singl' ), __( '% Comments', 'singl' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php echo $content; ?>
			<?php
				wp_link_pages( array(
					'before'   => '<div class="page-links">',
					'after'    => '</div>',
					'pagelink' => '<span class="page-link">%</span>',
				) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'singl' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'singl' ) );

				if ( ! singl_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'singl' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'singl' );
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'singl' );
					} else {
						$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'singl' );
					}

				} // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
			?>

			<?php edit_post_link( __( 'Edit', 'singl' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	<?php endif; // End if 'post' == get_post_type() ?>
</article><!-- #post-## -->
