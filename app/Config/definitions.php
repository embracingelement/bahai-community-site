<?php

date_default_timezone_set('America/Los_Angeles');

$cacheBreak = false;
if(
    (!empty($_REQUEST) && array_key_exists('break_cache', $_REQUEST) && $_REQUEST['break_cache'] == "true")
    ||
    (!empty($argv) && !empty($argv[1]) && $argv[1] == "break_cache")
){
    $cacheBreak = true;
}

$debug = true;
if(!empty($argv) && !empty($argv[2]) && $argv[2] == "debug_off"){
    $debug = false;
}

function pr($object){
    print_r("<pre>");
    print_r($object);
    print_r("</pre>");
}

define('DEBUG',  $debug);
define('CACHE_BREAK_OVERRIDE', $cacheBreak);
define('APP_ROOT',  __DIR__ . '/..');
define('PUBLIC_ROOT',  __DIR__ . '/../../public');
define('REPO_ROOT',  APP_ROOT . '/..');
define('CREDENTIALS_PATH', REPO_ROOT . '/credentials');
define('APPLICATION_NAME', 'Bahai Community Website');
define('CREDENTIALS_FILE', CREDENTIALS_PATH . '/credentials.json');
define('CLIENT_SECRET_FILE', CREDENTIALS_PATH . '/client_secret.json');
define('SCOPES', implode(' ', array(
        \Google_Service_Calendar::CALENDAR_READONLY)
));