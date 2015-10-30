<?php

date_default_timezone_set('America/Los_Angeles');

define('DEBUG',  TRUE);
define('APP_ROOT',  __DIR__ . '/..');
define('REPO_ROOT',  APP_ROOT . '/..');
define('CREDENTIALS_PATH', REPO_ROOT . '/credentials');
define('APPLICATION_NAME', 'Bahai Community Website');
define('CREDENTIALS_FILE', CREDENTIALS_PATH . '/credentials.json');
define('CLIENT_SECRET_FILE', CREDENTIALS_PATH . '/client_secret.json');
define('SCOPES', implode(' ', array(
        \Google_Service_Calendar::CALENDAR_READONLY)
));