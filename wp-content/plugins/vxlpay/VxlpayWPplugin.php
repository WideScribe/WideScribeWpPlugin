<?php
/**
 * Vxlpay wordpress plugin
 *
 * A plugin used to administer the vxlpay payramp adaptive paywall.
 * 
 * @package   VXLPAY
 * @author    Jens Tandstad <jens@vxlpay.com>
 * @license   GPL-2.0+
 * @link      http://www.vxlpay.com
 * @copyright 2014 Vxlpay AS
 *
 * @wordpress-plugin
 * Plugin Name:       VXLPAY Payramp
 * Plugin URI:        http://www.vxlpay.com
 * Description:       This pay per view makes it possible for you to charge for content on your newssite or blog.
 * Version:           1.0.0
 * Author:            Jens Tandstad, VXLPAY AS
 * Author URI:        www.vxlpay.com
 * Text Domain:       plugin-name-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: 
 * WordPress-Plugin-Boilerplate: v2.6.1
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name.php` with the name of the plugin's class file
 *
 */

require_once( plugin_dir_path( __FILE__ ) . 'public/ClassVxlpayPlugin.php' );



/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */


/*
 * @TODO:
 *
 * - replace Plugin_Name with the name of the class defined in
 *   `class-plugin-name.php`
 */
add_action( 'plugins_loaded', array( 'VxlpayWpPlugin', 'get_instance' ) );





/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-name-admin.php` with the name of the plugin's admin file
 * - replace Plugin_Name_Admin with the name of the class defined in
 *   `class-plugin-name-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
   
	require_once( plugin_dir_path( __FILE__ ) . 'admin/ClassVxlpayWPAdmin.php' );
	add_action( 'plugins_loaded', array( 'VxlpayWpAdmin', 'get_instance' ) );
        register_activation_hook( __FILE__, array( 'VxlpayWpAdmin', 'activate' ) );
      //  register_deactivation_hook( __FILE__, array( 'VxlpayWpAdmin', 'deactivate' ) );
}
