<?php
/*
 * The template for displaying Comments.
 */
?>

<?php if (post_password_required()) { ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view any comments.', 'news_magazine'); ?></p>
    
	<?php return; } ?>

<?php if (have_comments()) : ?>
    <h5 id="comments">
			<?php
				printf( _n('One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'news_magazine'),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>');
			?>
    </h5>

    <ol class="commentlist">
        <?php wp_list_comments('avatar_size=60'); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <div class="navigation">
        <div class="previous"><?php previous_comments_link(__( '&#8249; Older comments','news_magazine' )); ?></div><!-- end of .previous -->
        <div class="next"><?php next_comments_link(__( 'Newer comments &#8250;','news_magazine', 0 )); ?></div><!-- end of .next -->
    </div><!-- end of.navigation -->
    <?php endif; ?>

<?php else : ?>

<?php endif; ?>

<?php
if (!empty($comments_by_type['pings'])) :
    $count = count($comments_by_type['pings']);
    ($count !== 1) ? $txt = __('Pings&#47;Trackbacks','news_magazine') : $txt = __('Pings&#47;Trackbacks','news_magazine');
?>

    <h6 id="pings"><?php printf( __( '%1$d %2$s for "%3$s"', 'news_magazine' ), $count, $txt, get_the_title() )?></h6>

    <ol class="commentlist">
        <?php wp_list_comments('type=pings&max_depth=<em>'); ?>
    </ol>


<?php endif; ?>

<?php if (comments_open()) : ?>

    <?php
    $fields = array(
        'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" placeholder="' . __('Name','news_magazine') . ' *" /></p>',
        'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" placeholder="' . __('E-mail','news_magazine') . ' *" /></p>',
        'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . __('Website','news_magazine') . '" /></p>',
   
   );
   
 $defaults = array(
	  'id_form'           => 'commentform',
	  'id_submit'         => 'submit',
	  'title_reply'       => __( 'Leave a Reply' ,'news_magazine'),
	  'title_reply_to'    => __( 'Leave a Reply to %s','news_magazine' ),
	  'cancel_reply_link' => __( 'Cancel Reply' ,'news_magazine'),
	  'label_submit'      => __( 'Post Comment','news_magazine' ),
	  'comment_field'     =>  '<p class="comment-form-comment"> <textarea  placeholder="' . __('Comment','news_magazine') . ' *" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	  'must_log_in'       => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.','news_magazine' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		) . '</p>',
	  'fields'            => apply_filters( 'comment_form_default_fields', $fields ),
);
   

    comment_form($defaults); 


 endif; ?>
