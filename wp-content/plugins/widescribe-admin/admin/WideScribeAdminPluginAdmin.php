<?php
/**
 * @author yoyoncahyono
 * WidescribeAdminPlugin implementation
 * for user with administrator role
 * its handle settings and initialization for
 * the Widescribe admin/partner API aceess
 *
 */
class WideScribeAdminPluginAdmin
{
    // Instance of the admin class, for using public functions
    protected static $instance = null;
    
    /**
     * Construct the plugin object
     */
    public function __construct()
    {
        $this->plugin = new stdClass;
        $this->plugin->name = 'widescribe-admin'; // Plugin Folder
        $this->plugin->displayName = 'WS Admin'; // Plugin Name
        $this->plugin->version = '1.0';
        $this->plugin->folder = WP_PLUGIN_DIR . '/' . $this->plugin->name; // Full Path to Plugin Folder
        $this->plugin->url = WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), '', plugin_basename(__FILE__));
        // Register settings and load the menu items for accessing the widescribe panel
        add_action('admin_init', array(
            &$this,
            'registerSettings'
        ));
        add_action('admin_menu', array(
            &$this,
            'adminMenu'
        ));
        
       
    }
    
    /**
     * Return an instance of this class.
     */
    public static function get_instance() {
        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    /**
     * Register Settings
     */
    function registerSettings() {
        // Do nothing
    }

    /**
     * addMenus for plugin settings 
     */
    function adminMenu()
    {
        
        add_options_page( $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name.'_options', array(
            &$this,
            'settingsPage'
        ));
        
        add_submenu_page($this->plugin->name, 'Settings', 'Settings', 'manage_options', $this->plugin->name.'_options', array(
            &$this,
            'settingsPage'
        ));
   }
   
   /**
    * handle the plugin settings page presentation, options and initialization
    */
   function settingsPage(){
       if (!empty($_POST['ws_initializeportal'])) {
           if (!empty(get_option($this->plugin->name.'_api_url'))) {
               try {
                   $api = new WideScribeAdminPluginAPI();
                   $result = $api->initializePortalRequest(esc_attr( get_option($this->plugin->name.'_init_key')));
                   if ($result->success) {
                       $partner = $result->result;
                       $this->message = $result->message;
                       update_option($this->plugin->name.'_public_key', $result->result->publicKey);
                       update_option($this->plugin->name.'_private_key', $result->result->privateKey);
                   } else {
                       $this->errorMessage = $result->message;
                   }
               } catch (Exception $e) {
                   $this->errorMessage = $e->getMessage();
               }
           } else {
               $this->errorMessage = 'You must provide WS API Url';
           }
       }
       include_once(WP_PLUGIN_DIR . '/' . $this->plugin->name . '/admin/views/settings.php');
   }
     public static function activate() {

        if (WideScribeAdminPluginAdmin::createWStables() === false) {
            $message = 'Activated widescribe plugin, but failed to create local log tables';
            WideScribeWpAdmin::log('activate', $message);
            return $message;
        }
       
        $message = 'Successfully activated the WideScribe Admin plugin';
        WideScribeWpAdmin::log('activate', $message);

        return $message;
    }
   
   public static function createWSTables() {
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
  `error` int(11) DEFAULT 0
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      
        if (!dbDelta($sql)) {
            print "Error creating WideScribe watchdog table. If you see this message, then the reason is that the table already existed";
            WideScribeWpAdmin::error('createWSTables', 'Error creating vxl log table. If you see this message, then the reason is that the table already existed');
            return "The plugin failed to create log and error tables. WideScribe requires the table wp_widscribe_watchdog to capture any errors that may occur and notify you. Please ensure that the CREATE TABLE MySQL permissions are granted for the Wordpress user.";
        } 
        
        return ;
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
    
}