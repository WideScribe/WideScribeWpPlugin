<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=>  __('Block One', 'hephaestus'),
				"block_two"		=>  __('Block Two', 'hephaestus'),
				"block_three"	=>  __('Block Three', 'hephaestus'),
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=>  __('Block Four', 'hephaestus'),
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_template_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array( __('Select A number', 'hephaestus'),"1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" =>  __('Settings', 'hephaestus'),
					"type" => "heading");
					
$of_options[] = array( "name" =>  __('Hello There', 'hephaestus'),
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">". __('Welcome To Supremo Panel', 'hephaestus')."</h3>". __('Supremo Panel is a slightly modified version of the original options framework by <a href=\"http://aquagraphite.com/\">AquaGraphite.com</a>', 'hephaestus'),
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => __('Enable Slider (disabled)', 'hephaestus'),
					"desc" => __('Enable Slider', 'hephaestus'),
					"id" => "slider_checkbox",
					"std" => 0,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __('Slider Options', 'hephaestus'),
					"desc" => __('Unlimited slider with drag and drop sortings.', 'hephaestus'),
					"id" => "pingu_slider",
					"std" => "",
					"type" => "slider");
					
					
$of_options[] = array( "name" => __('Upload Favicon', 'hephaestus'),
					"desc" => __('Upload Favicon', 'hephaestus'),
					"id" => "favicon",
					"std" => "",
					"mod" => "min",
					"type" => "upload");    

$of_options[] = array( "name" => __('Twitter URI', 'hephaestus'),
					"desc" => __('Place your Twitter URI', 'hephaestus'),
					"id" => "twitteruri",
					"std" => "#",
					"type" => "text");

$of_options[] = array( "name" => __('Facebook URI', 'hephaestus'),
					"desc" => __('Place your Facebook URI', 'hephaestus'),
					"id" => "facebookuri",
					"std" => "#",
					"type" => "text"); 

$of_options[] = array( "name" => __('RSS URI', 'hephaestus'),
					"desc" => __('Place your RSS URI', 'hephaestus'),
					"id" => "rssuri",
					"std" => "#",
					"type" => "text"); 	
					
$of_options[] = array( "name" => __('Google Analytics Code', 'hephaestus'),
                    "desc" => __('Paste your Google Analytics Code Here', 'hephaestus'),
                    "id" => "analytics",
                    "std" => "",
                    "type" => "textarea");
					
	}
}
?>
