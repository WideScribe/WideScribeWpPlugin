<?php

class WideScribeAdminPluginAuthor
{
    // Instance of the admin class, for using public functions
    protected static $instance = null;

    /**
     * Construct the plugin object
     */
    public function __construct()
    {
        $this->plugin = new stdClass();
        $this->plugin->pages = array();
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
            'adminPanelsAndMetaBoxes'
        ));
        add_filter('admin_title', array(
            &$this,
            'adminPageTitle'
        ), 10, 2);
        add_action( 'current_screen',  array(
            &$this,
            'checkRequirement'
        ) );
    }

    /**
     * Return an instance of this class.
     */
    public static function get_instance()
    {
        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Register Settings
     */
    function registerSettings()
    {
        register_setting($this->plugin->name, $this->plugin->name . '_api_url');
        register_setting($this->plugin->name, $this->plugin->name . '_init_key');
        register_setting($this->plugin->name, $this->plugin->name . '_public_key');
        register_setting($this->plugin->name, $this->plugin->name . '_private_key');
    }

    /**
     * Activate the plugin
     */
    public static function activate()
    {
        // Do nothing
    }

    /**
     * Deactivate the plugin
     */
    public static function deactivate()
    {
        // Do nothing
    }

    function adminPanelsAndMetaBoxes()
    {
        add_menu_page($this->plugin->displayName, $this->plugin->displayName, 'edit_posts', $this->plugin->name, null, 'https://vxlpay.appspot.com/vxl/img/favicon.ico');
        
        $this->plugin->pages['all_sites_page'] = add_submenu_page($this->plugin->name, 'My Sites', 'My Sites', 'edit_posts', $this->plugin->name, array(
            &$this,
            'partnersPanel'
        ));
        $this->plugin->pages['new_site_page'] = add_submenu_page($this->plugin->name, 'Add New Site', 'Add New Site', 'edit_posts', $this->plugin->name . '-add', array(
            &$this,
            'addNewPartnerPanel'
        ));
        $this->plugin->pages['stats_page'] = add_submenu_page($this->plugin->name, 'Statistics', 'Statistics', 'edit_posts', $this->plugin->name . '-stats', array(
            &$this,
            'statisticsPanel'
        ));
    }
    
    function checkRequirement($screen) {
        if (in_array($screen->id, $this->plugin->pages)) {
            if (empty(get_option($this->plugin->name . '_api_url')) || empty(get_option($this->plugin->name . '_init_key')) || empty(get_option($this->plugin->name . '_public_key')) || empty(get_option($this->plugin->name . '_public_key'))) {
                if (current_user_can('manage_options')) {
                    if (@$_GET['page'] !== $this->plugin->name.'_options') {
                        $url = admin_url('options-general.php?page=' . $this->plugin->name . '_options');
                        wp_redirect($url);
                    }
                } else {
                    wp_die('Please contact admin to initialize the WS Admin Setting');
                }
            }
        }
    }

    function partnersPanel()
    {
        if (! empty($_GET['action'])) {
            $id = @$_GET['id'];
            if (! empty($_GET['partner'])) {
                $id = $_GET['partner'];
            }
            if (! empty($id)) {
                switch ($_GET['action']) {
                    case 'edit':
                        $this->editPartnerPanel($id);
                        return;
                        break;
                    case 'delete':
                        $this->deletePartnerPanel($id);
                        return;
                        break;
                }
            }
            wp_die('Unknown action! ('.$_GET['action'].')');
        } else {
            $this->myPartnersPanel();
        }
    }

    function myPartnersPanel()
    {
        $partnersTable = new WideScribeAdminPluginTable();
        $api = new WideScribeAdminPluginAPI();
        try {
            $result = $api->makeApiRequest('/admin/partner');
            if ($result->success) {
                $partnersTable->data = $result->result;
                $partnersTable->prepare_items();
            } else {
                $this->errorMessage = $result->message;
            }
        } catch (Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
        include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/my-partners.php');
    }

    function editPartnerPanel($id)
    {
        $api = new WideScribeAdminPluginAPI();
        if (! empty($_GET['id'])) {
            if (! empty($_POST['ws_editpartner']) && ! empty($_POST['partner'])) {
                $editedPartner = $_POST['partner'];
                try {
                    $result = $api->makeApiRequest('/admin/partner/' . $id, array(
                        'data' => json_encode($editedPartner)
                    ));
                    if ($result->success) {
                        unset($_POST['ws_editpartner']);
                        $partner = $result->result;
                        $this->message = $result->message;
                    } else {
                        $this->errorMessage = $result->message;
                    }
                } catch (Exception $e) {
                    $this->errorMessage = $e->getMessage();
                }
            } else {
                try {
                    $result = $api->makeApiRequest('/admin/partner/' . $id);
                    if ($result->success) {
                        $partner = $result->result;
                    } else {
                        $this->errorMessage = $result->message;
                    }
                } catch (Exception $e) {
                    $this->errorMessage = $e->getMessage();
                }
            }
        }
        include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/partner-edit.php');
    }

    function deletePartnerPanel($id)
    {
        $api = new WideScribeAdminPluginAPI();
        if (! is_array($id)) {
            if (! empty($_POST['ws_deletepartner'])) {
                try {
                    $result = $api->makeApiRequest('/admin/partner/' . $id, array(
                        'http_method' => 'DELETE'
                    ));
                    if ($result->success) {
                        $this->message = $result->message;
                    } else {
                        $this->errorMessage = $result->message;
                    }
                } catch (Exception $e) {
                    $this->errorMessage = $e->getMessage();
                }
            } else {
                try {
                    $result = $api->makeApiRequest('/admin/partner/' . $id);
                    if ($result->success) {
                        $partner = $result->result;
                    } else {
                        $this->errorMessage = $result->message;
                    }
                } catch (Exception $e) {
                    $this->errorMessage = $e->getMessage();
                }
            }
        } else {
            $this->errorMessage = 'Sorry Bulk Action Not yet Supported!';
        }
        include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/partner-delete.php');
    }

    function addNewPartnerPanel()
    {
        if (! empty($_POST['ws_createpartner']) && ! empty($_POST['partner'])) {
            $api = new WideScribeAdminPluginAPI();
            $newPartner = $_POST['partner'];
            try {
                $result = $api->makeApiRequest('/admin/partner', array(
                    'data' => json_encode($newPartner)
                ));
                if ($result->success) {
                    $partner = $result->result;
                    $this->message = $result->message;
                    include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/partner-detail.php');
                    return;
                } else {
                    $this->errorMessage = $result->message;
                }
            } catch (Exception $e) {
                $this->errorMessage = $e->getMessage();
            }
        }
        include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/partner-new.php');
    }

    function statisticsPanel()
    {
        include_once (WP_PLUGIN_DIR . '/' . $this->plugin->name . '/author/views/statistics.php');
    }

    function adminPageTitle($admin_title, $title)
    {
        $screen = get_current_screen();
        if ($screen->id == $this->plugin->pages['all_sites_page'] && ! empty($_GET['action'])) {
            $pos = strpos($admin_title, $title);
            if ($pos !== false) {
                $oldTitle = $title;
                switch ($_GET['action']) {
                    case 'edit':
                        $title = 'Update Partner';
                        break;
                    case 'delete':
                        $title = 'Delete Partner';
                        break;
                }
                $admin_title = substr_replace($admin_title, $title, $pos, strlen($oldTitle));
            }
        }
        return $admin_title;
    }

    function selectInputOptions($options = array(), $selected = false)
    {
        foreach ($options as $value => $label) {
            if ($selected == $value)
                $p = "\n\t<option selected='selected' value='" . esc_attr($value) . "'>$label</option>";
            else
                $r .= "\n\t<option value='" . esc_attr($value) . "'>$label</option>";
        }
        echo $p . $r;
    }
}