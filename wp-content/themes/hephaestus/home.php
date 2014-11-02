<?php get_header(); ?>
	<?php
	if ($data['slider_checkbox'] == 1)	{
	?>
	<div class="prepend-1 span-20 append-1 append-bottom" id="sliderWrap">
		<div id="slider">
		<?php 
		
		 foreach ($data['pingu_slider'] as $slide ) {
		?>
		   <div class="slide">
		   <?php if($slide['link']) { ?>
			<a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['url']; ?>" alt="slide" width="890" height="270"/></a>
			<?php } else { ?>
			<img src="<?php echo $slide['url']; ?>" width="890" height="270"/>
			<?php } ?>
			<?php if($slide['description']) { ?>
			<div class="slidedesc"><p><?php echo $slide['description']; ?></p></div>
			<?php } ?>
		   </div>
		<?php 
		 }
		?>
		</div>
	<a href="#" id="snext"></a>
	<a href="#" id="sprev"></a>
	</div>
	<div class="clear"></div>	
	<?php
	} else {
		if (get_header_image() != '') {
	?>
	<div class="prepend-1 span-20 append-1 append-bottom" id="sliderWrap">
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="Header Image" />
	</div>
	<div class="clear"></div>
	<?php }} ?>
	<div class="prepend-1 span-14">
	<div class="span-6 append-1 prepend-top">
	<?php $i = 0; if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) == 0) : $wp_query->next_post(); else : the_post(); ?>
		<div class="homepost hoverpost"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php if(has_post_thumbnail()) {
					the_post_thumbnail('thumb-one', array("class" => "posting"));  
					} else { ?>
					<img class="posting" src="<?php echo get_template_directory_uri(); ?>/images/no_image.png" alt="<?php the_title(); ?>" width="260" height="160" />
			<?php	} ?>
		<img class="hoverimg" src="<?php echo get_template_directory_uri(); ?>/images/hoverpost.png" width="260" height="196" alt="" /></a>
		<h1><?php 
        $thetitle = get_the_title($post->ID);
        $origpostdate = get_the_date('M d, Y', $post->post_parent);
        $origposttime = get_the_time('M d, Y', $post->post_parent);
        $dateline = $origpostdate.' '.$origposttime;
       //var_dump($thetitle);
       if($thetitle==null){echo $dateline;}else{
        the_title_shorten(20);                     
       }
        
        ?></h1>
		</div>
	<?php endif; endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.', 'hephaestus'); ?></p>
	<?php endif; ?>
	<?php $i = 0; rewind_posts(); ?>
	</div>
	<div class="span-6 append-1 prepend-top last">
	<?php $i = 0; if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) !== 0) : $wp_query->next_post(); else : the_post(); ?>
	<div class="homepost hoverpost"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php if(has_post_thumbnail()) {
					the_post_thumbnail('thumb-one', array("class" => "posting")); 
					} else { ?>
					<img class="posting" src="<?php echo get_template_directory_uri(); ?>/images/no_image.png" alt="<?php the_title(); ?>" width="260" height="160" />
			<?php	} ?>
		<img class="hoverimg" src="<?php echo get_template_directory_uri(); ?>/images/hoverpost.png" width="260" height="196" alt="" /></a>
		<h1><?php 
         if (get_the_title()) the_title_shorten(20); else echo the_date();?></h1>
	</div>
	<?php endif; endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.', 'hephaestus'); ?></p>
	<?php endif; ?>
	</div>
	<div class="clear"></div>
   <?php if(function_exists('pagenavi')) { pagenavi(); } ?>
</div>  
<?php get_sidebar(); ?> 
<?php get_footer(); ?>               