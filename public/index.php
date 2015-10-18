<?php

use BCS\BahaiCommunitySiteApp;

require '../vendor/autoload.php';
require '../app/Config/Definitions.php';

$app = new BahaiCommunitySiteApp();
$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
$events = $calendarService->getUpcomingEvents();
?>
<html>

<head></head>
    <body>

   <h1>Success!</h1>
    <ul class="upcoming">
        <?php foreach($events as $event){
           echo $eventView->getEventHTML($event);
         } ?>
    </ul>
    </body>

</html>
