<?php
add_action('admin_init', 'news_magazine_meta_init');

function news_magazine_meta_init()
{

    wp_enqueue_script('news_magazine_meta_js', get_template_directory_uri() . '/admin/includes/meta/meta.js', array('jquery'));
    wp_enqueue_style('news_magazine_meta_css', get_template_directory_uri() . '/admin/includes/meta/meta.css');

    foreach (array('post', 'page') as $type) {
        add_meta_box('news_magazine_all_meta', 'News Magazine Custom Meta Box', 'news_magazine_meta_setup', $type, 'normal', 'high');
    }

    add_action('save_post', 'news_magazine_meta_save');
}

function news_magazine_meta_setup()
{

	global $news_magazine_layout_page,$news_magazine_general_settings_page,$news_magazine_home_page,$post;
    $meta = get_post_meta($post->ID, 'news_magazine_meta_date', TRUE);

	$n_of_home_post=get_option( 'posts_per_page', 6 ); 
	if( gettype ($post->ID) == 'integer' ){
		$meta=array(
			'layout' =>  $news_magazine_layout_page->options_themeoptions['default_layout']['std'] ,
			'content_width' =>  $news_magazine_layout_page->options_themeoptions['content_area']['std'] ,
			'main_col_width' =>  $news_magazine_layout_page->options_themeoptions['main_column']['std'] ,
			'pr_widget_area_width' =>  $news_magazine_layout_page->options_themeoptions['pwa_width']['std'],
			'fullwidthpage' => $news_magazine_layout_page->options_themeoptions['full_width']['std'],
			'blogstyle' => '',
			'showthumb' => '',
			'blog_perpage' =>$n_of_home_post,
			'showtitle' => '',
			'showdesc' => '',
			'detect_portrait' => '',
			'thumbsize' => '2',
			'static_pages_on' => '',			
			'all_categories_on' => '',
			'tags_on' => '',
			'archives_on' => '',
			'authors_on' => '',
			'category_tabs_mst_pop'=> ''
		);
		
	}
	else
	{
		$meta_if_par_not_initilas=array(
			'layout' =>  $news_magazine_layout_page->options_themeoptions['default_layout']['std'] ,
			'content_width' =>  $news_magazine_layout_page->options_themeoptions['content_area']['std'] ,
			'main_col_width' =>  $news_magazine_layout_page->options_themeoptions['main_column']['std'] ,
			'pr_widget_area_width' =>  $news_magazine_layout_page->options_themeoptions['pwa_width']['std'],
			'fullwidthpage' => $news_magazine_layout_page->options_themeoptions['full_width']['std'],
			'blogstyle' => '',
			'showthumb' => '',
			'blog_perpage' => $n_of_home_post,
			'showtitle' => '',
			'showdesc' => '',
			'detect_portrait' => '',
			'thumbsize' => '2',
			'static_pages_on' => '',			
			'all_categories_on' => '',
			'tags_on' => '',
			'archives_on' => '',
			'authors_on' => '',
			'blog_posts_on' => '',
		    'category_tabs_mst_pop'=> ''	
		);
		foreach($meta_if_par_not_initilas as $key=>$meta_if_par_not_initila){
			
			if(!isset($meta[$key])){
				$meta[$key]=$meta_if_par_not_initila;
			}
		
		}
		
	}

    // instead of writing HTML here, lets do an include
   require_once('meta.php');

    // create a custom nonce for submit verification later
    echo '<input type="hidden" name="news_magazine_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

function news_magazine_meta_save($post_id)
{

    // authentication checks
    // check user permissions
    if (isset($_POST['post_type']) && $_POST['post_type'] == 'page') {
        if (!current_user_can('edit_page', $post_id)) return $post_id;
    } else {
        if (!current_user_can('edit_post', $post_id)) return $post_id;
    }
	
    $current_data = get_post_meta($post_id, 'news_magazine_meta_date', TRUE);
	if(isset($_POST['news_magazine_meta_date']))
		$new_data = $_POST['news_magazine_meta_date'];
    else
		$new_data = "";

    if (gettype ($post_id) == 'integer') {
       if(is_null($new_data)){ 
		delete_post_meta($post_id, 'news_magazine_meta_date');
		}
	   else{ 
		update_post_meta($post_id, 'news_magazine_meta_date', $new_data);
		add_post_meta($post_id, 'news_magazine_meta_date', $new_data, TRUE);
		}
   } elseif (!is_null($new_data)) {
      update_post_meta($post_id, 'news_magazine_meta_date', $new_data);

   }  

    return $post_id;
}

function news_magazine_meta_clean(&$arr)
{
    if (is_array($arr)) {
        foreach ($arr as $i => $v) {
            if (is_array($arr[$i])) {
                news_magazine_meta_clean($arr[$i]);

                if (!count($arr[$i])) {
                    unset($arr[$i]);
                }
            } else {
                if (trim($arr[$i]) == '') {
                    unset($arr[$i]);
                }
            }
        }

        if (!count($arr)) {
            $arr = NULL;
        }
    }
}