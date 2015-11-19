<?php

namespace BCS;

use Calendar\CalendarClient;
use Calendar\RegisteredCalendars;
use Calendar\CalendarService;
use Calendar\Event\EventAggregator;
use Calendar\Event\EventView;
use Config\Twig;
use FastCache\FastCache;

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
    private $registeredCalendars;

    function __construct(){
        FastCache::setup(['cache.path' => APP_ROOT . '/cache']);

        $twig = new Twig();
        $this->calendarClient = new CalendarClient();
        $this->calendarService = new CalendarService($this->calendarClient);
        $this->eventView = new EventView($twig->getTwigEnvironment());
        $this->eventAggregator = new EventAggregator();
        $this->registeredCalendars = new RegisteredCalendars();
    }

    /**
     * @return CalendarService
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

    /**
     * @return RegisteredCalendars
     */
    public function getRegisteredCalendars()
    {
        return $this->registeredCalendars;
    }


}