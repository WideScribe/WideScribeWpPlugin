<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Singl
 */
$sidebar = ( is_active_sidebar( 'sidebar-1' )
          || is_active_sidebar( 'sidebar-2' )
          || is_active_sidebar( 'sidebar-3' )
) ? true : false;
?>

		</div><!-- #content -->
	</div><!-- .page-wrapper -->

	<div class="bottom-wrapper<?php if ( $sidebar ) echo ' has-sidebar'; ?>">
		<?php if ( $sidebar ) : ?>
			<div class="trigger-wrapper clear">
				<a href="#" class="widgets-trigger closed" title="<?php esc_attr_e( 'Widgets', 'singl' ); ?>">
					<span class="fa fa-angle-up"><span class="screen-reader-text"><?php _e( 'Widgets', 'singl' ); ?></span></span>
				</a>
			</div><!-- .trigger-wrapper -->
			<div id="widgets-wrapper" class="bottom-panel hide">
				<?php get_sidebar(); ?>
			</div><!-- #widgets-wrapper -->
		<?php endif ;?>

		<?php if ( get_theme_mod( 'singl_subscribe_form' ) ) : ?>
			<div class="subscribe-form-wrapper">
				<?php echo do_shortcode( '[blog_subscription_form title="' . __( 'Get email updates', 'singl' ) . '" subscribers_total="false" subscribe_logged_in="" subscribe_text=""]' ); ?>
			</div><!-- .subscribe-form-wrapper -->
		<?php endif; ?>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<?php do_action( 'singl_credits' ); ?>
				<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'singl' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'singl' ), 'Singl', '<a href="https://wordpress.com/themes/" rel="designer">WordPress.com</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- .bottom-wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>