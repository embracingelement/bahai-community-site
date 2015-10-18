<?php

define('APP_ROOT',  __DIR__ . '/../..');
define('APP_CONTAINER_ROOT',APP_ROOT . '/..');
define('APP_CREDENTIALS_PATH',APP_CONTAINER_ROOT . '/credentials');
define('APPLICATION_NAME', 'Bahai Community Website');
define('CREDENTIALS_FILE', APP_CREDENTIALS_PATH . '/credentials.json');
define('CLIENT_SECRET_FILE', APP_CREDENTIALS_PATH . '/client_secret.json');
define('SCOPES', implode(' ', array(
        \Google_Service_Calendar::CALENDAR_READONLY)
));