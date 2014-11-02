<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="prepend-1 span-13 append-1 prepend-top" id="single">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="postheader"></div>
			<h1>
             <a href="<?php the_permalink() ?>" 
             title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
             <?php if (get_the_title($post->ID)) the_title(); else echo the_date(); ?>
             </a>
            
            
            </h1>	
			
			<?php the_content(); ?>
			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'hephaestus' ) . '</span>', 'after' => '</div>' ) ); ?>
			<div class="clear"></div>
			<?php comments_template( '', true ); ?>
			<span id="categorylist"><?php _e('Submitted in: ', 'hephaestus'); ?><?php echo get_the_category_list( __( ', ', 'hephaestus' )); ?></span> | 
			<span id="tagspost"><?php the_tags(); ?></span>
	</div>
	</div>
<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>