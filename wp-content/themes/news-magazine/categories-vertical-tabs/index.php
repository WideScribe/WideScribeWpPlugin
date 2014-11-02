<?php
function news_magazine_set_post_views($postID) {
    $count_key = 'news_magazine_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
       delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



add_action( 'wp_enqueue_scripts', 'news_magazine_categories_vertical_tabs_style' );
function  news_magazine_categories_vertical_tabs_style(){
	wp_enqueue_style('static-style', get_template_directory_uri() .'/categories-vertical-tabs/style/style.css');
}

function news_magazine_theme_name_scripts(){
	wp_enqueue_script( 'script-name', get_template_directory_uri(). '/categories-vertical-tabs/js/javascript.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'news_magazine_theme_name_scripts' );

require_once( 'php/front.end.php');

?>