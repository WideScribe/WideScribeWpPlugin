<?php
function news_magazine_categories_vertical_tabs(){

global $news_magazine_home_page,$news_magazine_general_settings_page,$wp_query;

// initila home setings variables
foreach ($news_magazine_home_page->options_homepage as $value) 
{
	if(isset($value['id']))
	{
		if (get_theme_mod( $value['id'] ) === FALSE)
		{
			 $$value['var_name'] = $value['std']; 
		} 
		else { 		
			$$value['var_name'] = get_theme_mod( $value['id'] );
		}	
	}
}

foreach ($news_magazine_general_settings_page->options_generalsettings as $value) 
{
    if (get_theme_mod( $value['id'] ) === FALSE)
	{
		 $$value['var_name'] = $value['std']; 
	} else {
		 $$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}
if($hide_cat_tab_post=='on' && is_home()){
echo news_magazine_display_categories_vertical_tabs_html(array(
			"postType"=>"category",
			"categoryID"=>news_magazine_remove_last_comma($tab_post_categories),
			"containerFloat"=>"left",
			"postsCount"=>$tab_post_count,
			"visibleTabsCount"=>$tab_post_visible_count,
			"tabsWidth"=>"30",
			"contentWidth"=>"69%",
			"tabsBackground"=>"",
			"blogStyle"=>$blog_style,
			"thumbnailMaxHeight"=>"160px"));
			
	}		
}



				
function news_magazine_content_posts_for_home() {
	global $news_magazine_general_settings_page,$news_magazine_home_page,$wp_query;
// initila home setings variables
foreach ($news_magazine_home_page->options_homepage as $value) 
{
	if(isset($value['id']))
	{
		if (get_theme_mod( $value['id'] ) === FALSE)
		{
			 $$value['var_name'] = $value['std']; 
		} 
		else { 		
			$$value['var_name'] = get_theme_mod( $value['id'] );
		}	
	}
}
// initila general setings variables
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) 
{
    if (get_theme_mod( $value['id'] ) === FALSE)
	{
		 $$value['var_name'] = $value['std']; 
	} else {
		 $$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}		
if(is_home()){

 if(have_posts()) { 
		while (have_posts()) {
			the_post();

			?>
	<div class="blog-post home-post blog-post-div">
	   <div class="blog-post blog-page">				
									  
					<div class="image-block"><?php 
						if($grab_image && $date_enable){
						    echo news_magazine_posted_on_blog();
						}
						if($grab_image && !has_post_thumbnail()) 
						{
							echo news_magazine_display_thumbnail(240,182); 
						}
						else 
						{
						   echo news_magazine_thumbnail(240,182);
						}
						?></div>
					<h3>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				<?php	
				if(isset($blog_style) && $blog_style=="on") 
					{ ?>								
					   <style>
						 .blog-post .post-date + img{
							height: 180px !important;
							width: 240px;
						 }
					   </style>
					<p>
						<?php news_magazine_the_excerpt_max_charlength(200); ?>
					</p>
					<a href="<?php the_permalink(); ?>"  class="read_more read_blog"><?php echo __('More', 'news_magazine'); ?></a>	
					<?php  }
					else 
					{ ?>
					<p>
						<?php the_content(__('More','news_magazine')); ?>
					</p>
					<?php } ?>					
			<div class="clear"></div>	
		</div>
	</div>
	<?php 
	}
	if( $wp_query->max_num_pages > 2 ){ ?>
		<div class="page-navigation">
			<?php news_magazine_nav_link(); ?>
		</div>	   
	<?php }
	
	}

} else if(is_front_page())
{

	 if(have_posts()) { 
		while (have_posts()) {
			the_post(); ?>
			<div class="home-post blog-post-div">				 
				<h2 class="page-header">
					<span><?php the_title(); ?></span>
				</h2>	
				<?php	the_content(__('More','news_magazine')); ?>
				<div class="clear"></div>	
			</div>
			<?php 
	   } ?>
	    <div class="navigation">
			<?php posts_nav_link(); ?>
		</div>
	
	<?php }
	 global $post;
	   $withcomments = true;
		if(comments_open())
		{	wp_reset_query(); ?>
			<div class="comments-template">
				<?php echo comments_template();	?>
			</div>
  <?php }		
			
   }
 }	


function news_magazine_content_posts() {

global $news_magazine_general_settings_page,$news_magazine_home_page,$wp_query;

// initila home setings variables
foreach ($news_magazine_home_page->options_homepage as $value) 
{
	if(isset($value['id']))
	{
		if (get_theme_mod( $value['id'] ) === FALSE)
		{
			 $$value['var_name'] = $value['std']; 
		} 
		else { 		
			$$value['var_name'] = get_theme_mod( $value['id'] );
		}	
	}
}
// initila general setings variables
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) 
{
    if (get_theme_mod( $value['id'] ) === FALSE)
	{
		 $$value['var_name'] = $value['std']; 
	} else {
		 $$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}		

if ($hide_content_post=='on') {	
	$cat_checked=0;
	if($content_post_categories)
		$cat_checked=1;
	$n_of_home_post=get_option( 'posts_per_page', 6 ); 
		
	if($n_of_home_post!=0){
		 if(have_posts()) { ?>
			 <div id="latest-news" class="content-inner-block">
			      <h2><?php echo $content_post_cat_name; ?></h2>
				  <div class="latest-news-post">				     
					 <ul>
				<?php	while (have_posts()) {
						the_post();   ?>
						
						<li>
							<div class="image-block-<?php the_ID(); ?> image-block">
							<?php if($grab_image  && $date_enable){ ?>
							    <div class="post-date"> <?php the_time('j'); ?><br> <?php the_time('M'); ?></div>
							<?php } ?>	
								<a class="title_href" href="<?php echo get_permalink() ?>">
								  <?php if($grab_image)
								   {
									echo news_magazine_display_thumbnail(140, 130); 
								   }
								   else 
								   {
									echo news_magazine_thumbnail(140, 130);
								   } ?>					  
								</a>
					        </div>
							<div class="text-block">
							    <a class="title_href" href="<?php echo get_permalink() ?>">
									 <h3><?php the_title(); ?></h3>
								</a>		
								<?php news_magazine_the_excerpt_max_charlength(120); ?>
							</div>				
						 </li>
						 <?php } ?>
					   </ul>	 
				   </div>  
				</div>
				<div class="page-navigation">
				    <?php posts_nav_link(' ', __('Previous page','news_magazine'), __('Next page','news_magazine')); ?>
			    </div>
				<?php wp_reset_query();
				}
				 
				
	    }	
	}		
}


function news_magazine_entry_cont(){

//for update general_settings
global $news_magazine_general_settings_page;
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) {
    if (get_theme_mod( $value['var_name'] ) === FALSE)
	{ 
		$$value['var_name'] = $value['std'];
	}
	else
    { 
		$$value['var_name'] = get_theme_mod( $value['id'] );
    }

} ?>
	<div class="blog-post blog-page">	
			<div class="image-block"><?php 
				if($grab_image && !has_post_thumbnail()) 
				{
					echo news_magazine_display_thumbnail(240,182); 
				}
				else 
				{
				   echo news_magazine_thumbnail(240,182);
				}
				?>
			</div>
			<h3>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<?php	
			if(isset($blog_style) && $blog_style=="on") 
				{ ?>													   
				<p>
					<?php news_magazine_the_excerpt_max_charlength(250); ?>
				</p>
				<a href="<?php the_permalink(); ?>"  class="read_more read_blog"><?php echo __('More', 'news_magazine'); ?></a>	
				<?php  }
				else 
				{ ?>
				<p>
					<?php the_content(__('More','news_magazine')); ?>
				</p>
				<?php }
				 if($date_enable){
				  news_magazine_entry_meta();
				} ?>
		<div class="clear"></div>		   
	</div>
	<?php

}

function news_magazine_entry_cont_for_search(){

//for update general_settings
global $news_magazine_general_settings_page;
foreach ($news_magazine_general_settings_page->options_generalsettings as $value) {
    if (get_theme_mod( $value['var_name'] ) === FALSE)
	{ 
		$$value['var_name'] = $value['std'];
	}
	else
    { 
		$$value['var_name'] = get_theme_mod( $value['id'] );
    }
} ?>
		<div class="entry">
	        <?php if($blog_style){
			     the_excerpt();
			   }else{
			     the_content(__('More','news_magazine'));
			   }  ?>
		</div>
		<?php if($date_enable){          
				   news_magazine_entry_meta(); 			
			 }

}

function news_magazine_footer_text(){

global  $news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value ) {
	if(isset($value['id'])){
		if ( get_theme_mod( $value['id'] ) === FALSE ) {
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}
}

  if($footer_text != ""){ ?>
	<div id="footer-bottom">
	   <div id="ex_social">
			<?php news_magazine_ftricons(); ?>
	   </div>
	   <?php echo stripslashes($footer_text); ?>		
	</div>
<?php }
}



function news_magazine_custom_css(){

global 	$news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value ) {
	if(isset($value['id'])){
		if ( get_theme_mod( $value['id'] ) === FALSE ) {
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}

}
echo "<style>".$custom_css."</style>";
}



function news_magazine_logo_img(){

global $news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value )
 {
	if(isset($value['id']))
	{		
		if ( get_theme_mod( $value['id'] ) === FALSE )
		{
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}		
	}
}
?>
<div id="header-middle">
	<a class="hedar-a-element" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<div>
		<?php if(trim($logo_img) && $logo_img!=''){?> 
				<h1 id="site-title">
					<span>
						<a id="logo" style="color: #c7c6c6;" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						 <?php   echo "<img id=\"site-title\" src=\"".$logo_img."\" alt=\"logo\">";   ?>
					   </a>
				   </span>
				</h1><?php	
			} 
			else { ?> 
			<h1 id="site-title">
				<span>
					<a class="site-title-a" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
					</a>
				</span>
			</h1>
		<?php } ?>
		</div>
	</a>
	<div class="clear"></div>
</div>
<?php
}


function news_magazine_slideshow(){
global $news_magazine_home_page,$news_magazine_slider_page;
foreach ($news_magazine_home_page->options_homepage as $value)
 {
	if(isset($value['id'])){
		if (get_theme_mod( $value['id'] ) === FALSE)
		{ 
		   $$value['var_name'] = $value['std']; 
		} else { 
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}
}
 $image_link=get_theme_mod('web_busines_image_link',get_template_directory_uri('template_url').'/images/slider_1.jpg'.';;;;'. get_template_directory_uri('template_url').'/images/slider_2.jpg'.';;;;'.get_template_directory_uri('template_url').'/images/slider_3.jpg');
 
    if(!$hide_slider && is_home() && $image_link!=''){
		
	?><script>
	var data = [];      

	<?php
		$image_link=get_theme_mod('web_busines_image_link',get_template_directory_uri('template_url').'/images/slider_1.jpg'.';;;;'. get_template_directory_uri('template_url').'/images/slider_2.jpg'.';;;;'.get_template_directory_uri('template_url').'/images/slider_3.jpg');
		
		if($image_link){
			$link_array=explode(';;;;',$image_link);
			if(count($link_array)>1)
			array_pop($link_array);
		}else {$link_array=array();}	
		
		for($i=0;$i<count($link_array);$i++){
			echo 'data["'.$i.'"]=[];';
		}
		
		
		for($i=0;$i<count($link_array);$i++){
			echo 'data["'.$i.'"]["id"]="'.$i.'";';
			echo 'data["'.$i.'"]["image_url"]="'.$link_array[$i].'";';
		}			
		
		$image_textarea=get_theme_mod('web_busines_image_textarea','<h2>Lorem ipsum dolor sit amet</h2><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>;;;;<h2>Lorem ipsum</h2><p>Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>;;;;<h2>Lorem ipsum dolor sit ame</h2><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>');
		
		if($image_textarea){
			$textarea_array=explode(';;;;',$image_textarea);
			array_pop($textarea_array);
		}else {
			$textarea_array=array();
		}
		
		for($i=0;$i<count($textarea_array);$i++){
			echo 'data["'.$i.'"]["description"]="'.$textarea_array[$i].'";';
			$current_image_description = $textarea_array[$i];
		}


		$image_title=get_theme_mod('web_busines_image_title',';;;;');
		if($image_title){
			$title_array=explode(';;;;',$image_title);
			array_pop($title_array);
		}else {
			$title_array=array();
		}
		
		for($i=0;$i<count($title_array);$i++){
		  if($title_array[$i]!=''){
			echo 'data["'.$i.'"]["alt"]="'.$title_array[$i].'";';
		  }else
			echo 'data["'.$i.'"]["alt"]="";'; 
		  $current_image_alt=$title_array[$i];
		 	
		} ?>
    </script>
	 
 <?php		
	$slideshow_title_position = explode('-', trim(get_theme_mod('ct_slider_title_position', 'right-top')) );
	$slideshow_description_position = explode('-', trim(get_theme_mod('ct_slider_description_position', 'right-bottom')) );
 ?>
 <style>
  .bwg_slideshow_image_wrap {
	height:<?php echo get_theme_mod('ct_slider_height','400'); ?>px;
	width:100% !important;
  }

  .bwg_slideshow_title_span {
	text-align: <?php echo $slideshow_title_position[0]; ?>;
	vertical-align: <?php echo $slideshow_title_position[1]; ?>;
  }
  .bwg_slideshow_description_span {
	text-align: <?php echo $slideshow_description_position[0]; ?>;
	vertical-align: <?php echo $slideshow_description_position[1]; ?>;
  }
</style>

<!--SLIDESHOW START-->
<div id="slideshow">
	<div class="container">
	<div class="slider_contener_for_exklusive">
	<div class="bwg_slideshow_image_wrap" id="bwg_slideshow_image_wrap_id">
      <?php 

	  $current_image_id=0;
      $current_pos =0;
	  $current_key=0;				
	  
        ?>
		<!--################# DOTS ################# -->

		 <a id="spider_slideshow_left" onclick="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data);"><span id="spider_slideshow_left-ico"><span><i class="bwg_slideshow_prev_btn fa "></i></span></span></a>
         <a id="spider_slideshow_right" onclick="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data);"><span id="spider_slideshow_right-ico"><span><i class="bwg_slideshow_next_btn fa "></i></span></span></a>
		<!--################################## -->
		

	  <!--################ IMAGES ################## -->
      <div id="bwg_slideshow_image_container"  width="100%" class="bwg_slideshow_image_container">        
        <div class="bwg_slide_container" width="100%">
          <div class="bwg_slide_bg">
            <div class="bwg_slider">
          <?php
		  
		$image_href=get_theme_mod('web_busines_image_href',';;;;');
		if($image_href){
			$href_array=explode(';;;;',$image_href);
			array_pop($href_array);
		}
		else {
			$href_array=array();
		}	
			
	   if($image_link){
			$image_rows=explode(';;;;',$image_link);
			if(count($image_rows)>1)
			array_pop($image_rows);
		}else {
			$image_rows=array();
		}	
		$i=0;
			
          foreach ($image_rows as $key => $image_row) {
            if ($i == $current_image_id) {
              $current_key = $key;
              ?>
              <span class="bwg_slideshow_image_span" id="image_id_<?php echo $i; ?>">
                <span class="bwg_slideshow_image_span1">
                  <span class="bwg_slideshow_image_span2">
					  <a href="<?php if(isset($href_array[$i])) echo $href_array[$i]; ?>" >
							<img id="bwg_slideshow_image"
							 class="bwg_slideshow_image"
							 src="<?php echo $image_row; ?>"
							 image_id="<?php echo $i; ?>" />
					  </a>
                  </span>
                </span>
              </span>
              <input type="hidden" id="bwg_current_image_key" value="<?php echo $key; ?>" />
              <?php
            }
            else {
              ?>
              <span class="bwg_slideshow_image_second_span" id="image_id_<?php echo $i; ?>">
                <span class="bwg_slideshow_image_span1">
                  <span class="bwg_slideshow_image_span2">
                    <a href="<?php if(isset($href_array[$i])) echo $href_array[$i]; ?>" ><img id="bwg_slideshow_image_second" class="bwg_slideshow_image" src="<?php echo $image_row; ?>" /></a>
                  </span>
                </span>
              </span>
              <?php
            }
			$i++;
          }
          ?>
            </div>
          </div>
        </div>
        <?php
          if (isset($enable_slideshow_ctrl) && $enable_slideshow_ctrl) {
            ?>
          <a id="spider_slideshow_left" href="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data);"><span id="spider_slideshow_left-ico"><span><i class="bwg_slideshow_prev_btn fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-left"></i></span></span></a>
          <span id="bwg_slideshow_play_pause"><span><span id="bwg_slideshow_play_pause-ico"><i class="bwg_ctrl_btn bwg_slideshow_play_pause fa fa-play"></i></span></span></span>
          <a id="spider_slideshow_right" href="javascript:bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data);"><span id="spider_slideshow_right-ico"><span><i class="bwg_slideshow_next_btn fa <?php echo $theme_row->slideshow_rl_btn_style; ?>-right"></i></span></span></a>
          <?php }   ?>
      </div>
	
	
	
	<!--################ TITLE ################## -->
      <div class="bwg_slideshow_image_container" style="position: absolute;">
        <div class="bwg_slideshow_title_container">
          <div style="display:table; margin:0 auto;">
            <span class="bwg_slideshow_title_span">
				<div class="bwg_slideshow_title_text" >
					<?php echo $title_array[0]; ?>
			   </div>
            </span>
          </div>
        </div>
      </div>

	  <!--################ DESCRIPTION ################## -->
      <div class="bwg_slideshow_image_container" style="position: absolute;">
        <div class="bwg_slideshow_title_container">
          <div style="display:table; margin:0 auto;">
            <span class="bwg_slideshow_description_span">
              <div class="bwg_slideshow_description_text">
                <?php echo $textarea_array[0]; ?>        
			  </div>
            </span>
          </div>
        </div>
      </div>
    </div>
   </div>
  </div>
</div>
<?php


$news_magazine_js_parameters=array(
	"pausetime"    =>get_theme_mod('ct_pause_time','4000'),
	"speed"        =>get_theme_mod('ct_anim_speed','500'),
	"pausehover"   =>get_theme_mod('ct_pause_on_hover',false),
	"effect"       =>trim(get_theme_mod('ct_effect','random')),
	"height"       =>get_theme_mod('ct_slider_height','400'),
	"widt_standart"=>1024
);

news_magazine_slideshow_java_script($news_magazine_js_parameters); ?>

<!--SLIDESHOW END-->

<?php }

}

function news_magazine_top_posts(){

global $news_magazine_home_page,$news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value ) 
{
    if ( get_theme_mod( $value['id'] ) === FALSE ) 
	{ 
	   $$value['var_name'] = $value['std']; 
	} else {
   	   $$value['var_name'] = get_theme_mod( $value['id'] ); 
	}
}
foreach ($news_magazine_home_page->options_homepage as $value) 
{
	if(isset($value['id']))
	{
		if (get_theme_mod( $value['id'] ) === FALSE)
		{
			 $$value['var_name'] = $value['std']; 
		} 
		else { 		
			$$value['var_name'] = get_theme_mod( $value['id'] );
		}	
	}
}
if(isset($blog_style) && $blog_style=="on") 
{ ?>								
   <style>
	 #top-posts-list li div.image-block img{
		height: 180px !important;
		width: 250px;
	 }
   </style>
<?php }   

if ($hide_top_posts=='on' && is_home()) {	
                
$news_magazine_query = new WP_Query('posts_per_page='.$top_post_count.'&cat='.$top_post_categories.'&orderby=date');				
if($news_magazine_query->have_posts()) { ?>
	<div  id="top-posts"  class="content-inner-block">
		<ul id="top-posts-list">				
		 <?php
			while ($news_magazine_query->have_posts()) 
			{						
				$news_magazine_query->the_post(); ?>
				
			<li>
			   <div class="image-block">
					<?php if($grab_image && $date_enable){
					   echo news_magazine_posted_on_blog();
					 } ?>	
					<a href="<?php the_permalink(); ?>">
					<?php if($grab_image)
						   {
							echo news_magazine_display_thumbnail(240,182); 
						   }
						   else 
						   {
							echo news_magazine_thumbnail(240,182);
						   } ?>
					</a>
			   </div>							
			   <div class="text">
					<a href="<?php the_permalink(); ?>">
						<h3 class="heading"><?php the_title(); ?></h3>
					</a>	
						<p><?php news_magazine_the_excerpt_max_charlength(250); ?></p>
			   </div>					
			</li>
			<?php }  ?>					
		</ul>
	</div>
			
	<?php } } wp_reset_postdata();
}

function news_magazine_favicon_img(){

global $news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value )
 {
	if(isset($value['id']))
	{		
		if ( get_theme_mod( $value['id'] ) === FALSE )
		{
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}		
	}
}

if($favicon_enable=='on' && $favicon_img)
{ ?>
	<link rel="shortcut icon" href="<?php if(trim($favicon_img)) echo esc_url($favicon_img);?>" type="image/x-icon" />
	<?php  
}
}

function news_magazine_ftricons(){

global  $news_magazine_general_settings_page;
foreach ( $news_magazine_general_settings_page->options_generalsettings as $value ) {
	if(isset($value['id'])){
		if ( get_theme_mod( $value['id'] ) === FALSE ) {
		   $$value['var_name'] = $value['std']; 
		} 
		else {
		   $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}
}
?>

 <a  <?php if( $show_facebook_icon=='' || $facebook_url == "" ){ echo "style=\"display:none;\""; } ?> href="<?php if( trim($facebook_url) ) { echo esc_url($facebook_url);} else { echo "javascript:;";}?>"  target="_blank" title="Facebook">
	<img src="<?php  echo get_template_directory_uri('template_url'); ?>/images/Facebook-icon.png" width="45" height="45" alt="" />
 </a>
 <a <?php if( $show_twitter_icon=='' || $twitter_url == ""){ echo "style=\"display:none;\""; } ?> href="<?php if( trim($twitter_url) ){ echo esc_url($twitter_url);} else { echo "javascript:;";}?>" target="_blank" title="Twitter">
	<img src="<?php  echo get_template_directory_uri('template_url'); ?>/images/twitter_icon.png" width="45" height="45" alt="" />
 </a>
 <a <?php if( $show_rss_icon=='' || $rss_url == "" ) { echo "style=\"display:none;\""; } ?>  href="<?php if( trim($rss_url) ) { echo esc_url($rss_url);} else { echo "javascript:;";}?>" target="_blank" title="Rss">
	<img src="<?php  echo get_template_directory_uri('template_url'); ?>/images/rss-icon.png" width="45" height="45" alt="" />
 </a>
<?php
}


function news_magazine_nav_link( ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="navigation" role="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'news_magazine' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'news_magazine' ) ); ?></div>
		</nav>
	<?php endif;
}

function news_magazine_slideshow_java_script($news_magazine_js_parameters){
?>
<script type="text/javascript">
	var bwg_transition_duration = <?php echo $news_magazine_js_parameters["speed"];?>;
	// For browsers that does not support transitions.
	function bwg_fallback(current_image_class, next_image_class, direction) {
		bwg_<?php echo $news_magazine_js_parameters["effect"];?>(current_image_class, next_image_class, direction);		
	}
	
	function bwg_<?php echo $news_magazine_js_parameters["effect"];?>(current_image_class, next_image_class, direction) {	
		if (bwg_testBrowser_cssTransitions()) {
		  jQuery(next_image_class).css('transition', 'opacity ' + bwg_transition_duration + 'ms linear');
		  jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
		  jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		}
		else {
		  jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, bwg_transition_duration);
		  jQuery(next_image_class).animate({
			  'opacity' : 1,
			  'z-index': 2
			});
		  // For IE.
		  jQuery(current_image_class).fadeTo(bwg_transition_duration, 0);
		  jQuery(next_image_class).fadeTo(bwg_transition_duration, 1);
		}
	}	

     var bwg_trans_in_progress = false;
     
      var bwg_playInterval;
      // Stop autoplay.
      clearInterval(bwg_playInterval);

      var bwg_current_key = 0;
      var bwg_current_filmstrip_pos = 0;
      // Set filmstrip initial position.
      function bwg_set_filmstrip_pos(filmStripWidth) {
        var selectedImagePos = -bwg_current_filmstrip_pos - (jQuery(".bwg_slideshow_filmstrip_thumbnail").width() + 2) / 2;
        var imagesContainerLeft = Math.min(0, Math.max(filmStripWidth - jQuery(".bwg_slideshow_filmstrip_thumbnails").width(), selectedImagePos + filmStripWidth / 2));
        jQuery(".bwg_slideshow_filmstrip_thumbnails").animate({
            left: imagesContainerLeft
          }, {
            duration: 500,
            complete: function () { bwg_filmstrip_arrows(); }
          });
      }
      function bwg_move_filmstrip() {
        var image_left = jQuery(".bwg_slideshow_thumb_active").position().left;
        var image_right = jQuery(".bwg_slideshow_thumb_active").position().left + jQuery(".bwg_slideshow_thumb_active").outerWidth(true);
        var bwg_filmstrip_width = jQuery(".bwg_slideshow_filmstrip").outerWidth(true);
        var long_filmstrip_cont_left = jQuery(".bwg_slideshow_filmstrip_thumbnails").position().left;
        var long_filmstrip_cont_right = Math.abs(jQuery(".bwg_slideshow_filmstrip_thumbnails").position().left) + bwg_filmstrip_width;
        if (image_left < Math.abs(long_filmstrip_cont_left)) {
          jQuery(".bwg_slideshow_filmstrip_thumbnails").animate({
            left: -image_left
          }, {
            duration: 500,
            complete: function () { bwg_filmstrip_arrows(); }
          });
        }
        else if (image_right > long_filmstrip_cont_right) {
          jQuery(".bwg_slideshow_filmstrip_thumbnails").animate({
            left: -(image_right - bwg_filmstrip_width)
          }, {
            duration: 500,
            complete: function () { bwg_filmstrip_arrows(); }
          });
        }
      }
      // Show/hide filmstrip arrows.
      function bwg_filmstrip_arrows() {
        if (jQuery(".bwg_slideshow_filmstrip_thumbnails").width() < jQuery(".bwg_slideshow_filmstrip").width()) {
          jQuery(".bwg_slideshow_filmstrip_left").hide();
          jQuery(".bwg_slideshow_filmstrip_right").hide();
        }
        else {
          jQuery(".bwg_slideshow_filmstrip_left").show();
          jQuery(".bwg_slideshow_filmstrip_right").show();
        }
      }

      function bwg_testBrowser_cssTransitions() {
        return bwg_testDom('Transition');
      }
      function bwg_testBrowser_cssTransforms3d() {
        return bwg_testDom('Perspective');
      }
      function bwg_testDom(prop) {
        // Browser vendor CSS prefixes.
        var browserVendors = ['', '-webkit-', '-moz-', '-ms-', '-o-', '-khtml-'];
        // Browser vendor DOM prefixes.
        var domPrefixes = ['', 'Webkit', 'Moz', 'ms', 'O', 'Khtml'];
        var i = domPrefixes.length;
        while (i--) {
          if (typeof document.body.style[domPrefixes[i] + prop] !== 'undefined') {
            return true;
          }
        }
        return false;
      }
      function bwg_cube(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
		// If browser does not support 3d transforms/CSS transitions.
        if (!bwg_testBrowser_cssTransitions()) {
          return bwg_fallback(current_image_class, next_image_class, direction);
        }
        if (!bwg_testBrowser_cssTransforms3d()) {
          return bwg_fallback3d(current_image_class, next_image_class, direction);
        }
        bwg_trans_in_progress = true;
        jQuery(".bwg_slide_bg").css('perspective', 1000);
        jQuery(current_image_class).css({
          transform : 'translateZ(' + tz + 'px)',
          backfaceVisibility : 'hidden'
        });
        jQuery(next_image_class).css({
          opacity : 1,
          backfaceVisibility : 'hidden',
          transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
        });
        jQuery(".bwg_slider").css({
          transform: 'translateZ(-' + tz + 'px)',
          transformStyle: 'preserve-3d'
        });
        // Execution steps.
        setTimeout(function () {
          jQuery(".bwg_slider").css({
            transition: 'all ' + bwg_transition_duration + 'ms ease-in-out',
            transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
          });
        }, 20);
        // After transition.
        jQuery(".bwg_slider").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));
        function bwg_after_trans() {
          jQuery(current_image_class).removeAttr('style');
          jQuery(next_image_class).removeAttr('style');
          jQuery(".bwg_slider").removeAttr('style');
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          bwg_trans_in_progress = false;
        }
      }
      function bwg_cubeH(current_image_class, next_image_class, direction) {
        // Set to half of image width.
        var dimension = jQuery(current_image_class).width() / 2;
        if (direction == 'right') {
          bwg_cube(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          bwg_cube(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
        }
      }
      function bwg_cubeV(current_image_class, next_image_class, direction) {
        // Set to half of image height.
        var dimension = jQuery(current_image_class).height() / 2;
        // If next slide.
        if (direction == 'right') {
          bwg_cube(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
        }
        else if (direction == 'left') {
          bwg_cube(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
        }
      }
      // For browsers that does not support transitions.
      function bwg_fallback(current_image_class, next_image_class, direction) {
	  
        bwg_(current_image_class, next_image_class, direction);
      }
      // For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).
      function bwg_fallback3d(current_image_class, next_image_class, direction) {
        bwg_sliceV(current_image_class, next_image_class, direction);
      }
      function bwg_none(current_image_class, next_image_class, direction) {
        jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
        jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
      }
      function bwg_(current_image_class, next_image_class, direction) {
		
        if (bwg_testBrowser_cssTransitions()) {
          jQuery(next_image_class).css('transition', 'opacity ' + bwg_transition_duration + 'ms linear');
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
        }
        else {
          jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, bwg_transition_duration);
          jQuery(next_image_class).animate({
              'opacity' : 1,
              'z-index': 2
            });
          // For IE.
          jQuery(current_image_class).fadeTo(bwg_transition_duration, 0);
          jQuery(next_image_class).fadeTo(bwg_transition_duration, 1);
        }
      }
      function bwg_grid(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
        // If browser does not support CSS transitions.
        if (!bwg_testBrowser_cssTransitions()) {
          return bwg_fallback(current_image_class, next_image_class, direction);
        }
        bwg_trans_in_progress = true;
        // The time (in ms) added to/subtracted from the delay total for each new gridlet.
        var count = (bwg_transition_duration) / (cols + rows);
        // Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)
        function bwg_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
          var delay = (c + r) * count;
          // Return a gridlet elem with styles for specific transition.
          return jQuery('<div class="bwg_gridlet" />').css({
            width : width,
            height : height,
            top : top,
            left : left,
            backgroundImage : 'url("' + src + '")',
            backgroundColor: jQuery(".bwg_slideshow_image_wrap").css("background-color"),
            /*backgroundColor: rgba(0, 0, 0, 0),*/
            backgroundRepeat: 'no-repeat',
            backgroundPosition : img_left + 'px ' + img_top + 'px',
            backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
            transition : 'all ' + bwg_transition_duration + 'ms ease-in-out ' + delay + 'ms',
            transform : 'none'
          });
        }
        // Get the current slide's image.
        var cur_img = jQuery(current_image_class).find('img');
        // Create a grid to hold the gridlets.
        var grid = jQuery('<div />').addClass('bwg_grid');
        // Prepend the grid to the next slide (i.e. so it's above the slide image).
        jQuery(current_image_class).prepend(grid);
        // vars to calculate positioning/size of gridlets
        var cont = jQuery(".bwg_slide_bg");
        var imgWidth = cur_img.width();
        var imgHeight = cur_img.height();
        var contWidth = cont.width(),
            contHeight = cont.height(),
            imgSrc = cur_img.attr('src'),//.replace('/thumb', ''),
            colWidth = Math.floor(contWidth / cols),
            rowHeight = Math.floor(contHeight / rows),
            colRemainder = contWidth - (cols * colWidth),
            colAdd = Math.ceil(colRemainder / cols),
            rowRemainder = contHeight - (rows * rowHeight),
            rowAdd = Math.ceil(rowRemainder / rows),
            leftDist = 0,
            img_leftDist = (jQuery(".bwg_slide_bg").width() - cur_img.width()) / 2;
        // tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).
        tx = tx === 'auto' ? contWidth : tx;
        tx = tx === 'min-auto' ? - contWidth : tx;
        ty = ty === 'auto' ? contHeight : ty;
        ty = ty === 'min-auto' ? - contHeight : ty;
        // Loop through cols
        for (var i = 0; i < cols; i++) {
          var topDist = 0,
              img_topDst = (jQuery(".bwg_slide_bg").height() - cur_img.height()) / 2,
              newColWidth = colWidth;
          // If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.
          if (colRemainder > 0) {
            var add = colRemainder >= colAdd ? colAdd : colRemainder;
            newColWidth += add;
            colRemainder -= add;
          }
          // Nested loop to create row gridlets for each col.
          for (var j = 0; j < rows; j++)  {
            var newRowHeight = rowHeight,
                newRowRemainder = rowRemainder;
            // If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.
            if (newRowRemainder > 0) {
              add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
              newRowHeight += add;
              newRowRemainder -= add;
            }
            // Create & append gridlet to grid.
            grid.append(bwg_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
            topDist += newRowHeight;
            img_topDst -= newRowHeight;
          }
          img_leftDist -= newColWidth;
          leftDist += newColWidth;
        }
        // Set event listener on last gridlet to finish transitioning.
        var last_gridlet = grid.children().last();
        // Show grid & hide the image it replaces.
        grid.show();
        cur_img.css('opacity', 0);
        // Add identifying classes to corner gridlets (useful if applying border radius).
        grid.children().first().addClass('rs-top-left');
        grid.children().last().addClass('rs-bottom-right');
        grid.children().eq(rows - 1).addClass('rs-bottom-left');
        grid.children().eq(- rows).addClass('rs-top-right');
        // Execution steps.
        setTimeout(function () {
          grid.children().css({
            opacity: op,
            transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
          });
        }, 1);
        jQuery(next_image_class).css('opacity', 1);
        // After transition.
        jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));
        function bwg_after_trans() {
          jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
          jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
          cur_img.css('opacity', 1);
          grid.remove();
          bwg_trans_in_progress = false;
        }
      }
      function bwg_sliceH(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        bwg_grid(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }
      function bwg_sliceV(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'min-auto';
        }
        else if (direction == 'left') {
          var translateY = 'auto';
        }
        bwg_grid(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
      }

      function bwg_slideV(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateY = 'auto';
        }
        else if (direction == 'left') {
          var translateY = 'min-auto';
        }
        bwg_grid(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
      }

      function bwg_slideH(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var translateX = 'min-auto';
        }
        else if (direction == 'left') {
          var translateX = 'auto';
        }
        bwg_grid(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
      }

      function bwg_scaleOut(current_image_class, next_image_class, direction) {
        bwg_grid(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
      }
      
      function bwg_scaleIn(current_image_class, next_image_class, direction) {
        bwg_grid(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
      }

      function bwg_blockScale(current_image_class, next_image_class, direction) {
        bwg_grid(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
      }

      function bwg_kaleidoscope(current_image_class, next_image_class, direction) {
        bwg_grid(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
      }

      function bwg_fan(current_image_class, next_image_class, direction) {
        if (direction == 'right') {
          var rotate = 45;
          var translateX = 100;
        }
        else if (direction == 'left') {
          var rotate = -45;
          var translateX = -100;
        }
        bwg_grid(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
      }

      function bwg_blindV(current_image_class, next_image_class, direction) {
        bwg_grid(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }

      function bwg_blindH(current_image_class, next_image_class, direction) {
        bwg_grid(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
      }
	  
      function bwg_random(current_image_class, next_image_class, direction) {
        var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
        // Pick a random transition from the anims array.
		
        this["bwg_" + anims[Math.floor(Math.random() * anims.length)] + ""](current_image_class, next_image_class, direction);
      }
      
	  function iterator() {
        var iterator = 1;

        return iterator;
      }

	function bwg_change_image(current_key, key, data) {
			
		if (bwg_trans_in_progress) {
		  return;
		}
		var direction = 'right';
		if (bwg_current_key > key) {
		  var direction = 'left';
		}
		else if (bwg_current_key == key) {
		  return;
		}
		
		// Hide previous/next buttons on first/last images.
		if (data[key]) {
		  if (current_key == '-1') { // Filmstrip.
			current_key = jQuery(".bwg_slideshow_thumb_active").children("img").attr("image_key");
		  }
		  else if (current_key == '-2') { // Dots.
			current_key = jQuery(".bwg_slideshow_dots_active").attr("image_key");
		  }

		  // Set active thumbnail.
		  jQuery(".bwg_slideshow_filmstrip_thumbnail").removeClass("bwg_slideshow_thumb_active").addClass("bwg_slideshow_thumb_deactive");
		  jQuery("#bwg_filmstrip_thumbnail_" + key + "").removeClass("bwg_slideshow_thumb_deactive").addClass("bwg_slideshow_thumb_active");
		  jQuery(".bwg_slideshow_dots").removeClass("bwg_slideshow_dots_active").addClass("bwg_slideshow_dots_deactive");
		  jQuery("#bwg_dots_" + key + "").removeClass("bwg_slideshow_dots_deactive").addClass("bwg_slideshow_dots_active");          		 
		  bwg_current_key = key;		  

		  // Change image id, key, title, description.
		  jQuery("#bwg_current_image_key").val(key);
		  jQuery("#bwg_slideshow_image").attr('image_id', data[key]["id"]);
		  		  
		  jQuery(".bwg_slideshow_title_text").html(data[key]["alt"]);
		  jQuery(".bwg_slideshow_description_text").html(data[key]["description"]);
						
		  var current_image_class = "#image_id_" + data[current_key]["id"];
		
		  var next_image_class = "#image_id_" + data[key]["id"];
		  bwg_<?php echo $news_magazine_js_parameters["effect"];?>(current_image_class, next_image_class, direction);
		}
			

		jQuery('.bwg_slideshow_title_text').removeClass('none');
		if(jQuery('.bwg_slideshow_title_text').html()==""){jQuery('.bwg_slideshow_title_text').addClass('none');}
		
		jQuery('.bwg_slideshow_description_text').removeClass('none');
		if(jQuery('.bwg_slideshow_description_text').html()==""){jQuery('.bwg_slideshow_description_text').addClass('none');}
	}
		
     function bwg_popup_resize() {
    
	   //standart chap vor@ voroshvac chi bnav template um
	   
		firstsize=1024;
		var bodyWidth=jQuery(window).width();
		var	parentWidth=jQuery(".bwg_slideshow_image_wrap").parent().width();
		
		//tryuk vor hankarc responsive.js @  ushana body i chap@ verci vochte verevi div i 
		if(parentWidth>bodyWidth){parentWidth=bodyWidth;}
	     var kaificent_for_shoxq=(30/firstsize);
		var str=(<?php echo $news_magazine_js_parameters["height"];?>/firstsize  );	
	

          jQuery(".bwg_slideshow_image_wrap").css({height: ((parentWidth) * str)});
		  jQuery("#slideshow").css({height: ((parentWidth) * str)});
		  jQuery(".slider_contener_for_exklusive").css('border-width',(kaificent_for_shoxq*parentWidth));		 
		  jQuery(".bwg_slideshow_image_wrap > div").css({height: ((parentWidth) * str)});
		  jQuery(".bwg_slideshow_title_container > div").css({height: ((parentWidth) * str)});		
		  jQuery(".bwg_slideshow_image").css({height: ((parentWidth) * str)});						
          jQuery(".bwg_slideshow_image_container").css({width: (parentWidth)});
          jQuery(".bwg_slideshow_image_container").css({height: ((parentWidth) * str)});
          jQuery(".bwg_slideshow_image").css({
            maxWidth: parentWidth,
            maxHeight: ((parentWidth) * str)
          });     
          jQuery(".bwg_slideshow_filmstrip_container").css({width: (parentWidth)});
          jQuery(".bwg_slideshow_filmstrip").css({width: (parentWidth - 40)});
          jQuery(".bwg_slideshow_dots_container").css({width: (parentWidth)});   
      }
	  
      jQuery(document).ready(function () {
		bwg_popup_resize();
		
		jQuery(window).resize(function() {
			bwg_popup_resize();
		});
				
        var bwg_click = jQuery.browser.mobile ? 'touchend' : 'click';

        // Set image container height.
        jQuery(".bwg_slideshow_image_container").height(jQuery(".bwg_slideshow_image_wrap").height() - 0);

        // Set filmstrip initial position.
        bwg_set_filmstrip_pos(jQuery(".bwg_slideshow_filmstrip").width());

        // Play/pause.
        
       function play() {
		   window.clearInterval(bwg_playInterval);
		   /* Play.*/
		   bwg_playInterval = setInterval(function () {
			 var iterator = 1;
			 if (0) {
			   iterator = Math.floor((data.length - 1) * Math.random() + 1);
			 }
			 bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator) % data.length, data)
		   }, '<?php echo $news_magazine_js_parameters["pausetime"];?>');
		 }
		 jQuery(window).focus(function() {
		   if (!jQuery(".bwg_ctrl_btn").hasClass("fa-play")) {
			 play();
		   }
		   var i = 0;
		   jQuery(".bwg_slider").children("span").each(function () {
			 if (jQuery(this).css('opacity') == 1) {
			   jQuery("#bwg_current_image_key").val(i);
			 }
			 i++;
		   });
		 });
		 jQuery(window).blur(function() {
		   window.clearInterval(bwg_playInterval);
		 });

		var pausehover="<?php echo $news_magazine_js_parameters["pausehover"];?>";

		if(pausehover=="true"){
		$("#bwg_slideshow_image_container, .bwg_slideshow_image_container").hover(function(){clearInterval(bwg_playInterval);},function(){play();});
		}

       if (1) {
         play();
         jQuery(".bwg_slideshow_play_pause").attr("title", "Pause");
         jQuery(".bwg_slideshow_play_pause").attr("class", "bwg_ctrl_btn bwg_slideshow_play_pause fa fa-pause");
       }

     });

</script>

<?php
}
?>