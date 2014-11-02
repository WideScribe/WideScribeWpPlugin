<?php

class news_magazine_color_control_page_class{
	
	public $colorcontrol;
	public $shortcolorcontrol;
	public $options_colorcontrol;
	
	
	
	
	
	
	function __construct(){
		global $news_magazine_special_id_for_db;
		add_action( 'customize_preview_init', array($this,'web_bussines_customize_preview_js') );
		
		$this->colorcontrol = "Color Control";
		$this->shortcolorcontrol = $news_magazine_special_id_for_db."cc";
		
		
		$value_of_std[0]=get_theme_mod($this->shortcolorcontrol."_menu_elem_back_color",'#FFFFFF');
		$value_of_std[1]=get_theme_mod($this->shortcolorcontrol."_slider_back_color",'#F9F9F9');
		$value_of_std[2]=get_theme_mod($this->shortcolorcontrol."_content_back_color",'#FFFFFF');
		$value_of_std[3]=get_theme_mod($this->shortcolorcontrol."_sideb_background_color",'#FFFFFF');
		$value_of_std[4]=get_theme_mod($this->shortcolorcontrol."_footer_back_color",'#EFEFEF');
		$value_of_std[5]=get_theme_mod($this->shortcolorcontrol."_footer_sidebar_back_color",'#F9F9F9');
		$value_of_std[6]=get_theme_mod($this->shortcolorcontrol."_borders_color",'#0071A0');
		$value_of_std[7]=get_theme_mod($this->shortcolorcontrol."_top_posts_color",'#FFFFFF');
		$value_of_std[8]=get_theme_mod($this->shortcolorcontrol."_text_headers_color",'#000000');
		$value_of_std[9]=get_theme_mod($this->shortcolorcontrol."_primary_text_color",'#000000');
		$value_of_std[10]=get_theme_mod($this->shortcolorcontrol."_footer_text_color",'#000000');
		$value_of_std[11]=get_theme_mod($this->shortcolorcontrol."_primary_links_color",'#565656');
		$value_of_std[12]=get_theme_mod($this->shortcolorcontrol."_primary_links_hover_color",'#0071A0');
		$value_of_std[13]=get_theme_mod($this->shortcolorcontrol."_menu_links_color",'#000000');
		$value_of_std[14]=get_theme_mod($this->shortcolorcontrol."_menu_links_hover_color",'#0071A0');		
		$value_of_std[15]=get_theme_mod($this->shortcolorcontrol."_menu_color",'#000000');
		$value_of_std[16]=get_theme_mod($this->shortcolorcontrol."_selected_menu_color",'#FFFFFF');
		$value_of_std[17]=get_theme_mod($this->shortcolorcontrol."_color_scheme",'#E0E0E0');	
		$value_of_std[18]=get_theme_mod($this->shortcolorcontrol."_logo_text_color",'#000000');
		$value_of_std[20]=get_theme_mod($this->shortcolorcontrol."_block_text_color",'#ffffff');
        $value_of_std[21]=get_theme_mod($this->shortcolorcontrol."_slider_text_color",'#ffffff');	
        $value_of_std[22]=get_theme_mod($this->shortcolorcontrol."_meta_info_color",'#8F8F8F');		

		
		$this->options_colorcontrol = array(
		   "menu_elem_back_color" => array(
			
				"name" => "Menu Element Backround Color",
				
				"desc" => "",
				
				"var_name" =>'menu_elem_back_color',

				"id" => $this->shortcolorcontrol . "_menu_elem_back_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[0]
			), 	
			
			 "slider_back_color" => array(
			
				"name" => "Slider Backround Color",
				
				"desc" => "",
				
				"var_name" =>'slider_back_color',

				"id" => $this->shortcolorcontrol . "_slider_back_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[1]
			),

			"slider_text_color" => array(
			
				"name" => "Slider Text Color",
				
				"desc" => "",
				
				"var_name" =>'slider_text_color',

				"id" => $this->shortcolorcontrol . "_slider_text_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[21]
			),
			
		
			 "sideb_background_color" =>  array(
			
				"name" => "Sidebar Background Color",
				
				"desc" => "",
				
				"var_name" =>'sideb_background_color',

				"id" => $this->shortcolorcontrol . "_sideb_background_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[3]
			),	

			 "footer_back_color" =>  array(

				"name" => "Footer Background Color",

				"desc" => "",
				
				"var_name" =>'footer_back_color',

				"id" => $this->shortcolorcontrol . "_footer_back_color",

				"type" => "picker",

				"std" => $value_of_std[4]
				),
				
			"footer_sidebar_back_color" =>  array(

				"name" => "Footer Sidebar Background Color",

				"desc" => "",
				
				"var_name" =>'footer_sidebar_back_color',

				"id" => $this->shortcolorcontrol . "_footer_sidebar_back_color",

				"type" => "picker",

				"std" => $value_of_std[5]
				),
				
			 "borders_color" =>  array(

				"name" => "Highlight Color",

				"desc" => "",
				
				"var_name" =>'borders_color',

				"id" => $this->shortcolorcontrol . "_borders_color",

				"type" => "picker",

				"std" => $value_of_std[6]
				),

			"block_text_color" =>  array(
			
				"name" => "Highlight Font Color",
				
				"desc" => "",
				
				"var_name" =>'block_text_color',

				"id" => $this->shortcolorcontrol . "_block_text_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[20]
			),	
				
			 "top_posts_color" =>  array(

				"name" => "Top Posts Background Color",

				"desc" => "",
				
				"var_name" =>'top_posts_color',

				"id" => $this->shortcolorcontrol . "_top_posts_color",

				"type" => "picker",

				"std" => $value_of_std[7]
				),	
				
			 "text_headers_color" =>  array(

				"name" => "Header Text Color",

				"desc" => "",
				
				"var_name" =>'text_headers_color',

				"id" => $this->shortcolorcontrol . "_text_headers_color",

				"type" => "picker",

				"std" => $value_of_std[8]
			),	

			

			 "primary_text_color" =>  array(

				"name" => "Primary Text Color",

				"desc" => "",
				
				"var_name" =>'primary_text_color',

				"id" => $this->shortcolorcontrol . "_primary_text_color",

				"type" => "picker",

				"std" => $value_of_std[9]
			),
			
			 "footer_text_color" =>  array(

				"name" => "Footer Text Color",

				"desc" => "",
				
				"var_name" =>'footer_text_color',

				"id" => $this->shortcolorcontrol . "_footer_text_color",

				"type" => "picker",

				"std" => $value_of_std[10]
			),

			

			 "primary_links_color" =>  array(

				"name" => "Primary Links",

				"desc" => "",
				
				"var_name" =>'primary_links_color',

				"id" => $this->shortcolorcontrol . "_primary_links_color",

				"type" => "picker",

				"std" => $value_of_std[11]
			),

			 "primary_links_hover_color" =>  array(

				"name" => "Primary Links Hover",

				"desc" => "",
				
				"var_name" =>'primary_links_hover_color',

				"id" => $this->shortcolorcontrol . "_primary_links_hover_color",

				"type" => "picker",

				"std" => $value_of_std[12]
			),

			 "menu_links_color" =>  array(

				"name" => "Menu Links",

				"desc" => "",
				
				"var_name" =>'menu_links_color',

				"id" => $this->shortcolorcontrol . "_menu_links_color",

				"type" => "picker",

				"std" => $value_of_std[13]
			),

			 "menu_links_hover_color" =>  array(

				"name" => "Menu Links Hover",

				"desc" => "",
				
				"var_name" =>'menu_links_hover_color',

				"id" => $this->shortcolorcontrol . "_menu_links_hover_color",

				"type" => "picker",

				"std" => $value_of_std[14]
			),			
			

			 "menu_color" =>  array(

				"name" => "Hover Menu Item",

				"desc" => "",
				
				"var_name" =>'menu_color',

				"id" => $this->shortcolorcontrol . "_menu_color",

				"type" => "picker",

				"std" => $value_of_std[15]
			),
			
			 "selected_menu_color" =>  array(

				"name" => "Selected Menu Item",

				"desc" => "",
				
				"var_name" =>'selected_menu_color',

				"id" => $this->shortcolorcontrol . "_selected_menu_color",

				"type" => "picker",

				"std" => $value_of_std[16]
			),

			 "color_scheme" =>  array(
			
				"name" => " ",
				
				"var_name" =>'color_scheme',

				"id" => $this->shortcolorcontrol . "_color_scheme",
				
				"type" => "",
				
				"std" => $value_of_std[17]
			),
			
			 "logo_text_color" =>  array(
			
				"name" => "Logo Text Color ",
				
				"desc" => "",
				
				"var_name" =>'logo_text_color',

				"id" => $this->shortcolorcontrol . "_logo_text_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[18]
			),
			
			 "meta_info_color" =>  array(
			
				"name" => "Meta Information Text Color ",
				
				"desc" => "",
				
				"var_name" =>'meta_info_color',

				"id" => $this->shortcolorcontrol . "_meta_info_color",
				
				"type" => "picker",
				
				"std" => $value_of_std[22]
			)
			
		);
		
	
	}
	
	public function web_bussines_customize_preview_js() {
	wp_enqueue_script( 'magazine_new-customizerfunction', get_template_directory_uri() . '/scripts/theme-customizerfunctions.js' );
	 	wp_enqueue_script( 'magazine_new-customizer', get_template_directory_uri() . '/scripts/theme-customizer.js', array( 'customize-preview' ) , '20130916', true );
	?><script>curent_template_url='<?php echo get_template_directory_uri();  ?>'</script><?php
	}
	
	
	/// save changes or reset options
	public function web_dorado_theme_update_and_get_options_color_control(){
		
		if ( isset($_GET['page']) && $_GET['page'] == "news_magazine_theme" && isset($_GET['controller']) && $_GET['controller'] == "color_control_page") {

			if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'save' ) {
				foreach ($this->options_colorcontrol as $value) {
					set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);

				}
				foreach ($this->options_colorcontrol as $value) {
					if (isset($_REQUEST[$value['var_name']])) {
						set_theme_mod($value['id'], $_REQUEST[$value['var_name']]);
					} else {
						remove_theme_mod($value['id']);
					}
				}
				header("Location: themes.php?page=news_magazine_theme&controller=color_control_page&saved=true");
				die;
			} else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset' ) {
				foreach ($this->options_colorcontrol as $value) {
					remove_theme_mod($value['id']);
				}
				header("Location: themes.php?page=news_magazine_theme&controller=color_control_page&reset=true");
				die;
			}
		}	
	}
	
	public function web_dorado_color_control_page_admin_scripts(){

		wp_enqueue_style('color_control_page_main_style',get_template_directory_uri('template_directory').'/admin/css/color_control.css');	
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
		

	}
	
	public function update_color_control(){

//for update global options
global $news_magazine_color_control_page;

foreach ($news_magazine_color_control_page->options_colorcontrol as $value) {
     $$value['var_name'] = $value['std']; 
}
$background_color = get_background_color();
$background_image=get_background_image();
?>
 <style type="text/css">

h1, h2, h3, h4, h5, h6, h1>a, h2>a, h3>a, h4>a, h5>a, h6>a,h1 > a:link, h2 > a:link, h3 > a:link, h4 > a:link, h5 > a:link, h6 > a:link,h1 > a:hover,h2 > a:hover,h3 > a:hover,h4 > a:hover,h6 > a:hover,h1> a:visited,h2 > a:visited,h3 > a:visited,h4 > a:visited,h5 > a:visited,h6 > a:visited {
    color:<?php echo $text_headers_color; ?>;
}

h2.page-header{
	border-bottom: 2px solid <?php echo $text_headers_color; ?>;
}

h3.most-categories-header{
	border-bottom: 2px solid <?php echo $borders_color; ?>;
}

h3.most-categories-header a{
	color:<?php echo $borders_color; ?>;
	background:#<?php echo $background_color; ?> !important;
}

#slideshow{
    background-color:<?php echo $slider_back_color; ?>;
}
.bwg_slideshow_description_text,.bwg_slideshow_description_text *,.bwg_slideshow_title_text *{
    color:<?php echo $slider_text_color; ?>;
}

#back h3 a{
	color: <?php echo '#'.$this->negativeColor(news_magazine_ligthest_brigths($menu_elem_back_color, 10)); ?> !important;
}
a:link.site-title-a,a:hover.site-title-a,a:visited.site-title-a,a.site-title-a{
	color:<?php echo $logo_text_color;?>;
}

 .more-link{ 
	color:<?php echo $menu_links_color;?> !important;
}

#back {
     background-color: <?php echo '#'.news_magazine_ligthest_brigths($menu_elem_back_color, 10); ?>;
}

#header-block,#header .phone-menu-block.phone{
	background-color:<?php echo $menu_color; ?>;
}

#footer-bottom{
	background-color:<?php echo $footer_back_color; ?>;
}

#footer{
    background-color:<?php echo $footer_sidebar_back_color; ?>;
}

.container.device {
    background-color: <?php echo $footer_back_color; ?>;
}

body{
	color: <?php echo $primary_text_color; ?>;
}
#wrapper{
    color: <?php echo $primary_text_color; ?>;
}

.container.device,#footer-bottom {
    color: <?php echo $footer_text_color; ?>;
}

a:link, a:visited {
    text-decoration: none;
    color: <?php echo $primary_links_color; ?>;
}

 .top-nav-list .current-menu-item{
    color: <?php echo $menu_links_hover_color; ?> !important;
	background-color: <?php echo  $selected_menu_color; ?>;
}

a:hover {
    color: <?php echo $primary_links_hover_color; ?>;
}

.get_title{
	background-color:<?php echo $menu_color; ?>;
	background-image:url(<?php get_template_directory_uri(); ?>/images/Shado.png);
	background-position: bottom;
	background-repeat: no-repeat;
}

.top-nav-list li:hover {
    background-color: <?php echo $menu_color; ?> !important;
}
.top-nav-list li.current-menu-item, .top-nav-list li.current_page_item, .top-nav-list.phone   li ul li:hover  > a,.top-nav-list.phone   li ul li  > a:hover, .top-nav-list.phone   li ul li  > a:focus, .top-nav-list.phone   li ul li  > a:active,  .top-nav-list.phone  li.current-menu-item > a:hover,.phone #top-nav-list > li ul li.current-menu-item,.phone #top-nav-list > li ul li.current_page_item{
    color:<?php echo $primary_links_hover_color ?>;
	background-color: <?php echo $selected_menu_color; ?> ;
}
.top-nav-list li.current-menu-item> a, .top-nav-list li.current_page_item >a,#top-nav-list li.current-menu-item >a, #top-nav-list li.current_page_item >a{
	color: <?php echo $menu_links_hover_color; ?>;
}


.image-block .post-date, #wd-categories-vertical-tabs ul.tabs li.active, #wd-categories-vertical-tabs ul.tabs li:hover,a.read_more:visited,a.read_more:link,.read_more, .more-link ,#searchsubmit, a .page-links-number, .post-password-form input[type="submit"], .more-link {
    background-color:<?php echo $borders_color; ?>;
	color:<?php echo $block_text_color; ?>;
}
::selection{
    background-color:<?php echo $borders_color; ?>;
	color:<?php echo $block_text_color; ?>;
}

#wd-categories-vertical-tabs ul.tabs li:hover h3,#wd-categories-vertical-tabs ul.tabs li:hover span{
    color:<?php echo $block_text_color; ?>;
}

#wd-categories-vertical-tabs  ul.tabs li.active a h3,#wd-categories-vertical-tabs  ul.tabs li.active a span {
	color:<?php echo $block_text_color; ?>;
}

#top-posts-list li, #latest-news, .post-date + img{
	border-top: 2px solid <?php echo $borders_color; ?>;
}

.sidebar-container   .widget-area ul li:before, .news_categories ul li:before {
	border-left: solid <?php echo $borders_color; ?>;
	border-width: 6px;
}

.phone-menu-block.phone:before  {	
	border-left: solid <?php echo $menu_links_hover_color; ?>;
	border-width:9px;
}

.arrow-left{
	border: 2px solid <?php echo $borders_color; ?>;
}

.arrow-right{
   	border-left: 5px solid <?php echo $borders_color; ?>;
}

#menu-button-block{
   	border-left: 3px solid <?php echo $menu_links_hover_color; ?>;
}

#search-input::-webkit-input-placeholder, #search-input, .widget-area > h3, .widget-area >h2,.sep, .sitemap h3,.comment-author .fn, .tab-more,#latest-news + .page-navigation a{
	color:<?php echo $borders_color; ?> !important;
}

.widget-area> h3, .widget-area> h2 {
	border-bottom:2px solid <?php echo $borders_color; ?>;
	color:<?php echo $borders_color; ?> !important;
}

#top-nav {
   background:<?php echo $menu_elem_back_color; ?>;
}


#commentform #submit,.reply,#reply-title small{
	    background-color: <?php echo $borders_color; ?>;
		 color:<?php echo $block_text_color;?>;
}

.reply a, #reply-title small a{
		 color:<?php echo $block_text_color;?>;
}

#top-nav-list > li ul, .top-nav-list > ul > li ul{
	background:<?php echo $this->hex_to_rgba($menu_color,0.7); ?>;
}
.phone #top-nav > div > ul li ul{
   background:<?php echo $menu_color; ?> !important;
}
.phone #top-nav > div > ul,.phone #top-nav > div ul{
   background:<?php echo $menu_elem_back_color; ?> !important;
}
.phone #top-nav{
   background:none !important;
}

h2.page-header a, h2.page-header span{
    background:#<?php echo $background_color; ?> !important;
}

.sidebar-container , #latest-news>h2{
   background-color:<?php echo $sideb_background_color; ?>;
}
.commentlist li {
	  background-color:<?php echo $sideb_background_color; ?>;
}
.children .comment{
	  background-color:#<?php echo news_magazine_ligthest_brigths($sideb_background_color,37); ?>;
}
#respond{
	  background-color:#<?php echo news_magazine_ligthest_brigths($sideb_background_color,37); ?>;
}

.entry-meta *,.entry-meta-cat *{
   color: <?php echo $meta_info_color; ?> !important;
}

#top-nav.phone  > li  > a, #top-nav.phone  > li  > a:link, #top-nav.phone  > li  > a:visitedG581
  {
	color:<?php echo $menu_links_color; ?>;
	background:<?php echo $menu_elem_back_color; ?>;
}
.phone .top-nav-list > li:hover > a ,.phone .top-nav-list  > li  > a:hover, .phone .top-nav-list > li  > a:focus, .phone .top-nav-list > li  > a:active {
	color:<?php echo $menu_links_hover_color; ?> !important;
	background-color:<?php echo $menu_color; ?> !important;
}
#top-posts {  
   background-color:<?php echo $top_posts_color; ?>;
}

.top-nav-list.phone   li ul li  > a, .top-nav-list.phone   li ul li  > a:link, .top-nav-list.phone   li  ul li > a:visited {
	color:<?php echo $menu_links_color ?> !important;
}
#top-nav-list > li > a, .top-nav-list > ul> li > a{
    color:<?php echo $menu_links_color ?>;
}

 #top-nav-list > li ul > li > a, .top-nav-list > li ul > li > a{
    color:<?php echo $menu_links_hover_color ?>;
	border-top:1px solid <?php echo '#'.news_magazine_ligthest_brigths($menu_color,20); ?> !important;	
 }

#top-nav-list > li:hover > a, #top-nav-list > li ul > li > a:hover,.top-nav-list  li:hover  a, .top-nav-list  li ul  li  a:hover,#menu-button-block a, #menu-button-block a:link{
    color:<?php echo $menu_links_hover_color ?>;
}
.phone  .top-nav-list li ul li:hover  > a,.phone .top-nav-list  li ul li  > a:hover, .phone  .top-nav-list li ul li  > a:focus, .phone  .top-nav-list li ul li  > a:active {
	color:<?php echo $menu_links_hover_color; ?> !important;
	background-color:<?php echo $menu_color; ?> !important;
}
.top-nav-list.phone  li.has-sub >  a, .top-nav-list.phone  li.has-sub > a:link, .top-nav-list.phone  li.has-sub >  a:visited {
	background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right top no-repeat !important;
}
.top-nav-list.phone  li.has-sub:hover > a,.top-nav-list.phone  li.has-sub > a:hover, .top-nav-list.phone  li.has-sub > a:focus, .top-nav-list.phone  li.has-sub >  a:active {
	background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right top no-repeat !important;
}

.top-nav-list.phone  li ul li.has-sub > a, .top-nav-list.phone  li ul li.has-sub > a:link, .top-nav-list.phone  li ul li.has-sub > a:visited{
	background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -18px no-repeat !important;
}
.top-nav-list.phone  li ul li.has-sub:hover > a,.top-nav-list.phone  li ul li.has-sub > a:hover, .top-nav-list.phone  li ul li.has-sub > a:focus, .top-nav-list.phone  li ul li.has-sub > a:active {
	background:<?php echo '#'.news_magazine_ligthest_brigths($menu_elem_back_color,15); ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -18px no-repeat !important;
}
.phone #top-nav-list > li ul li,.phone .top-nav-list> ul > li ul li{
	background-color:<?php echo '#'.news_magazine_ligthest_brigths($menu_color,10); ?>; 
}

.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-item > a:focus, .top-nav-list.phone  li.current-menu-item > a:active{
	color:<?php echo $menu_links_color ?> !important;
	background-color:<?php echo $menu_elem_back_color; ?> !important;
}

.top-nav-list.phone  li.current-menu-item > a,.top-nav-list.phone  li.current-menu-item > a:visited,
{
	color:<?php echo $primary_links_hover_color ?> !important;
	background-color:<?php echo $selected_menu_color; ?> !important;
}

.phone  #top-nav-list  li, .phone #top-nav-list > li ul li,.phone .top-nav-list > li ul li, .phone .top-nav-list  li{
   	border-bottom:1px solid <?php echo $menu_color; ?> !important;
}

.phone #top-nav > div > ul > li.haschild > a:hover, .phone #top-nav > div > ul > li.haschild > a:focus,.phone #top-nav > div > ul > li.haschild > a:active,.phone #top-nav > div > ul > li.haschild.active > a{
	background:url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right bottom no-repeat <?php echo $menu_color; ?> !important;
	background-position-y: -44px !important;
}

.top-nav-list.phone  li.current-menu-parent > a, .top-nav-list.phone  li.current-menu-parent > a:link, .top-nav-list.phone  li.current-menu-parent > a:visited,
.top-nav-list.phone  li.current-menu-parent > a:hover, .top-nav-list.phone  li.current-menu-parent > a:focus, .top-nav-list.phone  li.current-menu-parent > a:active,
.top-nav-list.phone  li.has-sub.current-menu-item  > a, .top-nav-list.phone  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li.has-sub.current-menu-item > a:visited,
.top-nav-list.phone  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li.has-sub.current-menu-item > a:active,
.top-nav-list.phone  li.current-menu-ancestor > a, .top-nav-list.phone  li.current-menu-ancestor > a:link, .top-nav-list.phone  li.current-menu-ancestor > a:visited,
.top-nav-list.phone  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li.current-menu-ancestor > a:active {
	color:<?php echo $menu_links_color ?> !important;
	background:<?php echo $menu_elem_back_color; ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right bottom no-repeat !important;
}
.top-nav-list.phone  li ul  li.current-menu-item > a, .top-nav-list.phone  li ul  li.current-menu-item > a:link, .top-nav-list.phone  li ul  li.current-menu-item > a:visited,
.top-nav-list.phone  li ul  li.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.current-menu-item > a:active{
	color:<?php echo $menu_links_color ?> !important;
	background-color:<?php echo '#'.news_magazine_ligthest_brigths($menu_elem_back_color,15); ?> !important;
}
.top-nav-list.phone li ul  li.current-menu-parent > a, .top-nav-list.phone  li ul  li.current-menu-parent > a:link, .top-nav-list.phone  li ul  li.current-menu-parent > a:visited,
.top-nav-list.phone li ul li.current-menu-parent  > a:hover, .top-nav-list.phone  li ul  li.current-menu-parent > a:focus, .top-nav-list.phone  li ul  li.current-menu-parent > a:active,
.top-nav-list.phone  li ul  li.has-sub.current-menu-item > a, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:link, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:visited,
.top-nav-list.phone  li ul  li.has-sub.current-menu-ancestor > a:hover, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:focus, .top-nav-list.phone  li ul  li.has-sub.current-menu-item > a:active,
.top-nav-list.phone li ul  li.current-menu-ancestor > a, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:link, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:visited,
.top-nav-list.phone li ul li.current-menu-ancestor  > a:hover, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:focus, .top-nav-list.phone  li ul  li.current-menu-ancestor > a:active {
	color:<?php echo $menu_links_color ?> !important;
	background:<?php echo '#'.news_magazine_ligthest_brigths($menu_elem_back_color,15); ?>  url(<?php echo get_template_directory_uri(); ?>/images/arrow.menu.png) right -158px no-repeat !important;
}

#wd-categories-vertical-tabs  ul.tabs li a:focus, #wd-categories-vertical-tabs  ul.tabs li a:active {
	color:<?php echo $block_text_color; ?> !important;
}

#wd-categories-vertical-tabs  ul.tabs li.active  {
	color:{tabsActiveColor};
	background:<?php echo $borders_color; ?>;
}

.phone #wd-categories-vertical-tabs .content-block{
	border-top: 1px solid <?php echo $borders_color; ?>;
}

#wd-categories-vertical-tabs .tabs-block{
	border-right:2px solid <?php echo $borders_color; ?>;
}
.phone #wd-categories-vertical-tabs .tabs-block{
    background-color:<?php echo $borders_color; ?>;
}

    </style>

<?php
}
	private function negativeColor($color)
	{
		//get red, green and blue
		$r = substr($color, 0, 2);
		$g = substr($color, 2, 2);
		$b = substr($color, 4, 2);
		
		//revert them, they are decimal now
		$r = 0xff-hexdec($r);
		$g = 0xff-hexdec($g);
		$b = 0xff-hexdec($b);
		
		//now convert them to hex and return.
		return dechex($r).dechex($g).dechex($b);
	}
	
	public function dorado_theme_admin_color_control(){
		if(isset($_REQUEST['controller']) && $_REQUEST['controller']=='color_control_page'){
			if (isset($_REQUEST['saved']) && $_REQUEST['saved'] ) 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->colorcontrol . ' settings saved.</strong></p></div>';
			
		if (isset($_REQUEST['reset']) && $_REQUEST['reset'] ) 
		
			echo '<div id="message" class="updated"><p><strong>' . $this->colorcontrol . ' settings reset.</strong></p></div>';
		}
		global $news_magazine_admin_helepr_functions;
		$pickers=$this->get_option_type('picker');
		$count_picker=count( $pickers );
		$array_of_colors=array(
							array(
								"menu_elem_back_color" => "#ffffff",
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FFFFFF", 
								"footer_back_color" => "#EFEFEF", 
								"footer_sidebar_back_color" => "#F9F9F9",
								"borders_color" => "#0071A0", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#0071A0", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#0071A0", 
								"menu_color" => "#000000", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							),
							array(
								"menu_elem_back_color" => "#ffffff", 
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FBFBFB", 
								"footer_back_color" => "#EFEFEF", 
								"footer_sidebar_back_color" => "#F9F9F9",
								"borders_color" => "#9F0142", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#9F0142", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#9F0142", 
								"menu_color" => "#ffffff", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							),							
							array(
								"menu_elem_back_color" => "#ffffff", 
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FBFBFB", 
								"footer_back_color" => "#EFEFEF",
								"footer_sidebar_back_color" => "#F9F9F9",								
								"borders_color" => "#470053", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#470053", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#470053", 
								"menu_color" => "#ffffff", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							),
							array(
								"menu_elem_back_color" => "#ffffff", 
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FBFBFB", 
								"footer_back_color" => "#EFEFEF",
								"footer_sidebar_back_color" => "#F9F9F9",
								"borders_color" => "#005816", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#005816", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#005816", 
								"menu_color" => "#ffffff", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							),
							array(
								"menu_elem_back_color" => "#ffffff", 
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FBFBFB", 
								"footer_back_color" => "#EFEFEF", 
								"footer_sidebar_back_color" => "#F9F9F9",
								"borders_color" => "#DAAA10", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#DAAA10", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#DAAA10", 
								"menu_color" => "#ffffff", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							),
							array(
								"menu_elem_back_color" => "#ffffff",
								"slider_back_color" => "#F9F9F9",
								"sideb_background_color" => "#FBFBFB", 
								"footer_back_color" => "#EFEFEF", 
								"footer_sidebar_back_color" => "#F9F9F9",
								"borders_color" => "#DB6710", 
								"top_posts_color" => "#ffffff", 
								"text_headers_color" => "#000000", 
								"primary_text_color" => "#000000", 
								"footer_text_color" => "#000000", 
								"primary_links_color" => "#565656", 
								"primary_links_hover_color" => "#DB6710", 
								"menu_links_color" => "#000000", 
								"menu_links_hover_color" => "#DB6710", 
								"menu_color" => "#ffffff", 
								"selected_menu_color" => "#ffffff", 
								"logo_text_color" => "#000000",
								"block_text_color"=>"#ffffff",
								"meta_info_color"=>"#8F8F8F"
							)
							);
		
		
		
		?><?php $this->default_themes_jquery($array_of_colors) ?>
		
        <?php global $news_magazine_web_dor; ?>
		<div id="main_color_control_page">			
			<table align="center" width="90%" style="margin-top: 0px;border-bottom: rgb(111, 111, 111) solid 2px;">
			    <tr>   
                      <td style="font-size:14px; font-weight:bold">
					     <a href="<?php echo $news_magazine_web_dor.'/wordpress-themes-guide-step-1.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">User Manual</a><br />This section allows you customize the color features.
                         <a href="<?php echo $news_magazine_web_dor.'/wordpress-theme-options/3-6.html'; ?>" target="_blank" style="color:#126094; text-decoration:none;">More...</a>
					 </td>    
                      <td  align="right" style="font-size:16px;">
                           <a href="<?php echo $news_magazine_web_dor.'/wordpress-themes/news-magazine.html'; ?>" target="_blank" style="color:red; text-decoration:none;">
                              <img src="<?php echo get_template_directory_uri() ?>/images/header.png" border="0" alt="" width="215">
                           </a>
                       </td>
                </tr>
				<tr>
					<td style="height: 70px;"><h3 style="margin: 0px;font-family:Segoe UI;color: rgb(111, 111, 111); font-size:18pt;">Color Control</h3></td>
				</tr>
			</table>
		  <div style="margin: 0 auto;width:90%;padding-bottom:0px; padding-top:0px;">		
			<div class="optiontitle" style="">
				  <p style="font-size:15px;font-weight:bold;color: #333;">The color customization parameters are disabled in free version. Please buy the commercial version in order to enable this functionality.</p>
				  <img src="<?php echo get_template_directory_uri(); ?>/images/color.jpg" width="100%" style="border-bottom: 1px solid rgb(206, 206, 206);">
			</div>
	     </div>
</div>	
		 <?php
	}
	
	private function get_option_type($type=''){
	$cur_type_elements=array();
	$k=0;
	foreach( $this->options_colorcontrol as $option ){
		
		if(isset($type) && isset($option['type']) && $option['type'] == $type ){
		
			$cur_type_elements[$k]=$option;
			$k++;
		}
		
	}
	return $cur_type_elements;
	}
	
	
	private function default_themes_jquery($array_of_colors=NULL){
		// print array if it not set
		if($array_of_colors===NULL){
			echo "\$array_of_colors=array(<br>array(<br>";
			foreach($this->options_colorcontrol as $key=>$special_color){
				if($special_color['type']=='picker'){
					echo "	\"".$special_color['var_name']."\" => \"".$special_color['std']."\", <br>";
				}
			}
			echo "),<br>array(<br>";
			foreach($this->options_colorcontrol as $key=>$special_color){
				if($special_color['type']=='picker'){
					echo "	\"".$special_color['var_name']."\" => \"".$special_color['std']."\", <br>";
				}
			}
			echo ")); esi copy past ara array_of_colors tex@ kashxati";
			die();
			
		}
		// print qjeru and initial colors standart themes
		else
		{			
			echo '<script>jQuery(document).ready(function(){
				jQuery("#color_scheme").change(function () {
					var bkg = jQuery("#color_scheme option:selected").val();  ';

			foreach($array_of_colors as $key=>$colors){
				
				echo 'if (bkg == "Theme-'.($key+1).'") {';
					foreach($colors as $key=>$color){				
					
						echo 'jQuery("#'.$key.'").val("'.$color.'"); ';
						echo 'jQuery("#'.$key.'").css("backgroundColor", "'.$color.'"); ';
						echo 'jQuery("#'.$key.'").iris("color", "'.$color.'"); ';
						echo 'jQuery("#'.$key.'_picker").children("div").css("backgroundColor", "'.$color.'"); ';
 
					}
				echo " }";
			}
			
			echo "});  });</script>";
		}
		
		
	}
	private function default_theme_select($array_of_colors=NULL){
		$count_of_selects=count($array_of_colors);
		
		echo '<select name="color_scheme" id="color_scheme">';
		
		for($i=1;$i<=$count_of_selects;$i++){
			$selected='';
			$selected=selected($this->options_colorcontrol['color_scheme']['std'], 'Theme-'.$i );
			echo '<option value="Theme-'.$i.'" '.$selected.'>Theme-'.$i.'</option>';
			
		}
		
		echo '</select>';
		
		
	}
	private function hex_to_rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
          return $default; 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
}


}
 
