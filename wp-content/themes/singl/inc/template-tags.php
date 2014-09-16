<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Singl
 */

if ( ! function_exists( 'singl_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function singl_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'singl' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav screen-reader-text">' . __( '&laquo; Older posts', 'singl' ) . '</span>' ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( '<span class="meta-nav screen-reader-text">' . __( 'Newer posts &raquo;', 'singl' ) . '</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'singl_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function singl_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'singl' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav screen-reader-text">' . _x( '&laquo; Previous Post', 'Previous post link', 'singl' ) . '</span>' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav screen-reader-text">' . _x( 'Next Post &raquo;', 'Next post link', 'singl' ) . '</span>' ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'singl_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function singl_comment( $comment, $args, $depth ) {
	global $post;
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'singl' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'singl' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body clear<?php if ( '' == get_avatar( $comment ) ) echo ' no-avatar'; ?>">
			<?php if ( '' != get_avatar( $comment ) ) : ?>
			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div><!-- .comment-author -->
			<?php endif; ?>

			<div class="comment-content">
				<footer class="comment-meta">
					<div>
						<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>
						<?php
							if ( $comment->user_id === $post->post_author ) {
								echo '<span class="bypostauthor">' . __( 'Author', 'singl' ) . '</span>';
							}
						?>
						<?php
							comment_reply_link( array_merge( $args, array(
								'add_below'  => 'div-comment',
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
								'reply_text' => __( 'Reply', 'singl' ),
								'before'     => '<span class="reply">',
								'after'      => '</span>',
							) ) );
						?>
					</div>
					<div>
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%s ago', 'time', 'singl' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit', 'singl' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</footer><!-- .comment-meta -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'singl' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for singl_comment()

if ( ! function_exists( 'singl_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function singl_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'singl' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function singl_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so singl_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so singl_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in singl_categorized_blog.
 */
function singl_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'singl_category_transient_flusher' );
add_action( 'save_post',     'singl_category_transient_flusher' );
