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
}