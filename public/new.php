<?php


require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/Config/Definitions.php';

use Calendar\CalendarClient;

$calendarClient = new CalendarClient();

$calendarService = new Google_Service_Calendar($calendarClient->getGoogleClient());

print_r(json_encode($calendarService->calendarList->listCalendarList()->getItems(),JSON_PRETTY_PRINT));

?>