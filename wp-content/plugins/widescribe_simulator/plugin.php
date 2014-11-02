<?php
/*
Plugin Name: WideScribe Simulator
Plugin URI: http://github.com/tommcfarlin/My-Social-Network
Description: A simple WordPress widget for sharing a few of your social networks.
Version: 1.1
Author: Tom McFarlin
Author URI: http://tommcfarlin.com
Author Email: tom@tommcfarlin.com
License:

  Copyright 2011 My Social Network (tom@tommcfarlin.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class WideScribe_Simulator extends WP_Widget {

	const name = 'WideScribe Simulator';
	const locale = 'widescribe_simulator';
	const slug = 'widescribe_simulator';
	
	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/
	
	/**
	 * The widget constructor. Specifies the classname and description, instantiates
	 * the widget, loads localization files, and includes necessary scripts and
	 * styles.
	 */
	function __construct() {

		load_plugin_textdomain(self::locale, false, dirname(plugin_basename( __FILE__ ) ) . '/lang/' );

		$widget_opts = array (
			'classname' => self::name, 
			'description' => __('A simple way to simulate the income from WideScribing your site.', self::locale)
		);	
		
		$this->WP_Widget(self::slug, __(self::name, self::locale), $widget_opts);

            // Load JavaScript and stylesheets
            $this->register_scripts_and_styles();
		
	} // end constructor

	/*--------------------------------------------------*/
	/* API Functions
	/*--------------------------------------------------*/
	
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget($args, $instance) {
	
		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		// Display the widget
		include(WP_PLUGIN_DIR . '/' . self::slug . '/views/simulator.php');
		
		echo $after_widget;
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form($instance) {
	
		// Display the admin form
            include(WP_PLUGIN_DIR . '/' . self::slug . '/views/simulator.php');
		
	} // end form
	
	/*--------------------------------------------------*/
	/* Private Functions
	/*--------------------------------------------------*/
	
	/**
	 * Registers and enqueues stylesheets for the administration panel and the
	 * public facing site.
	 */
	private function register_scripts_and_styles() {
                wp_enqueue_script('jquery');
		wp_register_script('jquery.mobile', ("https://code.jquery.com/mobile/1.4.4/jquery.mobile-1.2.0.min.js"), false);
                wp_enqueue_script('jquery.mobile');
               
      		$this->load_file(self::slug, '/' . self::slug . '/js/WSsimulator.js', true);
		$this->load_file(self::slug, '/' . self::slug . '/css/widget.css');
	
	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name	The 	ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file($name, $file_path, $is_script = false) {
		
    	$url = WP_PLUGIN_URL . $file_path;
		$file = WP_PLUGIN_DIR . $file_path;
    
		if(file_exists($file)) {
			if($is_script) {
				wp_register_script($name, $url);
				wp_enqueue_script($name);
			} else {
				wp_register_style($name, $url);
				wp_enqueue_style($name);
			} // end if
		} // end if
    
	} // end load_file
	
} // end class
add_action('widgets_init', create_function('', 'register_widget("WideScribe_Simulator");'));
?>
