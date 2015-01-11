<?php
/**
 * @author yoyoncahyono
 * WidescribeAdminPlugin API client
 * its hadle curl request, initialization and 
 * setup API request authroization header
 */
class WideScribeAdminPluginAPI
{
    private $_apiUrl;
    private $_portalId;
    private $_publicKey;
    private $_privateKey;
    /**
     * contruct the object with defined/predefined API header parameter 
     * @param string $apiUrl
     * @param string $portalId
     * @param string $publicKey
     * @param string $privateKey
     */
    public function __construct($apiUrl = null, $portalId = null, $publicKey = null, $privateKey = null) {
        $this->plugin = new stdClass;
        $this->plugin->name = 'widescribe-admin';
        $this->_apiUrl = empty($apiUrl)?esc_url( get_option($this->plugin->name.'_api_url')):$apiUrl;
        $this->_portalId = empty($portalId)?esc_url( home_url( '/' )):$portalId;
        $this->_publicKey = empty($publicKey)?esc_attr( get_option($this->plugin->name.'_public_key')):$publicKey;
        $this->_privateKey = empty($privateKey)?esc_attr( get_option($this->plugin->name.'_private_key')):$privateKey;
        
        // Load admin style sheet and JavaScript.
          add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));
          add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    protected function makeRequest($route, $options = array(), $parseJson = true, $expectedResponseCode = array(200))
    {
        $url = $this->_apiUrl . trim($route,'/');
        $ch = $this->initRequest($url, $options);
        $result = curl_exec($ch);
        $headers = curl_getinfo($ch);
        if (curl_errno($ch) > 0) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);
        if (! in_array($headers['http_code'], $expectedResponseCode)) {
            $errorMessage = 'Invalid response http code: ' . $headers['http_code'] . '.' . PHP_EOL . 'URL: ' . $url . PHP_EOL . 'Options: ' . var_export($options, true) . PHP_EOL . 'Result: ' . $result;
            //$errorMessage = 'Invalid response http code: ' . $headers['http_code'];
            throw new Exception($errorMessage);
        }
        if ($parseJson) {
            $result = $this->parseJson($result);
        }
        return $result;
    }

    protected function initRequest($url, $options = array())
    {
        $ch = curl_init();
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // error with open_basedir or safe mode
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        
        if (isset($options['referer'])) {
            curl_setopt($ch, CURLOPT_REFERER, $options['referer']);
        }
        
        if (isset($options['headers'])) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $options['headers']);
        }
        
        if (isset($options['query'])) {
            $url_parts = parse_url($url);
            if (isset($url_parts['query'])) {
                $query = $url_parts['query'];
                if (strlen($query) > 0) {
                    $query .= '&';
                }
                $query .= http_build_query($options['query']);
                $url = str_replace($url_parts['query'], $query, $url);
            } else {
                $url_parts['query'] = $options['query'];
                $new_query = http_build_query($url_parts['query']);
                $url .= '?' . $new_query;
            }
        }
        
        if (isset($options['data'])) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['data']);
        }
        
        if (isset($options['http_method'])) {
            switch (strtoupper($options['http_method'])) {
                case 'POST':
                    if (! isset($options['data'])) {
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, array());
                    }
                    break;
                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    ;
                    break;
            }
        }
        
        curl_setopt($ch, CURLOPT_URL, $url);
        return $ch;
    }

    protected function parseJson($response)
    {
        $result = json_decode($response);
        if ($result) {
            return $result;
        } else {
            throw new Exception('Invalid response format'.$response);
        }
    }
    
    public function initializePortalRequest($bearer) {
        $options = array(
            'headers' => array('Portal-Id: '.$this->_portalId, 'X-Auth: Bearer '.$bearer),
            'http_method' => 'post'
        );
        return $this->makeRequest('/admin/init', $options);
    }
    public function makeApiRequest($route, $options = array(), $parseJson = true, $expectedResponseCode = array(200,401)) {
        $contentHash = hash_hmac('sha256', @$options['data'], $this->_privateKey);
        $options['headers'] = array('Portal-Id: '.$this->_portalId, 'Client-Id: '.get_current_user_id(), 'X-Public: '.$this->_publicKey, 'X-Hash: '.$contentHash);
        return $this->makeRequest($route, $options, $parseJson, $expectedResponseCode);
    }
}
