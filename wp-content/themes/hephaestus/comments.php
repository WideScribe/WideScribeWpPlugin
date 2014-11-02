<div id="commentsheader"></div>
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'hephaestus' ); ?></p>
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>
<?php if ( have_comments() ) : ?>
<div class="commentline"></div>
		<h2 id="comments-title">
			<?php
				printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'hephaestus' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?><div class="paginate_comments"><?php paginate_comments_links(); ?></div><?php endif; ?>
		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'callback' => 'hephaestus_comment' ) );
			?>
		</ol>
	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'hephaestus' ); ?></p>
	<?php endif; ?>
<div class="clear"></div>
<div class="commentline"></div>
<?php if(comments_open()) : ?>  
<?php if(get_option('comment_registration') && !$user_ID) : ?>  
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p><?php else : ?>  
	<?php comment_form(); ?>
	 <?php endif; ?>  
<?php else : ?>  
    <span><?php _e( 'The comments are closed.', 'hephaestus' ); ?></span>  
<?php endif; ?>  
