<?php
namespace Calendar;
use Calendar\Event\Event;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:39 PM
 */

class CalendarService {
    private $googleService;
    private $client;

    function __construct(CalendarClient $client){
        $this->client = $client;
        $this->googleService = new Google_Service_Calendar($client->getGoogleClient());
    }

    function getUpcomingEvents(){
        $calendarId = 'primary';
        $optParams = array(
            'maxResults' => 10,
//            'orderBy' => 'startTime',
//            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );

        $results = $this->googleService->events->listEvents($calendarId, $optParams);

        $events = [];

        foreach ($results->getItems() as $googleEvent) {
            array_push($events, $this->createEventFromGoogleEvent($googleEvent));
        }

        return $events;
    }

    function createEventFromGoogleEvent(Google_Service_Calendar_Event $googleEvent){
//        print_r("<pre>");
//        print_r($googleEvent);
        $start = $googleEvent->start->dateTime;
        if (empty($start)) {
            $start = $googleEvent->start->date;
        }

        $event = new Event();
        $event->setTitle($googleEvent->getSummary());
        $event->setStartDate($start);
        $event->setLocation($googleEvent->getLocation());
        $event->setDescription($googleEvent->getDescription());
        $event->setContactEmail($googleEvent->getCreator()->getEmail());

        return $event;
    }
}