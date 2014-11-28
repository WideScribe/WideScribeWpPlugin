<?php

/**
 * V X L P A Y Wordpress Plugin
 *
 * @package   WideScribe post Class
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


class WideScribeWpPost {
    static function createWpRequest(){
        
        try{
               if(isset($_POST['_wpnonce'])){
                   $nonce = $_POST['_wpnonce'];
               }
               else{
                   $nonce = substr(uniqid(), 0, 8);
               }
               $secret = sha1(get_option('vxl_sharedSecret').$nonce);
               if (!$secret) {
                    throw new ErrorException ("ERROR : Was unable to register secret option when attemtping to store $postId to widescribe. The post will not be possible to charge using widescribe and will be handed out for free");
               }
               $partnerId = get_option('vxl_partnerId');
               if (!$partnerId) {
                    throw new ErrorException ("ERROR : Was unable to send the partnerId for this user");
               }

                // END OF GUARD STATEMENTS
                // Route Lookup the complete post content from the wordpress database
                // Implement : Figure out the post object received here, and urlencode
                // all the text and characters.
                // $partnerID = getOption('partnerId');
                //$secret = sha1(getOption('sharedSecret'));
                // Nonce and verification
                
                return array('secret'=>$secret, 'nonce'=>$nonce, 'wp_http_referer'=>$_POST['_wp_http_referer'], 'partnerId'=>$partnerId);
                
        } catch (ErrorException $e) {
             WideScribeWpAdmin::error("widescribeAdmin.createWPRequest", $e);
           
            return $e->getMessage();
        }
        
    }
    static function vxlcURL($route, $fields, $backdoor = false) {
       
        $url = wsApi . $route;
        if($backdoor){
            $url = 'https://'.$_SERVER['HTTP_HOST'].'/widescribe/backdoor/'.$route;
        
        }
        WideScribeWpPost::log("WideScribeWpPost.vxlcURL", 'Attempting to coomunicate with the WideScribe cloud ' , json_encode($fields));
        $ch = curl_init();
        $curlConfig = array(
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => $fields,
            CURLOPT_SSL_VERIFYPEER => FALSE
        );
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        
        if ($result === false) {
            $errorMessage = "ERROR CURL:  " . curl_error($ch);
            WideScribeWpPost::error("WideScribeWpPost.vxlcURL", $errorMessage , json_encode($fields));
            
            $result = new ErrorException(
                    'WideScribe API at '.$url. ' returned empty result '.$errorMessage , 
                    808,
                    3);
          
            curl_close($ch);
            return $result;
        }
         
        curl_close($ch);
        //print $result;
        $ro =  json_decode(utf8_encode($result));
        
        if (is_object($ro)) {
            return $ro;
        }
        else{
            $errorMessage =   "ERROR CURL: The response was not parsable json (route attemtped : ".$url;
            WideScribeWpPost::error("WideScribeWpPost.vxlcURL", $errorMessage , $result);
            $result = new ErrorException(
                    $errorMessage,
                    809,
                    3);
            
               return $result;
          
        }
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

    
    static function doAction($vxlAction){
        
        //return WideScribeWpPost::testVXLconnection();
    
        switch ($vxlAction) {
        // This is a request to forward a call to the widescribe API with a new user
            case 'redeem':
                // Make a curl post call
                   $secret = sha1(get_option('vxl_sharedSecret'));
                   $partnerId = get_option('vxl_partnerId');
                   
                   $fields = array(
                        'partnerId' => $partnerId,
                        'secret' => $secret,
                        'firstname' => $_POST['firstname'],
                        'lastname' => $_POST['lastname'], 
                        'email' => $_POST['email'],
                        'voucherCode' => $_POST['voucherCode']
                    );
                   
                   
                  $ro = WideScribeWpPost::vxlcURL('/wp/voucher', $fields);
                 // print_r($ro);
                  if(! is_object($ro)){
                     return __('The request to the WideScribe API did not return an object', 'widescribe');
                  }

                  return __($ro->status, 'widescribe');

            break;
            default:
               return  __('Invalid widescribe admin action selected', 'widescribe');
            break;
        }
    }
        
}
