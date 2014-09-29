<?php

/**
 * V X L P A Y Wordpress Plugin
 *
 * @package   WideScribes
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://www.widescribe.com
 * @copyright 2014 widescribe AS
 */

/**
 * Plugin class. This class enables the widescribe plugin, client facing functionality.
 *
 * 
 
 *
 * @package widescribe
 * @author  Jens Tandstad <jens@widescribe.com>
 */
class WideScribeWpPlugin {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '1.0.0';

    /**
     * 
     *
     * Unique identifier for your plugin.
     *
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_slug = 'widescribe';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct() {
        $this->log = false;
        $this->error = false;
        $this->partnerName = get_option('vxl_partnerName');
        //register_setting($this->plugin->name, 'vxl_partnerName', 'trim');
        //$this->log('WideScribePLUGIN.__Construct', 'Running constructor');
        // Load plugin text domain
        add_action('init', array($this, 'load_plugin_textdomain'));

        // Activate plugin when new blog is added
        add_action('wpmu_new_blog', array($this, 'activate_new_site'));

        // Load public-facing style sheet and JavaScripts for vxl
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // These are the main actions.
        add_action('wp_head', array(&$this, 'frontendHeader'));
        add_action('wp_footer', array(&$this, 'frontendFooter'));
        
     
       
        add_filter( 'the_content', array($this, 'fltr_add_voucher_form') );
        add_filter( 'the_content', array($this, 'fltr_content_trancher') );
        
        if(isset($_POST['submit'])){
           require_once( plugin_dir_path( __FILE__ ) . '/ClassWideScribeWPPost.php' );
           $this->message =  WideScribeWPPost::doAction($_POST['vxlAction']);

        }
        
    }
    
    
    
    /**
     * Return the plugin slug.
     *
     * @since    1.0.0
     *
     * @return    Plugin slug variable.
     */
    public function get_plugin_slug() {
        return $this->plugin_slug;
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
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);

        load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');
        load_plugin_textdomain($domain, FALSE, basename(plugin_dir_path(dirname(__FILE__))) . '/languages/');
    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
         wp_enqueue_style($this->plugin_slug . '-plugin-styles', 'https://beta.widescribe.com/vxl/css/VXL.css', array(), self::VERSION);
    }
    
    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
           wp_enqueue_script($this->plugin_slug . '-VXL_check-script', 'https://beta.widescribe.com/vxl/js/VXL_apply.js', array('jquery'), self::VERSION);
           wp_enqueue_script($this->plugin_slug . '-VXL_apply-script', 'https://beta.widescribe.com/vxl/js/VXL_check.js', array('jquery'), self::VERSION);
    }

    /**
     * NOTE:  Actions are points in the execution of a page or process
     *        lifecycle that WordPress fires.
     *
     *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
     *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    1.0.0
     */
    public function action_method_name() {
        // @TODO: Define your action hook callback here
    }

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    1.0.0
     */
    public function filter_method_name() {
        // @TODO: Define your filter hook callback here
    }
    
      
   /*  fltr_add_voucher_form()
    *  Check if the page contains the short code __FORM_VOUCHER__ which triggers the 
    *  replacement of this element with the actua form
    *     */
    
    public function fltr_add_voucher_form($content){
       global $post;
       if( stripos( $content, '__FORM_VOUCHER__' ) !== false){
            str_replace('__FORM_VOUCHER__', '', $content );
            include_once(WP_PLUGIN_DIR . '/' . $this->plugin_slug . '/public/views/form.php');
       }
       return $content;
    }
    
    
   /*  fltr_content_trancher()
    *  Trancher (to cut) is the word used to cut the content to enable the vxl
    *  script to inject the remaining content when the payment has been sucessfully processed.
    *  This function looks for the vxl trancher tag (::VXL::). It uses the setting from the options, 
    *  and returns a  number of words (full sentence).
    *     */
    
    public function fltr_content_trancher($content){
        global $post;
   
        $this->log('fltr_comment_trancher', "Filter comment trancher running at ". $_SERVER['REQUEST_URI']);
        
        if(is_front_page()){
            // This is the front page, and shoud not be charged.
            print $content;
            return;
        }
       
         $free = true;
         
         $posttags = get_the_tags();
     
         if ($posttags) {
           foreach($posttags as $tag) {
              if (strpos($tag->name, 'vxl') > 0){
                           $free = false;
                           break;
                       }
                }
         }
         
        
        if($free){
            print $content;
            return;
        }
    
        $trancherAtPos = 500;
        $vxl_trancherAt = get_option('vxl_trancherAt');
     
        switch($vxl_trancherAt){
            case 'trancher_at_token':
                $trancherAtPos =  strpos($content, '::VXL::');
                if($trancherAtPos > 0){
                   $content = substr($content, 0, $trancherAtPos);
                     
                }
                else{
                    // If the ::VXL:: trancher symbol was not found, take the N first paragraphs
                    $trancherAtPos =  $this->nth_strpos($content,  100);
                 
                }
            break;
            case 'trancher_after_heading':
               $trancherAtPos =  strpos($content, '</h1>+')+4;
           
            break;
            case 'trancher_after_ingres':
                 // Switch does not ext, update option fires after switch
                 $trancherAtPos =  strpos($content, '</ingres>')+9;
                
            break;
            case 'trancher_after_150_words':
                 $trancherAtPos =  $this->nth_strpos($content,  150);
                
            break;
             case 'trancher_after_100_words':
                 $trancherAtPos =  $this->nth_strpos($content,  100);
            break;
            case 'trancher_after_50_words':
                 $trancherAtPos =  $this->nth_strpos($content, 50);
            break;
            case 'trancher_after_20_words':
                 $trancherAtPos =  $this->nth_strpos($content,  20);
            break;
            case 'trancher_after_0_words':
                 $trancherAtPos =  $this->nth_strpos($content,  0);
            break;
            default:
                 $trancherAtPos =  $this->nth_strpos($content,  100);
            break;

        }
       
        
        if($trancherAtPos < strlen($content)){
           $content = substr($content, 0, $trancherAtPos).$this->addVxlFooter();
        }
        
	print  '<div id="trancher_inject">'.$content.'</div>';
    }
    
    /* getNextParagrah
     * 
     * Returns the character position of the Nth paragprah ending (+4). 
     * 
     *  */
    
    function getNextParagraph($string, $paragraphs, $depth, $offset){
        $parEnd = strpos($string, '</p>', $offset)+$offset;
       
        if($paragraphs > $depth){
            $parEnd = $this->getNextParagraph($string, $paragraphs, $depth+1, $parEnd);
        }
        return $parEnd;
    }
   
   // nth_strpos
   // Return the position which is occupied by the first punctuation mark
   // ocurring after N number of space characters..
    
   function nth_strpos($str, $n)
    {
      
        $ct = 0;
        $pos = 0;
        $s = ' ';
        while (($pos = strpos($str, $s, $pos)) !== false) {
          
            if ($ct >= $n) {
           
                if($s == '.'){
                    return $pos+1;
                }
                else{
                    $s = '.';
                }
            }
            $ct++;
            $pos++;
        }
        return 0;
    }  

   
    
     /*  addVxlFooter()
      *  This adds a vxl footer to a page, enabling the user to click to pay to see the rest
      *  Depending on the default behaviour of the system, this might be where the actual payment is
      *  done. if the autopay option is turned on, the user pays when entering the article.
      */
    function addVxlFooter(){
        $this->log('fltr_comment_trancher', "Filter addVXLfooter running");
        return '<br>This is appended to the end of tranchered article in wordpress';
    }
   

	/**
	* Constructor
	*/
	
	
	/**
	* Register Settings
	*/
	function registerSettings() {
		register_setting($this->plugin->name, 'vxl_insert_header', 'trim');
		register_setting($this->plugin->name, 'vxl_insert_footer', 'trim');
	}
	
	/**
    * Register the plugin settings panel
    */
   
     
    
    
        /**
	* Loads plugin textdomain
	*/
	function loadLanguageFiles() {
		load_plugin_textdomain($this->plugin->name, false, $this->plugin->name.'/languages/');
	}
	
	/**
	* Outputs script / CSS to the frontend header
	*/
        
        static function getTrinket($type){
           
            switch ($type){
                case 'type1':
             
                    return   '<div id="vxl_trinket" style="'.get_option('vxlStyle').'" onclick="vxl_getMain(event)" class="wp_trinket type1"><div class="wp_balanceText"></div></div>';
                    break;
                case 'type2':
                      return   '<div id="vxl_trinket" style="'.get_option('vxlStyle').'" onclick="vxl_getMain(event)" class="wp_trinket type2"><div class="wp_balanceText"></div></div>';
              
                break;
                case 'type3':
                   
                      return   '<div id="vxl_trinket" style="'.get_option('vxlStyle').'" onclick="vxl_getMain(event)" class="wp_trinket type3"><div class="wp_balanceText"></div></div>';
             
                break;
                default:
                      return   '<div id="vxl_trinket" style="'.get_option('vxlStyle').'" onclick="vxl_getMain(event)" class="wp_trinket type4"><div class="wp_balanceText"></div></div>';
             
                break;
            }
        }
        
	function frontendHeader() {
		
        if (is_admin() OR is_feed() OR is_robots() OR is_trackback()) {
                return;
        }

        print stripslashes('
        
            <div id="VXL_inject">
               '.WideScribeWpPlugin::getTrinket(get_option('vxlTrinketType')).'
                <div id="VXL_darken"></div>
                <div id="VXL_fs" style="display:none;">
                     <div id="VXL_header">
                    </div>
                     <div id="VXL_content">
                    </div>
                     <div id="VXL_footer">
                    </div>
                      
                </div>
            </div>');
         return;
	}
	
	/**
	* Outputs script / CSS to the frontend footer
	*/
	function frontendFooter() {
		
                if (is_admin() OR is_feed() OR is_robots() OR is_trackback()) {
                      return;
		}
             
               print stripslashes("
<script type=\"text/javascript\">
jQuery(document).ready(function($) {

window.provider = \'$this->partnerName\';
window.waitMessage = \"Just a moment, please...\";
window.live = false;
window.addEventListener(\'message\',function(event) {
    if(event.origin !== \'https://beta.widescribe.com\') return;
    window.vxltoken = event.data;},false);
});

</script>");
            return ;
	}
	
	/**
	* Outputs the given setting, if conditions are met
	*
	* @param string $setting Setting Name
	* @return output
	*/
        
        
        
	function output($setting) {
		// Ignore admin, feed, robots or trackbacks
		if (is_admin() OR is_feed() OR is_robots() OR is_trackback()) {
			return;
		}
		
		// Get meta
		$meta = get_option($setting);
		if (empty($meta)) {
			return;
		}	
		if (trim($meta) == '') {
			return;
		}
		
		// Output
		echo stripslashes($meta);
	}
       function error($funcname, $message, $data = null) {
        if(!$this->error){
            return ;
        }
        if (!$this->conn) {
            $this->conn = $this->getConn();
            if (!$this->conn) {
                return false;
            }
        }
        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        if (!isset($message)) {
            $message = 'unset';
        }
        $wpdb->insert( $wpdb->prefix.'widescribe_error', array("context"=>'public', "funcName" => $funcName, "message" => $message, "data"=>$data ));
        
        return true;
    }
    
    function log($funcName, $message, $data = null) {
        global $wpdb;
        
        if(!$this->log){
            return ;
        }
       
        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        
        if (!isset($message)) {
            $message = 'unset';
        }
        
        $wpdb->insert( $wpdb->prefix.'widescribe_log', array("context"=>'public', "funcName" => $funcName, "message" => $message, "data"=>$data ));
       
        return true;
    }
    
   
}