
	</div><!-- #container -->

	<div class="push"></div>

</div><!-- #wrapper -->

<footer id="colophon" role="contentinfo">
		<div id="site-generator">

			<?php echo __('&copy; ', 'newswire') . esc_attr( get_bloginfo( 'name', 'display' ) );  ?>
            <?php if ( is_front_page() && ! is_paged() ) : ?>
            <?php _e('- Powered by ', 'newswire'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'newswire' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'newswire' ); ?>"><?php _e('WordPress' ,'newswire'); ?></a>
			<?php _e(' and ', 'newswire'); ?><a href="<?php echo esc_url( __( 'http://wpdevshed.com/', 'newswire' ) ); ?>"><?php _e('WP Dev Shed', 'newswire'); ?></a>
            <?php endif; ?>
            
		</div>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>


</body>
</html>