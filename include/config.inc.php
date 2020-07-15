<?php

$DBSERVER = "localhost";
$DATABASENAME = "rwjonesp_rwjonesplumbing";
$USERNAME = "root";
$PASSWORD = "";
$SITE_NAME = "Etoile CMS";
$SITE_URL = "http://etoile-cms.test/";
$SECURE_URL = "https://etoile-cms.test/";
$TOP_COMPARE_URL = "";
$META_DESC = "etoile-cms.test";
$META_KEYWORD = "etoile-cms.test";
$META_ContentOwner = "etoile-cms.test";
$SiteEnCriptId = "etoile-cms.test";

define( 'SITE_URL', $SITE_URL );
define( 'SITE_ADMIN_URL', $SITE_URL . 'siteadmin');
define( 'SITE_NAME', $SITE_NAME );
define( 'DB_SERVER', $DBSERVER );
define( 'DB_NAME', $DATABASENAME );
define( 'DB_USERNAME', $USERNAME );
define( 'DB_PASSWORD', $PASSWORD );

function getBaseUrl() {
    $currentPath = $_SERVER['PHP_SELF']; 
    $pathInfo = pathinfo($currentPath); 
    $hostName = $_SERVER['HTTP_HOST']; 
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
    return $protocol.'://'.$hostName.$pathInfo['dirname'];
}

define( 'BASE_URL', getBaseUrl() );
define( 'BASE_ADMIN_URL', getBaseUrl());
