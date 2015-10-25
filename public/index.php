<?php

use BCS\BahaiCommunitySiteApp;

require '../vendor/autoload.php';
require '../app/Config/Definitions.php';

$app = new BahaiCommunitySiteApp();
$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
$nadiaCalendar = new \Calendar\Calendar("nadia@labahais.org");
$nadiaCalendar->setLocationTitle("LA Baha'i Center");
$nadiaCalendar->setLocation("5755 Rodeo Road, Los Angeles, CA 90016");
$events = $calendarService->getUpcomingEvents($nadiaCalendar);

?>
<html>

<head></head>
    <body>

   <h1>Success!</h1>
    <ul class="upcoming">
        <?php echo $eventView->getEventHTML($events, $nadiaCalendar); ?>
    </ul>
    </body>

</html>
