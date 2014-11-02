<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="prepend-1 span-20 append-1 last" id="single">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="postheader"></div>
			<h1><?php the_title(); ?></h1>	
			<div class="clear"></div>
			<span id="nav-previous"><?php previous_image_link( false, __( '&larr; Previous' , 'hephaestus' ) ); ?></span>
			<span id="nav-next"><?php next_image_link( false, __( 'Next &rarr;' , 'hephaestus' ) ); ?></span>
			<div class="clear"></div>
			<?php
			$metadata = wp_get_attachment_metadata();
			printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'hephaestus' ),
			esc_attr( get_the_time() ),
			get_the_date(),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height'],
			esc_url( get_permalink( $post->post_parent ) ),
			esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
			get_the_title( $post->post_parent )
			);
			?>
			<?php edit_post_link( __( 'Edit', 'hephaestus' ), '<span class="edit-link">', '</span><div class="clear"></div>' ); ?>
			<?php
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) {
				if ( $attachment->ID == $post->ID )
					break;
			}
			$k++;
			
			if ( count( $attachments ) > 1 ) {
				if ( isset( $attachments[ $k ] ) )
					
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
				else
					
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
			} else {
			
				$next_attachment_url = wp_get_attachment_url();
			}
			?>
			<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
			$attachment_size = apply_filters( 'supremo_attachment_size', 848 );
			echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1024 ) ); 
			?></a>
			<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
			<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'hephaestus' ) . '</span>', 'after' => '</div>' ) ); ?>
			<div class="clear"></div>
			<?php comments_template( '', true ); ?>
			<span id="categorylist"><?php _e('Submitted in: ', 'hephaestus'); ?><?php echo get_the_category_list( __( ', ', 'hephaestus' )); ?></span> | 
			<span id="tagspost"><?php the_tags(); ?></span>
	</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>