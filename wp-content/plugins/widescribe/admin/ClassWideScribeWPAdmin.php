<?php

/**
 * W I D E S C R I B E 
 * Wordpress Plugin
 *
 * @package   WideScribe admin class
 * @author    jens@widescribe.com <jens@widescribe.com>
 * @license   GPL-2.0+
 * @link      http://www.widescribe.com
 * @copyright 2014 WideScribe AS
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * Public facing functionality is available in the ClassWideScribePlugin.php
 *
 *
 * @package widescribe
 * @author  Jens Tandstad <jens@widescribe.com>
 */
class WideScribeWpAdmin {

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    // Instance of the admin class, for using public functions
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;
    // Instance of the plugin class, for using public functions
    private $plugin = null;

    /**
     * Initialize the plugin by loading admin scripts & styles and adding a
     * settings page and menu.
     *
     * @since     1.0.0
     */
    private function __construct() {
        $this->log = true;
        $this->error = true;

        $this->plugin = new stdClass;
        $this->plugin->name = 'widescribe'; // Plugin Folder
        $this->plugin->displayName = 'WideScribe'; // Plugin Name
        $this->plugin->version = '1.0';
        $this->plugin->folder = WP_PLUGIN_DIR . '/' . $this->plugin->name; // Full Path to Plugin Folder
        $this->plugin->url = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), "", plugin_basename(__FILE__));
        /*
         * @TODO :
         *
         * - Uncomment following lines if the admin class should only be available for super admins
         */
        /* if( ! is_super_admin() ) {
          return;
          } */


        // Set the plugin object
        $plugin = WideScribeWpPlugin::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        // Load admin style sheet and JavaScript.
        //  add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
        //  add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        // Add the options page and menu item.
        // Add an action link pointing to the options page.
        $plugin_basename = plugin_basename(plugin_dir_path(realpath(dirname(__FILE__))) . $this->plugin_slug . '.php');
        add_filter('plugin_action_links_' . $plugin_basename, array($this, 'add_action_links'));



        // Register settings and load the menu items for accessing the widescribe panel
        add_action('admin_init', array(&$this, 'registerSettings'));
       
       add_action('admin_menu', array(&$this, 'adminPanelsAndMetaBoxes'));
        // Attach to save_post hook, for contacting widescribe when new content are created
        add_action('save_post', array($this, 'saveContentWithWideScribe'));
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register and enqueue admin-specific style sheet.
     *
     * @TODO:
     *
     * - Rename "Plugin_Name" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
// This just echoes the chosen line, we'll position it later
    function vxl_statusMessage($message) {

        echo "<p id='widescribeStatus'>$message</p>";
    }

    public function enqueue_admin_styles() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($this->plugin_screen_hook_suffix == $screen->id) {
            //wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Plugin_Name::VERSION );
        }
    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @TODO:
     *
     * - Rename "Plugin_Name" to the name your plugin
     *
     * @since     1.0.0
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        if (!isset($this->plugin_screen_hook_suffix)) {
            return;
        }

        $screen = get_current_screen();
        if ($this->plugin_screen_hook_suffix == $screen->id) {
            //wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Plugin_Name::VERSION );
        }
    }

    // This just echoes the chosen line, we'll position it later

    /**
     * Add adminPanelTo the list
     *
     * @since    1.0.0
     */
    function adminPanelsAndMetaBoxes() {

        add_menu_page($this->plugin->displayName, $this->plugin->displayName, 'mange_options', 'widescribe.php', array(&$this, 'mainPanel'), WideScribe_FAVICON);
        add_meta_box('wideScribePostMetaBox', 'WideScribe settings box', array(&$this, 'wideScribePostMetaBoxSetup'), 'Post', 'normal', 'high');
       
        add_submenu_page('widescribe.php', 'Partner Settings', 'Partner settings', 'manage_options', 'Partner', array(&$this, 'partnerPanel'));
        add_submenu_page('widescribe.php', 'Operational', 'Operational', 'manage_options', 'Operational', array(&$this, 'operationalPanel'));
        add_submenu_page('widescribe.php', 'Paywall settings', 'Paywall settings', 'manage_options', 'Paywall', array(&$this, 'paywallPanel'));
        add_submenu_page('widescribe.php', 'Payment and statistics', 'Payment and statistics', 'manage_options', 'Statistics', array(&$this, 'statisticsPanel'));
        add_submenu_page('widescribe.php', 'Look and feel', 'Look and feel', 'manage_options', 'LookAndFeel', array(&$this, 'lookAndFeelPanel'));
        add_submenu_page('widescribe.php', 'Forms', 'Forms', 'manage_options', 'Forms', array(&$this, 'Forms'));
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_admin_page() {
        include_once( 'views/admin.php' );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */
    public function add_action_links($links) {

        return array_merge(
                array(
            'settings' => '<a href="' . admin_url('options-general.php?page=' . $this->plugin_slug) . '">' . __('Settings', $this->plugin_slug) . '</a>'
                ), $links
        );
    }

    /**
     * Register Settings
     */
    function registerSettings() {
        register_setting($this->plugin->name, 'vxl_partnerId', 'trim');
        register_setting($this->plugin->name, 'vxl_sharedSecret', 'trim');
    }

    function mainPanel() {

        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/main.php');
    }

    function lookAndFeelPanel() {
        if (isset($_POST['submit'])) {
            switch ($_POST['vxlAction']) {
                case 'save':
                    switch ($_POST['vxlTrinketType']) {
                        case 'type1':
                            // Switch does not exist, update option fires after switch
                            break;
                        case 'type2':
                            // Switch does not exist, update option fires after switch
                            break;
                        case 'type3':
                            // Switch does not exist, update option fires after switch
                            break;
                        default:
                            $this->errorMessage = $_POST['vxlIconType'] . __('is an icon type', $this->plugin->name);
                            return;
                            break;
                    }
                    update_option('vxlTrinketType', $_POST['vxlTrinketType']);
                    update_option('vxlStyle', $_POST['vxlStyle']);
                    $this->message = __('Updated the look and feel settings, you should now check how it looks by visiting your front page.', $this->plugin->name);

                    break;
                default:
                    $this->message = __('Invalid widescribe admin action selected', $this->plugin->name);
                    break;
            }
        }
        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/lookAndFeel.php');
    }

    /* This provides the edit of forms.
     * 
     */

    function forms() {
        if (isset($_POST['submit'])) {
            switch ($_POST['vxlAction']) {
                case 'save':
                    switch ($_POST['vxl_formEnabled']) {
                        case 'enabled':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'disabled':
                            // Switch does not ext, update option fires after switch
                            break;

                        default:
                            $this->errorMessage = $_POST['vxl_formEnabled'] . __('Not a valid selection', $this->plugin->name);
                            return;
                            break;
                    }
                    update_option('vxl_formEnabled', $_POST['vxl_formEnabled']);

                    $this->message = __('Updated the look and feel settings, you should now check how it looks by visiting your front page.', $this->plugin->name);

                    break;
                default:
                    $this->message = __('Invalid widescribe admin action selected', $this->plugin->name);
                    break;
            }
        }
        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/form.php');
    }

    function statisticsPanel() {
        if (isset($_POST['submit'])) {
            switch ($_POST['vxlAction']) {
                case 'showStatistcs':
                    print 'Shoestatitatrasdasd';
                    break;
                case 'save':

                    break;
                default:
                    $this->message = __('Invalid widescribe admin action selected', $this->plugin->name);
                    break;
            }
        }
        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/statistics.php');
    }

    function operationalPanel() {

        if (isset($_POST['submit'])) {

            switch ($_POST['vxlAction']) {
                case 'selectEnvironment':

                    break;
                case 'vxlwp_test':
                    $this->message = WideScribeWpPost::testVXLconnection();
                    break;
                case 'create_log_tables':
                    $this->message = WideScribeWpAdmin::createWSTables();
                    break;
                case 'empty_log_table':
                    $this->message = WideScribeWpAdmin::truncateLog();
                    break;
                case 'empty_error_table':
                    $this->message = WideScribeWpAdmin::truncateError();
                    break;
                default:
                    $this->message = __('Invalid widescribe admin action selected (' . $_POST['vxlAction'] . ')', $this->plugin->name);
                    break;
            }
        }
        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/operational.php');
    }

    function paywallPanel() {
        if (isset($_POST['submit'])) {
            switch ($_POST['vxlAction']) {
                case 'save':

                    switch ($_POST['vxl_trancherAt']) {
                        case 'trancher_at_token':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_heading':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_ingres':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_150_words':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_100_words':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_50_words':
                            // Switch does not ext, update option fires after switch
                            break;
                        case 'trancher_after_20_words':
                            // Switch does not ext, update option fires after switch
                            break;
                        default:
                            $this->errorMessage = $_POST['vxl_trancherAt'] . __('is an invalid choice for text chopping', $this->plugin->name);
                            return;
                            break;
                    }
                    update_option('vxl_trancherAt', $_POST['vxl_trancherAt']);
                    $this->message = __('Updated the trancher settings', $this->plugin->name);
                    break;

                default:
                    $this->message = __('Invalid widescribe admin action selected', $this->plugin->name);
                    return;
                    break;
            }
        }


        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/paywall.php');
        return;
    }

    /**
     * The endpoint for post calls made from  the Administration Panel
     * Saves POSTed data from the Administration Panel into WordPress options
     */
    function partnerPanel() {
        // Save Settings
        // Guard statement for admin panel

        if (isset($_POST['submit'])) {
            switch ($_POST['vxlAction']) {
                case 'save':
                    // Check nonce, if it exists, other stuff exit too.
                    if (!isset($_POST[$this->plugin->name . '_nonce'])) {
                        $this->errorMessage = __('nonce field is missing. Settings NOT saved.', $this->plugin->name);
                    } elseif (!wp_verify_nonce($_POST[$this->plugin->name . '_nonce'], $this->plugin->name)) {
                        // Invalid nonce
                        $this->errorMessage = __('Invalid nonce specified. Settings NOT saved.', $this->plugin->name);
                    } else {
                        // Save

                        if (!array_key_exists('vxl_domain', $_POST)) {
                            $this->errorMessage = __('Invalid post call received.', $this->plugin->name);
                            return;
                        }
                        update_option('vxl_partnerId', $_POST['vxl_partnerId']);
                        update_option('vxl_domain', $_POST['vxl_domain']);
                        update_option('vxl_email', $_POST['vxl_email']);
                        update_option('vxl_provider', $_POST['vxl_provider']);
                        update_option('vxl_sharedSecret', $_POST['vxl_sharedSecret']);

                        $this->message = __('Settings Saved.', $this->plugin->name);
                    }

                    break;
                default:
                    $this->message = __('Invalid widescribe admin action selected', $this->plugin->name);
                    return;
                    break;
            }
        }


        // Load Settings Form
        include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/partner.php');
    }

    /* saveContentWithWideScribe
     * 
     * This is attached to the save_post hook, and will save a copy of the wordpress content in widescribe. 
     * The process attempts to synchronise the widescribe database with any content changes on the serverside.
     * This is the preferred option for easily setting up widescribe, and nescessary for one-click install.
     * It is also possible that widescribe script could read from an api provided at widescribe.partnerdomain.com, which would
     * require the user to set up a partner site.
     * When successful, widescribe will be able to  
     * return it to the user using json upon payment, and the client javascript will himself
     * remove the payment dialog added by the filter on the wordpress site,
     * and insert the content directly into the 
     * DOM.
     */

    public function saveContentWithWideScribe($postId) {

        // Abort if the function is loaded without an action
        if (!isset($_POST['action'])) {

            return;
        }
        $secret = sha1(get_option('vxl_sharedSecret'));
        $partnerId = get_option('vxl_partnerId');

        // Widescribe does not push content of pages to the server
        if (is_page()) {
            return;
        }

        // This is a post. Check if its charged.
        $posttags = get_the_tags();
        $free = true;
        if ($posttags) {
            foreach ($posttags as $tag) {
                if (strpos($tag->name, 'Premium') >= 0) {
                    $free = false;
                    break;
                }
            }
        }

        // Abort if the post is not charged for.
        if ($free) {

            return;
        }


        // Route for saving articles in the widescribe database
        if (!isset($secret)) {
            $this->errorMessage = "ERROR : Was unable to register secret option when attemtping to store $postId to widescribe. The post will not be possible to charge using widescribe and will be handed out for free";

            WideScribeWpAdmin::error("widescribeAdmin.saveContentWithWideScribe", $this->errorMessage, $postId);
            return;
        }
        // Needs the partnedId
        if (!isset($partnerId)) {
            $this->errorMessage = "ERROR : Was unable to register shared secret option from database when attempting to store $postId to widescribe. The post will not be possible to charge using widescribe and will be handed out for free";
            WideScribeWpAdmin::error("widescribeAdmin.saveContentWithWideScribe", $this->errorMessage, $postId);
            return;
        }

        // END OF GUARD STATEMENTS
        // Route Lookup the complete post content from the wordpress database
        // Implement : Figure out the post object received here, and urlencode
        // all the text and characters.
        // $partnerID = getOption('partnerId');
        //$secret = sha1(getOption('sharedSecret'));
        // Nonce and verification
        $wp_nonce = $_POST['_wpnonce'];
        $_wp_http_referer = $_POST['_wp_http_referer'];

        // Post Id
        $postId = $_POST['post_ID'];

        // Context of the call, to allow filtering serverside
        $action = $_POST['action'];

        $post_title = $_POST['post_title'];
        $content = $_POST['content'];
        $post_name = $_POST['post_name'];
        $post_status = $_POST['post_status'];
        $post_type = $_POST['post_type'];
        $permaLink = get_permalink($postId);
        $original_post_status = $_POST['original_post_status'];

        $fields = array(
            'secret' => $secret,
            'nonce' => urlencode($wp_nonce),
            '_wp_http_referer' => urlencode($_wp_http_referer),
            'wpId' => urlencode($postId),
            'partnerId' => $partnerId,
            'action' => urlencode($action),
            'post_name' => urlencode($post_name),
            'post_content' => urlencode($content),
            'post_title' => urlencode($post_title),
            'post_status' => urlencode($post_status),
            'post_type' => urlencode($post_type),
            'permaLink' => urlencode($permaLink),
            'original_post_status' => urlencode($original_post_status)
        );

        $fields = array(
            'secret' => $secret,
            'wpNonce' => ($wp_nonce),
            '_wp_http_referer' => ($_wp_http_referer),
            'wpId' => ($postId),
            'partnerId' => $partnerId,
            'action' => ($action),
            'post_name' => ($post_name),
            'post_content' => ($content),
            'post_title' => ($post_title),
            'post_status' => ($post_status),
            'post_type' => ($post_type),
            'permaLink' => ($permaLink),
            'original_post_status' => ($original_post_status)
        );

        $ro = WideScribeWpPost::vxlcURL('/wp/store', $fields);

        // Check if the response was valid json.
        if (is_a($ro, 'ErrorException')) {
          
            WideScribeWpAdmin::error("WideScribeWpPost.saveContentWithWideScribe", 'The curl returned an error exception', $ro->getMessage(), $postId);
            $this->errorMessage = $ro->getMessage();
            return $ro;
        }
        
        if (!array_key_exists('status', $ro)) {
            $this->errorMessage = "ERROR : The cURL attempt to save post $postId to widescribe failed. The post will not be possible to charge using widescribe and will be handed out for free. Response was " . json_encode($ro);
            WideScribeWpAdmin::error("widescribeAdmin.saveContentWithWideScribe", $this->errorMessage, $ro, $postId);
            return;
        }
        if ($ro->status != 'success') {
            $this->errorMessage = "ERROR : Attempt to save $postId to widescribe failed. Server response was [" . $ro->status . "] for postId $postId ";
            WideScribeWpAdmin::error('widescribeAdmin.saveContentWithWideScribe', $this->errorMessage, $ro, $postId);

            return;
        }
        // Write a copy to the log so that it can be shown in the POST metabox directly under the Post editor
        WideScribeWpAdmin::log('widescribeAdmin.saveContentWithWideScribe', "Successfully updated post at WideScribe", null, $postId);
        return true;
    }

    static function error($funcName, $message, $data = null, $wpId = null) {
        global $wpdb;

        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        if (!isset($message)) {
            $message = 'unset';
        }
        
     
        $wpdb->insert($wpdb->prefix . 'widescribe_watchdog', array("context" => 'admin', "funcName" => $funcName, "message" => $message, "data" => $data, "wpId" => $wpId, 'error' => 1));
       
        return true;
    }

    static function log($funcName, $message, $data = null, $wpId = null) {

        global $wpdb;

        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        if (!isset($message)) {
            $message = 'unset';
        }

        $wpdb->insert($wpdb->prefix . 'widescribe_watchdog', array("context" => 'admin', "funcName" => $funcName, "message" => $message, "data" => $data, "wpId" => $wpId));

        return true;
    }


    public function truncateWatchdog() {
        global $wpdb;
        $wpdb->show_errors();
        $charset_collate = '';

        $table_name = $wpdb->prefix . "widescribe_watchdog";

        $sql = "TRUNCATE $table_name ";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


        if (!dbDelta($sql)) {
            $this->errorMessage = "Error attempting to truncate error table. " . $wpdb->last_error;
            WideScribeWpAdmin::error('truncateErrors', $this->errorMessage);
            $wpdb->print_error();
            return;
        } // Create the log table

        $message = 'Successfully truncated error table';
        WideScribeWpAdmin::log('truncateErrors', $message);
        return __($message, $this->plugin->name);
    }

    /*
     * create_vxl_tables
     * Fired on activation hook.
     * 
     * Not tested.
     */

    static function createWSTables() {
        global $wpdb;

        $charset_collate = '';

        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }

        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }
       
        $table_name = $wpdb->prefix . "widescribe_watchdog";

        $sql = "CREATE TABLE  IF NOT EXISTS $table_name (
      `context` varchar(10) NOT NULL,
  `funcName` varchar(55) NOT NULL,
  `message` varchar(250) NOT NULL,
  `data` varchar(250) NOT NULL,
  `wpId` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `error` int(11) DEFAULT NULL
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        if (!dbDelta($sql)) {
            WideScribeWpAdmin::error('createWSTables', 'Error creating vxl log table. If you see this message, then the reason is that the table already existed');
            return "The plugin failed to create log and error tables. WideScribe requires the table wp_widscribe_watchdog to capture any errors that may occur and notify you. Please ensure that the CREATE TABLE MySQL permissions are granted for the Wordpress user.";
        } 
        
       
        return ;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     */
    public static function activate($network_wide) {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_activate();

                    restore_current_blog();
                }
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
        if (WideScribeWpAdmin::createWStables() === false) {
            $message = 'Activated widescribe plugin, but failed to create local log tables';
            WideScribeWpAdmin::log('activate', $message);
            return $message;
        }
        // Flush the rewrite rules when enabling the API

        WideScribeWpAdmin::add_endpoint();
        WideScribeWpAdmin::flushRewrite();

        $message = 'Successfully activated the WideScribe plugin';
        WideScribeWpAdmin::log('activate', $message);

        return $message;
    }

    /** Add API Endpoint
     * Adds a wordpress regex API backdoor, in case that CORS requestes fails
     * @return void
     */
    public static function flushRewrite() {
        flush_rewrite_rules();
        return true;
    }

    /** Add API Endpoint
     * This is where the magic happens - brush up on your regex skillz
     * @return void
     */
    public static function add_endpoint() {
        // print 'Adding endpoint';

        add_rewrite_rule('widescribe/backdoor/(.+)', 'index.php?__api=1&route=$matches[1]', 'top');
        // add_rewrite_rule('^widescribe/backdoor/?([a-z]+)?/?([a-z]+)?/?', 'index.php?__api=1&route=$matches[1]&subroute=$matches[2]', 'top');
        // Flush the rewrite cache
        return;
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    1.0.0
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       deactivated on an individual blog.
     */
    public static function deactivate($network_wide) {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_deactivate();

                    restore_current_blog();
                }
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @since    1.0.0
     *
     * @param    int    $blog_id    ID of the new blog.
     */
    public function activate_new_site($blog_id) {

        if (1 !== did_action('wpmu_new_blog')) {
            return;
        }

        switch_to_blog($blog_id);
        self::single_activate();
        restore_current_blog();
    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @since    1.0.0
     *
     * @return   array|false    The blog ids, false if no matches.
     */
    private static function get_blog_ids() {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col($sql);
    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate() {
        // @TODO: Define activation functionality here
        // Check that wp_widescribe tables exist and that connecivity works
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate() {
        // @TODO: Define deactivation functionality here
       
    }

    /**
     * Print the log and return as a table
     *
     */
    
    public function printPostStatus($wpId){
        global $wpdb;
        
        $tableStr = '<h3>Status for this p</h3>';
        $tableStr .= '<table><tr><td>id</td><td>Context</td><td>Function name</td><td>Message</td><td>Data</td></tr>';

        $ro = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "widescribe_watchdog WHERE wpId = $wpId ORDER BY timestamp DESC LIMIT 1 ");

        foreach ($ro as $c) {
            if($c->error){
                return 'An error has occured, and the WideScribe version of this article failed to syncrhonize. This is caused by a technical error. Please contanct WideScribe support with the following details : <br>'. $c->message .' at time '. $c->timestamp . 'CET<br>Additional info : '.$c->data;
     
            }
            else{
               return $c->message .' at time '. $c->timestamp ;
            }
        }
        return 'This article has never been synchronized with Widescribe. Please update th article and check this field again';
    }
    
    public function printLog() {
        global $wpdb;

        $tableStr = '<h3>VXL Logged events</h3>';
        $tableStr .= '<table><tr><td>id</td><td>Context</td><td>Function name</td><td>Message</td><td>Data</td></tr>';

        $ro = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "widescribe_watchdog");

        foreach ($ro as $c) {
            $tableStr .= '<tr>'
                    . '<td>' . $c->id
                    . '</td><td>' . htmlspecialchars($c->context)
                    . '</td><td>' . htmlspecialchars($c->funcName)
                    . '</td><td>' . htmlspecialchars($c->message)
                    . '</td><td>' . htmlspecialchars($c->data)
                    . '</td></tr>';
        }
        return $tableStr . '</table>';
    }

    /**
     * Print the errors and return as a table
     *
     */
    public function printError() {
        global $wpdb;

        $tableStr = '<h3>VXL Errors</h3>';
        $tableStr .= '<table><tr><td>id</td><td>Context</td><td>Function name</td><td>Message</td><td>Data</td></tr>';

        $ro = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "widescribe_watchdog WHERE error = 1");

        foreach ($ro as $c) {
            $tableStr .= '<tr>'
                    . '<td>' . $c->id
                    . '</td><td>' . htmlspecialchars($c->context)
                    . '</td><td>' . htmlspecialchars($c->funcName)
                    . '</td><td>' . htmlspecialchars($c->message)
                    . '</td><td>' . htmlspecialchars($c->data)
                    . '</td></tr>';
        }
        return $tableStr . '</table>';
    }

    function __destruct() {
        if (isset($this->errorMessage)) {
            WideScribeWpAdmin::error('WideScribeAdminClass.DESTRUCT', $this->errorMessage, '');
        }
    }

    public function wideScribePostMetaBoxSetup() {
        global  $post;
        
        
        if ($post->ID) {
            
             print $this->printPostStatus($post->ID);
            
           //  require_once  ( __DIR__. '/includes/meta.php');
            
        }
        else{
            print "The post is not valid $post->ID";
            
        }

        // instead of writing HTML here, lets do an include
       

        // create a custom nonce for submit verification later
        echo '<input type="hidden" name="news_magazine_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
    }

}
