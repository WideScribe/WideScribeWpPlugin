<div class="span-22" id="footer">
		<div class="first prepend-1 span-6 append-1 prepend-top">
			<?php if ( ! dynamic_sidebar( 'footer-left' ) ) : ?>
			<div class="pre-widget">
			<h3><?php _e( 'Left Footer Widget?', 'hephaestus' ); ?></h3>
			<p><?php _e( 'This panel is active and ready for you to add some widgets via the WP Admin, isn&rsquo;t it?', 'hephaestus' ); ?></p>
			</div>
			<?php endif; ?>
		</div>
		<div class="span-6 append-1 prepend-top">
			<?php if ( ! dynamic_sidebar( 'footer-center' ) ) : ?>
			<div class="pre-widget">
			<h3><?php _e( 'Center Footer Widget', 'hephaestus' ); ?></h3>
			<p><?php _e( 'This panel is active and ready for you to add some widgets via the WP Admin, isn&rsquo;t it?', 'hephaestus' ); ?></p>
			</div>
			<?php endif; ?>
		</div>
		<div class="span-6 last prepend-top">
			<?php if ( ! dynamic_sidebar( 'footer-right' ) ) : ?>
			<div class="pre-widget">
			<h3><?php _e( 'Right Footer Widget', 'hephaestus' ); ?></h3>
			<p><?php _e( 'This panel is active and ready for you to add some widgets via the WP Admin, isn&rsquo;t it?', 'hephaestus' ); ?></p>
			</div>
			<?php endif; ?>			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="prepend-1 span-20 append-1 prepend-top" id="footerline"></div>
	<div class="clear"></div>
	<div class="prepend-1 span-20 append-1 prepend-top" id="footerbottom">
		<div class="span-11">
			<?php wp_nav_menu(array(
            'theme_location'  => 'secondary',
			'fallback_cb' => '',
			) ); ?>			
		</div>
		<div class="span-9 last">
			<a href="<?php echo esc_url( __( 'http://www.wpkamikaze.com/hephaestus-theme/', 'hephaestus' ) ); ?>"><?php printf( __( 'Hephaestus Theme by %s', 'hephaestus' ), 'WP Kamikaze' ); ?></a>
		</div>
	</div>
	<div class="clear"></div>
</div>

<?php wp_footer(); ?> 
</body>
</html>