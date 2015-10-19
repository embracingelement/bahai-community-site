<?php

namespace BCS;

use Calendar\CalendarClient;
use Calendar\CalendarService;
use Calendar\Event\EventAggregator;
use Calendar\Event\EventView;
use Config\Twig;

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
    private $eventAggregator;

    function __construct(){
        $twig = new Twig();
        $this->calendarClient = new CalendarClient();
        $this->calendarService = new CalendarService($this->calendarClient);
        $this->eventView = new EventView($twig->getTwig());
        $this->eventAggregator = new EventAggregator();
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