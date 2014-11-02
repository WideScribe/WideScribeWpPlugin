<?php

/*  Portal Class
 * 
 * ORM table : Portal
 * 
 * This is an object mapping of the Portal table with additional methods.
 * 
 * Notably functions
 * 
 * The Portal class decides which menus are avaiable to the user (this is for
 * enabling customization of the menus for individual Portals).
 * It contains static methods for looking up Portals using root domain of
 * an http referer string, useful when the contentObj was not found.
 * 
 * It keeps the initKey, publicKey and privateKey which is used to validate curl calls between
 * wordpress admin plugin parter portal site and the admin/* functionality.
 * 
 */

global $conn;

class Portal {

    public $id;
    public $portalName;
    public $domain;
    public $initKey;
    public $publicKey;
    public $privateKey;

    function __construct($id) {
        global $conn;

        $sql = 'SELECT id, portalName, domain, initKey, publicKey, privateKey FROM Portal where id = ?';


        if (!$conn) {
            VXLgate::error('Portal.__CONSTRUCT ', 'Connection failed', '');
            return false;
        }

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            VXLgate::error('Portal.__CONSTRUCT', 'Wrong SQL: ' . $sql . ' Error: ' . $conn->error, $this->id);
            return false;
        }
        
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $stmt->bind_result($this->id, $this->portalName, $this->domain, $this->initKey, $this->publicKey, $this->privateKey);

        if ($stmt->store_result()) {
            $stmt->fetch();
            if ($stmt->num_rows == 1) {
                return true;
            } else {
                VXLgate::error('Portal.__CONSTRUCT', 'Portal not found or > 1 found :, for PortalId (' . $id . ') got num rows : (' . $stmt->num_rows . '). SQL: ' . $sql, $stmt->error);
                return false;
            }
        } else {
            VXLgate::error('Portal.__CONSTRUCT', 'mysqli::store_result()     failed for ' . $sql, $stmt->error);
            return false;
        }
    }
    public static function getPortalByDomain($domain) {
        global $conn;
        $id = null;
        if (!$conn) {
            $conn = VXLgate::getConn();
            VXLgate::log('Portal.getPortalByDomain ', 'Connection failed', 'Attempting to recover bet VXLgate::getConn()');
            return false;
        }
        VXLgate::log('Portal.getPortalByDomain', 'Looking up  ' . $domain);
    
    
        $sql = 'SELECT id FROM portal where domain = ?';
    
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            VXLgate::error('Portal.getPortalByDomain', 'Wrong SQL: ' . $sql . ' Error: ' . $conn->error, $domain);
            return false;
        }
        $stmt->bind_param('s', $domain);
        $stmt->execute();
    
        $stmt->bind_result($id);
    
        if ($stmt->store_result()) {
    
            if ($stmt->num_rows == 1) {
                $stmt->fetch();
                if (!empty($id)) {
                    return new Portal($id);   
                } else {
                    VXLgate::error('Portal.getPortalByDomain', 'Portal not found, for domain ' . $domain . 'actually ' . $stmt->num_rows . '. SQL: ' . $sql, $stmt->error);
                    return false;
                }
            } else {
                VXLgate::error('Portal.getPortalByDomain', 'Portal not found or > 1 found - Got a result where num rows were not 1, for domain ' . $domain . 'actually ' . $stmt->num_rows . '. SQL: ' . $sql, $stmt->error);
                return false;
            }
        } else {
            VXLgate::error('Portal.getPortalByDomain', 'Store result failed for ' . $sql, $stmt->error);
            return false;
        }
        return false;
    }
    
    function save($context = 'Admin API') {
        global $conn;
        if (!$conn) {
            VXLgate::error('Portal.save', 'Connection failed', '');
            return false;
        }
        $sql = 'UPDATE portal SET portalName = ?, domain = ?, initKey = ?,  publicKey = ?, privateKey = ? WHERE id = ?';
        $stmt = $conn->prepare($sql);
    
        if ($stmt->error) {
            VXLgate::error('Portal.save', 'Error preparing SQL statement', '');
        }
        $stmt->bind_param('sssssi', $this->portalName, $this->domain, $this->initKey, $this->publicKey, $this->privateKey, $this->id);
    
        $stmt->execute();
    
        $stmt->store_result();
        if ($stmt->error) {
            VXLgate::error('Portal.save', 'Unable to persist the partner object ' . $stmt->error, $context);
            $stmt->close();
            return false;
        } else {
            VXLgate::log('Portal.save', 'Sucessfully saved partner object ' . $stmt->error, $context);
            return true;
        }
    }
    
}

?>