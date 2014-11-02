<?php get_header(); ?>
	<div class="prepend-1 span-13 append-1 prepend-top single">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="span-13 append-bottom">
			<div class="postheader"></div>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php if (get_the_title()) the_title(); else echo the_date(); ?></a></h1>
			<p class="dateparagraph"><?php _e('Posted by ', 'hephaestus'); the_author(); _e(' on ', 'hephaestus'); echo get_the_date(); ?></p>
			<div class="span-3">
			<?php 
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('thumb-two');
			} else { ?>
			<img src="<?php echo get_template_directory_uri(); ?>/images/no_image.png" alt="<?php the_title(); ?>" width="125" height="125" />
			<?php } ?>
			</div>
			<div class="span-10 last append-bottom"><?php the_excerpt(); ?>
			</div>
		</div>
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.', 'hephaestus'); ?></p>
		<?php endif; ?>
	<div class="clear"></div>
	<?php if(function_exists('pagenavi')) { pagenavi(); } ?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>               