<?php

use BCS\BahaiCommunitySiteApp;

require '../vendor/autoload.php';
require '../app/Config/Definitions.php';

$app = new BahaiCommunitySiteApp();
$calendarService = $app->getCalendarService();
$eventView = $app->getEventView();
echo "<pre>";
print_r($calendarService->getCurrentCalendars());

?>
<html>

<head></head>
    <body>

   <h1>Success!</h1>
    <ul class="upcoming">

    </ul>
    </body>

</html>
