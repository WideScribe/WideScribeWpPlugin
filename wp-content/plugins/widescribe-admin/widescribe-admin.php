<?php
/**
* Plugin Name: Widescribe admin
* Plugin URI: http://www.widescribe.com
* Description: This pay per view makes it possible for you to charge for content on your newssite or blog.
* Version: 1.0
* Author: Jens Tandstad, Yoyon Cayhyono WIDESCRIBE AS
* Author URI: jens@widescribe.com
* License: GPL-2.0+
*/

defined('WPINC') or die("No script kiddies please!");

if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . 'wp-includes/pluggable.php');
}

if (is_admin() && current_user_can('edit_posts') && (! defined('DOING_AJAX') || ! DOING_AJAX)) {
    require_once( plugin_dir_path(__FILE__) . 'author/WideScribeAdminPluginAPI.php' );
    require_once( plugin_dir_path(__FILE__) . 'author/WideScribeAdminPluginTable.php' );
    require_once (plugin_dir_path(__FILE__) . 'author/WideScribeAdminPluginAuthor.php');
    add_action('plugins_loaded', array(
        'WideScribeAdminPluginAuthor',
        'get_instance'
    ));
    register_activation_hook(__FILE__, array(
        'WideScribeAdminPluginAuthor',
        'activate'
    ));
   
}
if (is_admin() && current_user_can('manage_options') && (! defined('DOING_AJAX') || ! DOING_AJAX)) {
    require_once (plugin_dir_path(__FILE__) . 'admin/WideScribeAdminPluginAdmin.php');
    add_action('plugins_loaded', array(
        'WideScribeAdminPluginAdmin',
        'get_instance'
    ));
    register_activation_hook(__FILE__, array(
        'WideScribeAdminPluginAdmin',
        'activate'
    ));
    // register_deactivation_hook( __FILE__, array( 'WideScribeAdminPlugin', 'deactivate' ) );
}