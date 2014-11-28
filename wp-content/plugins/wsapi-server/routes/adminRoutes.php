<?php
/*
 * Admin Routes
 * Endpoint for receiving REST calls to Partner Portal admin interfaces.
 * URL calls can be made to these routes to get/post/delete JSON data for parner portal related calls
 */

/*
 * isValidRequest
 * a function to validate the API request
 * use validation agaist portalId, publicKey and
 * request payload hash_hmac based portal's private key
 * 
 */
function isValidRequest()
{
    global $app, $conn;
    $portalId = $app->request->headers('Portal-Id');
    $ppDomain = parse_url($portalId);
    $ppDomain = @$ppDomain['host'];
    $publicKey = $app->request->headers('X-Public');
    $contentHash = $app->request->headers('X-Hash');
    $portal = Portal::getPortalByDomain($ppDomain);
    if (! empty($portal) && $portal->publicKey == $publicKey) {
        $content = $app->request->getBody();
        $hash = hash_hmac('sha256', $content, $portal->privateKey);
        if ($hash === $contentHash) {
            return true;
        }
    }
    $result = array(
        'success' => false,
        'error' => 'UNAUTHORIZED',
        'message' => 'Invalid Request (portal not authorized/request hash check failed). Check your portal and key settings.'
    );
    $app->response->status(401);
    $app->response->setBody(json_encode($result));
    return false;
}



/*
 * admin/test
 *
 * This route is called to test the API endpoint connection
 *
 */
$app->get('/admin/test', function () use($app)
{
    $result = array(
        'success' => true,
        'message' => 'Connection Success'
    );
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($result));
});

/*
 * admin/init
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * Initialize partner portal authorization API call
 * It authenticate the portalId and initKey agaist "portal" table data
 * then return publicKey and privateKey that will be used on admin/partner 
 * based API authentication call
 * 
 */
$app->post('/admin/init', function () use($app)
{
    global $conn;
    $portalId = $app->request->headers('Portal-Id');
    $ppDomain = parse_url($portalId);
    $ppDomain = @$ppDomain['host'];
    $authorization = $app->request->headers('Authorization');
    $ppInitKey = $bearer = str_replace('Bearer ', '', $authorization);
    $portal = Portal::getPortalByDomain($ppDomain);
    if (! empty($portal)) {
        VXLgate::log('/admin/init', 'Initkey is'.$portal->initKey, json_encode($portal));
        if (!$portal->publicKey) {
            $result = array(
                'success' => false,
                'message' => 'Partner Portal Already Initialized',
                'error' => 'PORTAL_INIT_ERROR'
            );
        } else 
            if (! empty($portal->initKey) && $portal->initKey === $ppInitKey) {
                $publicKey = bin2hex(mcrypt_create_iv(128, MCRYPT_DEV_URANDOM));
                $privateKey = bin2hex(mcrypt_create_iv(128, MCRYPT_DEV_URANDOM));
                $keys = array(
                    'publicKey' => $publicKey,
                    'privateKey' => $privateKey
                );
                // $portal->initKey = null;
                $portal->publicKey = $publicKey;
                $portal->privateKey = $privateKey;
                if ($portal->save()) {
                    $result = array(
                        'success' => true,
                        'message' => 'Partner Portal Initialized',
                        'result' => $keys
                    );
                } else {
                    $result = array(
                        'success' => false,
                        'message' => 'Error Initializing Portal',
                        'error' => 'PORTAL_INIT_FAIL'
                    );
                }
            } else {
                $result = array(
                    'success' => false,
                    'message' => 'Invalid Partner Portal Initialization',
                    'error' => 'PORTAL_INIT_ERROR'
                );
            }
    } else {
        $result = array(
            'success' => false,
            'message' => 'Partner Portal not found',
            'error' => 'PORTAL_NOT_FOUND'
        );
    }
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($result));
});

/*
 * admin/partner GET
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * List partner API call based on ClientId
 * return list of clientId's partners
 *
 */
$app->get('/admin/partner', function () use($app)
{
    global $conn;
    $app->response->headers->set('Content-Type', 'application/json');
    if (isValidRequest()) {
        $clientId = $app->request->headers('Client-Id');
        $partners = Partner::all($clientId);
        if ($partners !== false) {
            $result = array(
                'success' => true,
                'message' => 'List of '.$clientId.' partners',
                'result' => $partners
            );
        } else {
            $result = array(
                'success' => false,
                'error' => 'PARTNER_LIST_FAIL',
                'message' => 'There is an issue listing the Partners'
            );
        }
        $app->response->setBody(json_encode($result));
    }
});

/*
 * admin/partner POST
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * Create partner API call
 * return newly created partner of the clientId
 *
 */
$app->post('/admin/partner', function () use($app)
{
    global $conn;
    $app->response->headers->set('Content-Type', 'application/json');
    if (isValidRequest()) {
        $clientId = $app->request->headers('Client-Id');
        $partner = new Partner();
        $body = $app->request->getBody();
        $data = json_decode($body,false);
        $partner->wsOwnerId = $clientId;
        $partner->partnerName = $data->partnerName;
        $partner->languageId = $data->languageId;
        $partner->domain = $data->domain;
        $partner->logosrc = $data->logosrc;
        $partner->defaultCost = $data->defaultCost;
        $partner->wordpressPage = @$data->wordpressPage;
        $partner->defaultCurrencyCode = $data->defaultCurrencyCode;
        
        $partner->balance = !empty($data->balance)?$data->balance:0;
        $partner->anonCompensation = !empty($data->anonCompensation)?$data->anonCompensation:0;
        $partner->emailCompensation = !empty($data->emailCompensation)?$data->emailCompensation:0;
        $partner->rootDomain = !empty($data->rootDomain)?$data->rootDomain:$data->domain;
        if($partner->save()){
            $result = array(
                'success' => true,
                'message' => 'Partner have been created successfuly. Please write down the secret key on safe place.',
                'result' => get_object_vars($partner)
            );
            $result['result']['secret'] = $partner->getSecret();
        } else {
            $result = array(
                'success' => false,
                'error' => 'PARTNER_CREATE_FAIL',
                'message' => 'There is an issue creating the Partner'
            );
        }
        $app->response->setBody(json_encode($result));
    }
});

/*
 * admin/partner/[partnerId] GET
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * Fetch partner of a specific partnerId API
 * return existing partner
 *
 */
$app->get('/admin/partner/:id', function ($id) use($app)
{
    global $conn;
    $app->response->headers->set('Content-Type', 'application/json');
    if (isValidRequest()) {
        $clientId = $app->request->headers('Client-Id');
        $partner = Partner::getByParterId($id, $clientId);
        if ($partner !== false) {
            $result = array(
                'success' => true,
                'message' => 'Attributes of partner '.$clientId,
                'result' => get_object_vars($partner)
            );
            $result['result']['secret'] = $partner->getSecret();
        } else {
            $result = array(
                'success' => false,
                'error' => 'PARTNER_GET_FAIL',
                'message' => 'Partner not found'
            );
        }
        $app->response->setBody(json_encode($result));
    }
});

/*
 * admin/partner/[partnerId] POST
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * Update partner of a specific partnerId API
 * return updated partner
 *
 */
$app->post('/admin/partner/:id', function ($id) use($app)
{
    global $conn;
    $app->response->headers->set('Content-Type', 'application/json');
    if (isValidRequest()) {
        $clientId = $app->request->headers('Client-Id');
        $partner = Partner::getByParterId($id, $clientId);
        if ($partner !== false) {
            $body = $app->request->getBody();
            $data = json_decode($body,false);
            
            $partner->partnerName = $data->partnerName;
            $partner->languageId = $data->languageId;
            $partner->domain = $data->domain;
            $partner->logosrc = $data->logosrc;
            $partner->defaultCost = $data->defaultCost;
            $partner->wordpressPage = @$data->wordpressPage;
            $partner->defaultCurrencyCode = $data->defaultCurrencyCode;
            
            if($partner->save()){
                $result = array(
                    'success' => true,
                    'message' => 'Partner have been updated successfuly',
                    'result' => get_object_vars($partner)
                );
            } else {
                $result = array(
                    'success' => false,
                    'error' => 'PARTNER_UPDATE_FAIL',
                    'message' => 'There is an issue updating the Partner',
                    'result' => get_object_vars($partner)
                );
            }
            $result['result']['secret'] = $partner->getSecret();
        } else {
            $result = array(
                'success' => false,
                'error' => 'PARTNER_UPDATE_FAIL',
                'message' => 'Partner not found'
            );
        }
        $app->response->setBody(json_encode($result));
    }
});

/*
 * admin/partner/[partnerId] DELETE
 *
 * This route is called from a wordpress enabled partner portal admin plugin.
 * Delete partner of a specific partnerId API
 * return delete status
 *
 */
$app->delete('/admin/partner/:id', function ($id) use($app)
{
    global $conn;
    $app->response->headers->set('Content-Type', 'application/json');
    if (isValidRequest()) {
        $clientId = $app->request->headers('Client-Id');
        $partner = Partner::getByParterId($id, $clientId);
        if ($partner !== false) {
            if($partner->delete()){
                $result = array(
                    'success' => true,
                    'message' => 'Partner have been deleted successfuly'
                );
                $result['result']['secret'] = $partner->getSecret();
            } else {
                $result = array(
                    'success' => false,
                    'error' => 'PARTNER_DELETE_FAIL',
                    'message' => 'There is an issue deleting the Partner'
                );
            }
        } else {
            $result = array(
                'success' => false,
                'error' => 'PARTNER_DELETE_FAIL',
                'message' => 'Partner not found'
            );
        }
        $app->response->setBody(json_encode($result));
    }
});
?>