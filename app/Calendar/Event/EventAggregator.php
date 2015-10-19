<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/18/15
 * Time: 8:39 PM
 */

namespace Calendar\Event;


class EventAggregator {
    /**
     * @param Event[] $events
     * @return array
     */
    public function groupEventsByLocation($events){
        $groupedEvents = [];
        foreach($events as $event){
            $location = $event->getLocation();

            if(!isset($groupedEvents[$location])){
                $groupedEvents[$location] = [];
            }

            array_push($groupedEvents[$location], $event);
        }

        return $groupedEvents;
    }
}