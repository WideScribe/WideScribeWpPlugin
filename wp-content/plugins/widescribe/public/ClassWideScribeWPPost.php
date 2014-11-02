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
   
    static function vxlcURL($route, $fields) {
        $url = wsApi . $route;
        
        
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
            //WideScribeWpPost::error("WideScribeWpPost.vxlcURL", $errorMessage );
            $result = new ErrorException(
                    'WideScribe API at '.wAPI.$route. ' returned empty result '.$errorMessage , 
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

    static function testVXLconnection() {
        $secret = sha1(get_option('vxl_sharedSecret').'randomNonce');
        $partnerId = get_option('vxl_partnerId');
        
        if (!isset($secret)) {
            $errorMessage =  "ERROR : Was unable to register secret option when attemtping to store $postId to widescribe. The post will not be possible to charge using widescribe and will be handed out for free";
           
            WideScribeWpPost::error("WideScribeWpPost.testVXLconnection", $errorMessage );
            return  $errorMessage;
        }
        
        if (!isset($partnerId)) {
            $errorMessaage = "ERROR : Was unable to register shared secret option from database when attempting to store $postId to widescribe. The post will not be possible to charge using widescribe and will be handed out for free";
           
            WideScribeWpPost::error("WideScribeWpPost.testVXLconnection", $errorMessage );
            return  $errorMessage;
   
        }
     
        $wpId = 234;
      
        $fields = array(
            'wpId'  => $wpId,
            'partnerId' => $partnerId,
            'secret' => $secret,
            'nonce' => 'randomNonce'
        );
        
        $ro = WideScribeWpPost::vxlcURL('/wp/test', $fields);
     
        if (is_a($ro, 'ErrorException')) {
            WideScribeWpPost::error("WideScribeWpPost.testVXLconnection", $errorMessage);
            return $ro->errorMessage;
        }
        

        if (!array_key_exists('status', $ro)) {
            $errorMessage = "ERROR : The cURL attempt did not contain the required 'status' variable. : ".json_encode($ro);
            WideScribeWpPost::error("WideScribeWpPost.testVXLconnection", $errorMessage);

            return $errorMessage;
        }
        
        if ($ro->status != 'success') {
            $errorMessage = "ERROR : " . $ro->status . ". ";
            
            WideScribeWpPost::error('WideScribeWpPost.testVXLconnection', $errorMessage);

            return $errorMessage;
        }
        
        WideScribeWpPost::log('WideScribeWpPost.testVXLconnection', "Successfully negotiated connection with widescribe");
        
        return __('Connection to widescribe successful', 'widescribe');
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
                   $secret = sha1(get_option('vxl_sharedSecret').'randomNonce');
                   $partnerId = get_option('vxl_partnerId');
                   
                   $fields = array(
                        'partnerId' => $partnerId,
                        'secret' => $secret,
                        'nonce' => 'randomNonce',
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
