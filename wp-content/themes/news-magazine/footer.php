
<div id="footer">
		<div class="container">
		    <div id="footer_eft"> 
		    	<?php if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
					<div id="sidebar3"   role="complementary">
						<div class="sidebar-container">
							<?php dynamic_sidebar( 'sidebar-3' );  ?>
						</div>
					</div>
				<?php } ?>
		
			<?php news_magazine_footer_text();   ?>
			
			</div>
			<?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
					<div id="sidebar4"   role="complementary">
						<div class="sidebar-container">
							<?php dynamic_sidebar( 'sidebar-4' );  ?>
						</div>
					</div>
		    <?php } ?>			
		</div>
		
	<div class="clear"></div>	
</div>
<?php wp_footer(); ?>

</body>
</html>
