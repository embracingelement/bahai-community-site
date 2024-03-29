<?php
namespace Calendar;
use ActivityType\ActivityType;
use Calendar\Event\Event;
use Google_Service_Calendar;
use Google_Service_Calendar_CalendarListEntry;
use Google_Service_Calendar_Event;
use Phpfastcache\Helper\Psr16Adapter;
use Neighborhood\Neighborhood;

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
        $this->cache = new Psr16Adapter('Files');
    }

    /**
     * @param ActivityType[] $activityTypes
     * @return ActivityType[]
     */
    function setNeighborhoods($activityTypes){
        $allActivityType = new ActivityType("All Activities");
        $allActivityType->setLetterName("A");
        $allNeighborhoodMap = [];

        /** @var Calendar $calendar */
        foreach($activityTypes as $activityType){
            $neighborhoodMap = [];

            $calendars = $activityType->getCalendars();
            foreach($calendars as $calendar){
                $events = $this->getUpcomingEvents($calendar);

                /** @var Event $event */
                foreach($events as $event){
                    $neighborhoodMap =  $this->addEventToNeighborhoodMap($event, $neighborhoodMap);
                    $allNeighborhoodMap = $this->addEventToNeighborhoodMap($event, $allNeighborhoodMap);
                }
            }

            $activityType = $this->addNeighborhoodsToActivityType($activityType, $neighborhoodMap);
        }

        $allActivityType = $this->addNeighborhoodsToActivityType($allActivityType, $allNeighborhoodMap);

        array_push($activityTypes, $allActivityType);

        return $activityTypes;
    }

    private function addNeighborhoodsToActivityType(ActivityType $activityType, $neighborhoodMap){
        ksort($neighborhoodMap);

        foreach($neighborhoodMap as $neighborhood){
            /**
             * @var Neighborhood $neighborhood
             */
            $neighborhood->setEvents(
                $this->sortEvents( $neighborhood->getEvents() )
            );
        }

        $neighborhoods = array_values($neighborhoodMap);

        $activityType->setNeighborhoods($neighborhoods);

        return $activityType;
    }

    private function addEventToNeighborhoodMap(Event $event, $neighborhoodMap){
        $neighborhoodName = explode(",",$event->getLocation())[0];


        if(!array_key_exists($neighborhoodName,$neighborhoodMap)){
            $neighborhood = new Neighborhood($neighborhoodName);
            $neighborhood->setLocation($event->getLocation());
            $neighborhoodMap[$neighborhoodName] = $neighborhood;
        }

        /**
         * @var Neighborhood $neighborhood
         */
        $neighborhood = $neighborhoodMap[$neighborhoodName];
        $neighborhoodEvents = $neighborhood->getEvents();
        array_push($neighborhoodEvents, $event);

        $neighborhood->setEvents(
            $neighborhoodEvents
        );

        return $neighborhoodMap;
    }

    public function sortEvents($events){
        $eventByDate = [];
        /** @var Event $event */
        foreach($events as $event){
            $eventByDate[$event->getStartDate()] = $event;
        }

        ksort($eventByDate);

        $events = array_values($eventByDate);

        return $this->sortByFeatured($events);
    }

    /**
     * @param Calendar[] $calendars
     * @return Event[]
     */
    public function mergeCalendarsEvents($calendars){
        /** @var Event[] $events */
        $events = [];

        /** @var Calendar $calendar */
        foreach($calendars as $calendar){
            $events = array_merge($events, $calendar->getEvents());
        }

        return $this->sortEvents($events);
    }

    function getUpcomingEvents(Calendar &$calendar, $options = array()){
        $events = $this->cache->get($this->getCalenderCacheId($calendar));

        if(is_null($events) || CACHE_BREAK_OVERRIDE) {

            $optParams = array(
                'maxResults' => 10,
                'orderBy' => 'startTime',
                'singleEvents' => TRUE,
                'timeMin' => date('c'),
                'timeMax' => date('c',strtotime('+1 month'))
            );

            $options = array_merge($optParams, $options);

            $events = [];

            try {
                $results = $this->googleService->events->listEvents($calendar->getId(), $options);

                foreach ($results->getItems() as $googleEvent) {
                    array_push($events, $this->createEventFromGoogleEvent($googleEvent));
                }
            }catch (\Exception $e){
                if(DEBUG) {
//                    pr($e);
                }
            }

            $events = $this->sortByFeatured($events);

            $this->cache->set($this->getCalenderCacheId($calendar), $events, 600);
        }

        $calendar->setEvents($events);

        return $events;
    }

    private function getCalenderCacheId(Calendar $calendar) {
        return str_replace(["{","}","(",")","/","\\","@",":"], "_", $calendar->getId());;
    }

    /**
     * @return array
     */
    function getMyCalendarsIdMap(){
        $items = $this->googleService->calendarList->listCalendarList()->getItems();
        $calendars = [];
        foreach($items as $item){
            $calendars[$item->summary] =$item->id;
        }

        return $calendars;
    }

    function getUpcomingEventsBasic($calendarId){
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
            'timeMin' => date('c'),
            'timeMax' => date('c',strtotime('+1 month'))
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
     * @param Event[] $events
     * @return Event[]
     */
    private function sortByFeatured($events){
        $featuredEvents = [];
        $otherEvents = [];

        /** @var Event $event */
        foreach($events as $event){
            if($event->isFeatured()){
                $featuredEvents[] = $event;
            }else{
                $otherEvents[] = $event;
            }
        }

        return array_merge($featuredEvents, $otherEvents);
    }


    /**
     * @return Google_Service_Calendar_CalendarListEntry[]
     */
    function getCurrentCalendars(){
        return $this->googleService->calendarList->listCalendarList()->getItems();
    }
}