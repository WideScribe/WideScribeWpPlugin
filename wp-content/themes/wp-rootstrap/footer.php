<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package rootstrap
 */
?>
<?php do_action( 'rootstrap_content_end' ); ?>
	</div><!-- #content -->
<?php do_action( 'rootstrap_footer_before' ); ?>

	<div id="footer-area">
	<?php do_action( 'rootstrap_footer_start' ); ?>
		<div class="container footer-inner">
			<?php get_sidebar( 'footer' ); ?>
		</div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info container">
				<?php rootstrap_social(); ?>
				<nav role="navigation" class="col-md-6">
					<?php rootstrap_footer_links(); ?>
				</nav>
				<div class="copyright">
					<?php echo rootstrap_get_option( 'custom_footer_text', 'rootstrap' ); ?>
					<?php rootstrap_footer_info(); ?> 
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
	<?php do_action( 'rootstrap_footer_end' ); ?>
</div><!-- #page -->
<?php do_action( 'rootstrap_footer_after' ); ?>
<?php do_action( 'rootstrap_body_end' ); ?>
<?php wp_footer(); ?>
</body>
</html>