<?php


function news_magazine_display_categories_vertical_tabs_html($data=array()){

    $a=wp_remote_get(get_template_directory_uri().'/categories-vertical-tabs/templates/categories-vertical-tabs.htm'); 
	$TEMPLATE=wp_remote_retrieve_body($a);

	//CSS
	$TEMPLATE=str_replace("{containerFloat}",$data["containerFloat"],$TEMPLATE);
	$TEMPLATE=str_replace("{postsCount}",$data["postsCount"],$TEMPLATE);
	$TEMPLATE=str_replace("{visibleTabsCount}",$data["visibleTabsCount"],$TEMPLATE);
	$TEMPLATE=str_replace("{tabsWidth}",$data["tabsWidth"]."%",$TEMPLATE);
	$TEMPLATE=str_replace("{tabsMargin}",($data["tabsWidth"]+1)."%",$TEMPLATE);
	$TEMPLATE=str_replace("{tabsBackground}",$data["tabsBackground"],$TEMPLATE);
	$TEMPLATE=str_replace("{contentWidth}",$data["contentWidth"],$TEMPLATE);
	$TEMPLATE=str_replace("{thumbnailMaxHeight}",$data["thumbnailMaxHeight"],$TEMPLATE);
	
	global $news_magazine_general_settings_page;
	foreach ($news_magazine_general_settings_page->options_generalsettings as $value) 
	{
		if (get_theme_mod( $value['id'] ) === FALSE)
		{
			 $$value['var_name'] = $value['std']; 
		} else {
			 $$value['var_name'] = get_theme_mod( $value['id'] ); 
		}
	}
  
    if(!isset($categoryContentsList))
			   $categoryContentsList='';
	if(!isset($categoryTabsList))
			   $categoryTabsList='';		   
	$postType=$data["postType"];
	//##############################Recent Posts###########################
	if($postType=="recent"){
		$args = array(
		'numberposts' => $data["postsCount"],
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_type' => 'post',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true );

		$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
		$recentList="";
		$tabid=0;
		foreach( $recent_posts as $recent ){
			$tabid++;
			$tabclass="";
			if($tabid=="1"){$tabclass='class="active"';}
			$img=wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]));
			$recentTabsList.= '<li '.$tabclass.'><a href="#'.$tabid.'"><h3>'.$recent["post_title"].'</h3><span class="date">'.$recent["post_date"].'</span></a></li>';
			
		}
		
		$contid=0;
		foreach( $recent_posts as $recent ){
			$contid++;
			$contclass="";
			if($contid=="1"){$contclass='class="active"';}
			$img=wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]));
			$recentContentsList.= '<li '.$contclass.' id="categories-vertical-tabs-content-'.$contid.'"><div class="thumbnail-block"><a class="image-block" href="'.get_permalink($recent["ID"]) .'"><img src="'.$img[0].'" alt='.$recent["post_title"].' /></a></div><div class="text"><a href="'.get_permalink($recent["ID"]) .'"><h3>'.$recent["post_title"].'</h3></a><p>'.$recent["post_content"].'</p></div></li>';
		}
		$TEMPLATE=str_replace("{tabsList}",$recentTabsList,$TEMPLATE);
		$TEMPLATE=str_replace("{contentsList}",$recentContentsList,$TEMPLATE);
		
		wp_reset_query();
	}
	else if($postType=="popular"){##############################Popular Posts##############################################
		wp_reset_query();
		$post=query_posts('meta_key=news_magazine_post_views_count&orderby=>meta_value&numberposts='.$data["postsCount"]);
		$tabid=0;
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$tabid++;
			$tabclass="";
			if($tabid=="1"){$tabclass='class="active"';}
			
			$popularTabsList.= '<li '.$tabclass.'><a href="#'.$tabid.'"><h3>'.strtoupper(get_the_title()).'</h3><span class="date">'.get_the_date().'</span></a></li>';
		endwhile;endif;	
		
		$contid=0;
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$contid++;
			$contclass="";
			if($contid=="1"){$contclass='class="active"';}
			
			
			$popularContentsList.= '<li '.$contclass.' id="categories-vertical-tabs-content-'.$contid.'"><div class="thumbnail-block"><a class="image-block" href="'.get_permalink().'"><img src="'.$url.'" alt="'.get_the_title().'" /></a></div><div class="text"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a><p>'.get_the_content().'</p></div></li>';
		endwhile;endif;	
		
		
		$TEMPLATE=str_replace("{tabsList}",$popularTabsList,$TEMPLATE);
		$TEMPLATE=str_replace("{contentsList}",$popularContentsList,$TEMPLATE);
		wp_reset_query();
	}else if($postType=="random"){//#############################Random Posts##############################################
	
	$post = query_posts('orderby=rand&numberposts='.$data["postsCount"]);
	$tabid=0;
	if ( have_posts() ) : while ( have_posts() ) : the_post();
			$tabid++;
			$tabclass="";
			if($tabid=="1"){$tabclass='class="active"';}
			$randomTabsList.= '<li '.$tabclass.'><a href="#'.$tabid.'"><h3>'.strtoupper(get_the_title()).'</h3><span class="date">'.get_the_date().'</span></a></li>';
			
	endwhile;endif;

	$contid=0;
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$contid++;
		$contclass="";
		if($contid=="1"){$contclass='class="active"';}
		
		$randomContentsList.= '<li '.$contclass.' id="categories-vertical-tabs-content-'.$contid.'"><div class="thumbnail-block"><a class="image-block" href="'.get_permalink().'"><img src="'.$url.'" alt="'.get_the_title().'" /></a></div><div class="text"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a><p>'.get_the_content().'</p></div></li>';	 
	endwhile;endif;
	
	wp_reset_query();
	
	$TEMPLATE=str_replace("{tabsList}",$randomTabsList,$TEMPLATE);
	$TEMPLATE=str_replace("{contentsList}",$randomContentsList,$TEMPLATE);
	
	}else if($postType=="category"){
	
	
	//#############################CATEGORY##############################################
		
		global $post;
		wp_reset_query();
		$magazine_query=new WP_Query('showposts='.$data["postsCount"].'&cat='.$data["categoryID"]);
		$tabid=0;
		if ( have_posts() ) : while ( $magazine_query->have_posts() ) : $magazine_query->the_post();
			$tabid++;
			$tabclass="";
			if($tabid=="1"){$tabclass='class="active"';}
			if(!isset($categoryTabsList))
			   $categoryTabsList='';
			$categoryTabsList.= '<li '.$tabclass.'><a href="#'.$tabid.'"><h3>'.strtoupper(get_the_title()).'</h3><span class="date">'.get_the_date().'</span></a></li>';
			
		endwhile;endif;
		
		$contid=0;
		if ( have_posts() ) : while ( $magazine_query->have_posts() ) : $magazine_query->the_post();
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$img_url = wp_get_attachment_url( get_post_thumbnail_id() );
			$contid++;
			$contclass="";
			if($contid=="1"){$contclass='class="active"';}
			if(!isset($categoryContentsList))
			   $categoryContentsList='';
			$categoryContentsList.= '<li '.$contclass.' id="categories-vertical-tabs-content-'.$contid.'">';
			if(has_post_thumbnail())
				$categoryContentsList.='<div class="thumbnail-block"><a class="image-block" href="'.get_permalink().'"><div class="post-thumbnail-div">
						  <div class="post-thumbnail" style="background-image:url('.$img_url.');">
							
						  </div>
					 </div></a></div>';
		    if($blog_style=="on")	  	 
			  $categoryContentsList.='<div class="text"><p>'.get_the_excerpt('').'</p></div>';
			else
			  $categoryContentsList.='<div class="text"><p>'.get_the_content('').'</p></div>';
			$categoryContentsList.='<div class="tabs-more"><a class="tab-more" href="'.get_permalink().'">'. __('More Information','news_magazine') . '</a><div class="sitemap-arrow tab-arrow">
									<div class="arrow-left"></div>
									<div class="arrow-right"></div>
						   </div>
						  </div>
						 </li>';		
		endwhile;endif;
		
	}
	$TEMPLATE=str_replace("{tabsList}",$categoryTabsList,$TEMPLATE);
	$TEMPLATE=str_replace("{contentsList}",$categoryContentsList,$TEMPLATE);
	
	return $TEMPLATE;
}
?>