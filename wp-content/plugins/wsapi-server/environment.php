<?php

// ENVIRONMENT SETTINGS FOR PRODUCTION

// Warning - these are environmentsettings for production.
// This file should not be commited, and should be Ignored by Version
// control. This file should be edited manually.
// If the file gets deleted or overwritten by accident - (this will happen, 
// and if it is happening to you right now - act quickly).

// The folder environments in root contains backup of environment files. 


if($_SERVER['SERVER_NAME'] == 'vxlpay.appspot.com'){
    $cloud = "CLOUD";
}
else{
    $cloud = 'LOCAL';
}

const wideScribeId = 3;
const production = false;

// Used to conncet to the CLOUD SQL server from the context of the
// GAE - this is much faster than CLOUDREMOTE, but uses the same
// database.
//sconst cloud = "CLOUDREMOTE";
 // Used to use the local instance of the MySQL
//const cloud = "CLOUDREMOTE";
// CLOUDREMOTE Used to access the GAE datastore, but run the API engine
// from a local setting. Only use when you need to test
// the API locally with actual production data.
if (getenv('CLEARDB_DATABASE_URL')){
    $url=parse_url(getenv('CLEARDB_DATABASE_URL'));
    $dbhostname = $url['host'];
    $dbusername = $url['user'];
    $dbpassword = $url['pass'];
    $dbname = substr($url['path'],1);
} else {
    $dbhostname = '127.0.0.1';
    $dbusername = 'root';
    $dbpassword = 'root';
    $dbname = 'widescribe';
}
define('DBServer', $dbhostname);
define('DBUser', $dbusername);
define('DBPass', $dbpassword);
define('DBName', $dbname);
const DBCloud = '/cloudsql/vxlpay:XXXX'; // e.g 'localhost' or '192.168.1.100'
const DBipAdress = "173.194.80.177";
const VXLROOT = "/Users/jenstandstad/GitHub/WideScribeBeta/";
const VXLdomain = 'https://widescribe.appspot.com';

?>