<?php

namespace BCS;

use Calendar\CalendarClient;
use Calendar\CalendarService;
use Calendar\Event\EventView;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 4:55 PM
 */

class BahaiCommunitySiteApp {
    private $calendarClient;
    private $calendarService;
    private $eventView;

    function __construct(){
        $this->calendarClient = new CalendarClient();
        $this->calendarService = new CalendarService($this->calendarClient);
        $this->eventView = new EventView();
    }

    /**
     * @return \Calendar\CalendarService
     */
    public function getCalendarService()
    {
        return $this->calendarService;
    }

    /**
     * @return EventView
     */
    public function getEventView()
    {
        return $this->eventView;
    }


}