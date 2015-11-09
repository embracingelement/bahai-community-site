<?php
namespace Calendar;
use Calendar\Event\Event;
use Google_Service_Calendar;
use Google_Service_Calendar_CalendarListEntry;
use Google_Service_Calendar_Event;
use FastCache\FastCache;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 5:39 PM
 */

class CalendarService {
    private $googleService;
    private $client;
    private $cache;

    function __construct(CalendarClient $client){
        $this->client = $client;
        $this->googleService = new Google_Service_Calendar($client->getGoogleClient());
        $this->cache = FastCache::file(strtotime('+1 minute'));
    }

    function getAndGroupCalendarsByType($calendars){
        $calendarMap = [];
        /** @var Calendar $calendar */
        foreach($calendars as $calendar){
            $baseGroup = $calendar->getType();

            if(!array_key_exists($baseGroup,$calendarMap)){
                $calendarMap[$baseGroup] = [];
            }

            $events = $this->getUpcomingEvents($calendar);

            /** @var Event $event */
            foreach($events as $event){
                $neighborhood = explode(",",$event->getLocation())[0];

                if(!array_key_exists($neighborhood,$calendarMap[$baseGroup])){
                    $calendarMap[$baseGroup][$neighborhood] = [
                        "neighborhood"=>$neighborhood,
                        "name"=>$event->getLocation(),
                        "id"=> $event->getLocationId(),
                        "events"=>[]
                    ];
                }
                array_push($calendarMap[$baseGroup][$neighborhood]["events"], $event);
            }
        }

        foreach($calendarMap as $type => $calendarType){
            ksort($calendarMap[$type]);

            foreach($calendarMap[$type] as $location => $locationObj){
                $calendarMap[$type][$location]["events"] = $this->sortEventsByDate($locationObj["events"]);
            }
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
        $events = $this->cache->get($calendar->getId());

        if(is_null($events)) {

            $optParams = array(
                'maxResults' => 10,
                'orderBy' => 'startTime',
                'singleEvents' => TRUE,
                'timeMin' => date('c')
            );

            $options = array_merge($optParams, $options);

            $results = $this->googleService->events->listEvents($calendar->getId(), $options);

            $events = [];

            foreach ($results->getItems() as $googleEvent) {
                array_push($events, $this->createEventFromGoogleEvent($googleEvent));
            }

            $this->cache->set($calendar->getId(), $events);
        }

        return $events;
    }

    function getUpcomingEventsBasic($calendarId){
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
        );

        return $this->googleService->events->listEvents($calendarId, $optParams);
    }

    /**
     * @param Google_Service_Calendar_Event $googleEvent
     * @return Event
     */
    function createEventFromGoogleEvent(Google_Service_Calendar_Event $googleEvent){
        $start = $googleEvent->getStart()->dateTime;
        if (empty($start)) {
            $start = $googleEvent->getStart()->date;
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