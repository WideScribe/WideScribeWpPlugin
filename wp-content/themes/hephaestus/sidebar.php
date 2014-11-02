	<div class="span-6 last prepend-top" id="sidebar">
		<div id="sidebarheader"></div>
		<div id="sidebarbody">
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

	<div class="pre-widget">
		<h3><?php _e( 'Widgetized Sidebar, isn&rsquo;t it?', 'hephaestus' ); ?></h3>
		<p><?php _e( 'This panel is active and ready for you to add some widgets via the WP Admin, isn&rsquo;t it?', 'hephaestus' ); ?></p>
	</div>
	<?php endif; ?>
		</div>
		<div id="sidebarfooter"></div>
	</div>
	<div class="clear"></div>