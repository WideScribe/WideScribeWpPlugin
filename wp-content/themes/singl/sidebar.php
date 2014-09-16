<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Singl
 */
?>
<div id="secondary" role="complementary" class="clear">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="top-sidebar-one" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="top-sidebar-two" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="top-sidebar-three" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- #third .widget-area -->
	<?php endif; ?>
</div><!-- #secondary -->
