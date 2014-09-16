<?php

/**
 * V X L P A Y Wordpress Plugin
 *
 * @package   VXLPAY post Class
 * @author    jens@vxlpay.com <jens@vxlpay.com>
 * @license   GPL-2.0+
 * @link      http://www.vxlpay.com
 * @copyright 2014 VXLPAY AS
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * Public facing functionality is available in the ClassVxlpayPlugin.php
 *
 *
 * @package vxlpay
 * @author  Jens Tandstad <jens@vxlpay.com>
 */

define( 'vxlApi' ,  'https://vxlpay.appspotlocal.com/wp/');
define( 'VXLPAY_FAVICON', 'https://vxlpay.appspotlocal.com/wp/favicon.ico' );
class VxlpayWpPost {
   
    static function vxlcURL($route, $fields) {
        $url = vxlApi . $route;
      
        
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
            VxlpayWpPost::error("VxlpayWpPost.vxlcURL", $errorMessage );
            $result = new StdClass();
            $result->status = 'WideScribe API returned empty result '.$errorMessage;
            curl_close($ch);
            return $result;
        }
         
        curl_close($ch);
        print $result;
        $ro =  json_decode(utf8_encode($result));
        
        if ($ro) {
           
            return $ro;
        }
        else{
            $errorMessage = "ERROR CURL:  , the response was not parsable json. Got : ( ".json_encode($ro)." )";
            VxlpayWpPost::error("VxlpayWpPost.vxlcURL", $errorMessage );
            return $errorMessage;
        }
       
    }

    static function testVXLconnection() {
        $secret = sha1(get_option('vxl_sharedSecret').'randomNonce');
        $partnerId = get_option('vxl_partnerId');
        
        if (!isset($secret)) {
            $errorMessage =  "ERROR : Was unable to register secret option when attemtping to store $postId to vxlpay. The post will not be possible to charge using vxlpay and will be handed out for free";
           
            VxlpayWpPost::error("VxlpayWpPost.testVXLconnection", $errorMessage );
            return  $errorMessage;
        }
        
        if (!isset($partnerId)) {
            $errorMessaage = "ERROR : Was unable to register shared secret option from database when attempting to store $postId to vxlpay. The post will not be possible to charge using vxlpay and will be handed out for free";
           
            VxlpayWpPost::error("VxlpayWpPost.testVXLconnection", $errorMessage );
            return  $errorMessage;
   
        }
     
       $wpId = 234;
      
        $fields = array(
            'wpId'  => $wpId,
            'partnerId' => $partnerId,
            'secret' => $secret,
            'nonce' => 'randomNonce'
        );
        

        $ro = VxlpayWpPost::vxlcURL('test', $fields);

        if ($ro == false) {

            $errorMessage = 'ERROR CURL : Curl returned empty object' . json_encode($ro);
            VxlpayWpPost::error("VxlpayWpPost.testVXLconnection", $errorMessage);
            return $errorMessage;;
        }
        if (!is_object($ro)) {
          
            $errorMessage = 'ERROR CURL : The response was not valid json, got ' . $ro;
            VxlpayWpPost::error("VxlpayWpPost.testVXLconnection", $errorMessage);
            return $errorMessage;
        }

        if (!array_key_exists('status', $ro)) {
            $errorMessage = "ERROR : The cURL attempt did not contain the required 'status' variable. : ".json_encode($ro);
            VxlpayWpPost::error("VxlpayWpPost.testVXLconnection", $errorMessage);

            return $errorMessage;
        }
        
        if ($ro->status != 'success') {
            $errorMessage = "ERROR : " . $ro->status . ". ";
            
            VxlpayWpPost::error('VxlpayWpPost.testVXLconnection', $errorMessage);

            return $errorMessage;
        }
        
        VxlpayWpPost::log('VxlpayWpPost.testVXLconnection', "Successfully negotiated connection with vxlpay");
        
        return __('Connection to vxlpay successful', 'vxlpay');
    }

   

    static function error($funcName, $message, $data = null) {
        global $wpdb;

        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        if (!isset($message)) {
            $message = 'unset';
        }
        $wpdb->insert($wpdb->prefix . 'vxlpay_error', array("context" => 'admin', "funcName" => $funcName, "message" => $message, "data" => $data));
        return true;
    }

    static function log($funcName, $message, $data = null) {

        global $wpdb;

        //  print $funcname . " - " . $message . " - " . $data;
        if (!isset($data)) {
            $data = 'unset';
        }
        if (!isset($message)) {
            $message = 'unset';
        }

        $wpdb->insert($wpdb->prefix . 'vxlpay_log', array("context" => 'admin', "funcName" => $funcName, "message" => $message, "data" => $data));

        return true;
    }
    
    static function doAction($vxlAction){
        
        //return VxlpayWpPost::testVXLconnection();
    
        switch ($vxlAction) {
        // This is a request to forward a call to the vxlpay API with a new user
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
                   
                   
                  $ro = VxlpayWpPost::vxlcURL('voucher', $fields);
                  print_r($ro);
                  if(! is_object($ro)){
                     return __('The request to the WideScribe API did not return an object', 'vxlpay');
                  }

                  return __($ro->status, 'vxlpay');

            break;
            default:
               return  __('Invalid vxlpay admin action selected', 'vxlpay');
            break;
        }
    }
        
}
