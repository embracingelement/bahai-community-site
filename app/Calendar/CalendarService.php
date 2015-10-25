<?php
namespace Calendar;
use Calendar\Event\Event;
use Google_Service_Calendar;
use Google_Service_Calendar_CalendarListEntry;
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

    function getAndGroupCalendarsByType($calendars){
        $calendarMap = [];
        /** @var Calendar $calendar */
        foreach($calendars as $calendar){
            $mapKey = $calendar->getType();

            if(!array_key_exists($mapKey,$calendarMap)){
                $calendarMap[$mapKey] = [];
            }

            $calendarMap[$mapKey] = array_merge($calendarMap[$mapKey], $this->getUpcomingEvents($calendar));
        }

        foreach($calendarMap as $type => $events){
            $calendarMap[$type] = $this->sortEventsByDate($events);
        }

        return $calendarMap;
    }

    private function sortEventsByDate($events){
        $eventByDate = [];
        /** @var Event $event */
        foreach($events as $event){
            $eventByDate[$event->getStartDate()] = $event;
        }

        ksort($eventByDate);

        return array_values($eventByDate);
    }

    function getUpcomingEvents(Calendar $calendar, $options = array()){
        $optParams = array(
            'maxResults' => 50,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );

        $options = array_merge($optParams, $options);


        $results = $this->googleService->events->listEvents($calendar->getId(), $options);

        $events = [];

        foreach ($results->getItems() as $googleEvent) {
            array_push($events, $this->createEventFromGoogleEvent($googleEvent));
        }

        return $events;
    }

    /**
     * @param Google_Service_Calendar_Event $googleEvent
     * @return Event
     */
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


    /**
     * @return Google_Service_Calendar_CalendarListEntry[]
     */
    function getCurrentCalendars(){
        return $this->googleService->calendarList->listCalendarList()->getItems();
    }
}